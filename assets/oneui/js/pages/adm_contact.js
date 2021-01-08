$(function () {
    //defaults
    var base_url = $('.base_url').val();
    var conId = $('.conId').val();

    $.fn.editable.defaults.inputclass = 'form-control';
    $.fn.editable.defaults.url = base_url+'backend/contacts/update/'+conId;
    $.fn.editable.defaults.mode = 'inline';

    //editables
    $('#con_address').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#con_open_time').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#con_close_time').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#con_open_time').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#con_phone_number').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#con_facebook').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#con_instagram').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#con_twitter').editable({
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
