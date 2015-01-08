@extends('backend.layouts.page')
@section('title')
Изображения фотоальбомов
@stop
@section('styles')
<link href="theme/js/fancybox/jquery.fancybox.css" rel="stylesheet" media="screen">
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <p><a href="{{{ route('admin-gallery-images-add') }}}" class="btn btn-default">Добавить изображения</a></p>
        <p>Всего изображений в базе: {{{ $cnt }}}</p>
        @if($images->count() != 0)
        {{ Form::open(array('route' => array('admin-gallery-images'), 'name' => 'editimages')) }}
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID </th>
                        <th>Изображение </th>
                        <th>Принадлежность</th>
                        <th>Разрешение</th>
                        <th>Размер</th>
                        <th>Загрузок</th>
                        <th>Действия</th>
                        <th><input type="checkbox" name="master_box" title="Выбрать все" onclick="javascript:ckeck_uncheck_all();" /></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($images as $image)
                    <tr>
                        <td>{{{ $image->id }}}</td>
                        <td><a href="{{ $image->ExternalPath('preview') }}" class="fancybox" title="{{ $image->caption }}"><img src="{{{ $image->ExternalPath() }}}" class="img-thumbnail" height="10%" width="10%"></a></td>
                        <td>{{{ $image->textref() }}}</td>
                        <td>{{{$image->width}}}x{{{ $image->height }}}</td>
                        <td>{{{ round($image->size/1024/1024,2) }}} Мб</td>
                        <td>{{{ $image->downloads }}}</td>
                        <td>
                            <a href="{{{ $image->DownloadLink() }}}" title="Загрузить оригинал изображения"><i class="fa fa-download"></i></a>
                            <a href="{{{ route('admin-gallery-images-edit',$image->id) }}}" title="Редактировать изображение"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{{ route('admin-gallery-images-delete',$image->id) }}}" title="Удалить изображение"><i class="fa fa-trash"></i></a>
                        </td>
                        <td>{{ Form::checkbox('image_indx[]',$image->id,false,array('class' => 'chek_img')) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                {{ Form::label('action', 'Выбор действия') }}
            </div>
            <div class="col-md-6">
                {{ Form::select('action',GalleryImages::$actions,null, array('class' => 'form-control input-sm')) }}
            </div>
        </div>
        <div class="col-md-12 text-right">
            {{ Form::submit('Выполнить', array('class' => 'btn btn-xs btn-primary')) }}
        </div>

        {{ Form::close() }}
        <?php echo $images->links(); ?>
        @endif
    </div>
</div>
@stop
@section('js-footer')
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
<script language='JavaScript' type="text/javascript">
<!--
function ckeck_uncheck_all() {
    var frm = document.editimages;
    for (var i=0;i<frm.elements.length;i++) {
        var elmnt = frm.elements[i];
        if (elmnt.type=='checkbox') {
            if(frm.master_box.checked == true){ elmnt.checked=false; }
            else{ elmnt.checked=true; }
        }
    }
    if(frm.master_box.checked == true){ frm.master_box.checked = false; }
    else{ frm.master_box.checked = true; }
}
-->
</script>
@stop