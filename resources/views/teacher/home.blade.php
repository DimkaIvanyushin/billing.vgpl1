@extends('layouts.app')

@section('content')

    <div class="row main control_button">
        <div class="col-12">
            <button onclick="window.history.back();" class="button btn btn-default btn-sm">
                <i class="fas fa-undo-alt text-primary"></i> Назад
            </button>

            <a href="/teacher/create" class="button btn btn-default btn-sm">
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
                    @if (count($teachers) > 0)
                        <div class="row">
                            <div class="col">
                                <ul class="list-group items">
                                    @foreach ($teachers as $key => $teacher)

                                        <div class="input-group input-group-sm">

                                            <li class="list-group-item clearfix check" style="width: 94%;"
                                                id="{{ $teacher->id }}">
                                                <span style="margin-right: 10px;" class="fa fa-user"></span>
                                                {{ $teacher->name }}

                                                <span class="pull-right">

                                                </span>
                                            </li>

                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary dropdown-toggle"
                                                        type="button"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" id="inputGroup-sizing-sm">
                                                </button>
                                                <div class="dropdown-menu" id="inputGroup-sizing-sm">
                                                    <a class="dropdown-item" href="/teacher/show/{{ $teacher->id}}"><i
                                                                class="fas fa-eye text-primary"></i> Показать</a>
                                                    <a class="dropdown-item"
                                                       href="/teacher/edit/{{ $teacher->id }}"><i
                                                                class="fas fa-pencil-alt text-success"></i>
                                                        Редактировать</a>
                                                    <a class="dropdown-item"
                                                       href="/teacher/delete/{{ $teacher->id }}"><i
                                                                class="fas fa-trash text-danger"></i> Удалить</a>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            <strong>Таблица пуста!</strong> добавить записи можно нажав кнопку
                            <strong>Добавить</strong>.
                        </div>
                    @endif

                    <div class="row main">
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection