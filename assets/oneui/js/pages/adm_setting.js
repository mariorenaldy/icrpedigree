$(function () {
    //defaults
    var base_url = $('.base_url').val();
    var studentId = $('.studentId').val();

    $.fn.editable.defaults.inputclass = 'form-control';
    $.fn.editable.defaults.url = base_url+'backend/setting/update/'+studentId;
    $.fn.editable.defaults.mode = 'inline';

    //editables
    $('#set_certificate_price').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });


    $('#set_first_champion_score').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#set_second_champion_score').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#set_third_champion_score').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });




});
