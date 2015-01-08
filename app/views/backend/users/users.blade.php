@extends('backend.layouts.page')
@section('title')
Пользователи
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <p><a href="{{ route('admin-users-add') }}" class="btn btn-default">Добавить пользователя</a></p>
        <p>Общее кол-во пользователей в системе: <strong>{{$users_cnt}}</strong></p>
        @if ($users_cnt != 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <!--
                    Форматируем выделение таблицы в зависимости от группы пользователя:
                    success - класс для Администраторов
                    info    - класс для Уникальных ролей
                    warning - класс для пользователей на подтверждении
                    danger  - класс для забаненных пользователей
                -->
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{{ route('users', $user->username) }}}" target="_blank">{{$user->username}}</a></td>
                    <td>{{ User::getRoleName($user->id) }}</td>
                    <td>
                        <a href="{{{ route('admin-users-access', $user->id) }}}" title="Назначить особые права пользователю"><i class="fa fa-check-circle-o"></i></a>
                        <a href="{{{ route('admin-users-edit', $user->id) }}}" title="Редактировать пользователя"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="{{{ route('admin-users-del', $user->id) }}}" onclick="return confirm('Вы уверены?');" title="Удалить пользователя"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@stop