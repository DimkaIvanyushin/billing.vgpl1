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
                            <form action="/teacher" class="form-inline" method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                    <select class="form-control form-control-sm" name="order" id="exampleSelect1">
                                        <option value="asc">По возрастанию</option>
                                        <option value="desc">По убыванию</option>
                                    </select>
                                    @if(!empty($sortby))
                                        <div class="input-group-append">
                                            <a href="/teacher" class="btn btn-danger btn-sm"><i style="padding-top:3px;"
                                                                                                class="fas fa-times"></i></a>
                                        </div>
                                    @endif
                                </div>

                                <input type="hidden" name="sortby" value="name">
                                <input type="hidden" name="page" value="{{ $teachers->currentPage() }}">

                            </form>

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
                                <div style="margin-bottom: 10px">
                                </div>
                                <ul class="list-group items">
                                    @foreach ($teachers as $key => $teacher)
                                        <li class="list-group-item clearfix" id="{{ $teacher->id }}">
                                            <span style="margin-right: 10px;"
                                                  class="fa fa-user"></span>
                                            {{ $teacher->name }}

                                            @if ($teacher->check_hour)
                                                <span class="badge badge-danger"><i
                                                            class="fas fa-clock"></i> {{ $teacher->total_hour }}</span>
                                            @else
                                                <span class="badge badge-success"><i
                                                            class="fas fa-clock"></i> {{ $teacher->total_hour }}</span>
                                            @endif
                                            <span class="pull-right">
                                                <a href="/teacher/show/{{ $teacher->id}}">
                                                    <i class="fas fa-eye text-primary"></i>
                                                </a>&nbsp;
                                                <a href="/teacher/edit/{{ $teacher->id }}">
                                                    <i class="fas fa-pencil-alt text-success"></i>
                                                </a>&nbsp;
                                                <a href="/teacher/delete/{{ $teacher->id }}">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>&nbsp;
                                            </span>
                                        </li>
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

                            {{ $links }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection