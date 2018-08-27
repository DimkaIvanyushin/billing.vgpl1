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

                        <div class="form-group">
                            <label for="exampleInputEmail1">Количество часов за учебный год</label>
                            <input type="text" AUTOCOMPLETE="off" name="count_hour" class="form-control"
                                   id="exampleInputEmail1" aria-describedby="emailHelp"
                                   placeholder="Количество часов">
                        </div>

                        <div class="form-group has-danger">
                            <label for="exampleInputEmail1">Выберите профиль предмета</label>
                            <select class="custom-select" id="course" name="discipline_type">
                                <option disabled>Выберите профиль предмета</option>
                                @foreach ($disciplines_type as $discipline_type)
                                    <option value="{{$discipline_type['id']}}">{{ $discipline_type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-success">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection