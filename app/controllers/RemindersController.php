<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('users.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
        $validator = Validator::make(Input::all(),User::getValidationRemind());
        if ($validator->passes()) {
            switch ($response = Password::remind(Input::only('email')))
            {
                case Password::INVALID_USER:
                    return Redirect::back()->with('error', Lang::get($response));

                case Password::REMINDER_SENT:
                    return Redirect::back()->with('success', Lang::get($response));
            }
        }
        return Redirect::back()->with('error','В процессе восстановления пароля возникли ошибки.')->withErrors($validator)->withInput();
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('frontend.users.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset($token = null)
	{
        if (is_null($token)) App::abort(404);
        if ($token != Input::get('token')) App::abort(403);
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::route('profile')->with('success','Пароль учетной записи успешно измененён. Теперь Вы можете войти на сайт с новым паролем.');
		}
	}

}
