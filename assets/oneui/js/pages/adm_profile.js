$(function () {
    //defaults
    var base_url = $('.base_url').val();
    var studentId = $('.studentId').val();

    $.fn.editable.defaults.inputclass = 'form-control';
    $.fn.editable.defaults.url = base_url+'backend/profile/update/'+studentId;
    $.fn.editable.defaults.mode = 'inline';

    //editables
    $('#prof_company_name').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });


    $('#prof_review').editable({
      validate: function(value) {
          if($.trim(value) == '') {
              return 'Inputan tidak boleh kosong!';
          }
      },
      success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
      }
    });

    $('#prof_desc').editable({
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


// upload background
$('input.uploadBG').on('change', function(e) {
    if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {
        var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;
        var reader = new FileReader();
        reader.onload = function(e) {
            image.attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
        $('#cropper-modalBG').modal('show');
    }else {
        alert('file not supported');
    }
});

$('#cropper-modalBG').on('shown.bs.modal', function() {
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


$('.btn-cropBG').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $('img#imgPreview-bg').attr('src', imgb64);
    $('#srcDataCrop-bg').val(imgb64);
    var data = $('.form-update-bg').serialize();
    var action = $('.form-update-bg').attr('action');
    $.ajax({
        url: action,
        method: 'POST',
        data: data,
        timeout: 10000,
        success: function(res) {
            res = $.parseJSON(res);
            if (res.data == '1') {
                swal({
                  title: "Success",
                  text: "gambar berhasil diubah!!",
                  type: "success",
                  // showCancelButton: true,
                  confirmButtonColor: "#3498DB",
                  confirmButtonText: "Ok",
                  // cancelButtonText: "Tetap Disini",
                  closeOnConfirm: true
                },
                function(){
                      window.location.reload();
                });
            } else {
                swal("Oops...", res.data, "error");
            }
        },
        error: function(jqXHR, exception) {
            alert(jqXHR.statusText);
        },
    });
    $('#cropper-modalBG').modal('hide');
});

$('#cropper-modalBG').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
    // $('body').addClass('modal-open');
});

// Logo
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
    $('img#imgPreview').attr('src', imgb64);
    $('#srcDataCrop').val(imgb64);
    var data = $('.form-update-logo').serialize();
    var action = $('.form-update-logo').attr('action');
    $.ajax({
        url: action,
        method: 'POST',
        data: data,
        timeout: 10000,
        success: function(res) {
            res = $.parseJSON(res);
            if (res.data == '1') {
                swal({
                  title: "Success",
                  text: "Logo berhasil diubah!!",
                  type: "success",
                  // showCancelButton: true,
                  confirmButtonColor: "#3498DB",
                  confirmButtonText: "Ok",
                  // cancelButtonText: "Tetap Disini",
                  closeOnConfirm: true
                },
                function(){
                      window.location.reload();
                });
            } else {
                swal("Oops...", res.data, "error");
            }
        },
        error: function(jqXHR, exception) {
            alert(jqXHR.statusText);
        },
    });
    $('#cropper-modal').modal('hide');
});


$('#cropper-modal').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
    // $('body').addClass('modal-open');
});
