/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */

 // ARTechnology
 
var base_url = $('.base_url').val();

jQuery('.form-update-birth').validate({
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
                    alert('Data lahir berhasil diubah!');
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
    if (type == 'update-birth') {
        $('.form-update-birth').attr('action', base_url+'births/update/'+id);
        $.get(base_url+'births/data/'+id, function(res) {
            res = $.parseJSON(res);
            if (res.bir_photo == '-')
                $('img#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgPreview').attr('src', base_url+'uploads/canine/'+res.bir_photo);
            
            $('#bir_a_s').val(res.bir_a_s);
            $('#bir_breed').val(res.bir_breed);
            $('#bir_gender').val(res.bir_gender);
            $('#bir_color').val(res.bir_color);
            $('#bir_date_of_birth').val(res.bir_date_of_birth);
            $('#breeder').val(res.bir_owner_name);
            $('#kennel').val(res.bir_cage);
            $('#bir_note').val(res.bir_note);
        });
    }

    $(target).modal('show');
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
    $('#imgPreview').attr('src', imgb64);
    $('#srcDataCrop').val(imgb64);
    $('#cropper-modal').modal('hide');
});

$('#cropper-modal').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
    $('body').addClass('modal-open');
});

$('#modal-update-birth').on('hidden.bs.modal', function() {
    $('img#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop').val('');
});