@extends('layouts.page')
@section('title')
Пользователи
@stop
@section('content')
<div class="col-md-12">
    @if ($users_cnt === 0)
    <p align="center">Пользотелей в системе не зарегистрировано.</p>
    @else
    <!-- Строим таблицу пользователей -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th>
                Ник
            </th>
            <th>
                Зарегистрирован
            </th>
            <th>
                Группа
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td><a href="{{{ route('users',  $user->username) }}}">{{ $user->username }}</a></td>
                <td>{{ LocalizedCarbon::instance($user->created_at)->diffForHumans() }}</td>
                <td>{{ User::getRoleName($user->id) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p>Всего зарегистрировано: <strong>{{$users_cnt}}</strong> пользователя(-ей) системы.</p>
    @endif
    <div style="text-align: center"><?php echo $users->links(); ?></div>
</div>
@stop