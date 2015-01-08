@extends('emails.layouts.default')
@section('theme')
Активация учётной записи
@stop
@section('body')
Ваш E-mail был использован для регистрации на сайте "{{ Config::get('app.sitename') }}"<br />
Для подтверждения регистрации перейдите по ссылке: <a href="{{ $activationUrl }}">{{ $activationUrl }}</a>
@stop