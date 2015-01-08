@extends('backend.layouts.page')
@section('title')
Требуется дополнительное действие
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('action' => array('AdminController@GoMassImages'))) }}
        {{ Form::hidden('act',$act) }}
        {{ Form::hidden('images',$imgs) }}
        @if ($act = 'move-album')
            <div class="form-group">
                {{ Form::label('album', 'Выбирете фотоальбом для переноса фотографий') }}
                {{ Form::select('album', GalleryAlbums::lists('name','id'),null, array('class' => 'form-control input-sm')) }}
                {{ $errors->first('album') }}
            </div>
        @endif
        {{ Form::submit('Сохранить', array('class' => 'btn btn-xs btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop