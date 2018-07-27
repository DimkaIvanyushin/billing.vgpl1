@extends('layouts.app')

@section('content')
    <div class="row main">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Добавить предмет</h4>
                </div>
                <div class="card-body">
                    <form action="/discipline/add" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название предмета</label>
                            <input type="text" AUTOCOMPLETE="off" name="name" class="form-control"
                                   id="exampleInputEmail1" aria-describedby="emailHelp"
                                   placeholder="Название предмета">
                            <small id="emailHelp" class="form-text text-muted">Что бы добавить несколько дисциплин,
                                введите их <strong>через запятую</strong>. Например: Математика,Всемирная
                                История,Английский язык
                            </small>
                        </div>
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection