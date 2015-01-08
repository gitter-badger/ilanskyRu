@extends('backend.layouts.page')
@section('title')
Добавить досье
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('route' => array('admin-dossier-add'))) }}
        <div class="form-group">
            {{ Form::label('name', 'Название') }}
            {{ Form::text('name','',array('class' => 'form-control','placeholder' => 'Имя досье')) }}
            {{ $errors->first('name') }}
        </div>
        <div class="form-group">
            {{ Form::label('slug', 'Латинское название') }}
            {{ Form::text('slug','',array('class' => 'form-control','placeholder' => 'Латинское наименование категории')) }}
            {{ $errors->first('slug') }}
        </div>
        <div class="form-group">
            {{ Form::label('alpha', 'Буква алфавита') }}
            {{ Form::text('alpha','',array('class' => 'form-control','placeholder' => 'Буква алфавита')) }}
            {{ $errors->first('alpha') }}
        </div>
        <div class="form-group">
            {{ Form::label('cat', 'Категория') }}
            {{ Form::select('cat', $cats, '', array('class' => 'form-control')) }}
            {{ $errors->first('cat') }}
        </div>
        <div class="form-group">
            {{ Form::label('short', 'Должность, краткое описание') }}
            {{ Form::text('short','',array('class' => 'form-control','placeholder' => 'Должность, краткое описание')) }}
            {{ $errors->first('short') }}
        </div>
        <div class="form-group">
            {{ Form::label('content', 'Содержание досье') }}
            {{ Form::textarea('content','',array('class' => 'form-control','placeholder' => 'Содержание досье')) }}
            {{ $errors->first('content') }}
        </div>
        <div class="form-group">
            {{ Form::label('web', 'Вэб-сайт') }}
            {{ Form::text('web','',array('class' => 'form-control','placeholder' => 'Введите Web-сайт')) }}
            {{ $errors->first('web') }}
        </div>
        {{ Form::submit('Добавить досье', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop
@section('js-footer')
<script src="/theme/js/ckeditor/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'content' );
</script>
@stop