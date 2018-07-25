@extends('layouts.app')

@section('content')

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

            <a href="/teacher/create" id="print" class="button btn btn-default btn-sm">
                <i class="fas fa-plus-circle text-primary"></i> Добавить
            </a>

        </div>
        <div class="col-2">
            <div id="discipline_chose" class="input-group">
                <select class="custom-select custom-select-sm" id="discipline" name="discipline">
                    <option disabled>Выберите предмет</option>
                    @foreach ($disciplines as $discipline)
                        <option value="{{$discipline->id}}">{{ $discipline->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button id="add_discipline" class="btn btn-success btn-sm" type="button"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row main">
        <div class="col-12 text-center">
            <h1>{{ $teacher['name']}}</h1>
        </div>
    </div>

    <div class="row main">
        <div class="col-12">
            @if (count($group_list) > 0)
                <div class="overflow-y">
                    <table class="table table-bordered bg-white table-striped">
                        <thead>
                        <tr>
                            <td rowspan="2">
                                Дисциплина
                            </td>

                            @foreach ($group_list as $groups)
                                <th colspan="{{ $groups['count_grups'] }}">
                                    <strong>{{ $groups['course_name'] }}</strong>
                                </th>
                            @endforeach

                            <td rowspan="2">
                                <div class="rotate">
                                    За курс
                                </div>
                            </td>

                            <td rowspan="2">
                                <div class="rotate">
                                    Всего
                                </div>
                            </td>
                            <td rowspan="2" style="min-width: 50px;">
                                <div class="rotate">
                                    Факультатив
                                </div>
                            </td>
                            <td rowspan="2" style="min-width: 50px;">
                                <div class="rotate">
                                    Допконтроль
                                </div>
                            </td>
                            <td rowspan="2" style="min-width: 50px;">
                                <div class="rotate">
                                    Кабинеты
                                </div>
                            </td>
                            <td rowspan="2" style="min-width: 50px;">
                                <div class="rotate">
                                    Экзамен
                                </div>
                            </td>
                            <td rowspan="2" style="min-width: 50px;">
                                <div class="rotate">
                                    Кураторство
                                </div>
                            </td>
                            <td rowspan="2">
                                <div class="rotate">
                                    ИТОГО
                                </div>
                            </td>

                        </tr>
                        @foreach ($group_list as $key=>$groups)
                            @foreach ($groups['groups'] as $group)
                                <td data-toggle="tooltip" title=" {{ $group['name'] }}">
                                    {{ $group['name'] }}
                                </td>
                            @endforeach
                        @endforeach
                        </thead>
                        <tbody>
                        @if (count($hour) > 0)
                            @foreach ($hour as $key=>$item)
                                <tr>
                                    <td discipline_id="{{ $item['discipline_id'] }}">
                                        <i id="del_dis_teacher"
                                           class="far fa-trash-alt text-danger"></i> {{ $item['discipline'] }}
                                    </td>
                                    @foreach ($item['time'] as $node)
                                        <td style="padding: 0; position: relative;">
                                        <span id="group" class="input_hour" entry_id="{{ $node['id'] }}"
                                              contenteditable>
                                        @if ($node['hour'] > 0)
                                                {{ $node['hour'] }}
                                            @endif
                                         </span>
                                        </td>
                                        </td>
                                    @endforeach

                                    <td class="sum">
                                        {{ $item['sum_hour'] }}
                                    </td>

                                    @if ($item === reset($hour))
                                        <td rowspan=" {{ $count_discipline }} ">
                                            @if ($sum_hour_group > 0)
                                                <strong id="sum_hour_group">{{ $sum_hour_group }}</strong>
                                            @endif
                                        </td>

                                        <td rowspan=" {{ $count_discipline }} " style="padding: 0; position: relative;">
                                            <span id="group" class="input_other_houer" name="elective_hour"
                                                  contenteditable>
                                                @if ($other_hour->elective_hour > 0)
                                                    {{ $other_hour->elective_hour }}
                                                @endif
                                            </span>
                                        </td>

                                        <td rowspan=" {{ $count_discipline }} " style="padding: 0; position: relative;">
                                            <span id="group" class="input_other_houer" name="DK_hour" contenteditable>
                                                @if ($other_hour->DK_hour > 0)
                                                    {{ $other_hour->DK_hour }}
                                                @endif
                                            </span>
                                        </td>

                                        <td rowspan=" {{ $count_discipline }} " style="padding: 0; position: relative;">
                                            <span id="group" class="input_other_houer" name="room_hour" contenteditable>
                                                @if ($other_hour->room_hour > 0)
                                                    {{ $other_hour->room_hour }}
                                                @endif
                                            </span>
                                        </td>

                                        <td rowspan=" {{ $count_discipline }} " style="padding: 0; position: relative;">
                                            <span id="group" class="input_other_houer" name="examinations_hour"
                                                  contenteditable>
                                                @if ($other_hour->examinations_hour > 0)
                                                    {{ $other_hour->examinations_hour }}
                                                @endif
                                            </span>
                                        </td>

                                        <td rowspan=" {{ $count_discipline }} " style="padding: 0; position: relative;">
                                            <span id="group" class="input_other_houer" name="supervision_hour"
                                                  contenteditable>
                                                @if ($other_hour->supervision_hour > 0)
                                                    {{ $other_hour->supervision_hour }}
                                                @endif
                                            </span>
                                        </td>

                                        <td rowspan=" {{ $count_discipline }} ">
                                            <strong id="total">{{ $total }}</strong>
                                        </td>

                                    @endif

                                    @endforeach


                                </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="row main">
                <div class="col-3">
                    Тарифицированно: <strong id="total">{{ $total }}</strong> час.
                </div>

            </div>
        </div>
    </div>

    <div class="alert alert-danger danger_hour" role="alert" style="display: none"></div>
    <input type="hidden" id="teacher_id" value="{{ $teacher->id }}">

@endsection
