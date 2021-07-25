/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */
var base_url = $('.base_url').val();
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTablequotes = function() {
        window.tablequotes = jQuery('.data-quotess').dataTable({
            order: [[1, 'desc']],
            columnDefs: [{ orderable: false, targets: [0, 2] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            quocessing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/quotes/data',
              type: 'POST',
            },
            columns: [
                    { data: 'quo_id',
                      render:function(data, type, row) {
                          var str = '<div class="checkbox-quotes">' +
                                        '<input type="checkbox" name="quotesId[]" value="' + data + '" data-toggle="tooltip" title="Select to remove">' +
                                  '</div>';
                          return str;
                      },
                    },
                    // { data: 'quo_author',
                    //   render: function(data, type, row) {
                    //       var str = '<img src="../' + data + '" width="100" style="border-radius:5%">';
                    //       return str;
                    //   },
                    // },
                    { data: 'quo_author'},
                    { data: 'quo_content'},
                    // { data: 'quo_desc'},
                    { data: 'quo_id',
                      render: function(data, type, row) {
                          var str = '<button class="btn btn-default" onClick="openModal(\'#modal-update-quotes\', \'update\', \'' + data + '\')" data-toggle="tooltip" title="Update quotes"><i class="si si-pencil"></i></button>';
                          return str;
                      },
                    },
                  ],
        }).on('draw.dt', function() {
            $(this).removeAttr('style');
            $('[data-toggle="tooltip"]').tooltip();
            $('.checkbox-quotes').shiftcheckbox({
                checkboxSelector: ':checkbox',
                selectAll: $('.checkbox-quotes-all'),
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
        jQuery('.form-add-quotes').validate({
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
                            $('#modal-add-quotes').modal('hide');
                            window.tablequotes.api().ajax.reload();
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
        jQuery('.form-update-quotes').validate({
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
                            $('#modal-update-quotes').modal('hide');
                            window.tablequotes.api().ajax.reload();
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
        jQuery('.form-import-quotes').validate({
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
                $('.quogress-add').show();
                $.ajax({
                  xhr: function() {
                      var xhr = new window.XMLHttpRequest();

                      xhr.upload.addEventListener("quogress", function(evt) {
                        if (evt.lengthComputable) {
                          var percentComplete = evt.loaded / evt.total;
                          percentComplete = parseInt(percentComplete * 100);
                          $('.quogress-upload-rec').css('width', percentComplete+'%').attr('aria-valuenow', percentComplete).text(percentComplete+'%');
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
                    quocessData: false,
                    contentType: false,
                    success: function(res) {
                        res = $.parseJSON(res);
                        if (res.data == '1') {
                            form.reset();
                            $('.quogress-add').hide();
                            $('#modal-import-quotes').modal('hide');
                            window.tablequotes.api().ajax.reload();
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
            initDataTablequotes();
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
        $.get(base_url+'backend/quotes/data/'+id, function(res) {
            res = $.parseJSON(res);
            $('.form-update-quotes').attr('action', base_url+'backend/quotes/update/'+id);

            $('#author-update-quotes').val(res.quo_author);
            $('#content-update-quotes').val(res.quo_content);
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
        requonsive: true,
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

$('#modal-add-quotes').on('hidden.bs.modal', function() {
    $('img#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop').val('');
});

$('#modal-update-quotes').on('hidden.bs.modal', function() {
    $('img#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop-update').val('');
});

// remove
$(document).on('change', '.data-quotess input:checkbox', function() {
    if ($('.data-quotess input:checkbox:checked').length > 0) {
        $('.btn-delete-quotes').removeAttr('disabled');
    }else {
        $('.btn-delete-quotes').attr('disabled', 'disabled');
    }
});

$('.btn-delete-quotes').click(function(e) {
    if ($('.data-quotess input:checkbox:checked').length > 0) {
        var conf = confirm('Remove selected quotes(s) ?');
        if (conf) {
            var data = $('.data-quotess input:checkbox:checked').serialize();

            $.ajax({
                url:base_url+'backend/quotes/remove',
                type:'POST',
                data:data,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.tablequotes.api().ajax.reload();
                        $('.btn-delete-quotes').attr('disabled', 'disabled');
                        $('.data-quotess input:checkbox:checked').removeAttr('checked');
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
        alert('Please select 1 or more quotes first!');
    }
});
