@extends('frontend.layouts.default')
@section('content')
<!-- Слайдер -->
@include('frontend.layouts.slider')
<!-- Section Area - Content Central -->
<section class="content-info">

<div class="semiboxshadow text-center">
    <img src="theme/img/img-theme/shp.png" class="img-responsive" alt="">
</div>

<!-- Dark Home -->
<div class="bg-dark dark-home">
<div class="row">
<!-- Left Content - Tabs and Carousel -->
<div class="col-md-9">
<!-- Nav Tabs -->
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#feature-news" data-toggle="tab">В Блогах</a></li>
    <li><a href="#players-staff" data-toggle="tab">Лучшие блоггеры</a></li>
    <li><a href="#club-news" data-toggle="tab">Группы</a></li>
</ul>
<!-- End Nav Tabs -->

<!-- Content Tabs -->
<div class="tab-content">
<!-- Tab One - Feature News -->
<div class="tab-pane active" id="feature-news">
    <!-- blog post-->
    <ul id="events-carousel" class="events-carousel padding-top">
        <!-- Item blog post -->
        <li>
            <div class="header-post">
                <div class="date">
                    <span>08/jan</span>
                    2014
                </div>
                <a href="#"><img src="theme/img/blog/no-image.jpg" alt=""></a>
                <div class="meta-tag">
                    <ul>
                        <li><i class="fa fa-user"></i><a href="#">Admin</a></li>
                        <li><i class="fa fa-folder-open"></i><a href="#">Cat</a></li>
                        <li class="text-right"><i class="fa fa-comment"></i><a href="#">10</a></li>
                    </ul>
                </div>
            </div>
            <div class="info-post">
                <h4><a href="#">Title</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </li>
        <!-- End Item blog post -->

        <!-- Item blog post -->
        <li>
            <div class="header-post">
                <div class="date">
                    <span>08/jan</span>
                    2014
                </div>
                <a href="#"><img src="theme/img/blog/no-image.jpg" alt=""></a>
                <div class="meta-tag">
                    <ul>
                        <li><i class="fa fa-user"></i><a href="#">Admin</a></li>
                        <li><i class="fa fa-folder-open"></i><a href="#">Design</a></li>
                        <li class="text-right"><i class="fa fa-comment"></i><a href="#">10</a></li>
                    </ul>
                </div>
            </div>
            <div class="info-post">
                <h4><a href="single-news.html">Title</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </li>
        <!-- End Item blog post -->

        <!-- Item blog post -->
        <li>
            <div class="header-post">
                <div class="date">
                    <span>08/jan</span>
                    2014
                </div>
                <a href="#"><img src="theme/img/blog/no-image.jpg" alt=""></a>
                <div class="meta-tag">
                    <ul>
                        <li><i class="fa fa-user"></i><a href="#">Admin</a></li>
                        <li><i class="fa fa-folder-open"></i><a href="#">Design</a></li>
                        <li class="text-right"><i class="fa fa-comment"></i><a href="#">10</a></li>
                    </ul>
                </div>
            </div>
            <div class="info-post">
                <h4><a href="#">Title</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </li>
        <!-- End Item blog post -->

        <!-- Item blog post -->
        <li>
            <div class="header-post">
                <div class="date">
                    <span>08/jan</span>
                    2014
                </div>
                <a href="#"><img src="theme/img/blog/no-image.jpg" alt=""></a>
                <div class="meta-tag">
                    <ul>
                        <li><i class="fa fa-user"></i><a href="#">Admin</a></li>
                        <li><i class="fa fa-folder-open"></i><a href="#">Design</a></li>
                        <li class="text-right"><i class="fa fa-comment"></i><a href="#">10</a></li>
                    </ul>
                </div>
            </div>
            <div class="info-post">
                <h4><a href="#">Title</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </li>
        <!-- End Item blog post -->

        <!-- Item blog post -->
        <li>
            <div class="header-post">
                <div class="date">
                    <span>08/jan</span>
                    2014
                </div>
                <a href="#"><img src="theme/img/blog/no-image.jpg" alt=""></a>
                <div class="meta-tag">
                    <ul>
                        <li><i class="fa fa-user"></i><a href="#">Admin</a></li>
                        <li><i class="fa fa-folder-open"></i><a href="#">Design</a></li>
                        <li class="text-right"><i class="fa fa-comment"></i><a href="#">10</a></li>
                    </ul>
                </div>
            </div>
            <div class="info-post">
                <h4><a href="#">Great Prospects.</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </li>
        <!-- End Item blog post -->
    </ul>
    <!-- End blog post-->
</div>
<!-- Tab One - Feature News -->

<!-- Tab Two - Players Staff -->
<div class="tab-pane" id="players-staff">
    <h3>V.I.P Пользователи</h3>
    <!-- Item Players-->
    <ul id="players-carousel" class="players ">
        <!-- Item Player -->
        <li class="item-player">
            <img src="theme/img/players/5.jpg" alt="" class="img-responsive">
            <div class="info-player">
                <h4><a href="#">User</a></h4>
                <h5><span>V.I.P</span></h5>
                <div class="overlay-player">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodn culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </li>
        <!-- End Player post -->

        <!-- Item Player -->
        <li class="item-player">
            <img src="theme/img/players/5.jpg" alt="" class="img-responsive">
            <div class="info-player">
                <h4><a href="#">User</a></h4>
                <h5><span>V.I.P</span></h5>
                <div class="overlay-player">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodn culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </li>
        <!-- End Player post -->

        <!-- Item Player -->
        <li class="item-player">
            <img src="theme/img/players/5.jpg" alt="" class="img-responsive">
            <div class="info-player">
                <h4><a href="#">User</a></h4>
                <h5><span>V.I.P</span></h5>
                <div class="overlay-player">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodn culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </li>
        <!-- End Player post -->

        <!-- Item Player -->
        <li class="item-player">
            <img src="theme/img/players/5.jpg" alt="" class="img-responsive">
            <div class="info-player">
                <h4><a href="#">User</a></h4>
                <h5><span>V.I.P</span></h5>
                <div class="overlay-player">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodn culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </li>
        <!-- End Player post -->

        <!-- Item Player -->
        <li class="item-player">
            <img src="theme/img/players/5.jpg" alt="" class="img-responsive">
            <div class="info-player">
                <h4><a href="#">User</a></h4>
                <h5><span>V.I.P</span></h5>
                <div class="overlay-player">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodn culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </li>
        <!-- End Player post -->

        <!-- Item Player -->
        <li class="item-player">
            <img src="theme/img/players/5.jpg" alt="" class="img-responsive">
            <div class="info-player">
                <h4><a href="#">User</a></h4>
                <h5><span>V.I.P</span></h5>
                <div class="overlay-player">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodn culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </li>
        <!-- End Player post -->
    </ul>
    <!-- End Item Players-->
</div>
<!-- Tab Two - Players Staff -->

<!-- Tab Theree - Club Teams -->
<div class="tab-pane" id="club-news">
    <h3>Club Teams</h3>
    <!-- Clubs Carousel-->
    <ul id="clubs-carousel" class="clubs-teams">
        <!-- Item carousel club -->
        <li class="row">
            <!-- Item clubs -->
            <div class="col-sx-12 col-sm-6 col-md-6">
                <div class="item-clubs">
                    <div class="img-clubs">
                        <img src="theme/img/clubs-team/1.png" alt="" class="img-responsive">
                    </div>
                    <div class="info-clubs">
                        <h4><a href="#">Club 1</a></h4>
                        <p>Lorem ipsum dolor sit amet,ectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!-- End Item clubs -->

            <!-- Item clubs -->
            <div class="col-sx-12 col-sm-6 col-md-6">
                <div class="item-clubs">
                    <div class="img-clubs">
                        <img src="theme/img/clubs-team/1.png" alt="" class="img-responsive">
                    </div>
                    <div class="info-clubs">
                        <h4><a href="#">Club</a></h4>
                        <p>Lorem ipsum dolor sit amet, ctetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!-- End Item clubs -->

            <!-- Item clubs -->
            <div class="col-sx-12 col-sm-6 col-md-6">
                <div class="item-clubs">
                    <div class="img-clubs">
                        <img src="theme/img/clubs-team/1.png" alt="" class="img-responsive">
                    </div>
                    <div class="info-clubs">
                        <h4><a href="#">Club</a></h4>
                        <p>Lorem ipsum dolor sit amet, coetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!-- End Item clubs -->

            <!-- Item clubs -->
            <div class="col-sx-12 col-sm-6 col-md-6">
                <div class="item-clubs">
                    <div class="img-clubs">
                        <img src="theme/img/clubs-team/1.png" alt="" class="img-responsive">
                    </div>
                    <div class="info-clubs">
                        <h4><a href="#">Club</a></h4>
                        <p>Lorem ipsum dolor sit amet, contur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!-- End Item clubs -->
        </li>
        <!-- End Item carousel club -->

        <!-- Item carousel club -->
        <li class="row">
            <!-- Item clubs -->
            <div class="col-sx-12 col-sm-6 col-md-6">
                <div class="item-clubs">
                    <div class="img-clubs">
                        <img src="theme/img/clubs-team/1.png" alt="" class="img-responsive">
                    </div>
                    <div class="info-clubs">
                        <h4><a href="#">Club</a></h4>
                        <p>Lorem ipsum dolor sit amet,ectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!-- End Item clubs -->

            <!-- Item clubs -->
            <div class="col-sx-12 col-sm-6 col-md-6">
                <div class="item-clubs">
                    <div class="img-clubs">
                        <img src="theme/img/clubs-team/1.png" alt="" class="img-responsive">
                    </div>
                    <div class="info-clubs">
                        <h4><a href="#">Club</a></h4>
                        <p>Lorem ipsum dolor sit amet, ctetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!-- End Item clubs -->

            <!-- Item clubs -->
            <div class="col-sx-12 col-sm-6 col-md-6">
                <div class="item-clubs">
                    <div class="img-clubs">
                        <img src="theme/img/clubs-team/1.png" alt="" class="img-responsive">
                    </div>
                    <div class="info-clubs">
                        <h4><a href="#">Club</a></h4>
                        <p>Lorem ipsum dolor sit amet, coetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!-- End Item clubs -->

            <!-- Item clubs -->
            <div class="col-sx-12 col-sm-6 col-md-6">
                <div class="item-clubs">
                    <div class="img-clubs">
                        <img src="theme/img/clubs-team/1.png" alt="" class="img-responsive">
                    </div>
                    <div class="info-clubs">
                        <h4><a href="#">Club</a></h4>
                        <p>Lorem ipsum dolor sit amet, contur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <!-- End Item clubs -->
        </li>
        <!-- End Item carousel club -->
    </ul>
    <!-- End Clubs Carousel-->
</div>
<!-- Tab Theree - Club Teams -->
</div>
<!-- Content Tabs -->
</div>
<!-- Left Content - Tabs and Carousel -->

<!-- Right Content - Content Counter -->
<div class="col-md-3">
    <aside>
        <div class="title-color text-center">
            <h4>Расписание событий</h4>
        </div>

        <div class="content-counter content-counter-home">
            <p class="text-center">
                <i class="fa fa-clock-o"></i>
                До события осталось
            </p>
            <div id="event-one" class="counter"></div>
            <ul class="post-options">
                <li><i class="fa fa-calendar"></i>June 12, 2014</li>
                <li><i class="fa fa-clock-o"></i>Kick-of, 12:00 PM</li>
            </ul>
            <p>Ei eum affert postulant, ius te mazim zril alterum. Illum dolorem ius ut, eu postulant principes sit.  ert postulant, ius te mazim zril alterum Tibique scriptorem cu pri, te fugit voluptatum mel, nibh exerci denique at qui.</p>
            <a class="btn btn-primary" href="#">
                Все события
                <i class="fa fa-clock-o"></i>
            </a>
        </div>
    </aside>
    <!-- Content Counter -->
</div>
<!-- End Right Content - Content Counter -->
</div>
</div>
<!-- Dark Home -->

<!-- Content Central -->
<div class="container padding-top">
<div class="row">

<!-- content Column Left -->
<div class="col-xs-12 col-md-6 col-lg-7">
    <!-- Recent Post -->
    <div class="panel-box">

        <div class="titles">
            <h4>Последние новости</h4>
        </div>

        <!-- Post Item -->
        <div class="post-item">
            <div class="row">
                <div class="col-md-4">
                    <div class="img-hover">
                        <img src="theme/img/blog/no-image.jpg" alt="" class="img-responsive">
                        <div class="overlay"><a href="#">+</a></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4><a href="#">News</a></h4>
                    <p class="data-info">January 3, 2014  / <i class="fa fa-comments"></i><a href="#">0</a></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rutrum, libero id imperdiet elementum, nunc... <a href="#">Подробнее [+]</a></p>
                </div>
            </div>
        </div>
        <!-- End Post Item -->

        <!-- Post Item -->
        <div class="post-item">
            <div class="row">
                <div class="col-md-4">
                    <div class="img-hover">
                        <img src="theme/img/blog/no-image.jpg" alt="" class="img-responsive">
                        <div class="overlay"><a href="#">+</a></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4><a href="#">News</a></h4>
                    <p class="data-info">January 9, 2014  / <i class="fa fa-comments"></i><a href="#">5</a></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rutrum, libero id imperdiet elementum, nunc... <a href="#">Подробнее [+]</a></p>
                </div>
            </div>
        </div>
        <!-- End Post Item -->

        <!-- Post Item -->
        <div class="post-item">
            <div class="row">
                <div class="col-md-4">
                    <div class="img-hover">
                        <img src="theme/img/blog/no-image.jpg" alt="" class="img-responsive">
                        <div class="overlay"><a href="#">+</a></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4><a href="#">News</a></h4>
                    <p class="data-info">January  4, 2014  / <i class="fa fa-comments"></i><a href="#">3</a></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rutrum, libero id imperdiet elementum, nunc... <a href="#">Подробнее [+]</a></p>
                </div>
            </div>
        </div>
        <!-- End Post Item -->

        <!-- Post Item -->
        <div class="post-item">
            <div class="row">
                <div class="col-md-4">
                    <div class="img-hover">
                        <img src="theme/img/blog/no-image.jpg" alt="" class="img-responsive">
                        <div class="overlay"><a href="#">+</a></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4><a href="#">News</a></h4>
                    <p class="data-info">January 8, 2014  / <i class="fa fa-comments"></i><a href="#">2</a></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rutrum, libero id imperdiet elementum, nunc... <a href="#">Подробнее [+]</a></p>
                </div>
            </div>
        </div>
        <!-- End Post Item -->
    </div>
    <!-- End Recent Post -->

    <!-- Experts -->
    <div class="panel-box">
        <div class="titles">
            <h4>Знакомства</h4>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3">
                <div class="box-info">
                    <img src="theme/img/experts/1.png" alt="" class="img-responsive">
                    <h5 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                    <p class="date-box">Abril 15, 2014</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3">
                <div class="box-info">
                    <img src="theme/img/experts/1.png" alt="" class="img-responsive">
                    <h5 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                    <p class="date-box">Abril 15, 2014</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3">
                <div class="box-info">
                    <img src="theme/img/experts/1.png" alt="" class="img-responsive">
                    <h5 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                    <p class="date-box">Abril 15, 2014</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3">
                <div class="box-info">
                    <img src="theme/img/experts/1.png" alt="" class="img-responsive">
                    <h5 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                    <p class="date-box">Abril 15, 2014</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3">
                <div class="box-info">
                    <img src="theme/img/experts/1.png" alt="" class="img-responsive">
                    <h5 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                    <p class="date-box">Abril 15, 2014</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3">
                <div class="box-info">
                    <img src="theme/img/experts/1.png" alt="" class="img-responsive">
                    <h5 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                    <p class="date-box">Abril 15, 2014</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3">
                <div class="box-info">
                    <img src="theme/img/experts/1.png" alt="" class="img-responsive">
                    <h5 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                    <p class="date-box">Abril 15, 2014</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-4 col-lg-3">
                <div class="box-info">
                    <img src="theme/img/experts/1.png" alt="" class="img-responsive">
                    <h5 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h5>
                    <p class="date-box">Abril 15, 2014</p>
                </div>
            </div>

        </div>
    </div>
    <!-- End Experts -->
</div>
<!-- End content Left -->

<!-- content Sidebar Center -->
<aside class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
    <!-- Locations -->
    <div class="panel-box">

        <div class="titles">
            <h4>Объявления</h4>
        </div>
        <!-- Locations Carousel -->
        <ul class="single-carousel">
            <li>
                <img src="theme/img/blog/no-image.jpg" alt="" class="img-responsive">
                <div class="info-single-carousel">
                    <h4>Board</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo cillum dolore eu fugiat nulla pariatur.</p>
                </div>
            </li>
            <li>
                <img src="theme/img/blog/no-image.jpg" alt="" class="img-responsive">
                <div class="info-single-carousel">
                    <h4>Board</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo cillum dolore eu fugiat nulla pariatur.</p>
                </div>
            </li>
            <li>
                <img src="theme/img/blog/no-image.jpg" alt="" class="img-responsive">
                <div class="info-single-carousel">
                    <h4>Board</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo cillum dolore eu fugiat nulla pariatur.</p>
                </div>
            </li>
        </ul>
        <!-- Locations Carousel -->
    </div>
    <!-- End Locations -->

    <!-- Video presentation -->
    <div class="panel-box">
        <div class="titles">
            <h4>Video</h4>
        </div>
        <!-- Locations Video -->
        <div class="row">
            <iframe src="http://www.youtube.com/embed/-wTq9vfasVQ" class="video"></iframe>
            <div class="col-md-12">
                <h4>Video</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo cillum dolore eu fugiat nulla pariatur.</p>
            </div>
        </div>
        <!-- End Locations Video -->
    </div>
    <!-- End Video presentation-->

    <!-- Widget Text-->
    <div class="panel-box">
        <div class="titles">
            <h4>Widget Text</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, incididunt ut labore et dolore.</p>
            </div>
        </div>
    </div>
    <!-- End Widget Text-->
</aside>
<!-- End content Sidebar Center -->

<!-- content Sidebar Right -->
<aside class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
    <!-- Diary -->
    <div class="panel-box">
        <div class="titles">
            <h4><i class="fa fa-calendar"></i>События</h4>
        </div>
        <!-- List Diary -->
        <div class="row">
            <div class="col-md-12">
                <p>Lorem ipsum dolor sit amet,elit sit consectetur.</p>
                <ul class="list-diary">
                    <!-- Item List Diary -->
                    <li>
                        <h5>LIGA BBVA <span>06-05-2014 - 11:00</span></h5>
                        <ul class="club-logo">
                            <li>
                                <img src="#" alt="">
                                <h6>Img</h6>
                            </li>
                            <li>
                                <img src="#" alt="">
                                <h6>Img</h6>
                            </li>
                        </ul>
                    </li>
                    <!-- End Item List Diary -->
                </ul>
            </div>
        </div>
        <!-- End List Diary -->
    </div>
    <!-- End Diary -->

    <!-- Adds Sidebar -->
    <div class="panel-box">
        <a href="#" target="_blank">
            <img src="theme/img/adds/sidebar.png" class="img-responsive" alt="">
        </a>
    </div>
    <!-- End Adds Sidebar -->
</aside>
<!-- End content Sidebar Right -->

</div>
</div>
<!-- End Content Central -->

<!-- Newsletter -->
<div class="section-wide">
    <div class="container">
        <div class="row newsletter">
            <div class="col-md-12">
                <div class="text-center">
                    <h2>Введите Ваш E-mail и <span class="text-resalt">подпишитесь</span> на рассылку новостей.</h2>
                    <p>При подписке на новости Вы всегда будете в курсе самых свежих событий города и района.</p>
                </div>
                <form id="newsletterForm" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                <input class="form-control" placeholder="Ваше имя" name="name"  type="text" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                <input class="form-control" placeholder="Ваш Email" name="email"  type="email" required="required">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" type="submit" name="subscribe" >Подписаться</button>
                                                 </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="result-newsletter"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Newsletter -->
</section>
<!-- End Section Area -  Content Central -->
@stop