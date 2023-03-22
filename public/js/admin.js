jQuery(document).ready(function($) {
    /*
     * Автоматическое создание slug при вводе name (замена кириллицы на латиницу)
     */
    $('input[name="name"]').on('input', function() {
        /* ... */
    });
    /*
     * Подключение wysiwyg-редактора для редактирования контента страницы
     */
    $('textarea[id="editor"]').summernote({
        lang: 'ru-RU',
        height: 300,
    });
});

/*
 * Загружает на сервер вставленное в редакторе изображение
 */
function uploadImage(image, textarea) {
    var data = new FormData();
    data.append('image', image);
    $.ajax({
        data: data,
        type: 'POST',
        url: '/admin/page/upload/image',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
            if (data.errors === undefined) {
                $(textarea).summernote('insertImage', data.image, function ($img) {
                    $img.css('max-width', '100%');
                });
            } else {
                $.each(data.errors, function (key, value) {
                    alert(value);
                });
            }
        },
    });
}
/*
 * Загружает на сервер вставленное в редакторе изображение
 */
function uploadImage(image, textarea) {
    var data = new FormData();
    data.append('image', image);
    $.ajax({
        data: data,
        type: 'POST',
        url: '/admin/page/upload/image',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
            $(textarea).summernote('insertImage', data.image, function ($img) {
                $img.css('max-width', '100%');
            });
        },
        error: function (reject) {
            $.each(reject.responseJSON.errors, function (key, value) {
                alert(value);
            });
        }
    });
}
