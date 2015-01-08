<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a class="active" href="{{{ route('admin-panel') }}}"><i class="fa fa-dashboard fa-fw"></i> Главная страница</a>
            </li>
            <li>
                <a href="{{{ route('admin-users') }}}"><i class="fa fa-users"></i> Пользователи и роли<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{{ route('admin-users') }}}">Пользователи</a>
                    </li>
                    <li>
                        <a href="{{{ route('admin-roles') }}}">Роли</a>
                    </li>
                    <li>
                        <a href="{{{ route('admin-users-profile-settings') }}}">Настройка профиля</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{{ route('admin-dossier') }}}"><i class="fa fa-briefcase"></i> Досье<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{{ route('admin-dossier') }}}">Список досье</a>
                    </li>
                    <li>
                        <a href="{{{ route('admin-dossier-cat') }}}">Категории досье</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{{ route('admin-gallery-albums') }}}"><i class="fa fa-picture-o"></i> Фотоальбомы<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{{ route('admin-gallery-albums') }}}">Фотоальбомы</a>
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{{ route('admin-gallery-images') }}}">Изображения</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{{ route('admin-gallery-albums') }}}"><i class="fa fa-graduation-cap"></i> Справочники<span class="fa arrow"></span></a>
            </li>
            <li>
                <a href="{{ route('admin-secure') }}"><i class="fa fa-unlock-alt"></i> Охрана операций</a>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{{ route('admin-options') }}}"><i class="fa fa-wrench fa-fw"></i> Настройки</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->