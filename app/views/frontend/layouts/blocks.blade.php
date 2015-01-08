@include('frontend.layouts.header')
<!-- Section Title -->
<section class="section-title img-feature">
    <div class="overlay-bg"></div>
    <div class="container">
        <h1>@yield('title')</h1>
    </div>
</section>
<!-- End Section Title -->
<!-- Контент -->
<section class="content-info">

    <div class="crumbs">
        <div class="container">
            <ul>
                <li><a href="/">Главная</a></li>
                <li>/</li>
                <li>@yield('title')</li>
            </ul>
        </div>
    </div>

    <div class="semiboxshadow text-center">
        <img src="theme/img/img-theme/shp.png" class="img-responsive" alt="">
    </div>

    <!-- Content Central -->
    <div class="container padding-top">
        <div class="row">
            @yield('content')
        </div>
    </div>
    <!-- End Content Central -->
</section>
<!-- Футер -->
@include('frontend.layouts.footer')