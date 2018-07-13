$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //
    //
    //
    // Добавить часы

    $('.input_hour').focusout(function () {
        // получаем значение
        var value = $(this).text();
        // получаем id записи что бы по нему искать
        var entry_id = $(this).attr('entry_id');

        // получаем все элементы выбранной строки в таблицу
        var $row_elements = $(this).parent().parent();

        // отсылаем на сервер данные
        $.post("/teacher/hour/add", {
            "value": value,
            "entry_id": entry_id
        }).done(function (data) {
            // если сервер ответил OK то начинаем считать
            // вставляем сумму часов
            $row_elements.find('.sum').text(data);
        });
    });

    $('.input_other_houer').focusout(function () {
        var name = $(this).attr('name');
        var value = $(this).text();
        var teacher_id = $("input#teacher_id").val();

        $.post("/teacher/other_hour/add", {
            "name": name,
            "value": value,
            "teacher_id": teacher_id
        }).done(function (data) {
            console.log('send');
        });
    });

    $('button#add_discipline').click(function () {
        var discipline = $("select#discipline").val();
        var teacher = $("input#teacher_id").val();

        $.post("/teacher/hour/add_discipline", {
            "discipline": discipline,
            "teacher": teacher
        }).done(function (data) {
            location.reload();
        });
    });

    //
    //
    // Поиск по списку

    $('#search').bind('keyup', function () {
        var searchString = $(this).val();

        $("ul.items li").each(function (index, value) {
            currentName = $(value).text();
            if (currentName.toUpperCase().indexOf(searchString.toUpperCase()) > -1) {
                $(value).show();
            } else {
                $(value).hide();
            }
        });

    });


});