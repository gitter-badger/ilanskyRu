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
                <p>&copy; Daniil V. Savenkoff 2014</p>
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
                <p><small>Версия сайта <b>0.1 beta</b>. Обо всех ошибках при работе сайта просьба сообщаять при помощи формы обратной связи.</small></p>
            </div>
        </div>
    </div>
</div>
<!-- footer Down-->

</div>
<!-- End layout-->

<!-- ======================= JQuery libs =========================== -->
<!-- jQuery local-->
<script src="theme/js/jquery.js"></script>
<!--Nav-->
<script type="text/javascript" src="theme/js/nav/tinynav.js"></script>
<script type="text/javascript" src="theme/js/nav/hoverIntent.js"></script>
<script type="text/javascript" src="theme/js/nav/superfish.js"></script>
<script src="theme/js/nav/jquery.sticky.js" type="text/javascript"></script>
<!--Totop-->
<script type="text/javascript" src="theme/js/totop/jquery.ui.totop.js" ></script>
<!--Accorodion-->
<script type="text/javascript" src="theme/js/accordion/accordion.js" ></script>
<!--Slide-->
<script type="text/javascript" src="theme/js/slide/camera.js" ></script>
<script type='text/javascript' src='theme/js/slide/jquery.easing.1.3.min.js'></script>
<!-- Maps -->
<script src="theme/js/maps/gmap3.js"></script>
<!-- carousel.js нужна для галереи и главной-->
<script src="theme/js/carousel/carousel.js"></script>
<!-- Filter -->
<script src="theme/js/filters/jquery.isotope.js" type="text/javascript"></script>
<!-- Twitter Feed хз зачем, но нужен для работы главной, и галлереи пока не знаю как исправить v -->
<script src="theme/js/twitter/jquery.tweet.js"></script>
<!-- flickr  хз зачем, но нужен для работы главной, и галлереи пока не знаю как исправить -->
<script src="theme/js/flickr/jflickrfeed.min.js"></script>
<!-- Counter -->
<script src="theme/js/counter/jquery.countdown.js"></script>
<!-- Bootstrap.js-->
<script type="text/javascript" src="theme/js/bootstrap/bootstrap.js"></script>
<!--MAIN FUNCTIONS-->
<script type="text/javascript" src="theme/js/main.js"></script>
<!-- Обязательные на всех страницах -->
<!--Ligbox-->
<script type="text/javascript" src="theme/js/fancybox/jquery.fancybox.js"></script>
<!-- Настройка Ligbox -->
<script type="text/javascript">
$(document).ready(function($) {

'use strict';

  $(".fancybox").fancybox({
      openEffect  : 'elastic',
      closeEffect : 'elastic',

      helpers : {
        title : {
          type : 'inside'
        }
      }
  });
});
</script>
<!-- Суб-функционал, разделённый по разделам -->
@yield('js-footer')
<!-- ======================= End JQuery libs =========================== -->

</body>
</html>