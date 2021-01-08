/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */

var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initValidationUpdate = function () {
        jQuery('.form-update-service').validate({
            errorClass: 'help-block text-right animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function (error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function (e) {
                jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            success: function (e) {
                jQuery(e).closest('.form-group').removeClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            rules: {
                code: {
                    required: true,
                },
                title: {
                    required: true,
                },
            },
            messages: {
                code: {
                    required: 'Please enter a code',
                },
                title: 'Please enter a title',
            },
            submitHandler: function (form) {
                $form = $(form);
                var button = $form.find('button[type="submit"]');
                button.attr('disabled', 'disabled');
                button.text('saving..');
                $.ajax({

                    url: $form.attr('action'),
                    type: 'POST',
                    // data: new FormData( form ),
                    // processData: false,
                    // contentType: false,

                    success: function (res) {
                        res = $.parseJSON(res);
                        if (res.data == '1') {
                            // form.reset();
                            alert('Perubahan berhasil disimpan!!');
                            // document.location.reload();

                        } else {
                            $('#modal-notif .block-content p').text(res.data);
                            $('#modal-notif').modal('show');
                        }
                        button.removeAttr('disabled');
                        button.text('Save');
                    },
                    error: function (jqXHR, exception) {
                        console.log(jqXHR)
                        $('#modal-notif .block-content p').text(jqXHR.statusText);
                        $('#modal-notif').modal('show');
                        button.removeAttr('disabled');
                        button.text('Save');
                    },
                });
                return false; // required to block normal submit since you used ajax
            },
        });
    };

    return {
        init: function() {
            // Init Datatables
            initValidationUpdate();

        },
    };
}();

// Initialize when page loads
jQuery(function() {
    BaseTableDatatables.init();
});
