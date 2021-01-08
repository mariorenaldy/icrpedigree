/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */

 // ARTechnology
 
var base_url = $('.base_url').val();

jQuery('.form-add-stud').validate({
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
                    form.reset();
                    alert('Data pacak berhasil ditambahkan!');
                    window.location.reload();
                }
                else {
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

jQuery('.form-update-stud').validate({
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
                    form.reset();
                    alert('Data pacak berhasil diubah');
                    window.location.reload();
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

jQuery('.form-add-birth').validate({
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
                    form.reset();
                    alert('Data lahir berhasil ditambahkan!');
                    window.location.reload();
                }
                else {
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

// Initialize when page loads
jQuery(function() {
    $('#date-add-stud').datetimepicker({
        format: 'DD-MM-YYYY',
        showTodayButton: true,
        showClose: true,
        icons: {
            time: 'fa fa-clock text-gray',
            date: 'fa fa-calendar text-gray',
            up: 'fa fa-arrow-up text-gray',
            down: 'fa fa-arrow-down text-gray',
            previous: 'fa fa-arrow-left text-gray',
            next: 'fa fa-arrow-right text-gray',
            today: 'fa fa-calendar text-gray',
            clear: 'fa fa-trash text-gray',
            close: 'fa fa-times text-gray'
        }
    });

    $('#date-update-stud').datetimepicker({
        format: 'DD-MM-YYYY',
        showTodayButton: true,
        showClose: true,
        icons: {
            time: 'fa fa-clock text-gray',
            date: 'fa fa-calendar text-gray',
            up: 'fa fa-arrow-up text-gray',
            down: 'fa fa-arrow-down text-gray',
            previous: 'fa fa-arrow-left text-gray',
            next: 'fa fa-arrow-right text-gray',
            today: 'fa fa-calendar text-gray',
            clear: 'fa fa-trash text-gray',
            close: 'fa fa-times text-gray'
        }
    });

    $('#bir_date_of_birth').datetimepicker({
        format: 'DD-MM-YYYY',
        showTodayButton: true,
        showClose: true,
        icons: {
            time: 'fa fa-clock text-gray',
            date: 'fa fa-calendar text-gray',
            up: 'fa fa-arrow-up text-gray',
            down: 'fa fa-arrow-down text-gray',
            previous: 'fa fa-arrow-left text-gray',
            next: 'fa fa-arrow-right text-gray',
            today: 'fa fa-calendar text-gray',
            clear: 'fa fa-trash text-gray',
            close: 'fa fa-times text-gray'
        }
    });
});

/* PROCCESSING */

// open modal add/update
function openModal(target, type, id) {
    if (type == 'update-stud') {
        $('.form-update-stud').attr('action', base_url+'studs/update/'+id);
        $.get(base_url+'studs/data/'+id, function(res) {
            res = $.parseJSON(res);
            if (res.stu_photo == '-')
                $('img#imgStud-update').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgStud-update').attr('src', base_url+'uploads/stud/'+res.stu_photo);
            
            if (res.stu_sire_photo == '-')
                $('img#imgSire-update').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgSire-update').attr('src', base_url+'uploads/stud/'+res.stu_sire_photo);
                
            if (res.stu_mom_photo == '-')
                $('img#imgDam-update').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgDam-update').attr('src', base_url+'uploads/stud/'+res.stu_mom_photo);
            
            $('#date-update-stud').val(res.stu_stud_date);
        });
    }
    else if (type == 'add-birth') {
        $('.form-add-birth').attr('action', base_url+'births/add/'+id);
        $('#bir_stu_id').val(id);
    }

    $(target).modal('show');
}

// add
$('#imageInputStud').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal').modal('show');
        $('#imgPreview').val('img#imgStud');
        $('#srcDataCrop').val('#srcDataCropStud');
    } else {
        alert('file not supported');
    }
});

$('#imageInputSire').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal').modal('show');
        $('#imgPreview').val('img#imgSire');
        $('#srcDataCrop').val('#srcDataCropSire');
    } else {
        alert('file not supported');
    }
});

$('#imageInputDam').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal').modal('show');
        $('#imgPreview').val('img#imgDam');
        $('#srcDataCrop').val('#srcDataCropDam');
    } else {
        alert('file not supported');
    }
});

$('#imageInputStud-update').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal').modal('show');
        $('#imgPreview').val('img#imgStud-update');
        $('#srcDataCrop').val('#srcDataCropStud-update');
    } else {
        alert('file not supported');
    }
});

$('#imageInputSire-update').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal').modal('show');
        $('#imgPreview').val('img#imgSire-update');
        $('#srcDataCrop').val('#srcDataCropSire-update');
    } else {
        alert('file not supported');
    }
});

$('#imageInputDam-update').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal').modal('show');
        $('#imgPreview').val('img#imgDam-update');
        $('#srcDataCrop').val('#srcDataCropDam-update');
    } else {
        alert('file not supported');
    }
});

$('#imageInputCanine').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modal').modal('show');
        $('#imgPreview').val('img#imgCanine');
        $('#srcDataCrop').val('#srcDataCropCanine');
    } else {
        alert('file not supported');
    }
});

$('#cropper-modal').on('shown.bs.modal', function() {
    var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
    image.cropper({
        // aspectRatio: 1 / 1,
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

$('.btn-crop').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $preview = $('#imgPreview').val();
    $($preview).attr('src', imgb64);
    $src = $('#srcDataCrop').val();
    $($src).val(imgb64);
    $('#cropper-modal').modal('hide');
});

$('#cropper-modal').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
    $('body').addClass('modal-open');
});

$('#modal-add-stud').on('hidden.bs.modal', function() {
    $('img#imgStud').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCropStud').val('');
    $('img#imgSire').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCropSire').val('');
    $('img#imgDam').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCropDam').val('');
});

$('#modal-update-stud').on('hidden.bs.modal', function() {
    $('img#imgStud-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCropStud-update').val('');
    $('img#imgSire-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCropSire-update').val('');
    $('img#imgDam-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCropDam-update').val('');
});

$('#modal-add-birth').on('hidden.bs.modal', function() {
    $('img#imgCanine').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCropCanine').val('');
});