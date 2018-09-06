@extends('layouts.app') @section('content')
<div class="row main control_button">
    <div class="col-12">
        <a class="btn btn-default btn-sm text-dark" style="background-color: #dddddd;" href="/group/create">
            <i class="fas fa-plus-circle text-success"></i> Добавить
        </a>
    </div>
</div>

<div class="row main">
    <div class="col-12">
        <div class="overflow-y">
            @if (count($data) > 0)
            <ul>
                @foreach ($data as $course)
                <li>
                    {{ $course['course_name'] }}
                </li>
                <ul>
                    @foreach ($course['groups'] as $group)
                    <li>
                        <a href="/group/show/{{ $group['id'] }}">
                            {{ $group['name'] }} группа
                        </a>
                        <a  href="/group/edit/{{ $group['id'] }}" style="font-size: 10px;"><i class="fas fa-pencil-alt text-success"></i></a>
                        <a href="/group/delete/{{ $group['id'] }}" style="font-size: 10px;"><i class="fas fa-trash text-danger"></i></a>
                    </li>
                    @endforeach
                </ul>
                @endforeach
            </ul>
            @else
            <div class="alert alert-info" role="alert">
                <strong>Таблица пуста!</strong> добавить записи можно нажав кнопку <strong>Добавить</strong>.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection