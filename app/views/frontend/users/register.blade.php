@extends('frontend.layouts.blocks')
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
                @include('frontend.layouts.alerts')
                <!-- Форма авторизации -->
                {{ Form::open(array('route' => 'post-user-register','class' => 'form-theme', 'name' => 'frmReg','ng-controller' => 'UserRegisterCtrl', 'novalidate')) }}
                <div class="form-group" ng-class="{'has-error': frmReg.email.$invalid && frmReg.email.$dirty, 'has-success': frmReg.email.$valid}">
                    {{ Form::label('email', 'Адрес электронной почты:') }}
                    {{ Form::email('email','',array('class' => 'form-control','ng-model' => 'user.email','placeholder' => 'Введите адрес электронной почты', 'minlength' => 6, 'maxlength' => 60, 'autocomplete' => 'email', 'required', 'server-validator' => 'api/user/check-email/')) }}
                    {{ $errors->first('email') }}
                    <div ng-messages="frmReg.email.$error" ng-messages-include="templates/form-messages.tpl"></div>
                </div>
                <div class="form-group" ng-class="{'has-error': frmReg.username.$invalid && frmReg.username.$dirty, 'has-success': frmReg.username.$valid}">
                    {{ Form::label('username', 'Имя пользователя') }}
                    {{ Form::text('username','',array('class' => 'form-control','ng-model' => 'user.username','placeholder' => 'Введите имя пользователя', 'minlength' => 3, 'maxlength' => 40, 'autocomplete' => 'username', 'required', 'server-validator' => 'api/user/check-user/')) }}
                    {{ $errors->first('username') }}
                    <div ng-messages="frmReg.username.$error" ng-messages-include="templates/form-messages.tpl"></div>
                </div>
                <div class="form-group" ng-class="{'has-error': frmReg.password.$invalid && frmReg.password.$dirty, 'has-success': frmReg.password.$valid}">
                    {{ Form::label('password', 'Пароль') }}
                    {{ Form::password('password',array('class' => 'form-control','ng-model' => 'user.password','placeholder' => 'Введите пароль', 'minlength' => 6, 'required')) }}
                    {{ $errors->first('password') }}
                    <div ng-messages="frmReg.password.$error" ng-messages-include="templates/form-messages.tpl"></div>
                </div>
                <div class="form-group" ng-class="{'has-error': frmReg.password_confirmation.$invalid && frmReg.password_confirmation.$dirty, 'has-success': frmReg.password_confirmation.$valid}">
                    {{ Form::label('password_confirmation', 'Подтверждение пароля') }}
                    {{ Form::password('password_confirmation',array('class' => 'form-control','ng-model' => 'user.password_confirmation','placeholder' => 'Введите подтверждение пароля', 'minlength' => 6, 'required', 'password-validator' => 'user.password')) }}
                    {{ $errors->first('password_confirmation') }}
                    <div ng-messages="frmReg.password_confirmation.$error" ng-messages-include="templates/form-messages.tpl"></div>
                </div>
                <div class="form-group"  ng-class="{'has-error': frmReg.captcha.$invalid && frmReg.captcha.$dirty, 'has-success': frmReg.captcha.$valid}">
                    {{ Form::label('captcha', 'Код безопастности') }}
                    <br/>
                    {{ HTML::image(Captcha::url()) }}
                    <br/><br/>
                    {{ Form::text('captcha','',array('class' => 'form-control','ng-model' => 'user.captcha', 'placeholder' => 'Введите код безопасности', 'minlength' => 5, 'maxlength' => 5, 'required')) }}
                    @if ($errors->first('captcha'))
                        Ошибка ввода кода безопасности
                    @endif
                    <div ng-messages="frmReg.captcha.$error" ng-messages-include="templates/form-messages.tpl"></div>
                </div>
                {{ Form::submit('Зарегистрироваться', array('class' => 'btn btn-lg btn-primary','ng-disabled' => 'frmReg.$invalid')) }}
                {{ Form::close() }}
                <br />
                <p><i class="fa fa-info"></i> Уже зарегистрированы? Пройдите <a href="{{{ route('user-login') }}}">авторизацию</a> и используйте все возможности сайта полностью!</p>
            </div>
        </div>
    </div>
    <!-- End Widget Text-->
</div>
@include('frontend.users.sidebars.register')
<!-- End Section Area - Content Central -->
@stop