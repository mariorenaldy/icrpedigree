/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */

 // ARTechnology
 
var base_url = $('.base_url').val();

var initValidationUpdate = function() {
    jQuery('.form-update-canine').validate({
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
                        $('#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg')
                        $('#modal-update-canines').modal('hide');
                        alert('Request berhasil disimpan');
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

// Initialize when page loads
jQuery(function() {
    initValidationUpdate();
});

/* PROCCESSING */

// open modal add/update
function openModal(target, type, id) {
    if (type == 'update') {
        $.get(base_url+'canines/data/'+id, function(res) {
            res = $.parseJSON(res);
            $('.form-update-canine').attr('action', base_url+'canines/update/'+id);
            if (res.can_photo == '-')
                $('img#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgPreview-update').attr('src', base_url+'uploads/canine/'+res.can_photo);
            $('#can_cage').val(res.can_cage);
            $('#can_address').val(res.can_address);
            $('#can_owner').val(res.can_owner);
        });
    }
    
    $(target).modal('show');
}

// add
$('input.upload').on('change', function(e) {
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

$('#cropper-modal').on('shown.bs.modal', function() {
    var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
    image.cropper({
        aspectRatio: NaN,
        autoCropArea: 1,
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
    $('img#imgPreview-update').attr('src', imgb64);
    $('#srcDataCrop-update').val(imgb64);
    $('#cropper-modal').modal('hide');
});

$('#cropper-modal').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
    $('body').addClass('modal-open');
});

$('#modal-update-canine').on('hidden.bs.modal', function() {
    $('img#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop-update').val('');
});