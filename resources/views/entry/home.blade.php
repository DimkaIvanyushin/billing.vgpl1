@extends('layouts.app')

@section('content')
    <style>
        @page {
            size: landscape;
            margin: 0;
        }
    </style>
    <div class="row main control_button">
        <div class="col-10">
            <button id="print" class="btn btn-default btn-sm">
                <i class="fas fa-print text-success"></i> Печатать
            </button>
        </div>

        <div class="col-2">
            <form action="teacher/find" method="get">
                <div class="input-group input-group-sm">
                    <input type="text" id="search" name="name" class="form-control" AUTOCOMPLETE="off"
                           aria-label="Small"
                           aria-describedby="inputGroup-sizing-sm"/>

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row main">
        <div class="col-12">
            <div class="">
                @if (count($teachers) > 0)
                    <div class="overflow-y">
                        <table class="table table-bordered bg-white table-striped main_table" align="center">
                            <thead>
                            <tr>
                                <td rowspan="2" data-toggle="tooltip" title="ФИО"> Ф.И.О.</td>
                                <td rowspan="2" data-toggle="tooltip" title="Предмет">Предмет</td>

                                @foreach ($group_list as $groups)
                                    <td colspan="{{ $groups['count_grups'] }}">
                                        <strong>{{ $groups['course_name'] }}</strong>
                                    </td>
                                @endforeach

                                <td rowspan="2" data-toggle="tooltip" title="Итого">
                                    <div class="rotate">
                                        <strong>Итого </strong>
                                    </div>
                                </td>
                                <td rowspan="2" data-toggle="tooltip" title="Факультатив"></i>
                                    <div class="rotate">
                                        Факультатив
                                    </div>
                                </td>
                                <td rowspan="2" data-toggle="tooltip" title="Дополнительный контроль">
                                    <div class="rotate">
                                        Доп. контроль
                                    </div>
                                </td>
                                <td rowspan="2" data-toggle="tooltip" title="Кабинеты">
                                    <div class="rotate">
                                        Кабинет
                                    </div>
                                </td>
                                <td rowspan="2" data-toggle="tooltip" title="Экзамены">
                                    <div class="rotate">
                                        Экзамен
                                    </div>
                                </td>
                                <td rowspan="2" data-toggle="tooltip" title="Кураторство">
                                    <div class="rotate">
                                        Кураторство
                                    </div>
                                </td>
                                <td rowspan="2" data-toggle="tooltip" title="Всего">
                                    <div class="rotate">
                                        <strong>
                                            Всего
                                        </strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                @foreach ($group_list as $key=>$groups)
                                    @foreach ($groups['groups'] as $group)
                                        <td data-toggle="tooltip" title=" {{ $group['name'] }}">
                                            {{ $group['name'] }}
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($teachers as $key => $teacher)
                                <tr>
                                    <td style="border-bottom: 2px solid black;"
                                        rowspan=" {{ $teacher['count_discipline'] }}">
                                        <strong><a href="/teacher/show/{{ $teacher['id'] }}">{{ $key }}</a></strong>
                                    </td>

                                    @foreach ($teacher['discipline'] as $key => $discipline)
                                        <td style="{{ $discipline === end($teacher['discipline']) ? 'border-bottom: 2px solid black;' : ''}}">
                                            {{ $key }}
                                        </td>

                                        @foreach ($discipline['hours'] as $hour)
                                            <td style="{{ $discipline === end($teacher['discipline']) ? 'border-bottom: 2px solid black;' : ''}}">
                                                @if($hour > 0)
                                                    {{ $hour }}
                                                @endif
                                            </td>
                                        @endforeach

                                        <td style="{{ $discipline === end($teacher['discipline']) ? 'border-bottom: 2px solid black;' : ''}}">
                                            <strong>{{ $discipline['sum'] }}</strong>
                                        </td>

                                        @if ($discipline === reset($teacher['discipline']))
                                            @foreach ($teacher['other_hour'] as $key => $hour)
                                                <td style="border-bottom: 2px solid black;"
                                                    rowspan=" {{ $teacher['count_discipline'] }}">
                                                    {{ $hour }}
                                                </td>
                                            @endforeach

                                            <td style="border-bottom: 2px solid black;"
                                                rowspan=" {{ $teacher['count_discipline'] }}">
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