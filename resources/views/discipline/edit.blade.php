<form action="/discipline/edit" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Название предмета</label>
        <input type="text" name="name" AUTOCOMPLETE="off" value="{{ $discipline->name }}" class="form-control"
               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Название предмета">
        <small id="emailHelp" class="form-text text-muted">Например: Информатика</small>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Количество часов за учебный год</label>
        <input type="text" AUTOCOMPLETE="off" name="count_hour" class="form-control"
               id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Количество часов" value="{{ $discipline->count_hour }}">
    </div>

    <div class="form-group has-danger">
        <label for="exampleInputEmail1">Выберите профиль предмета</label>
        <select class="custom-select" id="course" name="discipline_type">
            <option disabled>Выберите профиль предмета</option>
            @foreach ($disciplines_type as $discipline_type)

                <option @if($discipline->disciplinetype_id == $discipline_type->id) selected
                        @endif value="{{ $discipline_type->id }}">{{ $discipline_type->name }}</option>

            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Изменить</button>
    <input type="hidden" name="id" value="{{ $discipline->id }}">
    <input type="hidden" name="_method" value="PUT">
</form>
