@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Добавить преподавателя</h4>
                </div>
                <div class="card-body">
                    <form action="/teacher/add" method="get">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ФИО преподавателя</label>
                            <input type="text" AUTOCOMPLETE="off" name="name" class="form-control"
                                   id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Фамилия Имя Отчество">
                            <small id="emailHelp" class="form-text text-muted">Например: Иванов Иван Иванович</small>
                        </div>
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection