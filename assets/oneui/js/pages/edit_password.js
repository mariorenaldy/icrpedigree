// ARTechnology
var base_url = $('.base_url').val();

var initValidationUpdate = function() {
    jQuery('.form-update-member').validate({
        errorClass: 'help-block text-right animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group > div').append(error);
        },

        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },

        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },

        rules: {
            description: {
                required: true,
            },
        },
        messages: {
            description: {
                required: 'Please enter a description',
            },
        },
        submitHandler: function(form) {
            $form = $(form);
            var button = $form.find('button[type="submit"]');
            button.attr('disabled', 'disabled');
            button.text('saving..');
            $.ajax({
                url:$form.attr('action'),
                type:'POST',
                data:$form.serialize(),
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.location.reload();
                        alert('Data password berhasil disimpan!');
                    }else {
                        alert(res.data);
                    }
                    button.removeAttr('disabled');
                    button.text('Save');
                },

                error: function(jqXHR, exception) {
                    alert(jqXHR.status);

                    button.removeAttr('disabled');
                    button.text('Save');
                },
            });
            return false; // required to block normal submit since you used ajax
        },
    });
};

var initValidationImport = function() {
    jQuery('.form-import-member').validate({
        errorClass: 'help-block text-right animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group > div').append(error);
        },

        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },

        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error');
            jQuery(e).closest('.help-block').remove();
        },
        rules: {
            ImageFile: {
                required: true,
            },
            description: {
                required: true,
            },
        },
        messages: {
            ImageFile: {
                required: 'Please choose a picture',
            },
            description: {
                required: 'Please enter a description',
            },
        },
        submitHandler: function(form) {
            $form = $(form);
            var button = $form.find('button[type="submit"]');
            button.attr('disabled', 'disabled');
            button.text('saving..');
            $('.progress-add').show();
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.progress-upload-rec').css('width', percentComplete+'%').attr('aria-valuenow', percentComplete).text(percentComplete+'%');
                        console.log(percentComplete);

                        if (percentComplete === 100) {

                        }

                    }
                    }, false);

                    return xhr;
                },
                url:$form.attr('action'),
                type:'POST',
                // data:$form.serialize(),
                data: new FormData( form ),
                processData: false,
                contentType: false,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        form.reset();
                        $('.progress-add').hide();
                        $('#modal-import-member').modal('hide');
                    }else {
                        alert(res.data);

                    }
                    button.removeAttr('disabled');
                    button.text('Save');
                },

                error: function(jqXHR, exception) {
                    console.log(jqXHR)
                    alert(jqXHR.statusText);

                    button.removeAttr('disabled');
                    button.text('Save');
                },
            });
            return false; // required to block normal submit since you used ajax
        },
    });
};

// Initialize when page loads
jQuery(function() {
    initValidationUpdate();
    initValidationImport();
    getDataMember();
});

/* PROCCESSING */

// open modal add/update
function getDataMember() {
    var res = $('#form-update-member').data("is-member");
    $('.form-update-member').attr('action', base_url+'members/change_password/'+res.mem_id);
    $('#username-update-member').val(res.mem_username);
}
