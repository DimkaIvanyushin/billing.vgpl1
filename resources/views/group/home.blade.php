@extends('layouts.app')

@section('content')
    <div class="row main control_button">
        <div class="col-12">
            <a class="btn btn-success" href="/group/create">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>

    <div class="row main">
        @if (count($data) > 0)
            @foreach ($data as $course)
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{  $course['course_name'] }}</strong>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($course['groups'] as $group)
                                    <li class="list-group-item clearfix">
                                        <span class="fa fa-users'"></span>
                                        Группа: <strong>{{ $group['name'] }}</strong>
                                        <span class="pull-right">
                                    <a href="/group/show/{{ $group['id'] }}"><i
                                                class="fas fa-eye text-white"></i></a>&nbsp;
                                    <a href="/group/edit/{{ $group['id'] }}"><i
                                                class="fas fa-pencil-alt text-white"></i></a>&nbsp;
                                    <a href="/group/delete/{{ $group['id'] }}"><i
                                                class="fas fa-trash text-white"></i></a>&nbsp;
                                </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info" role="alert">
                <strong>Таблица пуста!</strong> добавить записи можно нажав кнопку <strong>Добавить</strong>.
            </div>
        @endif
    </div>
@endsection
