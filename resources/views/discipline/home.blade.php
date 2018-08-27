@extends('layouts.app')

@section('content')

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
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            <strong>Список</strong>
                        </div>
                        <div class="col-8">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                            class="fas fa-search"></i></span>
                                </div>
                                <input type="text" id="search" class="form-control" AUTOCOMPLETE="off"
                                       aria-label="Small"
                                       aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @if (count($lists) > 0)
                        <div class="row">
                            <div class="col">
                                <ul class="list-group items">
                                    @foreach ($lists as $list)

                                        <li class="list-group-item">
                                            Предметы: {{ $list[0]->discipline_type->name }}</li>

                                        @foreach ($list as $discipline)
                                            <li class="list-group-item clearfix" id="{{ $discipline->id }}">
                                                <span class="fa {{ Request::is('teacher') ? 'fa-user' : '' }}{{ Request::is('discipline') ? 'fa-book' : '' }}{{ Request::is('group') ? 'fa-users' : '' }}"></span>
                                                {{ $discipline->name }}
                                                <span class="badge badge-secondary">
                                                    {{ $discipline->count_hour }}
                                                </span>
                                                <span class="pull-right">
                                                    <a href="{{Request::url()}}/show/{{ $discipline->id }}"><i
                                                                class="fas fa-eye text-info"></i></a>&nbsp;
                                                    <a href="{{Request::url()}}/edit/{{ $discipline->id }}"><i
                                                                class="fas fa-pencil-alt text-success"></i></a>&nbsp;
                                                    <a href="{{Request::url()}}/delete/{{ $discipline->id }}"><i
                                                                class="fas fa-trash text-danger"></i></a>&nbsp;
                                                </span>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            <strong>Таблица пуста!</strong> добавить записи можно нажав кнопку <strong>Добавить</strong>.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
