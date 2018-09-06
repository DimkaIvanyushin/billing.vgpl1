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
        <div class="col-12">
            @if (count($teachers) > 0)
            <div class="overflow-y">    
            <table class="table table-bordered bg-white table-striped main_table">
                    <thead>
                        <tr>
                            <td class="table_desc">ID</td>
                            <td style="max-width:1px;" class="table_desc">Редактировать</td>
                            <td style="max-width:1px;" class="table_desc">Удалить</td>
                            <td class="table_desc">Инициалы</td>
                            <td class="table_desc">Часы</td>
                            <td class="table_desc">Предметы</td>
                            <td class="table_desc">Группы</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $key => $teacher)        
                            <tr>
                            <td rowspan="{{ count($teacher['discipline'])}}">{{$teacher['id']}}</td>
                            
                                <td style="padding:0px;" rowspan="{{ count($teacher['discipline'])}}">
                                    <a href="/teacher/edit/{{$teacher['id']}}">
                                        <i class="fas fa-pencil-alt text-success"></i>
                                    </a>
                                </td>
                                <td style="padding:0px;" rowspan="{{ count($teacher['discipline'])}}">
                                    <a href="/teacher/delete/{{$teacher['id']}}">
                                        <i class="fas fa-trash text-danger"></i> 
                                    </a>
                                </td>

                            <td rowspan="{{ count($teacher['discipline'])}}">
                                    <a href="/teacher/show/{{$teacher['id']}}">{{ $key }}</a>
                                </td>
                                
                                <td rowspan="{{ count($teacher['discipline'])}}">
                                    {{ $teacher['total'] }}
                                </td>
                                    @foreach($teacher['discipline'] as $name => $discipline)
                                    <td>
                                        <a href="*">{{ $name }}</a> 
                                    </td> 
                                    <td>
                                        @foreach ($discipline['group'] as $name_group => $item)
                                            {{ $name_group }}
                                        @endforeach
                                    </td>
                                    </tr>
                                    @endforeach
                            </tr>
                        @endforeach                       
                    </tbody>
                </table>

                @else
                <div class="alert alert-info" role="alert">
                    <strong>Таблица пуста!</strong> добавить записи можно нажав кнопку
                    <strong>Добавить</strong>.
                </div>
                @endif
            </div>
        </div>   
    </div>
@endsection