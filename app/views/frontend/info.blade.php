@extends('layouts.page')
@section('title')
Информационное сообщение
@stop
@section('content')
<div class="col-md-12">
    <p align="justify"><i class="fa fa-info"></i> {{$message}}</p>
    @if ($redirect)
    <script type="application/javascript">
        setTimeout(
            function() {
                location.href = '{{$redirect}}';
            },
            10000
        );
    </script>
    <p class="lead" align="center">Нажмите <a href="{{$redirect}}">эту ссылку</a>, если Ваш браузер не поддерживает автоматической переадресации.</p>
    @endif
</div>
@stop
