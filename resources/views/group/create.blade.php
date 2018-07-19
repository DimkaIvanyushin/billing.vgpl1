@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Добавить группу</h4>
                </div>
                <div class="card-body">
                    <form action="/group/add" method="post">
                        {{ csrf_field() }}
                        <div class="form-group has-danger">
                            <label for="exampleInputEmail1">Название группы</label>
                            <input type="text" AUTOCOMPLETE="off" name="name" class="form-control form-control-danger"
                                   id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Название группы"
                                   required>
                            <small id="emailHelp" class="form-text text-muted">Что бы добавить несколько групп, введите
                                их <strong>через запятую</strong>. Например: 66,67,68,69
                            </small>
                        </div>

                        <div class="form-group has-danger">
                            <label for="exampleInputEmail1">Выберите курс</label>
                            <select class="custom-select" id="course" name="course_id">
                                <option disabled>Выберите курс</option>
                                @foreach ($courses as $course)
                                    <option value="{{$course['id']}}">{{ $course['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

