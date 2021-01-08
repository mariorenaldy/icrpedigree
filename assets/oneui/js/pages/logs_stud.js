/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */
var base_url = $('.base_url').val();
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableStud = function() {
        window.tablecanine = jQuery('.data-studs').dataTable({
            order: [[1, 'desc']],
            columnDefs: [{ orderable: false, targets: [0,3,4,5,6,7,8,9] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            cancessing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/studs/logs',
              type: 'POST',
            },
            columns: [ { data: 'stu_photo',
                      render: function(data, type, row) {
                        if (data == '-') {
                          var str = '<img src="'+base_url+'assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%">';
                          return str;
                        }else{
                          var str = '<img src="'+base_url+'uploads/stud/'+ data + '" width="100" class="img img-thumbnail" style="border-radius:5%">';
                          return str;
                        }
                      },
                    },
                    { data: 'stu_stud_date',
                      render: function(data, type, row) {
                        if (data){
                            var parts = data.split('-');
                            return parts[2].substring(0, 2) + '-' + parts[1] + '-'+ parts[0]; // + parts[2].substring(2, 11);
                        }
                        else{
                            return '';
                        }
                      },
                    },
                    { data: 'mem_name'},
                    { data: 'stu_sire_photo',
                      render: function(data, type, row) {
                        var str = '';
                        if (row.stu_sire_id != 0)
                            str += '<a href="'+base_url+'backend/pedigrees/id/'+row.stu_sire_id+'" title="Sire">';
                        if (data == '-') {
                            str += '<img src="'+base_url+'assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%">';
                        }else{
                            str += '<img src="'+base_url+'uploads/stud/'+ data + '" width="100" class="img img-thumbnail" style="border-radius:5%">';
                        }
                        if (row.stu_sire_id != 0)
                            str += '</a>';
                        return str;
                      },
                    },
                    { data: 'stu_mom_photo',
                      render: function(data, type, row) {
                        var str = '';
                        if (row.stu_mom_id != 0)
                            str += '<a href="'+base_url+'backend/pedigrees/id/'+row.stu_mom_id+'" title="Dam">';
                        if (data == '-') {
                            str += '<img src="'+base_url+'assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%">';
                        }else{
                            str += '<img src="'+base_url+'uploads/stud/'+ data + '" width="100" class="img img-thumbnail" style="border-radius:5%">';
                        }
                        if (row.stu_mom_id != 0)
                            str += '</a>';
                        return str;
                      },
                    },
                    { data: 'use_username'},
                    { data: 'stu_app_date',
                      render: function(data, type, row) {
                        if (data){
                            var parts = data.split('-');
                            return parts[2].substring(0, 2) + '-' + parts[1] + '-'+ parts[0]; // + parts[2].substring(2, 11);
                        }
                        else{
                            return '';
                        }
                      },
                    },
                    { data: 'stat_name'},
                    { data: 'stu_note'},
                    { data: 'stu_id',
                      render: function(data, type, row) {
                          if (row.stu_stat == 0)
                            return '<button class="btn btn-default" onClick="openModal(\'#modal-update-stud\', \'update\', \'' + data + '\')" data-toggle="tooltip" title="Ubah pacak"><i class="si si-pencil"></i></button>';
                          else if (row.stu_stat == 1)
                            return '<button class="btn btn-info" onClick="openModal(\'#modal-add-birth\', \'add-birth\', \'' + data + '\')" data-toggle="tooltip" title="Tambah lahir"><i class="si si-plus"></i></button>';
                          else
                            return '';
                      },
                    },
                  ],
        }).on('draw.dt', function() {
            $(this).removeAttr('style');
            $('[data-toggle="tooltip"]').tooltip();
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
                            window.location.reload();
                            alert('Data pacak berhasil disimpan!');
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
    };

    var initValidationUpdate = function() {
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
                            window.location.reload();
                            alert('Data pacak berhasil diubah!');
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
    };

    var initValidationAddBirth = function() {
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
                            window.location.reload();
                            alert('Data lahir berhasil disimpan!');
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
    };

    return {
        init: function() {
            // Init Datatables
            initValidationAdd();
            initValidationUpdate();
            initValidationAddBirth();
            bsDataTables();
            initDataTableStud();
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
    if (type == 'update'){
        $.get(base_url+'backend/studs/logs/'+id, function(res) {
            res = $.parseJSON(res);
            // console.log(res);
            $('.form-update-stud').attr('action', base_url+'backend/studs/update/'+id);
            
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
            
            if (res.stu_sire_id){
                $.get(base_url+'backend/canines/parentId/'+res.stu_sire_id, function(resSire) {
                    res1 = $.parseJSON(resSire);
                    $("#stu_sire_id-update").html("").trigger('change');
                    var newOption = new Option(res1.can_a_s, res1.can_id, false, false);
                    $('#stu_sire_id-update').append(newOption).trigger('change');
                });
            }
            
            if (res.stu_mom_id){
                $.get(base_url+'backend/canines/parentId/'+res.stu_mom_id, function(resMom) {
                    res2 = $.parseJSON(resMom);
                    $("#stu_dam_id-update").html("").trigger('change');
                    var newOption = new Option(res2.can_a_s, res2.can_id, false, false);
                    $('#stu_dam_id-update').append(newOption).trigger('change');
                });
            }

            $.get(base_url+'backend/canines/memberId/'+res.stu_member, function(resMember) {
                res3 = $.parseJSON(resMember);
                $("#stu_member-update").html("").trigger('change');
                var newOption = new Option(res3.mem_name, res3.mem_id, false, false);
                $('#stu_member-update').append(newOption).trigger('change');
            });

            $('#stu_note-update').val(res.stu_note);
        });
    }
    else if (type == 'add-birth') {
        $('.form-add-birth').attr('action', base_url+'backend/births/add/'+id);
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