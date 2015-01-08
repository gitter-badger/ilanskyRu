<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
###########################
# Глобальный фильтр
###########################
Route::when('*','acl');
###########################
# AJAX
###########################
Route::group(array('prefix' => 'upload'), function() {
    Route::post('/addimgs/',
        [
            'as'    =>  'ajax-images-upload',
            'uses'  =>  'GalleryController@AjaxUpload'
        ])->before('csrf-ajax');
    Route::post('/delimgs',
        [
            'as'    =>  'ajax-images-delete',
            'uses'  =>  'GalleryController@AjaxDelete'
        ]);
});
###########################
# Главная страница
###########################
Route::get('/',
    [
        'as'    =>  'index',
        'uses'  =>  'IndexController@index'
    ]);
###########################
# Почти универсальная загрузка файлов
###########################
Route::get('/download/{class}/{hash}',
    [
        'as'    =>  'download',
        'uses'  =>  'IndexController@getDownloadFile'
    ]);
###########################
# Пользователи - личная часть
###########################
Route::group(array('prefix' => 'user'),function() {
    # Показать форму авторизации пользователя
    Route::get('login/{redirect?}',
        [
            'as'    => 'user-login',
            'uses'  => 'UserController@getLogin'
        ])->before('guest');
    # Обработать форму авторизации пользователя
    Route::post('login/{redirect?}',
        [
            'uses'   => 'UserController@postLogin'
        ])->before('csrf');
    # Показать форму регистрации пользователя
    Route::get('register',
        [
            'as'    => 'user-register',
            'uses'  => 'UserController@getRegister'
        ])->before('guest');
    # Обработать форму регистрации пользователя
    Route::post('register',
        [
            'uses' => 'UserController@postRegister'
        ])->before('csrf');
    # Выход пользователя из системы
    Route::get('logout',
        [
            'as'    => 'user-logout',
            'uses'  =>  'UserController@LogOut'
        ])->before('auth');
    # Активация учетной записи пользователя
    Route::get('activate',
        [
            'as'    => 'user-activate',
            'uses'  => 'UserController@getActivate'
        ]);
    # Повторная отправка письма с активацией аккаунта
    Route::get('reactivate',
        [
            'as'    => 'user-reactivate',
            'uses'  => 'UserController@getReactivate'
        ])->before('auth');
    # Восстановление пароля
    Route::get('/remind',
        [
            'as'    => 'user-remind',
            'uses'  => 'RemindersController@getRemind'
        ])->before('guest');
    Route::post('/remind',
        [
            'uses'  =>  'RemindersController@postRemind'
        ])->before('guest')->before('csrf');
    Route::get('/reset/{token}',
        [
            'as'    =>  'user-reset-password',
            'uses'  =>  'RemindersController@getReset'
        ])->before('guest');
    Route::post('/reset/{token}',
        [
            'uses'  =>  'RemindersController@postReset'
        ])->before('auth')->before('csrf');
    # Профиль пользователя
    Route::get('profile',
        [
            'as'     => 'user-profile',
            'uses'   => 'UserController@getProfile'
        ])->before('auth');
    # Редактировать профиль пользователя
    Route::get('profile/edit',
        [
            'as'    => 'user-edit-profile',
            'uses'  => 'UserController@GetEditProfile'
        ])->before('auth');
    # Обработать форму редактирования профиля
    Route::post('profile/edit',
        [
            'uses'   => 'UserController@PostEditProfile'
        ])->before('auth')->before('csrf');
    # Восстановление пароля пользователя
});
###########################
# Пользователи - публичная часть
###########################
Route::group(array('prefix' => 'users'),function() {
   # Показать список пользователей, либо профиль конкретного пользователя
    Route::get('/{name?}',
        [
            'as'    => 'users',
            'uses'  => 'UserController@getView'
        ])->where('role', '[A-Za-z]+');
});
###########################
# Галерея - публичная часть
###########################
Route::group(array('prefix' => 'gallery'), function() {
   # Главная страница галереи
    Route::get('/{album?}',
        [
            'as'    =>  'gallery',
            'uses'  =>  'GalleryController@getIndex'
        ])->where('album', '[A-Za-z0-9-_]+');
});

##########################
# Досье - публичная часть
#########################
Route::group(array('prefix' => 'dossier'), function() {
   # Алфавитная навигация по досье
    Route::get('/alpha/{alpha}',
        [
            'as'    => 'dossier-alpha',
            'uses'  => 'DossierController@getAlpha'
        ])->where('alpha','[A-Za-z0-9А-Яа-я]+');
    # Главная страница + путеводитель по досье
    Route::get('/{cat?}/{dossier?}',
        [
            'as'    => 'dossier',
            'uses'  => 'DossierController@getIndex'
        ])->where('cat','[A-Za-z0-9-_]+')->where('dossier','[A-Za-z0-9-_]+');
});

##########################
# Административная часть
##########################
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() {
   # Главнгая страница админ-панели
    Route::get('/',
        [
            'as'    => 'admin-panel',
            'uses'  => 'AdminController@getIndex'
        ]);
    ###################
    # Пользователи
    ###################
    Route::group(array('prefix' =>  'users'), function() {
        # Показать всех пользователей
        Route::get('/',
            [
                'as'    => 'admin-users',
                'uses'  => 'AdminController@getUsers'
            ]);
        # Удалить пользователя
        Route::get('/delete/{id}',
            [
                'as'    => 'admin-users-del',
                'uses'  => 'AdminController@getDelUser'
            ])->where('id', '[0-9]+');
        # Редактирование пользователя
        Route::get('/edit/{id}',
            [
                'as'    => 'admin-users-edit',
                'uses'  => 'AdminController@getEditUser'
            ])->where('id', '[0-9]+');
        Route::post('/edit/{id}',
            [
                'uses'  => 'AdminController@postEditUser'
            ])->before('csrf')->where('id', '[0-9]+');
        # Добавить пользовтаеля
        Route::get('/add',
            [
                'as'    =>  'admin-users-add',
                'uses'  =>  'AdminController@getAddUser'
            ]);
        Route::post('/add',
            [
                'uses'  =>  'AdminController@postAddUser'
            ])->before('csrf');
        Route::get('/access/{id}',
            [
                'as'    =>  'admin-users-access',
                'uses'  =>  'AdminController@getUsersAccess'
            ])->where('id', '[0-9]+');
        Route::post('/access/{id}',
            [
                'as'    =>  'admin-users-access',
                'uses'  =>  'AdminController@postUsersAccess'
            ])->where('id', '[0-9]+');
        Route::get('/profile',
            [
                'as'    =>  'admin-users-profile-settings',
                'uses'  =>  'AdminController@getProfile'
            ]);
    });
    #################
    # Роли
    #################
    Route::group(array('prefix' => 'roles'), function() {

        Route::get('/add',
            [
                'as'    =>  'admin-roles-add',
                'uses'  =>  'AdminController@getAddRole'
            ]);
        Route::post('/add',
            [
                'uses'  => 'AdminController@postAddRole'
            ])->before('csrf');
        # Показать форму редактирования ролей или пользователей любой роли
        Route::get('/{role?}',
            [
                'as'    =>  'admin-roles',
                'uses'  =>  'AdminController@getRoles'
            ])->where('role', '[A-Za-z]+');
        Route::get('/edit/{id}',
            [
                'as'    =>  'admin-roles-edit',
                'uses'  =>  'AdminController@getEditRoles'
            ])->where('id', '[0-9]+');
        Route::get('/delete/{id}',
            [
                'as'    =>  'admin-roles-delete',
                'uses'  =>  'AdminController@getDeleteRole'
            ])->where('id', '[0-9]+');
        Route::get('/access/{id}',
            [
                'as'    =>  'admin-roles-access',
                'uses'  =>  'AdminController@getRoleAccess'
            ])->where('id', '[0-9]+');
        Route::post('/access/{id}',
            [
                'uses'  =>  'AdminController@postRoleAccess'
            ])->before('csrf')->where('id', '[0-9]+');
    });
    #################
    # Настройка охраны операций
    #################
    Route::get('/secure',
        [
            'as'    =>  'admin-secure',
            'uses'  =>  'AdminController@getSecure'
        ]);
    Route::post('/secure',
        [
            'uses'  =>  'AdminController@postSecure'
        ])->before('csrf');
    ##################
    # Досье
    ##################
    Route::group(array('prefix' => 'dossier'), function() {
        Route::get('/',
            [
                'as'    =>  'admin-dossier',
                'uses'  =>  'AdminController@getDossier'
            ]);
        Route::get('add',
            [
                'as'    =>  'admin-dossier-add',
                'uses'  =>  'AdminController@getAddDossier'
            ]);
        Route::post('add',
            [
                'uses'  =>  'AdminController@postAddDossier'
            ])->before('csrf');
        Route::get('edit/{id}',
            [
                'as'        => 'admin-dossier-edit',
               'uses'     =>  'AdminController@getEditDossier'
            ])->where('id','[0-9]+');
        Route::post('edit/{id}',
            [
               'uses'   =>  'AdminController@postEditDossier'
            ])->before('csrf')->where('id','[0-9]+');
        Route::group(array('prefix' => 'cat'), function() {
            Route::get('/',
                [
                    'as'    => 'admin-dossier-cat',
                    'uses'  => 'AdminController@getDossierCats'
                ]);
            Route::get('/add',
                [
                    'as'    =>  'admin-dossier-cat-add',
                    'uses'  =>  'AdminController@getDossierAddCat'
                ]);
            Route::post('/add',
                [
                    'uses'  =>  'AdminController@postDossierAddCat'
                ])->before('csrf');
            Route::get('/edit/{id}',
                [
                    'as'    =>  'admin-dossier-cat-edit',
                    'uses'  =>  'AdminController@getDossierEdit'
                ])->where('id','[0-9]+');
            Route::post('/edit/{id}',
                [
                    'uses'  => 'AdminController@postDossierEdit'
                ])->where('id','[0-9]+')->before('csrf');
        });
    });
    ##################
    # Фотоальбомы
    ##################
    Route::group(array('prefix' => 'gallery'), function() {
        Route::group(array('prefix' => 'albums'), function() {
            Route::get('/',
                [
                    'as'    =>  'admin-gallery-albums',
                    'uses'  =>  'AdminController@getGalletyAlbums'
                ]);
            Route::get('/add',
                [
                    'as'    =>  'admin-gallery-albums-add',
                    'uses'  =>  'AdminController@getGalletyAlbumsAdd'
                ]);
            Route::post('/add',
                [
                    'as'    =>  'admin-gallery-albums-add',
                    'uses'  =>  'AdminController@postGalletyAlbumsAdd'
                ])->before('csrf');
            Route::get('/delete/{id}',
                [
                    'as'    =>  'admin-gallery-albums-delete',
                    'uses'  =>  'AdminController@getDeleteAlbum'
                ])->where('id', '[0-9]+');
            Route::get('/edit/{id}',
                [
                    'as'    =>  'admin-gallery-albums-edit',
                    'uses'  =>  'AdminController@getEditAlbum'
                ])->where('id', '[0-9]+');
            Route::post('/edit/{id}',
                [
                    'as'    =>  'admin-gallery-albums-edit',
                    'uses'  =>  'AdminController@postEditAlbum'
                ])->where('id', '[0-9]+')->before('csrf');
        });
        Route::group(array('prefix' => 'images'), function() {
            Route::get('/',
                [
                    'as'    =>  'admin-gallery-images',
                    'uses'  =>  'AdminController@getGalleryImages'
                ]);
            Route::post('/',
                [
                    'uses'  =>  'AdminController@postMassActImages'
                ])->before('csrf');
            Route::post('/mass-actions',
                [
                    'uses'  =>  'AdminController@GoMassImages'
                ])->before('csrf');
            Route::get('/add',
                [
                    'as'    =>  'admin-gallery-images-add',
                    'uses'  =>  'AdminController@getAddImages'
                ]);
            Route::post('/add',
                [
                    'uses'  =>  'AdminController@postAddImages'
                ])->before('csrf');
            Route::get('/edit/{id}',
                [
                    'as'    => 'admin-gallery-images-edit',
                    'uses'  => 'AdminController@getEditImages'
                ])->where('id','[0-9]+');
            Route::post('/edit/{id}',
                [
                   'uses'   =>  "AdminController@postEditImages"
                ])->before('csrf')->where('id','[0-9]+');
            Route::get('/delete/{id}',
                [
                    'as'    =>  'admin-gallery-images-delete',
                    'uses'  =>  'AdminController@getDelImages'
                ])->where('id','[0-9]+');

        });
    });
    ##################
    # Настройки сайта
    ##################
    Route::group(array('prefix' => 'options'), function () {
        Route::get('/',
            [
                'as'    => 'admin-options',
                'uses'  => 'AdminController@getOptions'
            ]);
        Route::post('/',
            [
                'uses'  => 'AdminController@postOptions'
            ])->before('csrf');
    });
});