@extends('backend.layouts.page')
@section('title')
Досье
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <p><a href="{{{ route('admin-dossier-add') }}}" class="btn btn-default">Добавить досье</a></p>
        <p>Всего досье в базе: {{{ $cnt }}}</p>
        @if($cnt != 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                        ID
                        </th>
                        <th>
                        Название
                        </th>
                        <th>
                        Действия
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dossier as $dos)
                    <tr>
                        <td>
                            {{{ $dos->id }}}
                        </td>
                        <td>
                            {{{ $dos->name }}}
                        </td>
                        <td>
                            <a href="{{{ route('admin-dossier-edit',$dos->id) }}}" title="Редактировать досье"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="" title="Удалить изображение"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <?php echo $dossier->links(); ?>
        @endif
    </div>
</div>
@stop