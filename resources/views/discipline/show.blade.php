@extends('layouts.app')

@section('content')

    <div class="row main">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> Предмет: {{ $discipline->name }} </h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> Преподаватели предмета:</li>

                    @if(count($data) > 0)
                        @foreach ($data as $teacher)
                            <li class="list-group-item disabled" style="background-color: #ececec;">
                                - {{  $teacher['teacher_name'] }} :
                                <span class="text-success">{{ $teacher['teacher_count_hour'] }} ч.</span>

                            </li>
                        @endforeach
                    @endif
                    <li class="list-group-item"> Часов по предмету "{{ $discipline->name }}" :
                        <strong> {{ $total_hour_discipline }}</strong> ч. /
                        <strong>{{ $discipline->count_hour }} </strong> ч.
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
