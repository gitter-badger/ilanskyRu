@extends('frontend.layouts.page')
@section('title')
Авторизация
@stop
@section('content')
<div class="col-md-12">
    @include('frontend.layouts.alerts')
    <!-- Форма авторизации -->
    {{ Form::open(array('route' => array('user-login',$redirect),'class' => 'form-theme','name' => 'frmAuth','ng-controller' => 'UserAuthCtrl', 'novalidate')) }}
    <div class="form-group" ng-class="{'has-error': frmAuth.username.$invalid && frmAuth.username.$dirty, 'has-success': frmAuth.username.$valid}">
        {{ Form::label('username', 'Имя пользователя') }}
        {{ Form::text('username','',array('class' => 'form-control','ng-model' => 'user.username','placeholder' => 'Имя пользователя', 'minlength' => 3, 'maxlength' => 40, 'autocomplete' => 'username', 'required')) }}
        {{ $errors->first('username') }}
        <div ng-messages="frmAuth.username.$error" ng-messages-include="templates/form-messages.tpl"></div>
    </div>
    <div class="form-group" ng-class="{'has-error': frmAuth.password.$invalid && frmAuth.password.$dirty, 'has-success': frmAuth.password.$valid}">
        {{ Form::label('password', 'Пароль') }}
        {{ Form::password('password',array('class' => 'form-control','ng-model' => 'user.password', 'placeholder' => 'Ваш пароль', 'minlength' => 6, 'required')) }}
        {{ $errors->first('password') }}
        <div ng-messages="frmAuth.password.$error" ng-messages-include="templates/form-messages.tpl"></div>
    </div>
    {{ Form::hidden('redirect',$redirect) }}
    {{ Form::submit('Войти на сайт', array('class' => 'btn btn-lg btn-primary','ng-disabled' => 'frmAuth.$invalid')) }}
    {{ Form::close() }}
    <br />
    <p><i class="fa fa-info"></i> Не зарегистрированы? Пройдите <a href="{{{ route('get-user-register') }}}">регистрацию</a>, это займет не более 2-х минут.</p>
    <p><i class="fa fa-info"></i> Забыли пароль? Попробуйте сделать <a href="{{ route('user-remind') }}">восстановление пароля</a>.</p>
 </div>
@stop