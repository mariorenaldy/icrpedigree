/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */
var base_url = $('.base_url').val();
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableBirth = function() {
        window.tablecanine = jQuery('.data-births').dataTable({
            order: [[1, 'desc']],
            columnDefs: [{ orderable: false, targets: [0,3,4,5,6,7,8,9] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            cancessing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/births/logs',
              type: 'POST',
            },
            columns: [ { data: 'bir_photo',
                        render: function(data, type, row) {
                        if (data == '-') {
                            var str = '<img src="'+base_url+'assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%">';
                            return str;
                        }else{
                            var str = '<img src="'+base_url+'uploads/canine/'+ data + '" width="100" class="img img-thumbnail" style="border-radius:5%">';
                            return str;
                        }
                        },
                    },
                    { data: 'bir_a_s'},
                    { data: 'bir_breed'},
                    { data: 'bir_gender'},
                    { data: 'bir_color'},
                    { data: 'bir_date_of_birth',
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
                    { data: 'bir_owner_name'},
                    { data: 'bir_cage'},
                    { data: 'stat_name'},
                    { data: 'use_username'},
                    { data: 'bir_app_date',
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
                    { data: 'bir_id',
                      render: function(data, type, row) {
                          if (row.bir_stat == 0)
                            return '<button class="btn btn-default" onClick="openModal(\'#modal-update-birth\', \'update\', \'' + data + '\')" data-toggle="tooltip" title="Ubah lahir"><i class="si si-pencil"></i></button>';
                          else
                            return '';
                      },
                    },
                    { data: 'bir_note'},
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

    var initValidationUpdate = function() {
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
                            window.location.reload();
                            alert('Data lahir berhasil diubah!');
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
            initValidationUpdate();
            bsDataTables();
            initDataTableBirth();
        },
    };
}();

// Initialize when page loads
jQuery(function() {
    BaseTableDatatables.init();
});

/* PROCCESSING */

// open modal update
function openModal(target, type, id) {
    if (type == 'update'){
        $.get(base_url+'backend/births/logs/'+id, function(res) {
            res = $.parseJSON(res);
            $('.form-update-birth').attr('action', base_url+'backend/births/update/'+id);
            
            if (res.bir_photo == '-')
                $('img#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgPreview').attr('src', base_url+'uploads/canine/'+res.bir_photo);
            
            $('#bir_a_s').val(res.bir_a_s);
            $('#bir_breed').val(res.bir_breed);
            $('#bir_gender').val(res.bir_gender);
            $('#bir_color').val(res.bir_color);

            parts = res.bir_date_of_birth.split('-');
            $('#bir_date_of_birth').val(parts[2].substring(0, 2) + '-' + parts[1] + '-'+ parts[0]);

            $('#breeder').val(res.bir_owner_name);
            $('#kennel').val(res.bir_cage);

            $.get(base_url+'backend/canines/memberId/'+res.bir_member, function(resMember) {
                res = $.parseJSON(resMember);
                $("#bir_member").html("").trigger('change');
                var newOption = new Option(res.mem_name, res.mem_id, false, false);
                $('#bir_member').append(newOption).trigger('change');
            });

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