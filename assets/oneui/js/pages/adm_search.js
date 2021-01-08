/*
 *  Document   : base_pages_login.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Login Page
 */
var base_url = $('.base_url').val();
var BasePagesLogin = function() {
    // Init Login Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
    var initValidationLogin = function(){
        jQuery('.form-search').validate({
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
                'nrp': {
                    required: true,
                    minlength: 3
                },
                'password': {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                'nrp': {
                    required: 'Tolong masukan NRP anda!',
                    minlength: 'Your nrp must consist of at least 3 characters'
                },
                'password': {
                    required: 'olong masukan password anda!T',
                    minlength: 'Your password must be at least 5 characters long'
                }
            },
            submitHandler: function(form) {
                $form = $(form);
                var button = $form.find('button[type="submit"]');
                button.attr('disabled', 'disabled');
                // button.text('Pengecekan..');
                $.ajax({
                    url:$form.attr('action'),
                    type:'POST',
                    data:$form.serialize(),
                    success: function(res) {
                        res = $.parseJSON(res);
                        if (res.data == '1') {
                            form.reset();
                            window.location.reload();
                        }else{
                            swal("Oops...", res.data, "error");
                        }
                        button.removeAttr('disabled');
                        button.text('Masuk');
                    },

                    error: function(jqXHR, exception) {
                        // $('#modal-notif .block-content p').text(jqXHR.statusText);
                        alert(jqXHR.statusText);
                        // $('#modal-notif').modal('show');
                        button.removeAttr('disabled');
                        // button.text('Masuk');
                    },
                });
                return false; // required to block normal submit since you used ajax
            },
        });
    };

    return {
        init: function () {
            // Init Login Form Validation
            initValidationLogin();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ BasePagesLogin.init(); });
