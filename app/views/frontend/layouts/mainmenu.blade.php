<!-- mainmenu-->
<nav class="mainmenu">
    <div class="container">
        <!-- Menu-->
        <ul class="sf-menu" id="menu">
            <li class="selected">
                <a href="{{{ route('get-index') }}}">Главная</a>
            </li>
            <!--
            <li class="current">
                <a href="#">Menu</a>
                <ul class="sub-current">
                    <li>
                        <a href="#">Menu</a>
                    </li>
                    <li>
                        <a href="#">Menu</a>
                    </li>
                    <li>
                        <a href="#">Menu</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Блоги</a>
                <div class="sf-mega">
                    <div class="col-md-3">
                        <h4>Возможности</h4>
                        <ul>
                            <li><a href="#">Создать блог</a></li>
                            <li><a href="#">Популярные блоги</a></li>
                            <li><a href="#">Заказать V.I.P</a></li>
                            <li><a href="#">Новые блоги</a></li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h4>V.I.P Blog</h4>
                        <div class="img-hover">
                            <img src="theme/img/blog/1.jpg" alt="" class="img-responsive">
                            <div class="overlay"><a href="#">+</a></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <h4>V.I.P Blog</h4>
                        <div class="img-hover">
                            <img src="theme/img/blog/2.jpg" alt="" class="img-responsive">
                            <div class="overlay"><a href="#">+</a></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <h4>V.I.P Blog</h4>
                        <div class="img-hover">
                            <img src="theme/img/blog/3.jpg" alt="" class="img-responsive">
                            <div class="overlay"><a href="#">+</a></div>
                        </div>
                    </div>
                </div>
            </li>
            -->
            <li>
                <a href="{{{ route('gallery') }}}">Галерея</a>
            </li>
            <!--
            <li class="current">
                <a href="#">Menu</a>
                <ul class="sub-current">
                    <li class="current">
                        <a href="#">Menu</a>
                        <ul class="sub-current">
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                        </ul>
                    </li>
                    <li class="current">
                        <a href="#">Menu</a>
                        <ul class="sub-current">
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                        </ul>
                    </li>
                    <li class="current">
                        <a href="#">Menu</a>
                        <ul class="sub-current">
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Menu</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Menu</a></li>
                    <li class="current">
                        <a href="#">Menu</a>
                        <ul class="sub-current">
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/download/gallery/2">Test Download</a>
            </li>
            -->
            <li class="current">
                @unless(Auth::check())
                <a href="{{{ route('user-login') }}}">Я</a>
                @endunless
                @unless(Auth::guest())
                <a href="{{{ route('user-profile') }}}">Я</a>
                @endunless
                <ul class="sub-current">
                    @unless(Auth::check())
                    <li>
                        <a href="{{{ route('user-login') }}}">Авторизация</a>
                    </li>
                    <li>
                        <a href="{{{ route('get-user-register') }}}">Регистрация</a>
                    </li>
                    @endunless
                    @unless(Auth::guest())
                    <li>
                        <a href="{{{ route('user-profile') }}}">Профиль</a>
                    </li>
                    <li>
                        <a href="{{{ route('user-logout') }}}">Выход</a>
                    </li>
                    @endunless
                </ul>
            </li>
        </ul>
        <!-- End Menu-->
    </div>
</nav>
<!-- End mainmenu-->