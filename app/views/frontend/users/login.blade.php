@extends('frontend.layouts.page')
@section('title')
Авторизация
@stop
@section('content')
<div class="col-md-12">
    @include('frontend.layouts.alerts')
    <!-- Форма авторизации -->
    {{ Form::open(array('route' => array('user-login',$redirect))) }}
    <div class="form-group">
        {{ Form::label('username', 'Имя пользователя') }}
        {{ Form::text('username','',array('class' => 'form-control','placeholder' => 'Имя пользователя', 'required' => 'required')) }}
        {{ $errors->first('username') }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Пароль') }}
        {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Ваш пароль', 'required' => 'required')) }}
        {{ $errors->first('password') }}
    </div>
    {{ Form::hidden('redirect',$redirect) }}
    {{ Form::submit('Войти на сайт', array('class' => 'btn btn-lg btn-primary')) }}
    {{ Form::close() }}
    <br />
    <p><i class="fa fa-info"></i> Не зарегистрированы? Пройдите <a href="{{{ route('user-register') }}}">регистрацию</a>, это займет не более 2-х минут.</p>
    <p><i class="fa fa-info"></i> Забыли пароль? Попробуйте сделать <a href="{{ route('user-remind') }}">восстановление пароля</a>.</p>
 </div>
@stop