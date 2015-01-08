@extends('backend.layouts.page')
@section('title')
Добавить пользователя
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('route' => array('admin-users-add'))) }}
        <!-- Логин -->
        <!-- Адрес электронной почты -->
        <div class="form-group">
            {{ Form::label('username', 'Логин пользователя:') }}
            {{ Form::text('username','',array('class' => 'form-control','placeholder' => 'Логин пользователя')) }}
            {{ $errors->first('username') }}
        </div>
        <!-- Адрес электронной почты -->
        <div class="form-group">
            {{ Form::label('full_name', 'Адрес электронной почты:') }}
            {{ Form::email('email','',array('class' => 'form-control','placeholder' => 'Адрес электронной почты')) }}
            {{ $errors->first('email') }}
        </div>
        <!-- Группа пользователя -->
        <div class="form-group">
            {{ Form::label('role', 'Группа пользователя') }}
            {{ Form::select('role', $roles, $def_role->lat_name, array('class' => 'form-control')) }}
            {{ $errors->first('role') }}
        </div>
        <!-- Пароль пользовтеля -->
        <div class="form-group">
            {{ Form::label('password', 'Пароль') }}
            {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Пароль пользователя', 'required' => 'required')) }}
            {{ $errors->first('password') }}
        </div>
        <div class="form-group">
            {{ Form::label('password_confirmation', 'Подтверждение пароля') }}
            {{ Form::password('password_confirmation',array('class' => 'form-control','placeholder' => 'Подтверждение пароля', 'required' => 'required')) }}
            {{ $errors->first('password_confirmation') }}
        </div>
        {{ Form::submit('Добавить пользователя', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop