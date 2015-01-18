<?php

class JuserController extends \BaseController {
	public function postCheckEmail() {
		return User::AjaxChek('email',Input::get('value'),User::$ValidationEmail);
	}
	public function postCheckUser() {
		return User::AjaxChek('username',Input::get('value'),User::$ValidationUsername);
	}
}