@extends('backend.layouts.page')
@section('title')
Добавить категорию
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('route' => array('admin-dossier-cat-add'))) }}
        <div class="form-group">
            {{ Form::label('name', 'Название') }}
            {{ Form::text('name','',array('class' => 'form-control','placeholder' => 'Название категории')) }}
            {{ $errors->first('name') }}
        </div>
        <div class="form-group">
            {{ Form::label('slug', 'Латинское название') }}
            {{ Form::text('slug','',array('class' => 'form-control','placeholder' => 'Латинское наименование категории')) }}
            {{ $errors->first('slug') }}
        </div>
        {{ Form::submit('Добавить категорию', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop