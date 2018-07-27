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

            <?php $reverse = ($sort == 'asc') ? 'desc' : 'asc';?>

            <button data-toggle="tooltip" data-placement="top" title="Сортировать по имени"
                    onclick="location.href='/teacher/sort/name/<?php echo $reverse; ?>'" class="btn btn-default btn-sm">
                <i class="fas fa-sort text-success"></i>
                <i class="fas fa-user"></i>
            </button>

            <button data-toggle="tooltip" data-placement="top" title="Сортировать по часам"
                    onclick="location.href='/teacher/sort/hour/<?php echo $reverse; ?>'" class="btn btn-default btn-sm">
                <i class="fas fa-sort text-success"></i>
                <i class="fas fa-clock"></i>
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
                                <div style="margin-bottom: 10px">


                                </div>
                                <ul class="list-group items">
                                    @foreach ($lists as $key => $list)
                                        <li class="list-group-item clearfix" id="{{ $list['id'] }}">
                                            <span style="margin-right: 10px;"
                                                  class="fa fa-user"></span>
                                            {{ $list['name'] }}

                                            @if ($list['check_hour'])
                                                <span class="badge badge-danger"><i
                                                            class="fas fa-clock"></i> {{ $list['total_hour'] }}</span>
                                            @else
                                                <span class="badge badge-success"><i
                                                            class="fas fa-clock"></i> {{ $list['total_hour'] }}</span>
                                            @endif
                                            <span class="pull-right">
                                                <a href="/teacher/show/{{ $list['id'] }}">
                                                    <i class="fas fa-eye text-primary"></i>
                                                </a>&nbsp;
                                                <a href="/teacher/edit/{{ $list['id'] }}">
                                                    <i class="fas fa-pencil-alt text-success"></i>
                                                </a>&nbsp;
                                                <a href="/teacher/delete/{{ $list['id'] }}">
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
                            <strong>Таблица пуста!</strong> добавить записи можно нажав кнопку <strong>Добавить</strong>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection