@extends('backend.layouts.page')
@section('title')
Фотоальбомы
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <p><a href="{{{ route('admin-gallery-albums-add') }}}" class="btn btn-default">Добавить альбом</a></p>
        @if ($albums_cnt != 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название альбома</th>
                    <th>Кол-во фотографий</th>
                    <th>Родительский</th>
                    <th>Системный</th>
                    <th>Добавление фото</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($albums as $album)
                <tr>
                    <td>
                        {{{ $album->id }}}
                    </td>
                    <td>
                        {{{ $album->name }}}
                    </td>
                    <td>
                        {{{ $album->images()->count() }}}
                    </td>
                    <td>
                        {{{ $album->parent_id }}}
                    </td>
                    <td>
                        @if ($album->is_system)
                        <i class="fa fa-check"></i>
                        @else
                        <i class="fa fa-times"></i>
                        @endif
                    </td>
                    <td>
                        @if ($album->is_add)
                        <i class="fa fa-check"></i>
                        @else
                        <i class="fa fa-times"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{{ route('admin-gallery-albums-edit', $album->id) }}}"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="{{{ route('admin-gallery-albums-delete',$album->id) }}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@stop