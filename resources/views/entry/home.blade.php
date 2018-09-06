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

    @if($data > 0)

    @foreach ($data as $page)
        <div class="overflow-y">    
            @foreach($page as $name => $teacher)
                <table class="table table-bordered bg-white table-striped main_table table-hover" align="center">
                    <thead>
                    <tr>
                    <td class="table_title" colspan="{{  count($category_hours) + 4}}"><a href="/teacher/show/{{ $teacher['id']}}">{{ $name }}</a></td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="table_desc">Дисциплина</td>
                        <td rowspan="2" class="table_desc">Группа</td>
                        <td rowspan="2" class="table_desc">%</td>
                        <td rowspan="2" class="table_desc"><strong>Всего</strong></td>
                    </tr>
                    @foreach($category_hours as $category)
                        <td class="table_desc">
                        {{ $category->name}}
                        </td>
                    @endforeach
                    </thead>
                    <tbody>
                    @foreach($teacher['data'] as $discipline => $entry)
                        <td rowspan="{{ count($entry['groups']) }}">
                            <a href="{{ $entry['url'] }}">{{ $discipline }}</a>
                        </td>
                        @foreach($entry['groups'] as $name_group => $group)
                            <td>
                                {{ $name_group }}
                            </td>
                            <td>
                                    {{ $entry['percent'] }}
                            </td>
                            <td><strong>{{ $group['sum'] }}</strong></td>
                            @foreach($group['hours'] as $item)
                                <td>{{ $item['hour'] }}</td>
                                @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        @if(isset($teacher['total']['hours']))
                            <td colspan="3" style="text-align: right">
                                <strong>ИТОГО</strong>
                            </td>

                            <td><strong>{{ $teacher['total']['sum'] }}</strong></td>
                            @foreach($teacher['total']['hours'] as $item)

                                <td><strong>{{ $item }}</strong></td>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="3" style="text-align: right">
                                <strong>
                                    ВСЕГО
                                </strong>
                            </td>
                            <td style="text-align: left;" colspan="{{ count($category_hours) + 1}}">
                                <strong>{{ $teacher['total']['total'] }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        </div>
        @endforeach
    @endif
@endsection