<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

Route::filter('acl',function() {
    $route_as   = Route::getCurrentRoute()->getName();
    $route_path  = Route::getCurrentRoute()->getPath();
    $route_uses = Route::getCurrentRoute()->getActionName();
    $route_type = Route::getCurrentRoute()->getMethods();
    #$route_rname = Route::getCurrentRoute()->getAction()['name'];@
    #print_r($route_type);
    ###########################
    # Добавить бы нам маршрут в табличку в случае его отсутствия
    ###########################
    $recource = Resource::where('action','=',$route_uses)->first();
    if (!$recource) {
        $recource = new Resource();
        $recource->name = $route_as;
        $recource->action = $route_uses;
        $recource->target = $route_path;
        $recource->secure = false; # На время разработки
        $recource->save();
    }
    # Ресурс не охраняется - даём доступ
    if (!$recource->secure) {
        return;
    }
    $recource_role = $recource->roles()->get();
    if (Auth::guest()) {
        $role = Role::where('lat_name','=','guest')->first();
    }
    else {
        $user = Auth::user();
        $recource_user = $recource->users()->get();
        foreach ($recource_user as $res_user) {
            if ($res_user->id == $user->id) {
                return;
            }
        }
        $role = $user->roles()->first();
    }
    foreach ($recource_role as $res_role) {
        if ($res_role->id == $role->id) {
            return;
        }
    }
    if (Auth::guest()) {
        if ($route_type[0] == 'GET') {
            return Redirect::route('user-login',Crypt::encrypt($route_as))->with('info','Необходима авторизация для проверки доступа пользователя к данному разделу. ');
        } else {
            return Redirect::route('user-login')->with('info','Необходима авторизация для проверки доступа пользователя к данной операции. ');
        }
    }
    return App::abort('403');
});



/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('user/login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/user/profile');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('csrf-ajax', function()
{
    if (Session::token() != Request::header('x-csrf-token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

#Свои ошибки
App::error(function($exception = 'Ошибка не определена системой. Стек ошибки пуст. Печально.', $code)
{
    switch ($code)
    {
        case 403:
            $messages = array(
                'code'      => $code,
                'title'     => 'Запрещено',
                'errtext'   => 'Доступ к данной странице запрещён. Вероятно у Вас недостаточно прав.'
            );
            return Response::view('frontend.layouts.errors',$messages,$messages['code']);
        case 404:
            $messages = array(
                'code'      => $code,
                'title'     => 'Страница не найдена',
                'errtext'   => 'К сожалению, запрашиваемая Вами страница не найдена.'
            );
            return Response::view('frontend.layouts.errors',$messages,$messages['code']);
        case 405:
            $messages = array(
                'code'      => $code,
                'title'     => 'Метод не разрешен',
                'errtext'   => 'В запросе использовался не разрешенный сервером метод.'
            );
            return Response::view('frontend.layouts.errors',$messages,$messages['code']);
        case 500:
            $messages = array(
                'code'      => $code,
                'title'     => 'Внутренняя ошибка сервера',
                'errtext'   => 'Что-то случилось с нашим бедным сервером.. Попробуйте обновить страницу...',
                'exception' => $exception
            );
            return Response::view('frontend.layouts.errors',$messages,$messages['code']);
        default:
            $messages = array(
                'code'      => $code,
                'title'     => 'Нераспознанная ошибка',
                'errtext'   => 'Подробностей ошибки не указано. Свяжитесь с Администратором: daniil@savenkoff.com'
            );
            return Response::view('frontend.layouts.errors',$messages,$messages['code']);
    }
});