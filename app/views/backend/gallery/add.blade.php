@extends('backend.layouts.page')
@section('title')
Добавить альбом
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('route' => array('admin-gallery-albums-add'))) }}
        <div class="form-group">
            {{ Form::label('name', 'Название') }}
            {{ Form::text('name','',array('class' => 'form-control','placeholder' => 'Название фотоальбома')) }}
            {{ $errors->first('name') }}
        </div>
        <div class="form-group">
            {{ Form::label('slug', 'Латинское название') }}
            {{ Form::text('slug','',array('class' => 'form-control','placeholder' => 'Латинское наименование фотоальбома')) }}
            {{ $errors->first('slug') }}
        </div>
        <div class="form-group">
            {{ Form::label('position', 'Позиция для сортировки') }}
            {{ Form::text('position','',array('class' => 'form-control','placeholder' => 'Позиция для сортировки')) }}
            {{ $errors->first('position') }}
        </div>
        <div class="form-group">
            {{ Form::label('parent_id', 'Корневой фотоальбом') }}
            {{ Form::select('parent_id', $albums, '', array('class' => 'form-control')) }}
            {{ $errors->first('parent_id') }}
        </div>
        <div class="form-group">
            {{ Form::label('keywords', 'Ключевые слова для метатегов (метатеги keywords)') }}
            {{ Form::textarea('keywords','',array('class' => 'form-control','placeholder' => 'Ключевые слова для метатегов (метатеги keywords)')) }}
            {{ $errors->first('keywords') }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Описание для фотоальбома (метатеги description)') }}
            {{ Form::text('description','',array('class' => 'form-control','placeholder' => 'Описание для фотоальбома (метатеги description)')) }}
            {{ $errors->first('description') }}
        </div>
        <div class="form-group">
            {{ Form::label('is_system', 'Системный фотоальбом - не отображается на сайте и в списках выбора') }}
            {{ Form::checkbox('is_system', 'value') }}
            {{ $errors->first('is_system') }}
        </div>
        <div class="form-group">
            {{ Form::label('is_add', 'Разрешено добавление фотографий') }}
            {{ Form::checkbox('is_add', 'value') }}
            {{ $errors->first('is_add') }}
        </div>
        {{ Form::submit('Добавить фотоальбом', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop