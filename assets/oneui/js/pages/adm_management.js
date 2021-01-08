/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */
var base_url = $('.base_url').val();
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTablemanagement = function() {
        window.tablemanagement = jQuery('.data-managements').dataTable({
            order: [[1, 'desc']],
            columnDefs: [{ orderable: false, targets: [0,3] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            mancessing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/managements/data',
              type: 'POST',
            },
            columns: [
                    { data: 'man_id',
                      render:function(data, type, row) {
                          var str = '<div class="checkbox-management">' +
                                        '<input type="checkbox" name="managementId[]" value="' + data + '" data-toggle="tooltip" title="Select to remove">' +
                                  '</div>';
                          return str;
                      },
                    },
                    { data: 'man_photo',
                      render: function(data, type, row) {
                          var str = '<img src="../' + data + '" width="100" style="border-radius:5%">';
                          return str;
                      },
                    },
                    { data: 'man_name'},
                    { data: 'man_position'},
                    { data: 'man_email'},
                    { data: 'man_id',
                      render: function(data, type, row) {
                          var str = '<button class="btn btn-default" onClick="openModal(\'#modal-update-management\', \'update\', \'' + data + '\')" data-toggle="tooltip" title="Update management"><i class="si si-pencil"></i></button>';
                          return str;
                      },
                    },
                  ],
        }).on('draw.dt', function() {
            $(this).removeAttr('style');
            $('[data-toggle="tooltip"]').tooltip();
            $('.checkbox-management').shiftcheckbox({
                checkboxSelector: ':checkbox',
                selectAll: $('.checkbox-management-all'),
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
        jQuery('.form-add-management').validate({
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
                            $('#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg')
                            $('#modal-add-management').modal('hide');
                            window.tablemanagement.api().ajax.reload();
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
        jQuery('.form-update-management').validate({
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
                            $('#modal-update-management').modal('hide');
                            window.tablemanagement.api().ajax.reload();
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
        jQuery('.form-import-management').validate({
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
                $('.mangress-add').show();
                $.ajax({
                  xhr: function() {
                      var xhr = new window.XMLHttpRequest();

                      xhr.upload.addEventListener("mangress", function(evt) {
                        if (evt.lengthComputable) {
                          var percentComplete = evt.loaded / evt.total;
                          percentComplete = parseInt(percentComplete * 100);
                          $('.mangress-upload-rec').css('width', percentComplete+'%').attr('aria-valuenow', percentComplete).text(percentComplete+'%');
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
                    mancessData: false,
                    contentType: false,
                    success: function(res) {
                        res = $.parseJSON(res);
                        if (res.data == '1') {
                            form.reset();
                            $('.mangress-add').hide();
                            $('#modal-import-management').modal('hide');
                            window.tablemanagement.api().ajax.reload();
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
            bsDataTables();
            initDataTablemanagement();
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
        $.get(base_url+'backend/managements/data/'+id, function(res) {
            res = $.parseJSON(res);
            $('.form-update-management').attr('action', base_url+'backend/managements/update/'+id);
            $('img#imgPreview-update').attr('src', '../'+res.man_photo);
            $('#name-update-management').val(res.man_name);
            $('#position-update-management').val(res.man_position);
            $('#email-update-management').val(res.man_email);
            $('#facebook-update-management').val(res.man_facebook);
            $('#twitter-update-management').val(res.man_twitter);
            $('#instagram-update-management').val(res.man_instagram);
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


$('.btn-crop').on('click', function(e) {
    var imgb64 = $('#cropper-wrap-img > img').cropper('getCroppedCanvas').toDataURL('image/png');
    $('img#imgPreview').attr('src', imgb64);
    $('#srcDataCrop').val(imgb64);
    $('img#imgPreview-update').attr('src', imgb64);
    $('#srcDataCrop-update').val(imgb64);
    $('#cropper-modal').modal('hide');
});

$('#cropper-modal').on('hidden.bs.modal', function() {
    $('#cropper-wrap-img > img').cropper('destroy');
    $('body').addClass('modal-open');
});

$('#modal-add-management').on('hidden.bs.modal', function() {
    $('img#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop').val('');
});

$('#modal-update-management').on('hidden.bs.modal', function() {
    $('img#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop-update').val('');
});

// remove
$(document).on('change', '.data-managements input:checkbox', function() {
    if ($('.data-managements input:checkbox:checked').length > 0) {
        $('.btn-delete-management').removeAttr('disabled');
    }else {
        $('.btn-delete-management').attr('disabled', 'disabled');
    }
});

$('.btn-delete-management').click(function(e) {
    if ($('.data-managements input:checkbox:checked').length > 0) {
        var conf = confirm('Remove selected management(s) ?');
        if (conf) {
            var data = $('.data-managements input:checkbox:checked').serialize();

            $.ajax({
                url:base_url+'backend/managements/remove',
                type:'POST',
                data:data,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.tablemanagement.api().ajax.reload();
                        $('.btn-delete-management').attr('disabled', 'disabled');
                        $('.data-managements input:checkbox:checked').removeAttr('checked');
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
        alert('Please select 1 or more management first!');
    }
});
