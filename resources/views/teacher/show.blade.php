@extends('layouts.app')

@section('content')

    <div class="row main">
        <div class="col-12">
            <div class="input-group">
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

    <div class="row main">
        <div class="col-12">
            @if (count($groups) > 0)
                <table class="table table-bordered bg-white">
                    <tbody>
                    <tr>
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
                    @if (count($hour) > 0)
                        @foreach ($hour as $key=>$item)
                            <tr>
                                <td discipline_id="{{ $item['discipline_id'] }}">{{ $item['discipline'] }}</td>
                                @foreach ($item['time'] as $node)
                                    <td style="padding: 0; position: relative;">
                                        <span id="group" class="input_hour" entry_id="{{ $node['id'] }}"
                                              contenteditable>{{ $node['hour'] }}</span></td>
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

    <div class="row main">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Итоговая таблица</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td data-toggle="tooltip" title="Всего"></i> Всего по предметам</td>
                            <td data-toggle="tooltip" title="Факультатив"></i> Факультатив</td>
                            <td data-toggle="tooltip" title="Дополнительный контроль"> ДК</td>
                            <td data-toggle="tooltip" title="Кабинеты"> Кабинет</td>
                            <td data-toggle="tooltip" title="Экзамены"> Экзамен</td>
                            <td data-toggle="tooltip" title="Всего часов">Всего</td>
                        </tr>
                        </thead>
                        <tbody>
                        <td>
                            {{ $sum_hour_group }}
                        </td>
                        <td style="padding: 0; position: relative;">
                            <span id="group" class="input_other_houer" name="elective_hour"
                                  contenteditable>{{ $other_hour->elective_hour }}</span></td>
                        </td>
                        <td style="padding: 0; position: relative;">
                            <span id="group" class="input_other_houer" name="DK_hour"
                                  contenteditable>{{ $other_hour->DK_hour }}</span></td>
                        </td>
                        <td style="padding: 0; position: relative;">
                            <span id="group" class="input_other_houer" name="room_hour"
                                  contenteditable>{{ $other_hour->room_hour }}</span></td>
                        </td>
                        <td style="padding: 0; position: relative;">
                            <span id="group" class="input_other_houer" name="examinations_hour"
                                  contenteditable>{{ $other_hour->examinations_hour }}</span></td>
                        </td>
                        <td>
                            {{ $total }}
                        </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="teacher_id" value="{{ $teacher->id }}">
@endsection
