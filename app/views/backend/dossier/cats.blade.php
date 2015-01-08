@extends('backend.layouts.page')
@section('title')
Категории досье
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <p><a href="{{{ route('admin-dossier-cat-add') }}}" class="btn btn-default">Добавить категорию</a></p>
        @if ($cats_cnt != 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Название категории</th>
                    <th>Латинское название</th>
                    <th>Кол-во досье</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cats as $cat)
                <tr>
                    <td>
                        {{$cat->name}}
                    </td>
                    <td>
                        {{$cat->slug}}
                    </td>
                    <td>

                    </td>
                    <td>
                        <a href="{{ route('admin-dossier-cat-edit',array(
                            'id'  =>    $cat->id )) }}"><i class="fa fa-pencil-square-o"></i></a>
                        <a href=""><i class="fa fa-trash"></i></a>
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