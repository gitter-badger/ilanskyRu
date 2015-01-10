<?php

class PuserController extends \BaseController {
	# Показать форму регистрации пользовател
	public function getRegister() {
		return View::make('frontend.users.register');
	}

}