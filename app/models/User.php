<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = 'users';
    protected $guarded = array(
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    );
    protected $fillable = array(
        'username',
        'email',
        'password'
    );
    protected $softDelete = true;

    ############################
    # 2.0 Реализация модели
    ############################

    ######
    # Валидации
    ######
    public static $AjaxCheckEmail = array(
        'email'     => array(
            'required',
            'between:6,60',
            'email',
            'unique:users'
        )
    );
    public static $AjaxCheckUsername = array(
        'username'  => array(
            'required',
            'between:3,40',
            'unique:users',
            'regex:/^[A-Za-z0-9]/'
        )
    );

    public static function postRegValid() {
        $rules = array();
        $rules =  $rules
            + self::$AjaxCheckEmail
            + self::$AjaxCheckUsername;
        return $rules;
    }
    ######
    # Связи
    ######

    ######
    # Функции
    ######

    public static function AjaxChek($field, $value, $rules) {
        $arr[$field] = $value;
        $v = Validator::make($arr,$rules);
        if ($v->passes()) {
            return Response::json(array('ok'),200);
        }
        return Response::json(array('error'),400);
    }

    ############################
    # END 2.0 Реализация модели
    ############################






















    public function roles() {
        return $this->belongsToMany('Role')->withTimestamps();
    }

    public function resources() {
        return $this->belongsToMany('Resource')->withTimestamps();
    }

    ### Нормализация связей
    public function dossiers() {
        return $this->hasMany('Dossier','author_id');
    }

    public function albums() {
        return $this->hasMany('GalleryAlbums','user_id');
    }

    public function images() {
        return $this->hasMany('GalleryImages','user_id');
    }

    ###############
    # Валидация
    ###############
    # Авторизация
    public static function getValidationAuth() {
        $validation = array(
            'username' => 'required',
            'password' => 'required',
            'redirect' => 'regex:/^[a-z-]/'
        );
        return $validation;
    }
    # Валидация регистраии пользователя
    public static function getValidationRegister() {
        $validation = array(
            'username'  => array(
                'required',
                'min:5',
                'unique:users',
                'regex:/^[A-Za-z0-9]/'
            ),
            'email'     => array(
                'required',
                'email',
                'unique:users'
            ),
            'password'  => array(
                'required',
                'confirmed',
                'min:6'
            ),
            'captcha'   => array(
                'required',
                'captcha'
            )
        );
        return $validation;
    }
    # Валидация изменения профиля через Админ-центр
    public static function getValidationAdminEdit() {
        $validation = array(
            'email'     => array(
                'required',
                'email'
            ),
            'role'      => array(
                'required',
                'exists:roles,lat_name'
            )
        );
        return $validation;
    }
    # Валидация изменения данных учётной записи
    public static function getValidationEditProfile() {
        $validation = array(
            'full_name' => array(
                'min:3',
                'max:64'
            ),
            /*
            'url'   => array(
                'regex:/^https?://[\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/$/'
            ),
            */
            'email' => array(
                'required',
                'email'
            )
        );
        return $validation;
    }
    # Валидация данных активации аккаунта
    public static function getValidationActivationAccount() {
        $validation = array(
            'UserID'    => array(
                'regex:/^[0-9]/'
            ),
            'activationCode'    => array(
                'regex:/^[A-Za-z0-9]/'
            )
        );
        return $validation;
    }
    # Валидация добавления пользователя через Админ-Центр
    public static function getValidationAddUserAdmin() {
        $validation = array(
            'username'  => array(
                'required',
                'min:5',
                'unique:users',
                'regex:/^[A-Za-z0-9]/'
            ),
            'email'     => array(
                'required',
                'email',
                'unique:users'
            ),
            'role'      => array(
                'required',
                'exists:roles,lat_name'
            ),
            'password'  => array(
                'required',
                'confirmed',
                'min:6'
            )
        );
        return $validation;
    }
    public static function getValidationRemind() {
        $validation = array(
            'email' => array(
                'required',
                'email',
                'exists:users,email'
            ),
            'captcha'   => array(
                'required',
                'captcha'
            )
        );
        return $validation;
    }
    ################
    # Паблик
    ################

    public static function getRoleName($userid) {
        $user = User::find($userid);
        if (!$user) {
            return 'Пользователь не найден.';
        }
        $role = $user->roles()->first();
        if (!$role) {
            return 'Роль не определена';
        }
        return $role->name;
    }
    public static function getLatRoleName($userid) {
        $user = User::find($userid);
        if (!$user) {
            return 'Пользователь не найден.';
        }
        $role = $user->roles()->first();
        if (!$role) {
            return 'Роль не определена';
        }
        return $role->lat_name;
    }
    # Отправить письмо активации пользователю
    public function sendActivationMail() {
        $activationUrl = action('UserController@getActivate',
            array(
                'UserID'            => $this->id,
                'activationCode'    => $this->activationCode,
            )
        );

        $that = $this;

        Mail::send('emails/users/activation', array(
            'activationUrl'     => $activationUrl
        ), function($message) use ($that) {
            $message->to($that->email)->subject('Активация учетной записи');
        });
    }
    # Активация пользователя
    function activate($activationCode) {
        // Если пользователь уже активирован, не будем делать никаких
        // проверок и вернем false
        if ($this->isActive) {
            return false;
        }
        // Если коды не совпадают, то также ввернем false
        if ($activationCode != $this->activationCode) {
            return false;
        }
        // Обнулим код, изменим флаг isActive и сохраним
        $this->activationCode = '';
        $this->isActive = true;
        $this->save();

        Log::info('User ['.$this->email.'] successfully activated');

        return true;
    }

    # Прочее
	protected $hidden = array('password', 'remember_token');

    public function permissions() {
        return $this->hasMany('Permission');
    }

    public function hasRole($key) {
        foreach ($this->roles as $role) {
            if ($role->name === $key) {
                return true;
            }
        }
        return false;
    }
}
