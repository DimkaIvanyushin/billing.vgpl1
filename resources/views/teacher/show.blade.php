@extends('layouts.app')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавить запись</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="/teacher/hour/add">
                        <div class="row main">
                            {{ csrf_field() }}

                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="SelectDiscipline">Дисциплина</label>
                                        <select name="discipline_id" class="form-control" id="SelectDiscipline">

                                            @foreach ($discipline as $item)
                                                <option value="{{$item['id']}}">{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="SelectGroup">Группа</label>
                                        <select name="group_id" class="form-control" id="SelectGroup">
                                            @foreach ($groups as $group)
                                                <option value="{{$group['id']}}">{{ $group['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    @foreach ($category_hours as $category_hour)

                                        <div class="form-group col-4">
                                            <label for="exampleFormControlInput1">{{ $category_hour['name'] }}</label>
                                            <input type="number" id="{{ $category_hour['id'] }}" name="hour[{{ $category_hour['id'] }}]"
                                                   class="form-control form-control-sm"
                                                   id="exampleFormControlInput1" value="0" placeholder="0">
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <input type="hidden" name="teacher_id" value="{{ $teacher['id'] }}">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary">Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="row main control_button">
        <div class="col-10">
            <button onclick="window.history.back();" class="button btn btn-default btn-sm">
                <i class="fas fa-undo-alt text-primary"></i> Назад
            </button>

            <button id="print" class="button btn btn-default btn-sm">
                <i class="fas fa-print text-info"></i> Печатать
            </button>

            <a href="/teacher/excel/{{$teacher['id']}}" id="print" class="button btn btn-default btn-sm">
                <i class="far fa-file-excel text-success"></i> В excel
            </a>

            <button data-toggle="modal" data-target="#exampleModalCenter" class="button btn btn-default btn-sm">
                <i class="fas fa-plus-circle text-primary"></i> Добавить
            </button>

            <a href="/teacher/delete/{{ $teacher['id'] }}" class="button btn btn-default btn-sm">
                <i class="fas fa-trash text-danger"></i> Удалить
            </a>

        </div>
    </div>

    <div class="row main">
        <div class="col-12">
            <div class="overflow-y">

                <div class="title">ПЕДАГОГИЧЕСКАЯ НАГРУЗКА</div>
                <div class="desc">преподавателя <strong>"{{ $teacher['name'] }}"</strong> учреждения образования
                    "Витебский государственный профессионально-технический колледж машиностроения имени М.Ф.Шмырёва"
                    2018 - 2019 учебный год
                </div>

                <table class="table table-bordered bg-white table-striped main_table" align="center">
                    <thead>
                    <td rowspan="2">Дисциплина</td>
                    <td rowspan="2">
                        <div class="rotate">
                            Группа
                        </div>
                    </td>
                    <td rowspan="2">
                        <div class="rotate">
                            <strong>
                                Всего
                            </strong>
                        </div>
                    </td>
                    @foreach($category_hours as $category)
                        <td>
                            <div class="rotate">{{ $category->name  }}</div>
                        </td>
                    @endforeach
                    </thead>
                    <tbody>
                    @foreach($data as $discipline => $item)
                        <td rowspan="{{ count($item) }}">
                            {{ $discipline }}
                        </td>
                        @foreach($item as $name_group => $group)
                            <td>
                                <form action="/teacher/discipline/delete" method="post">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="teacher_id" value="{{ $teacher['id'] }}">
                                    <input type="hidden" name="discipline_name" value="{{ $discipline }}">
                                    <input type="hidden" name="group_name" value="{{ $name_group }}">

                                    <input type="submit" value="Удалить">
                                </form>

                                {{ $name_group }}
                            </td>
                            <td><strong>{{ $group['sum'] }}</strong></td>
                            @foreach($group['hours'] as $item)
                                <td>{{ $item }}</td>
                                @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        @if(isset($total['hours']))
                            <td colspan="2" style="text-align: right">
                                <strong>ИТОГО</strong>
                            </td>
                            <td><strong>{{ $total['sum'] }}</strong></td>
                            @foreach($total['hours'] as $item)
                                <td><strong>{{ $item }}</strong></td>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="2" style="text-align: right">
                                <strong>
                                    ВСЕГО
                                </strong>
                            </td>
                            <td>
                                {{ $total['total'] }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="alert alert-danger danger_hour" role="alert" style="display: none"></div>

    <input type="hidden" id="teacher_id" value="{{ $teacher->id }}">

    <script>

        var calc_lpz = function () {
            var val = 0;
            var val_1pg = parseInt($('input#3').val(),10);
            var val_2pg = parseInt($('input#4').val(),10);
            var lpz = parseInt($('input#2').val(),10);

            val = (val_2pg * 1 + val_1pg) - lpz;

            $( "input#1" ).val(val);
        };

        $( "input#2" ).blur(calc_lpz);
        $( "input#3" ).blur(calc_lpz);
        $( "input#4" ).blur(calc_lpz);
    </script>
@endsection
