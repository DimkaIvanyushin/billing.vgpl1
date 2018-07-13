@extends('layouts.app')

@section('content')
<div class="row">
    <a href="/group/create" class="btn btn-success btn-group-sm">
        Добавить
    </a>
</div>

<div class="row" style="margin-top: 15px;">
    @if (count($teachers) > 0)
    <ul class="list-group">
        @foreach ($teachers as $teacher)
        <li class="list-group-item">{{  $teacher->fio }}</li>
        @endforeach
    </ul>
    @endif
</div>

@endsection