<?php
/**
 * Created by PhpStorm.
 * User: savenkoff
 * Date: 13.10.14
 * Time: 15:08
 */
class AdminController extends BaseController {
    ####################################################################################################################
    # Главня страница Админ-панели
    ####################################################################################################################
    public function getIndex() {
        return View::make('backend.index');
    }


















    ####################################################################################################################
    # ПОЛЬЗОВАТЕЛИ
    ####################################################################################################################
    # Показать список пользователей
    public function getUsers() {
        # Получаем список пользователей
        $users = User::orderBy('created_at', 'ASC')->paginate(50);
        $users_cnt = User::count();
        return View::make('backend.users.users', array(
            'users'     => $users,
            'users_cnt' => $users_cnt
        ));
    }
    # Удалить пользователя
    public function getDelUser($id) {
        $user = User::find($id);
        if (!$user) { App::abort('404'); }
        $user->delete();
        return Redirect::route('admin-users')->with('success','Пользователь успешно удалён.');
    }
    # Показать форму редактирования пользователя
    public function getEditUser($id) {
        $user = User::find($id);
        if (!$user) { App::abort('404'); }
        $roles = Role::lists('name','lat_name');
        return View::make('backend.users.edit', array(
            'user'  => $user,
            'roles' => $roles
        ));
    }
    # Обработать изменение пользователя
    public function postEditUser($id) {
        $validation = Validator::make(Input::all(),User::getValidationAdminEdit());
        if ($validation->passes()) {
            $user = User::find($id);
            if (!$user) { App::abort('404'); }
            $user->email = Input::get('email');
            $user->roles()->detach();
            $role = Role::where('lat_name', '=', Input::get('role'))->first();
            $user->roles()->attach($role);
            $user->save();
            return Redirect::route('admin-users-edit',array('id' => $id))->with('success', 'Пользователь успешно изменён.');
        }
        return Redirect::route('admin-users-edit',array('id' => $id))->with('error','При редактировании пользователи произошли ошибки.')->withErrors($validation)->withInput();
    }
    # Добавить пользователя
    public function getAddUser() {
        $roles = Role::lists('name','lat_name');
        $def_role = Role::where('lat_name','=','user')->first();
        return View::make('backend.users.add', array(
            'roles'     => $roles,
            'def_role'  => $def_role
        ));
    }
    # Обработать добавление пользователя
    public function postAddUser() {
        $validation = Validator::make(Input::all(),User::getValidationAddUserAdmin());
        if ($validation->passes()) {
            $user = new User();
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->isActive = true;
            $user->save();

            $role = Role::where('lat_name','=',Input::get('role'))->first();
            $user->roles()->attach($role);
        }
        return Redirect::back()->with('error','При добавлении пользователя возникли ошибки.')->withErrors($validation)->withInput();
    }
    # Настроить права пользователя
    public function getUsersAccess($id) {
        $user = User::find($id);
        if (!$user) { App::abort('404'); }
        $resources = Resource::paginate(50);
        return View::make('backend.users.access',array(
            'user'      => $user,
            'resources' => $resources
        ));
    }
    # Обработать настройку прав пользователя
    public function postUsersAccess($id) {
        $user = User::find($id);
        if (!$user) { App::abort('404'); }
        $user->resources()->detach();
        foreach(Input::all() as $form_key => $form_value) {
            if ($form_key == 'resource_id') {
                foreach ($form_value as $form_resource) {
                    $resource = Resource::find($form_resource);
                    if (!$resource) { App::abort('404'); }
                    $user->resources()->attach($resource);
                }
            }
        }
        return Redirect::back()->with('success','Права успешно сохранены.');
    }
    # Показать настройки профиля пользователя
    public function getProfile() {
        return View::make('backend.users.profile');
    }
    ####################################################################################################################
    # РОЛИ
    ####################################################################################################################
    # Показать форму ролей
    public function getRoles($group = null) {
        if ($group) {
            $role = Role::where('lat_name','=',$group)->first();
            if (!$role) { App::abort('404'); }
            $users = $role->users()->get();
            $users_cnt = $users->count();
            if ($users) {
                return View::make('backend.users', array(
                    'users'     => $users,
                    'users_cnt' => $users_cnt
                ));
            }
        }
        # Получаем список ролей пользователей
        $roles = Role::paginate(50);
        return View::make('backend.roles.roles',array(
            'roles' =>  $roles
        ));
    }
    # Редактирование роли
    public function getEditRoles($id) {
        $role = Role::find($id);
        if (!$id) { App::abort('404');  }
        if ($role->isDistrib) {
            Redirect::back()->with('info','Роль является дистрибутивной и не подлежит редактированию');
        }
        return View::make('backend.roles.edit',array(
            'role'      =>$role
        ));
    }
    # Удалить роль
    public function getDeleteRole($id) {
        $role = Role::find($id);
        if (!$role) { App::abort('404'); }
        $users = $role->users()->get();
        if ($role->isDistrib) {
            return Redirect::back()->with('error','Роль является дистрибутивной и не подлежит удалению.');
        }
        # Получить кол-во пользователей в системе c данной ролью
        $new_role = Role::where('lat_name','=','user')->first();
        foreach ($users as $user) {
            $user->roles()->detach();
            #Присваиваем роль пользователям
            $user->roles()->attach($new_role);
        }
        $role->delete();
        return Redirect::route('admin-roles')->with('success','Роль успешно удалена.');
    }
    # Добавить роль
    public function getAddRole() {
        return View::make('backend.roles.add');
    }
    # Обработаь добавление роли
    public function postAddRole() {
        $validation = Validator::make(Input::all(),Role::getValidateAddRole());
        if ($validation->passes()) {
            $role = new Role();
            $role->name = Input::get('name');
            if (!Input::get('lat_name')) {
                $role->lat_name = Slug::make(Input::get('name'));
            }
            else {
                $role->lat_name = Input::get('lat_name');
            }
            $role->save();
            return Redirect::route('admin-roles')->with('success','Роль успешно добавлена. Необходимо настроить права.');
        }
        return Redirect::back()->with('error','При добавлении роли возникли ошибки')->withErrors($validation)->withInput();
    }
    # Настроить права роли
    public function getRoleAccess($id) {
        $role = Role::find($id);
        if (!$role) { App::abort('404'); }
        $resources = Resource::orderBy('rus_name')->get();
        return View::make('backend.roles.access',array(
            'role'      => $role,
            'resources' => $resources
        ));
    }
    # Обработать права роли
    public function postRoleAccess($id) {
        DB::transaction(function() use ($id) {
            $role = Role::find($id);
            if (!$role) {
                App::abort('404');
            }
            $role->resources()->detach();

            foreach(Input::all() as $form_key => $form_value) {
                if ($form_key == 'resource_id') {
                    foreach ($form_value as $form_resource) {
                        $resource = Resource::find($form_resource);
                        if (!$resource) { App::abort('404'); }
                        $role->resources()->attach($resource);
                    }
                }
            }
        });
        return Redirect::back()->with('success','Права успешно сохранены.');
    }
    ####################################################################################################################
    # РЕСУРСЫ
    ####################################################################################################################
   # Показать ресурсы системы
    public function getSecure() {
        $resources = Resource::orderBy('target')->paginate(50);
        return View::make('backend.resources',array(
            'resources' => $resources
        ));
    }
    # Сохранить ресурсы системы
    public function postSecure() {
        $validator = Validator::make(Input::all(),Resource::isValidArray());
        if ($validator->passes()) {
            DB::transaction(function() {
                foreach(Input::all() as $form_key => $form_value) {
                    if ($form_key == 'secure') {
                        foreach($form_value as $secure_key => $secure_value) {
                            # Определяем ресурс по ID
                            $resource = Resource::findOrFail($secure_key);
                            if (!$resource) { App::abort('404'); }
                            $rus_name   = '';
                            $secure     = false;
                            # Обрабатываем массив полученных параметров
                            $valid_params = Validator::make($secure_value,Resource::getValidationSaveResource());
                            if ($valid_params->passes()) {
                                foreach($secure_value as $column => $value) {
                                    # тут мутно всё
                                    if ($column == 'rus_name') {
                                        $rus_name = $value;
                                        $resource->rus_name = $rus_name;
                                    } elseif ($column == 'secure') {
                                        $secure = true;
                                    }
                                }
                                $resource->secure = $secure;
                                $resource ->save();
                            } else {
                                return Redirect::back()->with('error','Не прошёл валидатор на записи #'.$secure_key);
                            }
                        }
                    }
                }
            });
            return Redirect::back()->with('success','Настройки охраны операций успешно сохранены.');
        }
        return Redirect::back()->with('error','При сохранении настроек произошли ошибки')->withErrors($validator)->exceptInput();
    }
    ####################################################################################################################
    # ФОТОАЛЬБОМЫ
    ####################################################################################################################
    # Показать фотоальбомы
    public function getGalletyAlbums() {
        $albums = GalleryAlbums::all();
        $albums_cnt = $albums->count();
        return View::make('backend.gallery.albums', array(
            'albums'      => $albums,
            'albums_cnt'  => $albums_cnt
        ));
    }
    # Доавить фотоальбом
    public function getGalletyAlbumsAdd() {
        $albums = $this->adNullLevel(GalleryAlbums::lists('name','id'));
        return View::make('backend.gallery.add',array(
            'albums'    =>  $albums
        ));
    }
    # Обработать добавление альбома
    public function postGalletyAlbumsAdd() {
        $validator = Validator::make(Input::all(),GalleryAlbums::getValidAlbAdmAdd());
        if ($validator->passes()) {
            DB::transaction(function() {
                $album = new GalleryAlbums();
                $album->name = Input::get('name');
                (Input::get('slug') == '') ? $album->slug = Slug::make(Input::get('name')) : $album->slug = Input::get('slug');
                (Input::get('position') == '') ? $album->position = 0 : $album->position = Input::get('position');
                (Input::get('parent_id') == '') ? $album->parent_id = 0 : $album->parent_id = Input::get('parent_id');
                $album->keywords = Input::get('keywords');
                $album->description = Input::get('description');
                #$album->user_id = Auth::user()->id;
                (Input::get('is_system') == '') ? $album->is_system = false : $album->is_system = true;
                (Input::get('is_add') == '') ? $album->is_add = false : $album->is_add = true;
                $album->save();
                $user = Auth::user();
                $user->GalleryAlbums()->attach($album);
            });
            return Redirect::route('admin-gallery-albums')->with('success','Фотоальбом успешно добавлен');
        }
        return Redirect::back()->with('error','При добавлении фотоальбома возникли ошибки')->withInput()->withErrors($validator);
    }
    #Удаление фотоальбома
    public function getDeleteAlbum($id) {
        $album = GalleryAlbums::find($id);
        if (!$album) { App::abort('404'); }
        $album->delete();
        return Redirect::back()->with('success','Фотоальбом успешно удалён.');
    }
    #Редактирование альбома
    public function getEditAlbum($id) {
        $album = GalleryAlbums::find($id);
        $albums = $this->adNullLevel(GalleryAlbums::lists('name','id'));
        if (!$album) { App::abort('404'); }
        return View::make('backend.gallery.edit', array(
            'album'     => $album,
            'albums'    => $albums
        ));
    }
    #Сохранение редактирования альбома
    public function postEditAlbum($id) {
        $album = GalleryAlbums::find($id);
        $validator = Validator::make(Input::all(),GalleryAlbums::getValidAlbAdmEdit());
        if ($validator->passes()) {
            $album->name = Input::get('name');
            (Input::get('slug') == '') ? $album->slug = Slug::make(Input::get('name')) : $album->slug = Input::get('slug');
            (Input::get('position') == '') ? $album->position = 0 : $album->position = Input::get('position');
            (Input::get('parent_id') == '') ? $album->parent_id = 0 : $album->parent_id = Input::get('parent_id');
            $album->keywords = Input::get('keywords');
            $album->description = Input::get('description');
            (Input::get('is_system') == '') ? $album->is_system = false : $album->is_system = true;
            (Input::get('is_add') == '') ? $album->is_add = false : $album->is_add = true;
            $album->save();
            return Redirect::back()->with('success','Альбом успешно отредактирован.');
        }
        return Redirect::back()->with('error','При сохранении альбома возникли ошибки')->withInput()->withErrors($validator);
    }
    # Все изображения
    public function getGalleryImages() {
        return View::make('backend.gallery.images', array(
            'images'    => GalleryImages::paginate(50),
            'cnt'       => GalleryImages::count()
        ));
    }
    public function getAddImages() {
        $albums = $this->adNullLevel(GalleryAlbums::lists('name','id'));
        return View::make('backend.gallery.addimg', array(
            'albums'    => $albums
        ));
    }
    # Добавить одно изображение
    public function postAddImages() {
        $validator = Validator::make(Input::all(),GalleryImages::getValidationImage());
        if ($validator->passes()) {
            DB::transaction(function() {
                $GetAlbum = Input::get('album');
                if ($GetAlbum != 0) {$album = GalleryAlbums::find($GetAlbum);}
                if (isset($album) && $GetAlbum == 0) { App::abort('404');}
                $image = new GalleryImages();
                $image->caption = Input::get('caption');
                $file = Input::file('image');
                if (in_array($file->getClientMimeType(),GalleryImages::$denied_mime)) {
                    return Redirect::back()->with('error','Загрузка такого типа изображений запрещена');
                }
                if (!Input::hasFile('image')) { return Redirect::back()->with('error','При загрузке файла произошла ошщибка: Файл не был успешно загружен')->withInput();}
                $newfilename = Str::random(64).'.'.$file->getClientOriginalExtension();
                $image->file = $newfilename;
                $image->mime = $file->getClientMimeType();
                $save = GalleryImages::SaveImage($file->getRealPath(),$newfilename,true);
                $image->height = $save['height'];
                $image->width = $save['width'];
                $image->size = $save['size'];
                $image->save();
                $user = Auth::user();
                $image->users()->attach($user);
                if ($GetAlbum != 0) {$image->GalleryAlbums()->attach($album);}
            });
            return Redirect::back()->with('success','Изображение успешно загружено');
        }
        return Redirect::back()->with('error','При добавлении изображения возникли ошибки')->withErrors($validator)->withInput();
    }
    # Удалить изображение
    public function getDelImages($id) {
        $image = GalleryImages::find($id);
        if (!$image) { App::abort('404'); }
       # Удаляем файлы с сервера
        foreach (GalleryImages::$dirs as $dir) {
            File::delete(public_path().'/uploads/gallery/'.$dir.'/'.date_format($image->created_at,'Y-m').'/'.$image->file);
        }
        $image->delete();
        return Redirect::back()->with('success', 'Изображение успешно удалено.');
    }
    # Редакировать изображение
    public function getEditImages($id) {
        $image = GalleryImages::find($id);
        if (!$image) { App::abort('404'); }
        return View::make('backend.gallery.editimg', array(
            'image'     => $image,
            'albums'    => $this->adNullLevel(GalleryAlbums::lists('name','id'))
        ));
    }
    public function postEditImages($id) {
        $image = GalleryImages::find($id);
        if (!$image) { App::abort('404'); }
        $v = Validator::make(Input::all(),GalleryImages::getEditValidation());
        if ($v->passes()) {
            DB::transaction(function() use ($image){
                if (Input::get('album') != 0) {
                    $album = GalleryAlbums::find(Input::get('album'));
                    #$album->photos()->save($image);
                    $image->ref()->associate($album);
                    $album->save();
                }
                $image->caption = Input::get('caption');
                $image->save();
            });
            return Redirect::route('admin-gallery-images')->with('success','Изображение # '.$image->id.' успешно отредактировано.');
        }
        return Redirect::back()->with('error','Ошибка при редактировании изображения')->withErrors($v)->withInput();
    }
    # Массовые действия с изображениями
    public function postMassActImages() {
        $v = Validator::make(Input::all(),GalleryImages::MassValidation());
        if ($v->passes()) {
                return View::make('backend.gallery.add-action',array(
                    'act'   => Input::get('action'),
                    'imgs'  => implode('|',Input::get('image_indx'))
                ));
            }
        return Redirect::back()->with('error','Ошибка при выполнении операциии')->withInput()->withErrors($v);
    }

    # Обработка при доп. действии
    public function GoMassImages() {
        $v = Validator::make(Input::all(),GalleryImages::GoMassValid());
        if ($v->passes()) {
            switch (Input::get('act')) {
                case 'move-album':
                    # Проверяем фактическое существование альбома
                    $album = GalleryAlbums::find(Input::get('album'));
                    if (!$album) { App::abort('404'); }
                    DB::transaction(function() use ($album) {
                        $images = explode('|',Input::get('images'));
                        foreach ($images as $ids) {
                            $image = GalleryImages::find($ids);
                            if (!$image) { App::abort('404'); }
                            $image->ref()->associate($album);
                            $image->save();
                        }
                    });
                    return Redirect::route('admin-gallery-images')->with('success','Перемещение изображений успешно завершено.');
                    break;
                default:
                    return Redirect::back()->with('info','Данное действие не обрабатывается')->withInput();
            }
        }
        return Redirect::back()->with('error','Ошибка при обработке массового действия: '.implode('<br># ',$v->messages()->getMessages()))->withInput();
    }

    ####################################################################################################################
    # НАСТРОЙКИ
    ####################################################################################################################
    public function getOptions() {
        return View::make('backend.options',array(
            'skins'             => Options::$skin,
            'seite'             => GalleryImages::$seite,
            'watermark_pos'     => GalleryImages::$weatermark_pos,
            'gallery'           => $this->adNullLevel(GalleryAlbums::lists('name','id'))
        ));
    }
    public function postOptions() {
        $v = Validator::make(Input::all(),Options::getValidate());
        if ($v->passes()) {
            DB::transaction(function() {
                foreach (Input::get('options') as $key => $value) {
                    if (!in_array($key,Options::$options)) {
                        return Redirect::back()->with('error','Настройка '.$key.' не допустима для сохранения')->withInput();
                    }
                Options::set_option($key,$value);
                }
            });
            return Redirect::back()->with('success','Настройки сайта успешно сохранены');
        };
        return Redirect::back()->withInput()->with('error','При сохранении настроек возникли ошибки')->withErrors($v);
    }
    ####################################################################################################################
    # ДОСЬЕ
    ####################################################################################################################
    # Показать категории досье
    public function getDossierCats() {
        return View::make('backend.dossier.cats', array(
           'cats_cnt'   => DossierCats::all()->count(),
            'cats'      => DossierCats::paginate(50)
        ));
    }
    # Добавить категорию досье
    public function getDossierAddCat() {
        return View::make('backend.dossier.addcat');
    }
    # Обработать добавление категории
    public function postDossierAddCat() {
        $validator = Validator::make(Input::all(),DossierCats::getValidatorAddCat());
        if ($validator->passes()) {
            DB::transaction(function() {
                $cat = new DossierCats();
                $cat->name = Input::get('name');
                (Input::get('slug') == '') ? $cat->slug = Slug::make(Input::get('name')) : $cat->slug = Input::get('slug');
                $cat->save();
            });
            return Redirect::back()->with('success','Категория успешно добавлена');
        }
        return Redirect::back()->with('error','Ошибка при добавлении категории')->withErrors($validator)->withInput();
    }
    # Редактировать категорию досье
    public function getDossierEdit($id) {
        $cat = DossierCats::find($id);
        if (!$cat) {App::abort('404');}
        return View::make('backend.dossier.editcat',array(
            'cat'   => $cat
        ));
    }
    # Обработать добавление досье
    public function postDossierEdit($id) {
        $cat = DossierCats::find($id);
        if (!$cat) { App::abort('404');}
        $validation = Validator::make(Input::all(),DossierCats::getValidatorEditCat());
        if ($validation->passes()) {
            $cat->name = Input::get('name');
            (Input::get('slug') == '') ? $cat->slug = Slug::make(Input::get('name')) : $cat->slug = Input::get('slug');
            $cat->save();
            return Redirect::back()->with('success','Категория успешно отредактирована');
        }
        return Redirect::back()->with('error','Ошибка при редактировании категории')->withInput()->withErrors($validation);
    }
    # Показать все досье
    public function getDossier() {
        $cnt    = Dossier::count();
        $dossier = Dossier::paginate(50);
        return View::make('backend.dossier.dossier',array(
            'cnt'       => $cnt,
            'dossier'   => $dossier
        ));
    }
    # Добавить досье
    public function getAddDossier() {
        return View::make('backend.dossier.adddos',array(
            'cats'  => DossierCats::lists('name','id')
        ));
    }
    public function postAddDossier() {
        $v = Validator::make(Input::all(),Dossier::getValidationDossier());
        if ($v->passes()) {
            DB::transaction(function() {
                $dos = new Dossier();
                $dos->MySave();
                /*
                $dos->name = Input::get('name');
                (Input::get('slug') == '') ? $dos->slug = Slug::make(Input::get('name')) : $dos->slug = Input::get('slug');
                (Input::get('alpha') == '') ? $dos->alpha = substr(preg_replace('/[^a-zA-ZА-Яа-я]/', '', Input::get('name')),0,1) : $dos->alpha = Input::get('alpha');
                $dos->short = Input::get('short');
                $dos->content = Input::get('content');
                $dos->web = Input::get('web');
                $dos->cat_id = Input::get('cat');
                $dos->author_id = Auth::user()->id;
                $dos->save();
                */
            });
            return Redirect::back()->with('success','Досье успешно добавлено.');
        }
        return Redirect::back()->with('error','Ошибка при сохранении досье')->withErrors($v)->withInput();
    }
    # Редактировать досье
    public function getEditDossier($id) {
        $dos = Dossier::find($id);
        if (!$dos) {App::abort('404');}
        return View::make('backend.dossier.editdos',
            array(
                'dos'   => $dos,
                'cats'  => DossierCats::lists('name','id')
            ));
    }

    public function postEditDossier($id) {
        $dos = Dossier::find($id);
        if (!$dos) {App::abort('404');}
        $v = Validator::make(Input::all(),Dossier::getValidationDossier());
        if ($v->passes()) {
            DB::transaction(function() use ($dos) {
                $dos->name      = Input::get('name');
                (Input::get('slug') == '') ? $dos->slug = Slug::make(Input::get('name')) : $dos->slug = Input::get('slug');
                (Input::get('alpha') == '') ? $dos->alpha = substr(preg_replace('/[^a-zA-ZА-Яа-я]/', '', Input::get('name')),0,1) : $dos->alpha = Input::get('alpha');
                $dos->short     = Input::get('short');
                $dos->content   = Input::get('content');
                $dos->web       = Input::get('web');
                $dos->cat_id    = Input::get('cat');
                ($dos->author_id == '') ? $dos->author_id = Auth::user()->id : null;
                $dos->save();
            });
            return Redirect::back()->with('success','Досье успешно отредактировано.');
        }
        return Redirect::back()->with('error','Ошибка при редактировании досье')->withErrors($v)->withInput();
    }
}