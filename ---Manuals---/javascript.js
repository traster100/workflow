"use strict";

$(document).ready(function () {

    //проверка вбиваемых символов на лету, когда вбиваем их в поле input
    $('#code').on('keyup', function () {

        var filed_string = $(this).val();

        //длина символов
        var length_symbols = filed_string.length;

        //ничего кроме латинницы и цифр
        var regexp = /^[a-zA-Z0-9]+$/i;
        if (regexp.test(filed_string)) {
            //тут код
        }

        //добавление/удаление аттрибута
        $('#check').attr('disabled', 'disabled');
        $('#check').removeAttr('disabled');

        //добавление/удаление класса
        $('#check').addClass('btn-default');
        $('#check').removeClass('btn-default');
    });

    //клик по кнопке
    $('#check').on('click', function () {

        //сама кнопка
        var button = $(this);

        //запрос к серверу
        $.post(
            'url',
            {
                'var1': 'value1',
                'var2': 'value2'
            },
            function (result) {
                console.log(result);
            });
    });

    //клик по кнопке которая появляется на странице динамически, и ее в момент загрузки еще нет
    $(document).delegate('#check', 'click', function () {
        //тут код
    });

    //клик по ссылке которая будет в будущем
    $(document).delegate('a', 'click', function () {
        //тут код
    });

    //скрол наверх или к элементу
    $('html,body').animate({scrollTop: $("input:first").offset().top - 100}, 500);
    $('#boxscroll').scrollTop(9999999);
    $('#boxscroll').scrollTop();

    $('a').click(function () {
        $('html, body').animate({
            scrollTop: $("header").offset().top
        }, 200);
        return false;
    });

    //редирект/открытие другого урла. обычно для скачивания файла
    window.location.href = 'url';

    //не давать вбивать ничего кроме цифр
    //<input type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' >

    //вопрос с подтверждением
    if (confirm('Удалить?')) {
        //тут код
    }

    //слушаем инпуты
    $('input').keydown(function (event) {

        //keypress - нажатие. еще keyup
        //может еще так быть event.which == 13

        //ловим Enter
        if (event.keyCode == 13) {
            //тут код
        }

        //ловим Esc
        if (event.keyCode == 27) {
            //тут код
        }
    });


    //слушаем селекты
    $('select').change(function (event) {
        //тут код
    });

    //генерация клика
    $('#submit').trigger('click');

    // остановить распространение события
    $('#submit').on('click', function (event) {
        event.preventDefault();
    });

    //проход по всем элементам
    $('input').each(
        function (index, element) {
            console.log($(element));
        }
    );

    //отметить все чекбокы
    $('.checkbox').prop('checked', 'checked');

    //событие на чекбоксе
    $('.check_print').on('change', function () {
        //тут код
    });

    //если нет класса - добавит, если есть - удалит
    $('a').toggleClass('active');

    //приведение к целому числу
    parseInt(new_count);

});