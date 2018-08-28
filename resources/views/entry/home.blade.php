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

    <div class="overflow-y">

        @if($data > 0)
            @foreach($data as $name => $teacher)
                <div class="title">{{ $name }}</div>

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
                    @foreach($teacher['data'] as $discipline => $item)
                        <td rowspan="{{ count($item) }}">
                            {{ $discipline }}
                        </td>

                        @foreach($item as $name_group => $group)
                            <td>
                                {{ $name_group }}
                            </td>

                            <td><strong>{{ $group['sum'] }}</strong></td>
                            @foreach($group['hours'] as $item)
                                <td>{{ $item }}</td>
                                @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        @if(isset($teacher['total']['hours']))
                            <td colspan="2" style="text-align: right">
                                <strong>ИТОГО</strong>
                            </td>

                            <td><strong>{{ $teacher['total']['sum'] }}</strong></td>
                            @foreach($teacher['total']['hours'] as $item)

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
                                {{ $teacher['total']['total'] }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
    </div>
    @endif

@endsection