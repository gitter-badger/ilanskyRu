<?php

class JuserController extends \BaseController {
	public function postCheckEmail() {
		$v = Validator::make(Input::all(),User::$AjaxCheckEmail);
		if ($v->passes()) {
			return Response::json(array('success'),200);
		}
		return Response::json($v->errors()->all(),400);
	}
}