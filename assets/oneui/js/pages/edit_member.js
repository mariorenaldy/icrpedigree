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
                        alert('Data member berhasil diubah!');
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
    $('.form-update-member').attr('action', base_url+'members/update/'+res.mem_id);
    if (res.mem_photo == '-')
        $('img#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/image.png');
    else
        $('img#imgPreview').attr('src', base_url+'uploads/members/'+res.mem_photo);
    if (res.mem_pp == '-')
        $('img#imgPreviewPP').attr('src', base_url+'assets/oneui/img/avatars/image.png');
    else
        $('img#imgPreviewPP').attr('src', base_url+'uploads/members/'+res.mem_pp);
    $('#name-update-member').val(res.mem_name);
    $('#address-update-member').val(res.mem_address);
    $('#mail-address-update-member').val(res.mem_mail_address);
    $('#hp-update-member').val(res.mem_hp);
    $('#kota-update-member').val(res.mem_kota);
    $('#kode-pos-update-member').val(res.mem_kode_pos);
    $('#email-update-member').val(res.mem_email);
    $('#username-update-member').val(res.mem_username);
    $('#pass-update-member').val('');
    $('#newpass-update-member').val('');
    $('#repass-update-member').val('');

    $('#id-update-kennel').val(res.mem_ken_id);
    if (res.ken_photo == '-')
        $('img#imgPreviewLogo').attr('src', base_url+'assets/oneui/img/avatars/image.png');
    else
        $('img#imgPreviewLogo').attr('src', base_url+'uploads/kennels/'+res.ken_photo);
    $('#name-update-kennel').val(res.ken_name);
    $('#format-update-kennel').val(res.ken_type_id);
}

// add
$('#imageInput').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal').modal('show');
    }else {
        alert('file not supported');
    }
});

$('#imageInputPP').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img-PP > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal-PP').modal('show');
    }else {
        alert('file not supported');
    }
});

$('#imageInputLogo').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img-logo > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal-logo').modal('show');
    }else {
        alert('file not supported');
    }
});

$('#cropper-modal').on('shown.bs.modal', function() {
    var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
    image.cropper({
        aspectRatio: 1 / 1,
        autoCropArea: 0.5,
        cropBoxResizable: true,
        checkImageOrigin: true,
        responsive: true,
        built: function() {
            // Strict mode: set crop box data first
            image.cropper('setCropBoxData', cropBoxData);
            image.cropper('setCanvasData', canvasData);
        },
    });
});

$('#cropper-modal-PP').on('shown.bs.modal', function() {
    var image = $('#cropper-wrap-img-PP > img'), cropBoxData, canvasData;
    image.cropper({
        aspectRatio: 1 / 1,
        autoCropArea: 0.5,
        cropBoxResizable: true,
        checkImageOrigin: true,
        responsive: true,
        built: function() {
            // Strict mode: set crop box data first
            image.cropper('setCropBoxData', cropBoxData);
            image.cropper('setCanvasData', canvasData);
        },
    });
});

$('#cropper-modal-logo').on('shown.bs.modal', function() {
    var image = $('#cropper-wrap-img-logo > img'), cropBoxData, canvasData;
    image.cropper({
        aspectRatio: 1 / 1,
        autoCropArea: 0.5,
        cropBoxResizable: true,
        checkImageOrigin: true,
        responsive: true,
        built: function() {
            // Strict mode: set crop box data first
            image.cropper('setCropBoxData', cropBoxData);
            image.cropper('setCanvasData', canvasData);
        },
    });
});

$('#btn-crop').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $('img#imgPreview').attr('src', imgb64);
    $('#srcDataCrop').val(imgb64);
    $('#cropper-modal').modal('hide');
});

$('#btn-crop-PP').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img-PP > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $('#imgPreviewPP').attr('src', imgb64);
    $('#srcDataCropPP').val(imgb64);
    $('#cropper-modal-PP').modal('hide');
});

$('#btn-crop-logo').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img-logo > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $('img#imgPreviewLogo').attr('src', imgb64);
    $('#srcDataCropLogo').val(imgb64);
    $('#cropper-modal-logo').modal('hide');
});

$('#cropper-modal').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
});

$('#cropper-modal-PP').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img-PP > img').cropper('destroy');
});

$('#cropper-modal-logo').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img-logo > img').cropper('destroy');
});
