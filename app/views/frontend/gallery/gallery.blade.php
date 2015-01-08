@extends('frontend.layouts.gallery')
@section('title')
Галерея
@stop
@section('menu')
        <a href="{{{route('gallery')}}}#" data-filter="*" class="current">Смотреть всё</a>
    @foreach ($navigate as $elem)
        <a href="{{{route('gallery')}}}#{{{ $elem->slug }}}" data-filter=".{{{ $elem->slug }}}">{{{ $elem->name }}}</a>
    @endforeach
@stop
@section('gallery')
<!-- Items Gallery filters-->
    <div class="galleryContainer">
    @foreach($images as $image)
        @include('frontend.gallery.img',array(
        'slug'          => $image->album->slug,
        'id'            => $image->id,
        'caption'       => $image->caption,
        'small_link'    => $image->ExternalPath(),
        'preview_link'  => $image->ExternalPath('preview')))
    @endforeach
    </div>
    <!-- End Items Gallery filters-->
    <div class="row">
        <div class="col-md-12">
            <div style="text-align: center">
            <?php echo $images->links(); ?>
            </div>

        </div>
    </div>
@stop
@section('js-footer')
<!-- Настройка фильтра галлерей -->
<script type="text/javascript">
$(document).ready(function($) {

'use strict';

  $(window).load(function(){
      var $container = $('.galleryContainer');
      $container.isotope({
      filter: '*',
          animationOptions: {
          duration: 750,
          easing: 'linear',
          queue: false
  	}
  });

  $('.galleryFilter a').click(function(){
      $('.galleryFilter .current').removeClass('current');
      $(this).addClass('current');
       var selector = $(this).attr('data-filter');
       $container.isotope({
        filter: selector,
              animationOptions: {
              duration: 750,
              easing: 'linear',
              queue: false
            }
        });
       return false;
      });
   });
});
</script>
@stop
