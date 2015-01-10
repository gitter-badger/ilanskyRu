<?php
/**
 * Created by PhpStorm.
 * User: savenkoff
 * Date: 07.10.14
 * Time: 22:50
 */
class UserController extends BaseController {
    # Просмотр своего профиля
    public function getProfile() {
        $user = Auth::user();
        if ($user == null) {
            return Redirect::route('index')->with('error','Не передан id пользователя.');
        }
        $role = $user->roles()->first();
        return View::make('frontend.users.profile',array(
            'user'  => $user,
            'role'  => $role
        ));
    }
    # Изменение своего профиля
    public function GetEditProfile() {
        $user = Auth::user();
        if ($user == null) {
            return Redirect::route('index')->with('error','Не передан id пользователя.');
        }
        return View::make('frontend.users.profile.edit',array(
            'user'  => $user
        ));
    }
    # Сохранение изменений своего профиля
    public function PostEditProfile() {
        $validation = Validator::make(Input::all(),User::getValidationEditProfile());
        if ($validation->passes()) {
            $user = Auth::user();
            /*
            echo Input::get('id');
            if ($user->id != Input::get('id'))  {
                    return Redirect::route('edit-profile')->with('error','Попытка подмены формы! Вы спалились))');
                }
            */
            $user->full_name = Input::get('full_name');
            $user->email = Input::get('email');
            $user->url = Input::get('url');
            $user->save();
            return Redirect::route('edit-profile')->with('success','Профиль успешно сохранён.');
        }
    }
    # Показать форму авторизации пользователя
    public function getLogin($redirect = null) {
        return View::make('frontend.users.login',array(
            'redirect'  => $redirect
        ));
    }
    # Обработать форму авторизации пользователя
    public function postLogin($redirect = null) {

        $validator = Validator::make(Input::all(), User::getValidationAuth());
        if ($validator->fails()) {
            return Redirect::route('user-login')->withErrors($validator);
        }
        $auth = Auth::attempt(array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        ),false);
        if (!$auth) {
            return Redirect::route('user-login')->with('error','Введёная пара логин\пароль неверна. Попробуйте снова.');
        }
        else {
            try {
                $redirect = Crypt::decrypt($redirect);
            }
            catch(Illuminate\Encryption\DecryptException $e) {
                null;
            }
            if (($redirect != Input::get('redirect')) or ($redirect == '')) {
                return Redirect::route('index')->with('success','Вы успешно авторизированы на сайте.');
            } else {
                return Redirect::route($redirect)->with('success','Вы успешно авторизированы на сайте.');
            }
        }
        #return Redirect::route('index');
    }
    # Повторный запрос письма активации
    public function getReactivate() {
        $user = Auth::user();
        if ($user->isActive) {
            return $this->getMessage('Профиль уже был активирован.');
        }
        else {
            $user->activationCode = $this->generateCode();
            $user->save();
            $user->sendActivationMail();
            return $this->getMessage('Письмо со ссылкой для активации аккаунта было успешно отправлено на адрес: '.$user->email);
        }
    }
    # Выйти из системы
    public function LogOut() {
        Auth::logout();
        return Redirect::route('index')->with('success', 'Вы успешно вышли из системы.');
    }
    # Обработать форму регистрации пользователя
    public function postRegister() {
        $validator = Validator::make(Input::all(),User::getValidationRegister());
        if ($validator->passes()) {
            $user = new User();
            $user->username         = Input::get('username');
            $user->email            = Input::get('email');
            $user->password         = Hash::make(Input::get('password'));
            $user->activationCode   = $this->generateCode();
            $user->isActive         = false;
            $user->save();

            # Присваиваем роль
            $role_user  = Role::where('lat_name', '=', 'confirmation')->first();
            $user->roles()->attach($role_user);

            # Отправляем пиьсмо с активацией
            $user->sendActivationMail();
            # Выводим сообщение
            return $this->getMessage('Регистрация почти завершена! Через пару минут, возможно раньше Вам на указанный адрес электронной придёт сообщение для подтверждения регистрации.');

            #Auth::login($user);
            #return Redirect::route('index')->with('success','Добро пожаловать на сайт, '. Auth::user()->username . '!');

        }
        else {
            return Redirect::back()->with(
                'error',
                'При регистрации возникли ошибки'
            )->withErrors($validator)->withInput();
        }
    }
    # Работа со ссылкой активации пользователя
    function getActivate() {
        $validator = Validator::make(Input::all(),User::getValidationActivationAccount());
        if ($validator->passes()) {
            $user = User::find(Input::get('UserID'));
            if (!$user) {
                return $this->getMessage('Неверная ссылка на активация аккаунта');
            }
            # Пытаемся активировать пользователя с указанным кодом
            if ($user->activate(Input::get('activationCode'))) {
                Auth::login($user);
                # Сюда надо списать изменение группы пользователя
                return $this->getMessage('Аккаунт успешно активирован.','/user/profile');
            }
            else {
                $user->activationCode = '';
                $user->save();
                # Меняем группу пользователя
                $role = Role::where('lat_name','=','user')->first();
                $user->roles()->detach();
                $user->roles()->attach($role);
            }
        }
        return $this->getMessage('Неверная ссылка для активации аккаунта, либо аккаунт уже активирован.');
    }
    # Показать список пользователей на сайте
    public function getView($user = null) {
        #Получаем список пользователей из базы
        $users = User::orderBy('created_at', 'ASC')->paginate(20);
        #$users = DB::table('users')->paginate(15);
        $users_count = User::count();

        return View::make('frontend.users.list',array(
            'users' => $users,
            'users_cnt' => $users_count
        ));
    }
}