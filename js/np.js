$(function() {

    $('#select-city').select2({
        language: "ru",
        placeholder: 'Выберите Город',
        ajax: {
            url: "../src/np/current-city.php",
            type: "POST",
            dataType: "json",
            cache: true,
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                $('#select-secession').html('<option value="null" disable>Выберите Отделение</option>');
                return {
                    results: data
                };
            },
        },
        minimumInputLength: 3
    })

    $('#select-secession').select2({
        language: "ru",
        placeholder: 'Выберите Отделение',
        ajax: {
            url: "../src/np/current-secession.php",
            type: "POST",
            dataType: "json",
            data: function() {
                var queryParameters = {
                    key: $('#select-city').val(),
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.each(data, function(key, val) {
                        $('#select-secession').append('<option value="' + val['id'] + '">' + val['text'] + '</option>');
                    })
                }
            },
        },
    });

});