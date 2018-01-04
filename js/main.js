(function() {

    // select2
    $('#select-city').select2({
        language: "ru",
        placeholder: 'Выберите Город',
        minimumInputLength: 3,        
        ajax: {
            url: "../src/np/current-city.php",
            type: "POST",
            dataType: "json",
            cache: true,
            delay: 250,
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
        }
    })

    $('#select-department').select2({
        language: "ru",
        placeholder: 'Выберите Отделение',
        ajax: {
            url: "../src/np/current-department.php",
            type: "POST",
            dataType: "json",
            data: function() {
                return {
                    cityKey: $('#select-city').val()
                };
            },
            processResults: function(data) {
                return {
                    results: data
                }
            },
        },
    });


    // form validator
    $('#np-form').submit(function() {
        let error = 0;
        $('.input-wrapper').find('input').each(function(){
            $(this).addClass('empty');

            if($(this).val() != ''){
                $(this).removeClass('empty');
            } else {
                error = 1;
            }
        })

        if($('#select2-select-city-container').text() == 'Выберите Город'){
            $('#select2-select-city-container').addClass('empty');             
            error = 1;
        } else {
            $('#select2-select-city-container').removeClass('empty');
        }

        if($('#select2-select-department-container').text() == 'Выберите Отделение'){
            $('#select2-select-department-container').addClass('empty');                                               
            error = 1;
        } else {
            $('#select2-select-department-container').removeClass('empty');
        }

        if(error){
          swal({
              title: 'Постойте',
              text: 'Пожалуйста, заполните пустые поля',
              type: 'error',
              confirmButtonColor: '#d91b1b',
          })
          return false;            
        }
        swal({
            title: 'Спасибо за попытку :)',
            text: 'Увы, но дальше сейчас не пройти. Возьми печеньку и не грусти!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Взять',
            cancelButtonText: 'Отказаться',
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
        }).then((result) => {
            if (result.value) {
            swal({
                title: 'Приятного аппетита',
                type: 'success',
                timer: 1500
            })
            } else if (result.dismiss === 'cancel') {
                swal({
                    title: 'Ну и ладно :(',
                    type: 'error',
                    timer: 1500
                })
            }
        })
        return false;        
    });

    // masks for input
    $('.input-wrapper #phone').mask('+38(099)99-99-999');


})(jQuery);