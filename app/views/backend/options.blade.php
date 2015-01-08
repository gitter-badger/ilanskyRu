@extends('backend.layouts.page')
@section('title')
Настройка сайта
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
    {{ Form::open(array('route' => array('admin-options'), 'files' => 'true', 'class' => 'form-horizontal', 'role' => 'form')) }}
        <ul class="nav nav-tabs" role="tablist" id="options">
          <li class="active"><a href="#default" role="tab" data-toggle="tab">Общие</a></li>
          <li><a href="#gallery" role="tab" data-toggle="tab">Галлерея</a></li>
          <li><a href="#dossier" role="tab" data-toggle="tab">Досье</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane fade in active" id="default">
          <br/>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[title]', 'Название сайта',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>например: "Моя домашняя страница"</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[title]',Options::get_option('title', false),array('placeholder' => 'Название сайта', 'class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[title]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[description]', 'Описание (Description) сайта',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>Краткое описание, не более 200 символов</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[description]',Options::get_option('description', false),array('placeholder' => 'Описание (Description) сайта', 'class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[description]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[keywords]', 'Ключевые слова (Keywords) для сайта:',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>Введите через запятую основные ключевые слова для вашего сайта</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[keywords]',Options::get_option('keywords', false),array('placeholder' => 'Ключевые слова (Keywords) для сайта', 'class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[keywords]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[skin]', 'Цветовое оформление сайта',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>Выбирете один из существующих цветовых решений</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::select('options[skin]', $skins, Options::get_option('skin', false), array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[skin]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[db_cache]', 'Время кеширования запросов из БД:',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>Введите в минутах время кеширования запросов из БД</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[db_cache]',Options::get_option('db_cache', false),array('placeholder' => 'Введите в минутах время кеширования запросов из БД', 'class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[db_cache]') }}
            </div>
          </div>
          <div class="tab-pane fade" id="gallery">
          <br/>
          <div class="form-group">
              <div class="col-xs-2 col-md-5 col-sm-6">
                  {{ Form::label('options[img_cnt]', 'Количество изображений на страницу',array('class' => 'control-label ')) }}
                  <p class="text-muted"><i><small>Разбиение на страницы происходит автоматически</small></i></p>
              </div>
              <div class="col-xs-10 col-md-7 col-sm-6">
                {{ Form::text('options[img_cnt]',Options::get_option('img_cnt', false),array('placeholder' => 'Количество изображений на страницу', 'class' => 'form-control')) }}
              </div>
              {{ $errors->first('options[img_cnt]') }}
          </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[img_indx_gallery]', 'Корневая галлерея для отображения на сайте',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>Укажите альбом, который будет являться корневым для отображаения на сайте</small></i></p>
                    <p class="text-muted"><i><small>На сайте будут отображаться все альбомы, кроме имеющих признак "системный"</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::select('options[img_indx_gallery]', $gallery, Options::get_option('img_indx_gallery', false), array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[img_max_up_side]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[img_max_up_side]', 'Максимально допустимые размеры оригинального изображения',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>Существует две возможности использования данной настройки:</small></i></p>
                    <p class="text-muted"><i><small>Первая: Вы вводите допустимые размеры в пикселях любой из сторон оригинального изображения. Например: 800.</small></i></p>
                    <p class="text-muted"><i><small>Вторая: Вы задаете ширину и высоту оригинального изображения в формате ширина x высота. Например: 800x600</small></i></p>
                    <p class="text-muted"><i><small>Если размер будет больше, то оригинальное изображение будет автоматически уменьшено до указанного размера, иначе изображение будет пережато без изменения размера. Вы можете указать 0, если хотите чтобы изображение оставалось оригинальным.</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[img_max_up_side]',Options::get_option('img_max_up_side', false),array('placeholder' => 'Максимально допустимые размеры оригинального изображения', 'class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[img_max_up_side]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[img_o_seite]', 'Параметры по умолчанию для оригинального изображения',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>В случае если вы задали максимальные размеры для оригинального изображения в настройках выше, то вы можете указать по какой из сторон по умолчанию будет проводиться контроль оригинального изображения.</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::select('options[img_o_seite]', $seite, Options::get_option('img_o_seite', false), array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[img_o_seite]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[img_t_seite]', 'Параметры по умолчанию для остальных изображений',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>В случае если вы задали максимальные размеры для остальных изображений в настройках ниже, то вы можете указать по какой из сторон по умолчанию будет проводиться контроль оригинального изображения.</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::select('options[img_t_seite]', $seite, Options::get_option('img_t_seite', false), array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[img_t_seite]') }}
            </div>
            <div class="form-group">
                  <div class="col-xs-2 col-md-5 col-sm-6">
                      {{ Form::label('options[img_preview_up_side]', 'Размер средней копии загруженного изображения',array('class' => 'control-label ')) }}
                      <p class="text-muted"><i><small>Существует две возможности использования данной настройки:</small></i></p>
                      <p class="text-muted"><i><small>Первая: Вы задаете максимальный размер в пикселях любой из сторон загружаемой картинки при превышении которого будет создаваться средняя копия изображения. Например: 400</small></i></p>
                      <p class="text-muted"><i><small>Вторая: Вы задаете ширину и высоту средней копии изображения в формате ширина x высота. Например: 100x100.</small></i></p>
                      <p class="text-muted"><i><small>Вы можете указать 0, если не хотите создавать средней копии загружаемых картинок на сервер.</small></i></p>
                  </div>
                  <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[img_preview_up_side]',Options::get_option('img_preview_up_side', false),array('placeholder' => 'Размер средней копии загруженного изображения', 'class' => 'form-control')) }}
                  </div>
                  {{ $errors->first('options[img_preview_up_side]') }}
            </div>
            <div class="form-group">
                  <div class="col-xs-2 col-md-5 col-sm-6">
                      {{ Form::label('options[img_small_up_side]', 'Размер маленькой превью копии загруженного изображения',array('class' => 'control-label ')) }}
                      <p class="text-muted"><i><small>Существует две возможности использования данной настройки:</small></i></p>
                      <p class="text-muted"><i><small>Первая: Вы задаете максимальный размер в пикселях любой из сторон загружаемой картинки при превышении которого будет создаваться уменьшенная копия. Например: 400</small></i></p>
                      <p class="text-muted"><i><small>Вторая: Вы задаете ширину и высоту уменьшенной копии изображения в формате ширина x высота. Например: 100x100.</small></i></p>
                      <p class="text-muted"><i><small>Вы можете указать 0, если не хотите создавать превью копии загружаемых картинок на сервер.</small></i></p>
                  </div>
                  <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[img_small_up_side]',Options::get_option('img_small_up_side', false),array('placeholder' => 'Размер маленькой превью копии загруженного изображения', 'class' => 'form-control')) }}
                  </div>
                  {{ $errors->first('options[img_small_up_side]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[img_allow_watermark]', 'Разрешить наложение водяных знаков',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>При загрузке или копировании картинки на сервер, на нее будет наложен водяной знак</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                  <div class="checkbox">
                    {{ Form::checkbox('options[img_allow_watermark]',Options::get_option('img_allow_watermark', false)) }}
                  </div>
                </div>
                {{ $errors->first('options[img_allow_watermark]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[img_pos_watermark]', 'Позиция наложения водяного знака',array('class' => 'control-label ')) }}
                    <p class="text-muted"><small><i>При загрузке или копировании картинки на сервер, на нее будет наложен водяной знак</i></small></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::select('options[img_pos_watermark]', $watermark_pos, Options::get_option('img_pos_watermark', false), array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[img_allow_watermark]') }}
            </div>
            <div class="form-group">
                  <div class="col-xs-2 col-md-5 col-sm-6">
                      {{ Form::label('options[img_min_watermark]', 'Минимальный размер для накладывания водяного знака',array('class' => 'control-label ')) }}
                      <p class="text-muted"><i><small>Минимальный размер любой из сторон изображения, до которого водяной знак накладываться не будет</small></i></p>
                  </div>
                  <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[img_min_watermark]',Options::get_option('img_min_watermark', false),array('placeholder' => 'Минимальный размер для накладывания водяного знака', 'class' => 'form-control')) }}
                  </div>
                  {{ $errors->first('options[img_min_watermark]') }}
            </div>
            <div class="form-group">
                  <div class="col-xs-2 col-md-5 col-sm-6">
                      {{ Form::label('options[img_jpeg_quality]', 'Качество сжатия .jpg изображения',array('class' => 'control-label ')) }}
                      <p class="text-muted"><i><small>Качество сжатия JPEG картинки при копировании на сервер</small></i></p>
                  </div>
                  <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[img_jpeg_quality]',Options::get_option('img_jpeg_quality', false),array('placeholder' => 'Качество сжатия .jpg изображения', 'class' => 'form-control')) }}
                  </div>
                  {{ $errors->first('options[img_jpeg_quality]') }}
            </div>
          </div>
          <div class="tab-pane fade" id="dossier">
          <br/>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[dos_indx_gallery]', 'Корневая галлерея фотографий досье',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>Укажите альбом, который будет являться корневым для содержание досье</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::select('options[dos_indx_gallery]', $gallery, Options::get_option('dos_indx_gallery', false), array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[dos_indx_gallery]') }}
          </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[dos_max_up_side]', 'Максимально допустимые размеры оригинального изображения',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>Существует две возможности использования данной настройки:</small></i></p>
                    <p class="text-muted"><i><small>Первая: Вы вводите допустимые размеры в пикселях любой из сторон оригинального изображения. Например: 800.</small></i></p>
                    <p class="text-muted"><i><small>Вторая: Вы задаете ширину и высоту оригинального изображения в формате ширина x высота. Например: 800x600</small></i></p>
                    <p class="text-muted"><i><small>Если размер будет больше, то оригинальное изображение будет автоматически уменьшено до указанного размера, иначе изображение будет пережато без изменения размера. Вы можете указать 0, если хотите чтобы изображение оставалось оригинальным.</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[dos_max_up_side]',Options::get_option('dos_max_up_side', false),array('placeholder' => 'Максимально допустимые размеры оригинального изображения', 'class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[dos_max_up_side]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[dos_o_seite]', 'Параметры по умолчанию для оригинального изображения',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>В случае если вы задали максимальные размеры для оригинального изображения в настройках выше, то вы можете указать по какой из сторон по умолчанию будет проводиться контроль оригинального изображения.</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::select('options[dos_o_seite]', $seite, Options::get_option('dos_o_seite', false), array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[dos_o_seite]') }}
            </div>
            <div class="form-group">
                <div class="col-xs-2 col-md-5 col-sm-6">
                    {{ Form::label('options[dos_t_seite]', 'Параметры по умолчанию для остальных изображений',array('class' => 'control-label ')) }}
                    <p class="text-muted"><i><small>В случае если вы задали максимальные размеры для остальных изображений в настройках ниже, то вы можете указать по какой из сторон по умолчанию будет проводиться контроль оригинального изображения.</small></i></p>
                </div>
                <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::select('options[dos_t_seite]', $seite, Options::get_option('dos_t_seite', false), array('class' => 'form-control')) }}
                </div>
                {{ $errors->first('options[dos_t_seite]') }}
            </div>
            <div class="form-group">
                  <div class="col-xs-2 col-md-5 col-sm-6">
                      {{ Form::label('options[dos_preview_up_side]', 'Размер средней копии загруженного изображения',array('class' => 'control-label ')) }}
                      <p class="text-muted"><i><small>Существует две возможности использования данной настройки:</small></i></p>
                      <p class="text-muted"><i><small>Первая: Вы задаете максимальный размер в пикселях любой из сторон загружаемой картинки при превышении которого будет создаваться средняя копия изображения. Например: 400</small></i></p>
                      <p class="text-muted"><i><small>Вторая: Вы задаете ширину и высоту средней копии изображения в формате ширина x высота. Например: 100x100.</small></i></p>
                      <p class="text-muted"><i><small>Вы можете указать 0, если не хотите создавать средней копии загружаемых картинок на сервер.</small></i></p>
                  </div>
                  <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[dos_preview_up_side]',Options::get_option('dos_preview_up_side', false),array('placeholder' => 'Размер средней копии загруженного изображения', 'class' => 'form-control')) }}
                  </div>
                  {{ $errors->first('options[dos_preview_up_side]') }}
            </div>
            <div class="form-group">
                  <div class="col-xs-2 col-md-5 col-sm-6">
                      {{ Form::label('options[dos_small_up_side]', 'Размер маленькой превью копии загруженного изображения',array('class' => 'control-label ')) }}
                      <p class="text-muted"><i><small>Существует две возможности использования данной настройки:</small></i></p>
                      <p class="text-muted"><i><small>Первая: Вы задаете максимальный размер в пикселях любой из сторон загружаемой картинки при превышении которого будет создаваться уменьшенная копия. Например: 400</small></i></p>
                      <p class="text-muted"><i><small>Вторая: Вы задаете ширину и высоту уменьшенной копии изображения в формате ширина x высота. Например: 100x100.</small></i></p>
                      <p class="text-muted"><i><small>Вы можете указать 0, если не хотите создавать превью копии загружаемых картинок на сервер.</small></i></p>
                  </div>
                  <div class="col-xs-10 col-md-7 col-sm-6">
                    {{ Form::text('options[dos_small_up_side]',Options::get_option('dos_small_up_side', false),array('placeholder' => 'Размер маленькой превью копии загруженного изображения', 'class' => 'form-control')) }}
                  </div>
                  {{ $errors->first('options[dos_small_up_side]') }}
            </div>





        </div>
        {{ Form::submit('Сохранить настройки', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
        </div>
    </div>
</div>
@stop