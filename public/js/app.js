//************************************************************************************** */
/**
Форматирования url для пагинации и сортировки
*/
function getUrl(name) {
    let searchParams = new URLSearchParams(window.location.search);

    let page = '';
    let sortbydate = '';
    let sortbyprice = '';

    if (searchParams.has('page')) {
        page = '&page=' + searchParams.get('page');
    }

    if (searchParams.has('sortbydate') && name !== 'sortbydate') {
        sortbydate = '&sortbydate=' + searchParams.get('sortbydate');
    }

    if (searchParams.has('sortbyprice') && name !== 'sortbyprice') {
        sortbydate = '&sortbyprice=' + searchParams.get('sortbyprice');
    }

    if (searchParams.has(name)) {
        window.location.href = '/?' + name + '=' + (!(searchParams.get(name) === 'true')) + page + sortbydate + sortbyprice;
    } else {
        window.location.href = '/?' + name + '=true' + page + sortbydate + sortbyprice;
    }
}
//************************************************************************************** */
/**
Получение данных по идентификатору объявления
*/
function openAd(id) {
    if (id === undefined){
        return;
    }
    
    $.ajax({
        method: "GET",
        url: "api/v1/ad/" + id + "?fields=images;description"
    }).done(function (data) {
        if (data.status === "success") {
            $('#name_error').hide();
            $('#description_error').hide();
            
            $('#name').removeClass("is-valid");
            $('#description').removeClass("is-valid");
    
            $('#name').removeClass("is-invalid");
            $('#description').removeClass("is-invalid");

            $("#name").val(data.data.name);
            $("#price").val(data.data.price);
            $("#image").val(data.data.images);

            $("#title").html('Объявление');
            $('#close').hide();
            $("#description").val(data.data.description);
            $('#messageBoxAdd').modal('show');
        } else {         
            if (data.status === "failed") {
                $("#title_res").html('Ошибка');
                $('#message').html(data.message);
                $('#messageBoxError').modal('show');
            }
        }
    });
}
//************************************************************************************** */
$(document).ready(function () {
    $('#name_error').hide();
    $('#description_error').hide();

    $('#sortByDate').on("click", function (e) {
        getUrl('sortbydate');
    });

    $('#sortByPrice').on("click", function (e) {
        getUrl('sortbyprice');
    });

    /** Добавление нового объявления открытие формы*/
    $('#add').on("click", function () {
        $('#name_error').hide();
        $('#description_error').hide();
        
        $('#name').removeClass("is-valid");
        $('#description').removeClass("is-valid");

        $('#name').removeClass("is-invalid");
        $('#description').removeClass("is-invalid");

        $("#name").val("");
        $("#price").val("");
        $("#image").val("");
        
        $("#title").html('Добавление объявления');
        $("#description").val('');
        $('#close').show();

        if ($("#image").val().length == 0) {
            if (!$("#image").hasClass("is-invalid")) {
                $("#image").addClass("is-invalid");
                $("#image").removeClass("is-valid");
                $('#close').attr("disabled", true);
            }
        }

        $('#messageBoxAdd').modal('show');
    });

    /** Удаление объявления */
    $('#delete').on("click", function () {
       let elements =  $("input[type='checkbox']")

       let data = [];

        for (i = 0; i < elements.length; i++) {
            if (elements[i].checked) {
                data.push($(elements[i]).data('id'));
            }
        }

        if (data.length > 0) {
            $.ajax({
                method: "POST",
                url: "api/v1/ad/delete",
                data: {'id': data}
            }).done(function (data) {
                if (data.status === "success") {
                    $("#title_res").html('Результат');
                    $('#message').html('Удалено');
                    $('#messageBoxError').modal('show');
                } else {
                    $("#title_res").html('Ошибка');
                    $('#message').html(data.message);
                    $('#messageBoxError').modal('show');
                }
            });
        }
    });

    /** Просмотр объявления */
    $('th').on("click", function (e) {
        if ($(e.target)[0].tagName == "TH") {
            openAd($(e.target).data('id'));
        }
    });

    $('td').on("click", function (e) {
        if ($(e.target)[0].tagName == "TD") {
            openAd($(e.target).data('id'));
        }
    });

    /** Валидация наименования */
    $('#name').on('input', function () {
        if ($(this).val().length < 200) {
            if (!$(this).hasClass("is-valid")) {
                $(this).addClass("is-valid");
                $(this).removeClass("is-invalid");
                $('#close').attr("disabled", false);
                $('#name_error').hide();
            }
        } else {
            if (!$(this).hasClass("is-invalid")) {
                $(this).addClass("is-invalid");
                $(this).removeClass("is-valid");
                $('#close').attr("disabled", true);
                $('#name_error').show();
            }
        }
    });

    /** Валидация описания */
    $('#description').on('input', function () {
        if ($(this).val().length < 1000) {
            if (!$(this).hasClass("is-valid")) {
                $(this).addClass("is-valid");
                $(this).removeClass("is-invalid");
                $('#close').attr("disabled", false);
                $('#description_error').hide();
            }
        } else {
            if (!$(this).hasClass("is-invalid")) {
                $(this).addClass("is-invalid");
                $(this).removeClass("is-valid");
                $('#close').attr("disabled", true);
                $('#description_error').show();
            }
        }
    });

    /** Валидация изображений */
    $('#image').on('input', function () {
        let res = $(this).val().split(";");

        if ((res.length > 0) && (res.length <= 3)) {
            if (!$(this).hasClass("is-valid")) {
                $(this).addClass("is-valid");
                $(this).removeClass("is-invalid");
                $('#close').attr("disabled", false);
            }
        } else {
            if (!$(this).hasClass("is-invalid")) {
                $(this).addClass("is-invalid");
                $(this).removeClass("is-valid");
                $('#close').attr("disabled", true);
            }
        }

        if ($('#image').val().length == 0) {
            if (!$(this).hasClass("is-invalid")) {
                $(this).addClass("is-invalid");
                $(this).removeClass("is-valid");
                $('#close').attr("disabled", true);
            }
        }
    });

    /** Добавление нового объявления */
    $('#close').on("click", function () {
        $('#messageBoxAdd').modal('hide');

        let img = $("#image").val().split(";");

        let images = [];
        
        for (i = 0; i < img.length; i++) {
            if (img[i].length > 0) {
                images.push(img[i]);
            }
        }

        let data = {
            'name': $("#name").val(),
            'price': $("#price").val(),
            'images': images,
            'description': $("#description").val()
        };

        $.ajax({
            method: "POST",
            url: "api/v1/ad",
            data: data
        }).done(function (data) {
            if (data.status === "success") {
                $("#title_res").html('Результат');
                $('#message').html("Новый ID - " + data.id);
                $('#messageBoxError').modal('show');
            } else {
                $("#title_res").html('Ошибка');
                $('#message').html(data.message);
                $('#messageBoxError').modal('show');
            }
        });
    });
});
//************************************************************************************** */
