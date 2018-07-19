@extends('layouts.app')

@section('content')

    <div class="row main control_button">
        <div class="col-12">
            <button id="print" class="btn btn-success">
                <i class="fas fa-print"></i>
            </button>
        </div>
    </div>

    <div class="row main">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $teacher['name']}} </h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Количество часов: <strong id="total">{{ $total }}</strong></li>
                    <li class="list-group-item">Количество предметов: <strong> {{ $count_discipline }}</strong></li>
                </ul>
            </div>
        </div>

        <div class="col-9">
            <div class="overflow-y">
                <table class="table table-bordered bg-white">
                    <thead>
                    <tr>
                        <td data-toggle="tooltip" title="Всего"><strong>Всего по предметам</strong></td>
                        <td data-toggle="tooltip" title="Факультатив"><strong>Факультатив</strong></td>
                        <td data-toggle="tooltip" title="Дополнительный контроль"><strong>Дополнительный
                                контроль</strong></td>
                        <td data-toggle="tooltip" title="Кабинеты"><strong>Кабинет</strong></td>
                        <td data-toggle="tooltip" title="Экзамены"><strong>Экзамен</strong></td>
                        <td data-toggle="tooltip" title="Кураторство"><strong>Кураторство</strong></td>
                        <td data-toggle="tooltip" title="Всего часов"><strong>Всего</strong></td>
                    </tr>
                    </thead>
                    <tbody>
                    <td>
                        <strong id="sum_hour_group">
                            @if ($sum_hour_group > 0)
                                {{ $sum_hour_group }}
                            @endif</strong>
                    </td>
                    <td style="padding: 0; position: relative;">
                    <span id="group" class="input_other_houer" name="elective_hour"
                          contenteditable>
                        @if ($other_hour->elective_hour > 0)
                            {{ $other_hour->elective_hour }}
                        @endif
                    </span>
                    </td>
                    </td>
                    <td style="padding: 0; position: relative;">
            <span id="group" class="input_other_houer" name="DK_hour"
                  contenteditable>
                @if ($other_hour->DK_hour > 0)
                    {{ $other_hour->DK_hour }}
                @endif</span></td>
                    </td>
                    <td style="padding: 0; position: relative;">
                    <span id="group" class="input_other_houer" name="room_hour" contenteditable>
                        @if ($other_hour->room_hour > 0)
                            {{ $other_hour->room_hour }}
                        @endif
                    </span>
                    </td>
                    <td style="padding: 0; position: relative;">
                    <span id="group" class="input_other_houer" name="examinations_hour" contenteditable>
                        @if ($other_hour->examinations_hour > 0)
                            {{ $other_hour->examinations_hour }}
                        @endif
                    </span>
                    </td>
                    <td style="padding: 0; position: relative;">
                    <span id="group" class="input_other_houer" name="supervision_hour" contenteditable>
                        @if ($other_hour->supervision_hour > 0)
                            {{ $other_hour->supervision_hour }}
                        @endif
                    </span>
                    </td>

                    <td>
                        <strong id="total">{{ $total }}</strong>
                    </td>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="row main">
        <div class="col-12">
            @if (count($groups) > 0)
                <table class="table table-bordered bg-white">
                    <thead>
                    <tr style="border-bottom: 2px solid #28a745;">
                        <th>
                            Предмет
                        </th>
                        @foreach ($groups as $group)
                            <th>
                                {{ $group->name }}
                            </th>
                        @endforeach
                        <th>
                            Итого
                        </th>
                    </tr>
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
                    </span></td>
                                    </td>
                                @endforeach
                                <td class="sum">
                                    {{ $item['sum_hour'] }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div id="discipline_chose" class="input-group">
                <select class="custom-select" id="discipline" name="discipline">
                    <option disabled>Выберите предмет</option>
                    @foreach ($disciplines as $discipline)
                        <option value="{{$discipline->id}}">{{ $discipline->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button id="add_discipline" class="btn btn-success" type="button"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-danger danger_hour" role="alert" style="display: none"></div>
    <input type="hidden" id="teacher_id" value="{{ $teacher->id }}">

@endsection
