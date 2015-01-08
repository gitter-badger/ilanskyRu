@extends('backend.layouts.page')
@section('title')
Редактировать досье "{{ $dos->name }}"
@stop
@section('styles')
	<style>
		body {
			font-size: 15px;
			font-family: "Helvetica Neue";
		}

		.b-button {
			display: inline-block;
			*display: inline;
			*zoom: 1;
			position: relative;
			overflow: hidden;
			cursor: pointer;
			padding: 4px 15px;
			vertical-align: middle;
			border: 1px solid #ccc;
			border-radius: 3px;
			background-color: #f5f5f5;
			background: -moz-linear-gradient(top, #fff 0%, #f5f5f5 49%, #ececec 50%, #eee 100%);
			background: -webkit-linear-gradient(top, #fff 0%,#f5f5f5 49%,#ececec 50%,#eee 100%);
			background: -o-linear-gradient(top, #fff 0%,#f5f5f5 49%,#ececec 50%,#eee 100%);
			background: linear-gradient(to bottom, #fff 0%,#f5f5f5 49%,#ececec 50%,#eee 100%);
			-webkit-user-select: none;
			-moz-user-select: none;
			user-select: none;
		}
			.b-button_hover {
				border-color: #fa0;
				box-shadow: 0 0 2px #fa0;
			}

			.b-button__text {
			}

			.b-button__input {
				cursor: pointer;
				opacity: 0;
				filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
				top: -10px;
				right: -40px;
				font-size: 50px;
				position: absolute;
			}


	#preview {
		max-width: 600px;
		box-shadow: 0 1px 3px rgba(0,0,0,.4);
		border-radius: 3px;
	}
		.b-file {
			height: 40px;
			padding: 5px;
			position: relative;
			overflow: hidden;
			border-radius: 3px;
			background-color: #fcfcfc;
			background: -webkit-linear-gradient(top, #fcfcfc 0%, #f6f6f6 100%);
			background: -moz-linear-gradient(top, #fcfcfc 0%, #f6f6f6 100%);
			background: -o-linear-gradient(top, #fcfcfc 0%, #f6f6f6 100%);
			background: linear-gradient(to bottom, #fcfcfc 0%, #f6f6f6 100%);
			clear: both;
		}
			.b-file__left {
				float: left;
				margin: 1px 0 0 2px;
				line-height: 0;
			}
				.b-file__left_border {
					border: 2px solid #fff;
					border-radius: 4px;
				}

			.b-file__right {
				margin-left: 45px;
			}

			.b-file__name {
				color: #36c;
				cursor: pointer;
				border-bottom: 1px dotted #36c;
				text-decoration: none;
			}
				.b-file__name:hover {
					color: #f00;
					border-bottom-color: #f00;
				}

			.b-file__info {
				color: #666;
				position: absolute;
				font-size: 12px;
				margin-top: 3px;
			}

			.b-file__bar {
				padding-top: 4px;
			}

			.b-file__error {
				color: #c00;
			}
			.b-file__done {
				color: #458383;
			}
			.b-file__abort {
				top: 10px;
				right: 20px;
				width: 15px;
				height: 15px;
				position: absolute;
				color: #c00;
				cursor: pointer;
				font-size: 20px;
				display: none;
			}
				.b-file_upload .b-file__abort { display: block; }

		.b-progress {
			width: 200px;
			height: 10px;
			border: 2px solid #E2E4E2;
			border-radius: 10px;
			box-shadow: inset 0 1px 1px rgba(0,0,0,.2);
			background-color: #d3d3d3;
			position: relative;
		}
			.b-progress__bar {
				width: 0;
				height: 10px;
				border-radius: 10px;
				background-color: #2D9DD7;
				background: -webkit-linear-gradient(top, #2D9DD7 0%, #1C81C7 100%); /* FF3.6+ */
				background: -moz-linear-gradient(top, #2D9DD7 0%, #1C81C7 100%); /* FF3.6+ */
				background: linear-gradient(to bottom, #2D9DD7 0%, #1C81C7 100%); /* FF3.6+ */
				-webkit-transition: width .5s ease-out;
				-moz-transition: width .5s ease-out;
				-ms-transition: width .5s ease-out;
				transition: width .5s ease-out;
			}

		.b-dropzone,
		.b-dropzone__bg {
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 30000;
			position: absolute;
		}
			.b-dropzone__bg {
				opacity: .2;
				background-color: #2D9DD7
			}
			.b-dropzone__txt {
				color: #1C81C7;
				text-shadow: 0 2px 1px #113C53;
				font-size: 400%;
				font-weight: bold;
				text-align: center;
				width: 500px;
				top: 50%;
				left: 50%;
				margin: -100px 0 0 -250px;
				z-index: 30001;
				position: absolute;
			}

		.b-layer {
			border: 3px solid #fff;
			border-radius: 5px;
			box-shadow: 0 1px 30px #000;
			background-color: #f3f3f3;
			top: 50px;
			left: 50%;
			z-index: 30002;
			position: absolute;
			margin-left: -150px;
			margin-bottom: 100px;
		}
			.b-layer__h1 {
				color: #fff;
				padding: 10px 10px;
				width: 300px;
				overflow: hidden;
				background-color: #2D9DD7;
			}
			.b-layer__img {
				padding: 5px 10px;
				text-align: center;
				border-top: 2px solid #fff;
			}
			.b-layer__info {
				padding: 2px 15px;
				border-top: 2px solid #fff;
			}
				.b-layer__info div {
					width: 280px;
					overflow: hidden;
					white-space: nowrap;
				}


	</style>

	<script src="/api/mailru/FileAPI/plugins/FileAPI.id3.js"></script>
	<script src="/api/mailru/FileAPI/plugins/FileAPI.exif.js"></script>

@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('route' => array('admin-dossier-edit', $dos->id), 'files' => 'true')) }}
        <div class="form-group">
            {{ Form::label('name', 'Название') }}
            {{ Form::text('name',$dos->name,array('class' => 'form-control','placeholder' => 'Имя досье')) }}
            {{ $errors->first('name') }}
        </div>
        <div class="form-group">
            {{ Form::label('slug', 'Латинское название') }}
            {{ Form::text('slug',$dos->slug,array('class' => 'form-control','placeholder' => 'Латинское наименование категории')) }}
            {{ $errors->first('slug') }}
        </div>
        <div class="form-group">
            {{ Form::label('alpha', 'Буква алфавита') }}
            {{ Form::text('alpha',$dos->alpha,array('class' => 'form-control','placeholder' => 'Буква алфавита')) }}
            {{ $errors->first('alpha') }}
        </div>
        <div class="form-group">
            {{ Form::label('cat', 'Категория') }}
            {{ Form::select('cat', $cats, $dos->cat->id, array('class' => 'form-control')) }}
            {{ $errors->first('cat') }}
        </div>
        <div class="form-group">
            {{ Form::label('short', 'Должность, краткое описание') }}
            {{ Form::text('short',$dos->short,array('class' => 'form-control','placeholder' => 'Должность, краткое описание')) }}
            {{ $errors->first('short') }}
        </div>
        <div class="form-group">
            {{ Form::label('content', 'Содержание досье') }}
            {{ Form::textarea('content',$dos->content,array('class' => 'form-control','placeholder' => 'Содержание досье')) }}
            {{ $errors->first('content') }}
        </div>
        <div class="form-group">
            {{ Form::label('web', 'Вэб-сайт') }}
            {{ Form::text('web',$dos->web,array('class' => 'form-control','placeholder' => 'Введите Web-сайт')) }}
            {{ $errors->first('web') }}
        </div>
        <div class="form-group">
            {{ Form::label('image', 'Изображение досье') }}
			{{ Form::file('image') }}
            {{ $errors->first('image') }}
        </div>
		{{ Form::submit('Сохранить досье', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
@stop
@section('js-footer')
<script src="/theme/js/ckeditor/ckeditor.js"></script>
<script> CKEDITOR.replace( 'content' );</script>
@stop