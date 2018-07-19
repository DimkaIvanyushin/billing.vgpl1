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
        <div class="col-12">
            <div class="">
                @if (count($teachers) > 0)
                    <div class="overflow-y">
                        <table class="table table-bordered bg-white main_table" align="center">
                            <thead>
                            <tr>
                                <td data-toggle="tooltip" title="ФИО"> Ф.И.О.</td>
                                <td data-toggle="tooltip" title="Предмет">Предмет</td>
                                @foreach ($groups as $group)
                                    <td data-toggle="tooltip" title=" {{ $group->name }}">
                                        {{ $group->name }}
                                    </td>
                                @endforeach
                                <td data-toggle="tooltip" title="Итого">
                                    <div class="rotate">
                                        <strong>Итого </strong>
                                    </div>
                                </td>
                                <td data-toggle="tooltip" title="Факультатив"></i>
                                    <div class="rotate">
                                        Факультатив
                                    </div>
                                </td>
                                <td data-toggle="tooltip" title="Дополнительный контроль">
                                    <div class="rotate">
                                        Доп. контроль
                                    </div>
                                </td>
                                <td data-toggle="tooltip" title="Кабинеты">
                                    <div class="rotate">
                                        Кабинет
                                    </div>
                                </td>
                                <td data-toggle="tooltip" title="Экзамены">
                                    <div class="rotate">
                                        Экзамен
                                    </div>
                                </td>
                                <td data-toggle="tooltip" title="Кураторство">
                                    <div class="rotate">
                                        Кураторство
                                    </div>
                                </td>
                                <td data-toggle="tooltip" title="Всего">
                                    <div class="rotate">
                                        <strong>
                                            Всего
                                        </strong>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($teachers as $key => $teacher)
                                <tr>
                                    <td rowspan=" {{ $teacher['count_discipline'] }}">
                                        <a href="/teacher/show/{{ $teacher['id'] }}">{{ $key }}</a>
                                    </td>

                                    @foreach ($teacher['discipline'] as $key => $discipline)
                                        <td>
                                            {{ $key }}
                                        </td>

                                        @foreach ($discipline['hours'] as $key => $hour)
                                            <td>
                                                @if($hour > 0)
                                                    {{ $hour }}
                                                @endif
                                            </td>
                                        @endforeach

                                        <td>
                                            <strong>{{ $discipline['sum'] }}</strong>
                                        </td>

                                        @if ($discipline === reset($teacher['discipline']))
                                            @foreach ($teacher['other_hour'] as $key => $hour)
                                                <td rowspan=" {{ $teacher['count_discipline'] }}">
                                                    {{ $hour }}
                                                </td>
                                            @endforeach

                                            <td rowspan=" {{ $teacher['count_discipline'] }}">
                                                <strong>{{ $teacher['total'] }}</strong>
                                            </td>

                                        @endif
                                </tr>
                                @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection