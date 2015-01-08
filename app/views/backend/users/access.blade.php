@extends('backend.layouts.page')
@section('title')
Настройка доступа пользователя "{{{$user->username}}}"
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('route' => array('admin-users-access', $user->id))) }}
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Охрана вкл.</th>
                <th>Русское наименование</th>
                <th>Выбор</th>
            </tr>
            </thead>
            <tbody>
        @foreach ($resources as $resource)
        <tr>
            <td>{{{ $resource->id }}}</td>
            <td>@if ($resource->secure)
                <i class="fa fa-check"></i>
                @else
                <i class="fa fa-times"></i>
                @endif
            </td>
            <td>{{{ $resource->rus_name }}}</td>
            <td>{{ Form::checkbox("resource_id[]", $resource->id, $user->resources->contains($resource->id)) }}</td>
        </tr>
        @endforeach
            </tbody>
        </table>
        {{ Form::submit('Сохранить параметры доступа', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop