@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Редактирование</h4>
                </div>
                <div class="card-body">
                    @include(Request::segment(1).'.edit')
                </div>
            </div>
        </div>
    </div>
@endsection
