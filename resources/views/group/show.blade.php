@extends('layouts.app')

@section('content')

    @if($data>0)
        <table class="table table-bordered bg-white table-striped main_table" align="center">
            @foreach($data as $teacher_name => $teacher)
                <tr>
                    <td rowspan="{{ count($teacher) }}" >{{ $teacher_name }}</td>
                    @foreach($teacher as $discipline_name => $discipline)
                        <td>{{ $discipline_name }}</td>

                        @foreach($discipline as $hour)
                            <td>{{ $hour }}</td>
                        @endforeach
                </tr>
                @endforeach
                </tr>
            @endforeach
        </table>
    @endif

@endsection
