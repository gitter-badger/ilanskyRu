@extends('backend.layouts.page')
@section('title')
Редактировать пользователя
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4>Редактирование {{$user->username}}</h4>
        {{ Form::open(array('route' => array('admin-users-edit', $user->id))) }}
        <!-- Адрес электронной почты -->
        <div class="form-group">
            {{ Form::label('email', 'Адрес электронной почты:') }}
            {{ Form::email('email',$user->email,array('class' => 'form-control','placeholder' => 'Адрес электронной почты')) }}
            {{ $errors->first('email') }}
        </div>
        <!-- Группа пользователя -->
        <div class="form-group">
            {{ Form::label('role', 'Группа пользователя') }}
            {{ Form::select('role', $roles, User::getLatRoleName($user->id), array('class' => 'form-control')) }}
            {{ $errors->first('role') }}
        </div>
        {{ Form::submit('Сохранить изменения', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop