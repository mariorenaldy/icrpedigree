// ARTechnology
var base_url = $('.base_url').val();

var initValidationAdd = function() {
    jQuery('.form-add-member').validate({
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
            $.ajax({
                url:$form.attr('action'),
                type:'POST',
                data:$form.serialize(),
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.location = base_url;
                        alert('Data berhasil disimpan!');
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
    initValidationAdd();
    initValidationImport();
});

/* PROCCESSING */
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

$('#btn-crop-logo').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img-logo > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $('img#imgPreviewLogo').attr('src', imgb64);
    $('#srcDataCropLogo').val(imgb64);
    $('#cropper-modal-logo').modal('hide');
});

$('#cropper-modal').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
});

$('#cropper-modal-logo').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img-logo > img').cropper('destroy');
});