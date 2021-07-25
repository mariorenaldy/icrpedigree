/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */

// ARTechnology
var base_url = $('.base_url').val();
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTablemember = function() {
        window.tablemember = jQuery('.data-members').dataTable({
            order: [[2, 'asc']],
            columnDefs: [{ orderable: false, targets: [0, 1, 9, 14, 15, 16]}],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            processing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/members/data',
              type: 'POST',
            },
            columns: [
                    { data: 'mem_id',
                      render:function(data, type, row) {
                          var str = '<div class="checkbox-member">' +
                                        '<input type="checkbox" name="memberId[]" value="' + data + '" data-toggle="tooltip" title="Select to remove">' +
                                  '</div>';
                          return str;
                      },
                    },
                    { data: 'mem_photo',
                      render: function(data, type, row) {
                        if (data == '-') {
                          var str = '<img src="'+base_url+'assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%">';
                          return str;
                        }else{
                          var str = '<img src="'+base_url+'uploads/members/'+ data + '" width="100" class="img img-thumbnail" style="border-radius:5%">';
                          return str;
                        }
                      },
                    },
                    { data: 'mem_name'},
                    { data: 'mem_address'},
                    { data: 'mem_mail_address'},
                    { data: 'mem_hp'},
                    { data: 'mem_kota'},
                    { data: 'mem_kode_pos'},
                    { data: 'mem_email'},
                    { data: 'mem_pp',
                      render: function(data, type, row) {
                        if (data == '-') {
                          var str = '<img src="'+base_url+'assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%">';
                          return str;
                        }else{
                          var str = '<img src="'+base_url+'uploads/members/'+ data + '" width="100" class="img img-thumbnail" style="border-radius:5%">';
                          return str;
                        }
                      },
                    },
                    { data: 'ken_name'},
                    { data: 'mem_stat',
                      render: function(data, type, row) {
                        if (row.mem_stat == 0) {
                          return 'Tidak Aktif';
                        }
                        else{
                          return 'Aktif';
                        }
                      },
                    },
                    { data: 'use_username'},
                    { data: 'mem_app_date',
                      render: function(data, type, row) {
                        if (row.mem_app_date){
                            var parts = row.mem_app_date.split('-');
                            return parts[2].substring(0, 2) + '-' + parts[1] + '-'+ parts[0]; // + parts[2].substring(2, 11);
                        }
                        else{
                            return '';
                        }
                      },
                    },
                    { data: 'mem_id',
                      render: function(data, type, row) {
                          var str = '<button class="btn btn-default" onClick="openModal(\'#modal-update-member\', \'update\', \'' + data + '\')" data-toggle="tooltip" title="Update member"><i class="si si-pencil"></i></button>';
                          return str;
                      },
                    },
                    { data: 'mem_id',
                      render: function(data, type, row) {
                          if (row.use_username == ''){
                            var str = '<button class="btn btn-success" onClick="approveMember(\''+ data + '\')" data-toggle="tooltip" title="Approve member"><i class="si si-check"></i></button>';
                            return str;
                          }
                          else{
                              return '';
                          }
                      },
                    },
                    { data: 'mem_id',
                        render: function(data, type, row) {
                            var str = '<button class="btn btn-primary" onClick="openModal(\'#modal-update-password\', \'password\', \'' + data + '\')" data-toggle="tooltip" title="Reset password"><i class="si si-pencil"></i></button>';
                            return str;
                        },
                    },
                  ],
        }).on('draw.dt', function() {
            $(this).removeAttr('style');
            $('[data-toggle="tooltip"]').tooltip();
            $('.checkbox-member').shiftcheckbox({
                checkboxSelector: ':checkbox',
                selectAll: $('.checkbox-member-all'),
                ignoreClick: 'a',
                onChange: function(checked) {

                },
            });
        });
    };

    // DataTables Bootstrap integration
    var bsDataTables = function() {
        var $DataTable = jQuery.fn.dataTable;

        // Set the defaults for DataTables init
        jQuery.extend(true, $DataTable.defaults, {
            dom:
                '<\'row\'<\'col-sm-6\'l><\'col-sm-6\'f>>' +
                '<\'row\'<\'col-sm-12\'tr>>' +
                '<\'row\'<\'col-sm-6\'i><\'col-sm-6\'p>>',
            renderer: 'bootstrap',
            oLanguage: {
                sLengthMenu: '_MENU_',
                sInfo: 'Showing <strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>',
                oPaginate: {
                    sPrevious: '<i class="fa fa-angle-left"></i>',
                    sNext: '<i class="fa fa-angle-right"></i>',
                },
            },
        });

        // Default class modification
        jQuery.extend($DataTable.ext.classes, {
            sWrapper: 'dataTables_wrapper form-inline dt-bootstrap',
            sFilterInput: 'form-control',
            sLengthSelect: 'form-control',
        });

        // Bootstrap paging button renderer
        $DataTable.ext.renderer.pageButton.bootstrap = function(settings, host, idx, buttons, page, pages) {
            var api     = new $DataTable.Api(settings);
            var classes = settings.oClasses;
            var lang    = settings.oLanguage.oPaginate;
            var btnDisplay, btnClass;

            var attach = function(container, buttons) {
                var i, ien, node, button;
                var clickHandler = function(e) {
                    e.preventDefault();
                    if (!jQuery(e.currentTarget).hasClass('disabled')) {
                        api.page(e.data.action).draw(false);
                    }
                };

                for (i = 0, ien = buttons.length; i < ien; i++) {
                    button = buttons[i];

                    if (jQuery.isArray(button)) {
                        attach(container, button);
                    } else {
                        btnDisplay = '';
                        btnClass = '';

                        switch (button) {
                            case 'ellipsis':
                                btnDisplay = '&hellip;';
                                btnClass = 'disabled';
                                break;

                            case 'first':
                                btnDisplay = lang.sFirst;
                                btnClass = button + (page > 0 ? '' : ' disabled');
                                break;

                            case 'previous':
                                btnDisplay = lang.sPrevious;
                                btnClass = button + (page > 0 ? '' : ' disabled');
                                break;

                            case 'next':
                                btnDisplay = lang.sNext;
                                btnClass = button + (page < pages - 1 ? '' : ' disabled');
                                break;

                            case 'last':
                                btnDisplay = lang.sLast;
                                btnClass = button + (page < pages - 1 ? '' : ' disabled');
                                break;

                            default:
                                btnDisplay = button + 1;
                                btnClass = page === button ?
                                        'active' : '';
                                break;
                        }

                        if (btnDisplay) {
                            node = jQuery('<li>', {
                                class: classes.sPageButton + ' ' + btnClass,
                                'aria-controls': settings.sTableId,
                                tabindex: settings.iTabIndex,
                                id: idx === 0 && typeof button === 'string' ?
                                        settings.sTableId + '_' + button :
                                        null,
                            })
                            .append(jQuery('<a>', {
                                    href: '#',
                                })
                                .html(btnDisplay)
                            )
                            .appendTo(container);

                            settings.oApi._fnBindAction(
                                node, {action: button}, clickHandler
                            );
                        }
                    }
                }
            };

            attach(
                jQuery(host).empty().html('<ul class="pagination"/>').children('ul'),
                buttons
            );
        };

        // TableTools Bootstrap compatibility - Required TableTools 2.1+
        if ($DataTable.TableTools) {
            // Set the classes that TableTools uses to something suitable for Bootstrap
            jQuery.extend(true, $DataTable.TableTools.classes, {
                container: 'DTTT btn-group',
                buttons: {
                    normal: 'btn btn-default',
                    disabled: 'disabled',
                },
                collection: {
                    container: 'DTTT_dropdown dropdown-menu',
                    buttons: {
                        normal: '',
                        disabled: 'disabled',
                    },
                },
                print: {
                    info: 'DTTT_print_info',
                },
                select: {
                    row: 'active',
                },
            });

            // Have the collection use a bootstrap compatible drop down
            jQuery.extend(true, $DataTable.TableTools.DEFAULTS.oTags, {
                collection: {
                    container: 'ul',
                    button: 'li',
                    liner: 'a',
                },
            });
        }
    };

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
                            form.reset();
                            $('#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
                            $('#imgPreviewPP').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
                            $('#modal-add-member').modal('hide');
                            window.tablemember.api().ajax.reload();
                            alert('Data member berhasil ditambahkan!');
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
                            form.reset();
                            $('#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
                            $('#imgPreviewPP-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
                            $('#modal-update-member').modal('hide');
                            window.tablemember.api().ajax.reload();
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

    var initValidationReset = function() {
        jQuery('.form-update-password').validate({
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
                            $('#modal-update-password').modal('hide');
                            alert('Data password berhasil diubah!');
                        } else {
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
                            window.tablemember.api().ajax.reload();
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

    return {
        init: function() {
            // Init Datatables
            initValidationAdd();
            initValidationUpdate();
            initValidationReset();
            bsDataTables();
            initDataTablemember();
            initValidationImport();
        },
    };
}();

// Initialize when page loads
jQuery(function() {
    BaseTableDatatables.init();
});

/* PROCCESSING */

// open modal add/update
function openModal(target, type, id) {
    if (type == 'update') {
        $.get(base_url+'backend/members/data/'+id, function(res) {
            res = $.parseJSON(res);
            $('.form-update-member').attr('action', base_url+'backend/members/update/'+id);
            if (res.mem_photo == '-')
                $('img#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgPreview-update').attr('src', base_url+'uploads/members/'+res.mem_photo);
            if (res.mem_pp == '-')
                $('img#imgPreviewPP-update').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgPreviewPP-update').attr('src', base_url+'uploads/members/'+res.mem_pp);
            
            $('#name-update-member').val(res.mem_name);
            $('#address-update-member').val(res.mem_address);
            $('#mail-address-update-member').val(res.mem_mail_address);
            $('#hp-update-member').val(res.mem_hp);
            $('#kota-update-member').val(res.mem_kota);
            $('#kode-pos-update-member').val(res.mem_kode_pos);
            $('#email-update-member').val(res.mem_email);

            $("#kennel-update-member").html("").trigger('change');
            var newOption = new Option(res.ken_name, res.mem_ken_id, false, false);
            $('#kennel-update-member').append(newOption).trigger('change');
            
            $('#username-update-member').val(res.mem_username);
            $('#pass-update-member').val('');
            $('#newpass-update-member').val('');
            $('#repass-update-member').val('');
        });
    }
    else if (type == "password"){
        $.get(base_url+'backend/members/data/'+id, function(res) {
            res = $.parseJSON(res);
            $('.form-update-password').attr('action', base_url+'backend/members/reset/'+id);
            $('#username-update-password').val(res.mem_username);
            $('#pass-update-password').val('');
            $('#newpass-update-password').val('');
            $('#repass-update-password').val('');
        });
    }

    $(target).modal('show');
}

function approveMember(id) {
    var conf = confirm('Approve selected member(s) ?');
    if (conf) {
        $.ajax({
            url:base_url+'backend/members/approve/'+id,
            type:'POST',
            success: function(res) {
                res = $.parseJSON(res);
                if (res.data == '1') {
                    window.tablemember.api().ajax.reload();
                    alert('Data member berhasil di-approve!');
                } else {
                    alert(res.data);
                }
            },

            error: function(jqXHR, exception) {
                alert(jqXHR.status);

            },
        });
    }
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

$('#imageInput-update').on('change', function(e) {
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

$('#imageInputPP-update').on('change', function(e) {
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

$('#cropper-modal-PP').on('shown.bs.modal', function() {
    var image = $('#cropper-wrap-img-PP > img'), cropBoxData, canvasData;
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


$('#btn-crop').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $('#imgPreview').attr('src', imgb64);
    $('#srcDataCrop').val(imgb64);
    $('#imgPreview-update').attr('src', imgb64);
    $('#srcDataCrop-update').val(imgb64);
    $('#cropper-modal').modal('hide');
});

$('#cropper-modal').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
    $('body').addClass('modal-open');
});

$('#btn-crop-PP').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img-PP > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $('#imgPreviewPP').attr('src', imgb64);
    $('#srcDataCropPP').val(imgb64);
    $('#imgPreviewPP-update').attr('src', imgb64);
    $('#srcDataCropPP-update').val(imgb64);
    $('#cropper-modal-PP').modal('hide');
});

$('#cropper-modal-PP').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img-PP > img').cropper('destroy');
    $('body').addClass('modal-open');
});

$('#modal-add-member').on('hidden.bs.modal', function() {
    $('img#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('img#imgPreviewPP').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop').val('');
    $('#srcDataCropPP').val('');
});

$('#modal-update-member').on('hidden.bs.modal', function() {
    $('img#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('img#imgPreviewPP-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop-update').val('');
    $('#srcDataCropPP-update').val('');
});

// remove
$(document).on('change', '.data-members input:checkbox', function() {
    if ($('.data-members input:checkbox:checked').length > 0) {
        $('.btn-activate-member').removeAttr('disabled');
        $('.btn-deactivate-member').removeAttr('disabled');
    }else {
        $('.btn-activate-member').attr('disabled', 'disabled');
        $('.btn-deactivate-member').attr('disabled', 'disabled');
    }
});

$('.btn-activate-member').click(function(e) {
    if ($('.data-members input:checkbox:checked').length > 0) {
        var conf = confirm('Activate selected member(s) ?');
        if (conf) {
            var data = $('.data-members input:checkbox:checked').serialize();

            $.ajax({
                url:base_url+'backend/members/activate',
                type:'POST',
                data:data,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.tablemember.api().ajax.reload();
                        $('.btn-activate-member').attr('disabled', 'disabled');
                        $('.btn-deactivate-member').attr('disabled', 'disabled');
                        $('.data-members input:checkbox:checked').removeAttr('checked');
                        alert('Data member berhasil diaktivasi!');
                    }else {
                        alert(res.data);
                    }
                },

                error: function(jqXHR, exception) {
                    alert(jqXHR.status);

                },
            });
        }
    }else {
        alert('Please select 1 or more member first!');
    }
});

$('.btn-deactivate-member').click(function(e) {
    if ($('.data-members input:checkbox:checked').length > 0) {
        var conf = confirm('Deactivate selected member(s) ?');
        if (conf) {
            var data = $('.data-members input:checkbox:checked').serialize();

            $.ajax({
                url:base_url+'backend/members/deactivate',
                type:'POST',
                data:data,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.tablemember.api().ajax.reload();
                        $('.btn-activate-member').attr('disabled', 'disabled');
                        $('.btn-deactivate-member').attr('disabled', 'disabled');
                        $('.data-members input:checkbox:checked').removeAttr('checked');
                        alert('Data member berhasil di-deaktivasi!');
                    } else {
                        alert(res.data);
                    }
                },

                error: function(jqXHR, exception) {
                    alert(jqXHR.status);

                },
            });
        }
    }else {
        alert('Please select 1 or more member first!');
    }
});
