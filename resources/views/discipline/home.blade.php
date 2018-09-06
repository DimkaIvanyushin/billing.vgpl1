@extends('layouts.app') @section('content')

<div class="row main control_button">
    <div class="col-12">
        <button onclick="window.history.back();" class="button btn btn-default btn-sm">
            <i class="fas fa-undo-alt text-primary"></i> Назад
        </button>

        <a href="{{ url('discipline/create') }}" class="button btn btn-default btn-sm">
            <i class="fas fa-plus-circle text-success"></i> Добавить
        </a>

        <button id="delete-items" class="button btn btn-default btn-sm">
            <i class="fas fa-trash text-danger"></i> Удалить (<span> 0 </span>)
        </button>
    </div>
</div>
<div class="row main">
    @if (count($lists) > 0) @foreach ($lists as $list)
    <div class="col-6">
        <div class="overflow-y">
            <table class="table table-bordered bg-white table-striped main_table">
                <thead>
                    <tr>
                        <td class="table_title">Предметы</td>
                        <td class="table_title">Часы</td>
                        <td class="table_title">Редактировать</td>
                        <td class="table_title">Удалить</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="table_desc">Предметы: {{ $list[0]->discipline_type->name }}</td>
                    </tr>
                    @foreach ($list as $discipline)
                    <tr>
                        <td style="width:250px;">
                            <a href="{{Request::url()}}/show/{{ $discipline->id }}">
                                {{ $discipline->name }}
                            </a>
                        </td>
                        <td style="width:150px;">{{ $discipline->count_hour }}</td>
                        <td >
                            <a href="{{Request::url()}}/edit/{{ $discipline->id }}">
                                <i class="fas fa-pencil-alt text-success"></i>
                            </a>
                        </td>
                        <td >
                            <a href="{{Request::url()}}/delete/{{ $discipline->id }}">
                                <i class="fas fa-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach @else
    <div class="alert alert-info" role="alert">
        <strong>Таблица пуста!</strong> добавить записи можно нажав кнопку <strong>Добавить</strong>.
    </div>
    @endif
</div>
@endsection