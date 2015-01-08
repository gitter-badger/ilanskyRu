@extends('layouts.blocks')
@section('title')
Регистрация
@stop
@section('content')
<div class="col-md-8">
    <!-- Widget Text-->
    <div class="panel-box">
        <div class="titles">
            <h4>Регистрация нового пользователя</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.alerts')
                <!-- Форма авторизации -->
                {{ Form::open(array('route' => 'user-register')) }}
                <div class="form-group">
                    {{ Form::label('email', 'Адрес электронной почты') }}
                    {{ Form::email('email','',array('class' => 'form-control','placeholder' => 'Введите адрес электронной почты', 'required' => 'required')) }}
                    {{ $errors->first('email') }}
                </div>
                <div class="form-group">
                    {{ Form::label('username', 'Имя пользователя') }}
                    {{ Form::text('username','',array('class' => 'form-control','placeholder' => 'Введите имя пользователя', 'required' => 'required')) }}
                    {{ $errors->first('username') }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Пароль') }}
                    {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Введите пароль', 'required' => 'required')) }}
                    {{ $errors->first('password') }}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Подтверждение пароля') }}
                    {{ Form::password('password_confirmation',array('class' => 'form-control','placeholder' => 'Введите подтверждение пароля', 'required' => 'required')) }}
                    {{ $errors->first('password_confirmation') }}
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
                {{ Form::submit('Зарегистрироваться', array('class' => 'btn btn-lg btn-primary')) }}
                {{ Form::close() }}
                <br />
                <p><i class="fa fa-info"></i> Уже зарегистрированы? Пройдите <a href="{{{ route('user-login') }}}">авторизацию</a> и используйте все возможности сайта полностью!</p>
            </div>
        </div>
    </div>
    <!-- End Widget Text-->
</div>
@include('users.sidebars.register')
<!-- End Section Area - Content Central -->
@stop