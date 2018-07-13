@extends('layouts.app')

@section('content')
<div class="row">
    <a href="/group/create" class="btn btn-success btn-group-sm">
        Добавить
    </a>
</div>

<div class="row" style="margin-top: 15px;">
    @if (count($groups) > 0)
    <ul class="list-group">
        @foreach ($groups as $group)
        <li class="list-group-item">{{  $group->name }}</li>
        @endforeach
    </ul>
    @endif
</div>

@endsection