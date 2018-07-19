<form action="/group/edit" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Название группы</label>
        <input type="text" name="name" AUTOCOMPLETE="off" value="{{ $group->name }}" class="form-control"
               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Название предмета">
    </div>

    <div class="form-group has-danger">
        <label for="exampleInputEmail1">Выберите курс</label>
        <select class="custom-select" id="course" name="course_id">
            <option disabled>Выберите курс</option>
            @foreach ($courses as $course)
                <option @if($group['course_id'] == $course['id']) selected @endif value="{{$course['id']}}">{{ $course['name'] }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Изменить</button>
    <input type="hidden" name="id" value="{{ $group->id }}">
    <input type="hidden" name="_method" value="PUT">
</form>