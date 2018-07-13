@extends('layouts.app')

@section('content')
<div class="row">
    <a href="/discipline/create" class="btn btn-success btn-group-sm">
        Добавить
    </a>
</div>

<div class="row" style="margin-top: 15px;">
    @if (count($disciplines) > 0)
    <ul class="list-group">
        @foreach ($disciplines as $discipline)
        <li class="list-group-item">{{ $discipline->name }}</li>
        @endforeach
    </ul>
</div>

@endif
@endsection