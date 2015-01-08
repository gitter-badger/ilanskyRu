@extends('layouts.page')
@section('title')
Восстановление пароля
@stop
@section('content')
<div class="col-md-12">
    <p>Для самостоятельного восстановления пароля необходимо знать адрес e-mail, указанный при регистрации.</p>
    <p>На указанный адрес e-mail будет отправлена ссылка на страницу восстановления пароля.</p>
    @include('layouts.alerts')
    <!-- Форма восстановления пароля -->
    {{ Form::open(array('route' => 'user-remind')) }}
    <div class="form-group">
        {{ Form::label('email', 'E-mail') }}
        {{ Form::email('email','',array('class' => 'form-control','placeholder' => 'Введите Ваш адрес электронной почты', 'required' => 'required')) }}
        {{ $errors->first('email') }}
    </div>
    <div class="form-group">
        {{ Form::label('captcha', 'Код безопастности') }}
        <br/>
        {{ HTML::image(Captcha::url()) }}
        <br/><br/>
        {{ Form::text('captcha','',array('class' => 'form-control','placeholder' => 'Введите код безопасности', 'required' => 'required')) }}
        @if ($errors->first('captcha'))
        Ошибка ввода кода безопасности
        @endif
    </div>
    {{ Form::submit('Восстановить пароль', array('class' => 'btn btn-lg btn-primary')) }}
    {{ Form::close() }}
    <br />
</div>
@stop