@extends('backend.layouts.page')
@section('title')
Добавить изображения
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs" role="tablist" id="myTab">
          <li class="active"><a href="#default" role="tab" data-toggle="tab">Обычный режим</a></li>
          <li><a href="#multiup" role="tab" data-toggle="tab">Мультизагрузка</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane fade in active" id="default">
             {{ Form::open(array('route' => array('admin-gallery-images-add'), 'files' => 'true')) }}
            <div class="form-group">
                {{ Form::label('album', 'Фотоальбом') }}
                {{ Form::select('album', $albums, '', array('class' => 'form-control')) }}
                {{ $errors->first('album') }}
            </div>
            <div class="form-group">
                {{ Form::label('caption', 'Описание изображения') }}
                {{ Form::textarea('caption','',array('class' => 'form-control','placeholder' => 'Описание изображения')) }}
                {{ $errors->first('caption') }}
            </div>
            <div class="form-group">
                {{ Form::label('image', 'Выбирете файл') }}
                {{ Form::file('image') }}
                {{ $errors->first('image') }}
            </div>
            <div class="form-group">
                {{ Form::label('watermark', 'Накладывать водяной знак?') }}

            </div>
            {{ Form::submit('Добавить изображение', array('class' => 'btn btn-lg btn-primary')) }}
            {{ Form::close() }}
          </div>
          <div class="tab-pane fade" id="multiup">
            222222222222222222222
          </div>
        </div>
    </div>
</div>

<script>
  $(function () {
    $('#myTab a:last').tab('show')
  })
</script>
@stop