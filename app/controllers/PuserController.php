<?php

class PuserController extends \BaseController {
	# Показать форму регистрации пользовател
	public function getRegister() {
		return View::make('frontend.users.register');
	}
	# Обработать форму регистрации пользователя
	# Доработать - поставить отправку почты в очередь
	public function postRegister() {
		$validator = Validator::make(Input::all(),User::postRegValid());
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
		}
		else {
			return Redirect::back()->with(
				'error',
				'При регистрации возникли ошибки'
			)->withErrors($validator)->withInput();
		}
	}
}