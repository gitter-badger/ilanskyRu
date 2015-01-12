<?php

class JuserController extends \BaseController {
	public function getCheckEmail() {
		$v = Validator::make(Input::all(),User::$AjaxCheckEmail);
		if ($v->passes()) {
			$user = User::where('email','=',Input::get('email'));
			if ($user) {
				return Response::json(array('success'),200);
			}
		}
		return Response::json($v->errors()->all(),400);
	}
}