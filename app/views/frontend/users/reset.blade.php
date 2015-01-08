@extends('layouts.page')
@section('title')
Сброс пароля
@stop
@section('content')
<div class="col-md-12">
    @include('layouts.alerts')
    <!-- Форма сброса пароля -->
    {{ Form::open(array('route' => array('user-reset-password', $token))) }}
        {{ Form::hidden('token', $token) }}
    <div class="form-group">
        {{ Form::label('email', 'Введите Ваш адрес электронной почты') }}
        {{ Form::email('email','',array('class' => 'form-control','placeholder' => 'Введите Ваш адрес электронной почты', 'required' => 'required')) }}
        {{ $errors->first('email') }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Введите новый пароль') }}
        {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Ваш новый пароль', 'required' => 'required')) }}
        {{ $errors->first('password') }}
    </div>
    <div class="form-group">
        {{ Form::label('password_confirmation', 'Подтверждение пароля') }}
        {{ Form::password('password_confirmation',array('class' => 'form-control','placeholder' => 'Введите подтверждение пароля', 'required' => 'required')) }}
        {{ $errors->first('password_confirmation') }}
    </div>
    {{ Form::submit('Сбросить пароль', array('class' => 'btn btn-lg btn-primary')) }}
    {{ Form::close() }}
    <br/>
    <p><p><i class="fa fa-info"></i> Неверная ссылка для сброса пароля? Вероятно ссылка устарела, необнохомо заново пройти процедуру <a href="{{ route('user-remind') }}">восстановления пароля</a>.</p></p>
</div>
@stop