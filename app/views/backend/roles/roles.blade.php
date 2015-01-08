@extends('backend.layouts.page')
@section('title')
Роли пользователей
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <p><a href="{{ route('admin-roles-add') }}" class="btn btn-default">Добавить роль</a></p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Анг.наименование</th>
                    <th>Кол-во пользователей</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->lat_name }}</td>
                    <td><a href="{{ route('admin-roles', $role->lat_name) }}">{{ $role->users()->get()->count() }}</a></td>
                    <td>
                        <a href="{{ route('admin-roles-access', $role->id) }}" title="Установить права роли"><i class="fa fa-check-circle-o"></i></a>
                        <a href="{{ route('admin-roles-edit', $role->id) }}" title="Редактировать роль"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="{{ route('admin-roles-delete', $role->id) }}" title="Удалить роль" onclick="return confirm('Вы уверены?');"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop