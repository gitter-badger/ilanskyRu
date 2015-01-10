<!-- footer-->
<footer id="footer">
    <div class="container">

        <!-- Wiguets Footer-->
        <div class="row">

            <!-- Twitter Wiguet-->
            <div class="col-xs-12 col-sm-7 col-md-3 col-lg-4">
                <div class="divisor-footer">
                    <i class="fa fa-twitter twit-list"></i>
                    <h4>Latest Tweet</h4>
                    <!--<div id="twitter"></div>-->
                </div>
            </div>
            <!-- End Twitter Wiguet-->

            <!-- Tags Wiguet-->
            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3">
                <div class="tags">
                    <h4>Tags</h4>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                    <a href="#" class="#" title="Tags"><i class="fa fa-tag"></i> tag </a>
                </div>
            </div>
            <!-- End Tags Wiguet-->

            <!-- Links Wiguet-->
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                <h4>Информация</h4>
                <ul class="links">
                    <li><i class="fa fa-check"></i> <a href="{{{route('dossier')}}}">Досье</a></li>
                </ul>
            </div>
            <!-- End Links Wiguet-->

            <!-- Случайные фото Wiguet-->
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <h4>Случайные фото</h4>
                <ul class="thumbs">
                    <?

                        /*
                        $images = GalleryImages::has('album')->with(array(
                            'album' => function($query) {
                                $query->where('is_system','=','0');
                            }
                        ))->orderBy(DB::raw('RAND()'))->remember(Options::get_option('db_cache'))->take(8)->get();
                     foreach($images as $image) {
                        print "<li>
                                    <a href=\"".$image->ExternalPath('preview')."\" class=\"fancybox\" rel=\"gallery-wiguet\">
                                        <img src=\"".$image->ExternalPath()."\" alt=\"".$image->caption."\">
                                    </a>
                               </li>";
                     }
                        */
                    ?>
                </ul>
            </div>
            <!-- End Случайные фото Wiguet-->
        </div>
        <!-- End Wiguets Footer-->

        <!-- Social Icons-->
        <div class="row">
            <ul class="social">
                <li>
                    <div>
                        <a href="#" class="facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </div>
                </li>
                <li>
                    <div>
                        <noindex>
                            <a href="https://twitter.com/IlanskyRu/" class="twitter-icon" rel="nofollow">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </noindex>
                    </div>
                </li>
                <li>
                    <div>
                        <noindex>
                            <a href="http://vk.com/ilanskyru" class="vimeo" rel="nofollow">
                                <i class="fa fa-vk"></i>
                            </a>
                        </noindex>
                    </div>
                </li>
<!--
                <li>
                    <div>
                        <a href="#" class="google-plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </li>
-->
                <li>
                    <div>
                        <noindex>
                            <a href="http://www.youtube.com/user/IlanskyRu" class="youtube" rel="nofollow">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </noindex>
                    </div>
                </li>
            </ul>
        </div>
        <!-- End Social Icons-->

    </div>
</footer>
<!-- End footer-->

<!-- footer Down-->
<div class="footer-down">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <p>&copy; Daniil V. Savenkoff 2015</p>
            </div>
            <div class="col-md-7">
                <!-- Nav Footer-->
                <ul class="nav-footer">
                    <li><a href="{{{ route('users') }}}">Пользователи</a> </li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
                <!-- End Nav Footer-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><small>Версия сайта <strong>0.1 beta</strong></small></p>
            </div>
        </div>
    </div>
</div>
<!-- footer Down-->

</div>
<!-- End layout-->

<!-- ======================= Библиотеки сайта =========================== -->
<!-- AngularJS -->
<script src="libs/angular.min.js"></script>
<script src="libs/angular/angular-messages.min.js"></script>
<!-- Ilansky AngularJS -->
<script src="libs/ilansky/ilansky_app_controllers.js"></script>
<script src="libs/ilansky/ilansky_app.js"></script>
<!-- jQuery -->
<script src="libs/jquery-1.11.2.min.js"></script>
<!--PlugIns-->
<script src="libs/jquery/jquery.ui.totop.js" type="text/javascript"></script>


<!--Nav-->
<script type="text/javascript" src="theme/js/nav/tinynav.js"></script>
<script type="text/javascript" src="theme/js/nav/hoverIntent.js"></script>
<script type="text/javascript" src="theme/js/nav/superfish.js"></script>
<script src="theme/js/nav/jquery.sticky.js" type="text/javascript"></script>

<!--Accorodion-->
<script type="text/javascript" src="theme/js/accordion/accordion.js" ></script>
<!-- carousel -->
<script src="theme/js/carousel/carousel.js"></script>
<!-- Counter -->
<script src="theme/js/counter/jquery.countdown.js"></script>
<!-- Bootstrap.js-->
<script type="text/javascript" src="theme/js/bootstrap/bootstrap.js"></script>
<!--MAIN FUNCTIONS-->
<script type="text/javascript" src="theme/js/main.js"></script>
<!--Ligbox-->
<script type="text/javascript" src="theme/js/fancybox/jquery.fancybox.js"></script>
<!-- Ilansky jQuery -->
<script src="libs/ilansky/ilansky_js.js"></script>
<!-- Суб-функционал, разделённый по разделам -->
@yield('js-footer')
<!-- ======================= End JQuery libs =========================== -->

</body>
</html>