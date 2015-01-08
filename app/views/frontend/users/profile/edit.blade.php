@extends('layouts.blocks')
@section('title')
Редактирование профиля
@stop
@section('content')
@include('users.sidebars.profile')
<div class="col-md-8">
    <!-- Widget Text-->
    <div class="panel-box">
        <div class="titles">
            <h4><i class="fa fa-user"></i> Основная информация профиля: {{$user->username}}</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.alerts')
                {{ Form::open(array('route' => 'edit-profile')) }}
                <div class="form-group">
                    {{ Form::label('full_name', 'Ваше полное имя') }}
                    {{ Form::text('full_name',$user->full_name,array('class' => 'form-control','placeholder' => 'Введите Ваше полное имя')) }}
                    {{ $errors->first('full_name') }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Адрес электронной почты') }}
                    {{ Form::email('email',$user->email,array('class' => 'form-control','placeholder' => 'Введите адрес электронной почты')) }}
                    {{ $errors->first('email') }}
                </div>
                <div class="form-group">
                    {{ Form::label('url', 'Ваш адрес сайта') }}
                    {{ Form::text('url',$user->url,array('class' => 'form-control','placeholder' => 'Введите Ваш Web-сайт')) }}
                    {{ $errors->first('url') }}
                </div>
                {{ Form::submit('Сохранить изменения', array('class' => 'btn btn-lg btn-primary')) }}
                {{ Form::close() }}
                <br />
            </div>
        </div>
    </div>
    <!-- End Widget Text-->
</div>
@stop