@extends('layouts.app')

@section('content')
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
                                <input type="text" id="search" class="form-control" AUTOCOMPLETE="off" aria-label="Small"
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
                                        <li class="list-group-item clearfix" id="{{ $list->id }}">
                                            <span class="fa {{ Request::is('teacher') ? 'fa-user' : '' }}{{ Request::is('discipline') ? 'fa-book' : '' }}{{ Request::is('group') ? 'fa-users' : '' }}"></span>
                                            {{ $list->name }}
                                            <span class="pull-right">
                                    <a href="{{Request::url()}}/show/{{ $list->id }}"><i
                                                class="fas fa-eye text-info"></i></a>&nbsp;
                                    <a href="{{Request::url()}}/edit/{{ $list->id }}"><i
                                                class="fas fa-pencil-alt text-success"></i></a>&nbsp;
                                    <a href="{{Request::url()}}/delete/{{ $list->id }}"><i
                                                class="fas fa-trash text-danger"></i></a>&nbsp;
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
                <div class="card-footer text-muted">
                    <a class="btn btn-success col-12" href="{{Request::url()}}/create">
                        <strong>Добавить</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
