<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    # Показать пользователю сообщение
    public function getMessage($message, $redirect = false) {
        return View::make('frontend.info'
        , array(
            'message'   => $message,
            'redirect'  => $redirect
        ));
    }
    # Сгенерировать случайную строку
    public function generateCode() {
        return Str::random();
    }
    # Добавить нулевой уровень
    public function adNullLevel($array) {
        $elem = array(0 => '- - - - - - - -');
        $array = (array)$elem+(array)$array;
        return $array;
    }
} 
