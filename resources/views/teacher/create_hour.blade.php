
@extends('layouts.app')

@section('content')

    @if (count($groups) > 0)
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>
                    Предмет
                </th>
                @foreach ($groups as $group)
                  <th>
                      {{ $group->name }}
                  </th>
                @endforeach
            </tr>
            <tr>
                <td>
                    <select id="discipline" name="discipline">
                        <option disabled>Выберите предмет</option>
                        @foreach ($disciplines as $discipline)
                            <option value="{{$discipline->id}}">{{ $discipline->name }}</option>
                        @endforeach
                    </select>
                </td>
                @foreach ($groups as $group)
                    <td style="padding: 0; position: relative;">
                        <span id="group" value="{{ $group->id }}" contenteditable></span></td>
                    </td>
                @endforeach
            </tr>
            </tbody>
        </table>
        <input type="hidden" id="teacher" value="{{ $teacher->id }}">
        <button id="add_hour" class="btn btn-success">Добавить</button>
    @endif


    <form action="/teacher/other_hour/add" method="post">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="elective_hour" class="col-sm-2 col-form-label">Факультатив</label>
            <div class="col-sm-10">
                <input type="text" name="elective_hour" class="form-control" id="elective_hour" placeholder="Факультатив">
            </div>
        </div>

        <div class="form-group row">
            <label for="DK_hour" class="col-sm-2 col-form-label">Дополнительный контроль</label>
            <div class="col-sm-10">
                <input type="text" name="DK_hour" class="form-control" id="DK_hour" placeholder="Дополнительный контроль">
            </div>
        </div>

        <div class="form-group row">
            <label for="room_hour" class="col-sm-2 col-form-label">Кабинеты</label>
            <div class="col-sm-10">
                <input type="text" name="room_hour" class="form-control" id="room_hour" placeholder="кабинеты">
            </div>
        </div>

        <div class="form-group row">
            <label for="examinations_hour" class="col-sm-2 col-form-label">Экзамены</label>
            <div class="col-sm-10">
                <input type="text" name="examinations_hour" class="form-control" id="examinations_hour" placeholder="Экзамены">
            </div>
        </div>

        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
        <input type="submit" class="btn btn-success" value="Отправить">

    </form>

@endsection