@extends('admin.layouts.page')
@section('title')
Настройка охраны операций
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('route' => array('admin-secure'))) }}
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя операции</th>
                <th>Русское наименование</th>
                <th>Ссылка</th>
                <th>Операция</th>
                <th>Охрана вкл.</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($resources as $resource)
            <tr>
                <td>{{{ $resource->id }}}</td>
                <td><fieldset disabled>{{ Form::text('secure['.$resource->id.'][name]',$resource->name,array('class' => 'form-control input-sm','placeholder' => 'Имя операции')) }}</fieldset></td>
                <td>{{ Form::text('secure['.$resource->id.'][rus_name]',$resource->rus_name,array('class' => 'form-control input-sm','placeholder' => 'Русское наименование для настройки доступа')) }}</td>
                <td><fieldset disabled>{{ Form::text('target['.$resource->id.'][target]',$resource->target,array('class' => 'form-control input-sm')) }}</fieldset></td>
                <td><fieldset disabled>{{ Form::text('action['.$resource->id.'][action]',$resource->action,array('class' => 'form-control input-sm')) }}</fieldset></td>
                <td>{{ Form::checkbox('secure['.$resource->id.'][secure]',$resource->secure,$resource->secure) }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ Form::submit('Сохранить настройки операций', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
        <p align="center"><?php echo $resources->links(); ?></p>
    </div>
</div>
@stop