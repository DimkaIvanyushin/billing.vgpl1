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
            <button onclick="window.history.back();" class="button btn btn-default btn-sm">
                <i class="fas fa-undo-alt text-primary"></i> Назад
            </button>

            <button id="print" class="btn btn-default btn-sm">
                <i class="fas fa-print text-success"></i> Печатать
            </button>
        </div>

        <div class="col-2">
            <form action="teacher/find" method="get" style="margin-bottom: 0;">
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

    @if (count($teachers_pages) > 0)
        @foreach($teachers_pages as $teachers)

            <div class="overflow-y">

                <div class="title">ПЕДАГОГИЧЕСКАЯ НАГРУЗКА</div>
                <div class="desc">преподавателей учреждения образования "Витебский государственный
                    профессионально-технический колледж машиностроения имени М.Ф.Шмырёва" 2017 - 2018 уч.г.
                </div>

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

                    @foreach ($teachers as $teacher)

                        <tr>
                            <td style="border-bottom: 2px solid black;"
                                rowspan=" {{ $teacher['count_discipline'] }}">
                                <strong><a href="/teacher/show/{{ $teacher['teacher_info']->id }}"> {{ $teacher['teacher_info']->name }}</a></strong>
                            </td>

                            @foreach ($teacher['discipline'] as $discipline)
                                <td style="{{ $discipline === end($teacher['discipline']) ? 'border-bottom: 2px solid black;' : ''}}">
                                    {{ $discipline['discipline'] }}
                                </td>

                                @foreach ($discipline['time'] as $hour)
                                    <td style="{{ $discipline === end($teacher['discipline']) ? 'border-bottom: 2px solid black;' : ''}}">
                                        @if($hour['hour'] > 0)
                                            {{ $hour['hour'] }}
                                        @endif
                                    </td>
                                @endforeach

                                <td style="{{ $discipline === end($teacher['discipline']) ? 'border-bottom: 2px solid black;' : ''}}">
                                    <strong>{{ $discipline['sum_hour'] }}</strong>
                                </td>

                                @if ($discipline === reset($teacher['discipline']))

                                    <td style="border-bottom: 2px solid black;"
                                        rowspan=" {{ $teacher['count_discipline'] }}">
                                        <strong>{{ $teacher['total_hour'] }}</strong>
                                    </td>

                                @endif
                        </tr>
                        @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif

@endsection