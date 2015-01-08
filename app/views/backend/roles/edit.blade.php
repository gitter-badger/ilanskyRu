@extends('backend.layouts.page')
@section('title')
Реактировать роль
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('route' => array('admin-roles-edit'))) }}
        <div class="form-group">
            {{ Form::label('name', 'Наименование') }}
            {{ Form::text('name',$role->name,array('class' => 'form-control','placeholder' => 'Наименование')) }}
            {{ $errors->first('name') }}
        </div>
        <div class="form-group">
            {{ Form::label('lat_name', 'Латинское наименование') }}
            {{ Form::text('lat_name',$role->lat_name,array('class' => 'form-control','placeholder' => 'Латинское наименование')) }}
            {{ $errors->first('lat_name') }}
        </div>
        {{ Form::submit('Сохранить роль', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop