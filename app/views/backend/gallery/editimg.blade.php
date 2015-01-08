@extends('backend.layouts.page')
@section('title')
Редактировать изображение
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
             {{ Form::open(array('route' => array('admin-gallery-images-edit',$image->id))) }}

            <div class="form-group">
                {{ Form::label('album', 'Фотоальбом') }}
                {{ Form::select('album', $albums,$image->GetIdAlbum(), array('class' => 'form-control')) }}
                {{ $errors->first('album') }}
            </div>
            <div class="form-group">
                {{ Form::label('caption', 'Описание изображения') }}
                {{ Form::textarea('caption',$image->caption,array('class' => 'form-control','placeholder' => 'Описание изображения')) }}
                {{ $errors->first('caption') }}
            </div>
            {{ Form::submit('Сохранить изображение', array('class' => 'btn btn-lg btn-primary')) }}
            {{ Form::close() }}
          </div>
</div>
@stop