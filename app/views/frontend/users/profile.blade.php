@extends('layouts.blocks')
@section('title')
Мой профиль
@stop
@section('content')
@include('users.sidebars.profile')
<div class="col-md-9">
    <!-- Widget Text-->
    <div class="panel-box">
        <div class="titles">
            <h4><i class="fa fa-user"></i> Профиль: {{$user->username}}</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.alerts')
                @if (!$user->isActive)
                <div class="alert alert-danger" style="text-align: justify">
                    <strong>Внимание!</strong> Ваш E-mail адрес не был подтверждён. Функиональность профиля ограничена. Для разблокировки профиля подтвердите Ваш E-mail. Если Вам не пришло письмо активации - Вы можете запросить его <a href="/user/reactivate">повторно</a>.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <img src="#" class="img-responsive">
                    </div>
                    <div class="col-md-8">

                    </div>
                </div>



                <p><strong>Ваш E-mail:</strong> {{$user->email}}<sup>*</sup></p>
                <p><strong>Группа:</strong> {{$role->name}}</p>
                <p><sup>*</sup> - не отображается на сайте</p>
                <p align="right"><a href="{{{ route('user-edit-profile') }}}"><i class="fa fa-pencil-square-o"></i> Редактировать профиль</a></p>
            </div>
        </div>
    </div>
    <!-- End Widget Text-->
</div>
@stop