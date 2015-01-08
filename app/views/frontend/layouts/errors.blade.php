@extends('frontend.layouts.blocks')
@section('title')
{{{ $code }}}: {{{ $title }}}
@stop
@section('content')
<div class="page-error">
    <h1>{{{ $code }}} <i class="fa fa-frown-o"></i></h1>
    <hr class="tall">
    <p class="lead">{{{ $errtext }}}</p>
    @if ($code == '500')
    <p><strong>Отладочная информация, можете отправить её на адрес: <a href="mailto:daniil@savenkoff.com?subject=StackTrace">daniil<i class="fa fa-at"></i>savenkoff.com</a>. Мы будем очень благодарны.</strong></p>
    <textarea maxlength="5000" rows="10" class="form-control" style="height: 138px;">{{$exception}}</textarea><br/>
    @endif
    <a href="javascript:history.back()" class="btn btn-lg btn-primary">Вернуться назад</a>
</div>
@stop