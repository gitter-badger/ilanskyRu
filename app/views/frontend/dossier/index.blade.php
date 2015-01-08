@extends('layouts.page')
@section('title')
Досье
@stop
@section('content')
<div class="col-md-12">
    @if ($count === 0)
    <p align="center">Досье в базе не зарегистрировано.</p>
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <h3>Всего в базе зарегистрировано <span class="text-resalt">{{$count}}</span> досье.</h3>
                <p class="tooltip-hover">{{ $alphabet }}</p>
            </div>
        </div>
    </div>
    @foreach($cats as $cat)
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4><i class="fa fa-info-circle"></i> <strong>Досье категории "<a href="{{ URL::route('dossier',$cat->slug) }}">{{ $cat->name }}</a>"</strong> (Всего <span class="text-resalt">{{$cat->dossiers()->remember(Options::get_option('db_cache'))->count()}}</span>)</h4>
            @if($cat->dossiers()->remember(Options::get_option('db_cache'))->count() != 0)
                <ul id="dossier-carousel{{$cat->id}}" class="dossiers">
                @foreach($cat->dossiers()->remember(Options::get_option('db_cache'))->orderBy('updated_at','DESC')->take(10)->get() as $dossier)
                    <!-- Item -->
                    <li class="item-dossier">
                        <img src="{{ $dossier->GetImage() }}" alt="{{ $dossier->short }}" class="img-responsive">
                        <div class="info-dossier">
                            <h4><a href="{{$dossier->GetFullLink()}}">{{ Options::Title($dossier->name,33) }}</a></h4>
                            <h5><span>{{ $cat->name }}</span></h5>
                            <div class="overlay-dossier">
                                <p>{{ $dossier->short }}</p>
                            </div>
                        </div>
                    </li>
                    <!-- End post -->
                @endforeach
                </ul>
            @endif
        </div>
    </div>
    @endforeach
    @endif
    <div style="text-align: center"></div>
</div>
@stop
@section('js-footer')
    <script type="text/javascript">
    $(document).ready(function($) {

    'use strict';
    @foreach($cats as $cat)
      //=================================== Carousel Dossier  ==================================//
       $("#dossier-carousel{{$cat->id}}").owlCarousel({
           autoPlay: 3200,
           items : 4,
           navigation: false,
           itemsDesktopSmall : [1024,4],
           itemsTablet : [768,3],
           itemsMobile : [600,2],
           pagination: true
       });
    @endforeach
    });
    </script>
@stop