$(document).ready(function () {

    var max_hour = 1440;
    var min_hour = 800;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

    function verification(data) {
        if (data > max_hour) {
            $('strong#total').css({color: 'red'});

            $('.danger_hour').text('Перебор ' + (max_hour - data) + ' час.');
            $('.danger_hour').show();
        } else if (data < min_hour) {
            $('strong#total').css({color: 'red'});

            $('.danger_hour').text('Недобор на ' + (data - min_hour) + ' час.');
            $('.danger_hour').show();
        } else {
            $('strong#total').css({color: 'green'})
            $('.danger_hour').hide();
        }
    }

   // $('.rotate').css('height', $('.rotate').width());

    $('#print').click(function () {
        window.print();
    });

    //
    //
    //
    // Добавить часы

    $('.input_hour').focus(function () {
        $(this).text('');
    });

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

            // если сервер ответил OK то
            // вставляем сумму часов

            // если часов больше чем 1440 и меньше 800 то выделяем текст красным
            verification(data.total);

            $row_elements.find('.sum').text(data.sum);
            $('strong#sum_hour_group').text(data.sum_hour_group);
            $('strong#total').text(data.total);

        });
    });

    $('.input_other_houer').focus(function () {
        $(this).text('');
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
            // если сервер ответил OK то
            // вставляем сумму часов

            // если часов больше чем 1440 и меньше 800 то выделяем текст красным
            verification(data.total);

            $('strong#sum_hour_group').text(data.sum_hour_group);
            $('strong#total').text(data.total);
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
    //
    // Удалить дисциплину у преподавателя

    $('i#del_dis_teacher').click(function () {
        var $_this = $(this);
        // получаем id записи что бы по нему искать
        var discipline_id = $_this.parent().attr('discipline_id');
        // получить id преподавателя
        var teacher_id = $("input#teacher_id").val();

        $.post("/teacher/discipline/delete", {
            "discipline_id": discipline_id,
            "teacher_id": teacher_id
        }).done(function (data) {

            // Если ответ с сервера ОК! то удаляем строку
            $_this.parent().parent().remove();

            // Вставляем пересчитанные часы после удаления

            // если часов больше чем 1440 и меньше 800 то выделяем текст красным
            verification(data.total);

            $('strong#total').text(data.total);
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