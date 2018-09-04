@extends('layouts.app')

@section('content')
    <div class="row main control_button">
        <div class="col-10">
            <button onclick="window.history.back();" class="button btn btn-default btn-sm">
                <i class="fas fa-undo-alt text-primary"></i> Назад
            </button>

            <button id="print" class="btn btn-default btn-sm">
                <i class="fas fa-print text-success"></i> Печатать
            </button>
        </div>
    </div>

    @if($data>0)
        <div class="row main">
            <div class="col-12">
                <div class="overflow-y">
                    <div class="title">Нагрузка группы <strong>{{ $group->name }} </strong></div>
                    <div class="desc">Учреждения образования
                        "Витебский государственный профессионально-технический колледж машиностроения имени М.Ф.Шмырёва"
                        2018 - 2019 учебный год
                    </div>
                    <table class="table table-bordered bg-white table-striped main_table table-hover" align="center">
                        <thead>
                        <td class="table_desc" rowspan="2">Преователь</td>
                        <td class="table_desc" rowspan="2">Дисциплина</td>
                        <td class="table_desc" rowspan="2"><strong>Всего</strong></td>

                        @foreach($category_hours as $category)
                            <td class="table_desc">{{ $category->name  }}</td>
                        @endforeach
                        </thead>

                        @foreach($data as $teacher_name => $teacher)
                            <tr>
                                <td rowspan="{{ count($teacher['disciplines']) }}">{{ $teacher_name }}</td>
                                @foreach($teacher['disciplines'] as $discipline_name => $discipline)
                                    <td>{{ $discipline_name }}</td>
                                    <td><strong>{{ $teacher['sum'] }}</strong></td>
                                    @foreach($discipline as $hour)
                                        <td>{{ $hour }}</td>
                                    @endforeach
                            </tr>
                            @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
