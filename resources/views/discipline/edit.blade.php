<form action="/discipline/edit" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Название предмета</label>
        <input type="text" name="name" AUTOCOMPLETE="off" value="{{ $discipline->name }}" class="form-control"
               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Название предмета">
        <small id="emailHelp" class="form-text text-muted">Например: Информатика</small>
    </div>
    <button type="submit" class="btn btn-success">Изменить</button>
    <input type="hidden" name="id" value="{{ $discipline->id }}">
    <input type="hidden" name="_method" value="PUT">
</form>
