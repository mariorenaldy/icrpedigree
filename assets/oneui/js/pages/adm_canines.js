/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */
var base_url = $('.base_url').val();
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTablecanine = function() {
        window.tablecanine = jQuery('.data-canines').dataTable({
            order: [[0, 'desc']],
            columnDefs: [{ orderable: false, targets: [0, 1, 11, 12, 13, 14, 15, 16, 17] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            cancessing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/canines/data',
              type: 'POST',
            },
            columns: [{ data: 'can_id',
                      render:function(data, type, row) {
                          var str = '<div class="checkbox-canine">' +
                                        '<input type="checkbox" name="canineId[]" value="' + data + '" data-toggle="tooltip" title="Select to remove">' +
                                  '</div>';
                          return str;
                      },
                    },
                    { data: 'can_photo',
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
                    { data: 'can_current_reg_number'},
                    { data: 'can_icr_moc_number'},
                    { data: 'can_icr_number'},
                    { data: 'can_id',
                        render: function(data, type, row) {
                            if (row.ken_type_id == 1) {
                                return row.can_a_s+' von '+row.ken_name;
                            }
                            else if (row.ken_type_id == 2){
                                return row.ken_name+'\' '+row.can_a_s;
                            }
                            else{
                                return row.can_a_s;
                            }
                        },
                    },
                    { data: 'can_gender'},
                    { data: 'can_owner'},
                    // ARTechnology 1
                    { data: 'mem_name'},
                    // ARTechnology 1
                    { data: 'can_score'},
                    // ARTechnology 2
                    { data: 'can_stat',
                      render: function(data, type, row) {
                        if (row.can_stat == 0) {
                          return 'Tidak Aktif';
                        }
                        else{
                          return 'Aktif';
                        }
                      },
                    },
                    // ARTechnology 2
                    { data: 'can_id',
                      render: function(data, type, row) {
                        if (row.can_remaining_payment == 0) {

                          var str = '<button class="btn btn-warning" onClick="openModal(\'#modal-payment-canines\', \'payment\', \'' + data + '\')" data-toggle="tooltip" title="Payment canine"><i class="si si-credit-card"></i> payment</button>';
                          return str;
                        }else{
                          var str = '<button class="btn btn-success btn-disabled" data-toggle="tooltip" disabled><i class="si si-check"></i> </button>';
                          return str;
                        }

                      },
                    },
                    { data: 'can_id',
                      render: function(data, type, row) {
                          var str = '<a href="'+base_url+'backend/pedigrees/id/'+data+'" class="btn btn-danger" data-toggle="tooltip" title="Silsilah"><i class="si si-users"></i></a>';
                          return str;

                      },
                    },

                    { data: 'can_id',
                      render: function(data, type, row) {
                          var str = '<a href="'+base_url+'backend/certificate/depan/'+data+'" class="btn btn-primary" data-toggle="tooltip" title="cetak sertifikat"><i class="si si-printer"></i><br/>('+row.can_print+')</a>';
                          return str;

                      },
                    },
                    { data: 'can_id',
                      render: function(data, type, row) {
                          var str = '<button class="btn btn-default" onClick="openModal(\'#modal-update-pedigree\', \'update2\', \'' + data + '\')" data-toggle="tooltip" title="Update Silsilah"><i class="si si-users"></i></button>';
                          return str;

                      },
                    },
                    { data: 'can_id',
                      render: function(data, type, row) {
                          var str = '<button class="btn btn-default" onClick="openModal(\'#modal-update-canines\', \'update\', \'' + data + '\')" data-toggle="tooltip" title="Update canine"><i class="si si-pencil"></i></button>';
                          return str;

                      },
                    },
                    { data: 'can_id',
                      render: function(data, type, row) {
                          var str = '<a href="'+base_url+'backend/canines/getFamily/'+data+'" class="btn btn-primary" data-toggle="tooltip" title="cari keluarga"><i class="si si-users"></i></a>';
                          return str;
                      },
                    },
                    { data: 'can_id',
                      render: function(data, type, row) {
                          var str = '<a href="'+base_url+'backend/canines/logs/'+data+'" class="btn btn-default" data-toggle="tooltip" title="logs"><i class="si si-doc"></i></a>';
                          return str;
                      },
                    },
                  ],
        }).on('draw.dt', function() {
            $(this).removeAttr('style');
            $('[data-toggle="tooltip"]').tooltip();
            $('.checkbox-canine').shiftcheckbox({
                checkboxSelector: ':checkbox',
                selectAll: $('.checkbox-canine-all'),
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
        jQuery('.form-add-canines').validate({
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
                            $(".sire").html("").trigger('change');
                            $(".dam").html("").trigger('change');
                            $(".member").html("").trigger('change');
                            // $('#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg')
                            // $('#modal-add-canine').modal('hide');
                            // window.tablecanine.api().ajax.reload();
                            window.location.reload();
                            alert('Data canine berhasil ditambahkan!');
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
                            window.tablecanine.api().ajax.reload();
                            // ARTechnology
                            alert('Data canine berhasil diubah');
                            // ARTechnology
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

    var initValidationUpdate2 = function() {
        jQuery('.form-update-pedigree').validate({
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
                            // $('#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg')
                            $('#modal-update-pedigree').modal('hide');
                            window.tablecanine.api().ajax.reload();
                            // ARTechnology
                            alert('Data silsilah berhasil diubah');
                            // ARTechnology
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

    var initValidationPayment = function() {
        jQuery('.form-payment-canine').validate({
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
                            // $('#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg')
                            $('#modal-payment-canines').modal('hide');
                            window.tablecanine.api().ajax.reload();
                            // ARTechnology
                            alert('Data pembayaran berhasil disimpan');
                            // ARTechnology
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
    return {
        init: function() {
            // Init Datatables
            initValidationAdd();
            initValidationUpdate();
            initValidationUpdate2();
            initValidationPayment();
            bsDataTables();
            initDataTablecanine();
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
        $.get(base_url+'backend/canines/data/'+id, function(res) {
            res = $.parseJSON(res);
            $('.form-update-canine').attr('action', base_url+'backend/canines/update/'+id);
            // ARTechnology
            if (res.can_photo == '-')
                $('img#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
            // ARTechnology
                $('img#imgPreview-update').attr('src', base_url+'uploads/canine/'+res.can_photo);
            $('#crn-update-canines').val(res.can_current_reg_number);
            $('#as-update-canines').val(res.can_a_s);
            $('#cin-update-canines').val(res.can_icr_number);
            $('#breed-update-canines').val(res.can_breed);
            $('#gender-update-canines').val(res.can_gender);
            $('#dob-update-canines').val(res.can_date_of_birth);
            $('#color-update-canines').val(res.can_color);
            $('#icrmn-update-canines').val(res.can_icr_moc_number);
            $('#breeder-update .breeder-update').val(res.can_owner_name);
            $('#kennel-update .kennel-update').val(res.can_cage);
            // ARTechnology #1
            $('#address-update .address-update').val(res.can_address);
            // ARTechnology #1
            $('#owner-update .owner-update').val(res.can_owner);
            // ARTechnology #2
            $('#note-update-canines').val(res.can_note);
            // ARTechnology #2

            $.get(base_url+'backend/canines/parentId/'+res.ped_sire_id, function(resSire) {
                  res1 = $.parseJSON(resSire);
                  $('#sire-update .sire-update').val(res1.can_a_s);
                  $('#can_sire').val(res1.can_id);
            });
            $.get(base_url+'backend/canines/parentId/'+res.ped_mom_id, function(resMom) {
                  res2 = $.parseJSON(resMom);
                  $('#dam-update .dam-update').val(res2.can_a_s);
                  $('#can_dam').val(res2.can_id);
            });

            // ARTechnology
            $.get(base_url+'backend/canines/memberId/'+res.can_member, function(resMember) {
                res3 = $.parseJSON(resMember);
                $("#member-update").html("").trigger('change');
                var newOption = new Option(res3.mem_name, res3.mem_id, false, false);
                $('#member-update').append(newOption).trigger('change');
            });
            // ARTechnology
        });
    }
    else if (type == 'payment') {
    // ARTechnology
    
    //   $.get(base_url+'backend/canines/data/'+id, function(res) {
    //       res = $.parseJSON(res);
    //       $('.form-payment-canine').attr('action', base_url+'backend/canines/update/'+id);
    //   });

    $('.form-payment-canine').attr('action', base_url+'backend/canines/payment/'+id);
    // ARTechnology
    }else if (type == 'update2') {
      $.get(base_url+'backend/canines/data/'+id, function(res) {
          res = $.parseJSON(res);
          $('.form-update-pedigree').attr('action', base_url+'backend/canines/update2/'+id);

              $.get(base_url+'backend/canines/parentId/'+res.ped_sire_id, function(resSire) {
                    res1 = $.parseJSON(resSire);
                    $("#sire-update").html("").trigger('change');
                    var newOption = new Option(res1.can_a_s, res1.can_id, false, false);
                    $('#sire-update').append(newOption).trigger('change');
              });

              $.get(base_url+'backend/canines/parentId/'+res.ped_mom_id, function(resMom) {
                    res2 = $.parseJSON(resMom);
                    $("#dam-update").html("").trigger('change');
                    var newOption = new Option(res2.can_a_s, res2.can_id, false, false);
                    $('#dam-update').append(newOption).trigger('change');
              });

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

$('#modal-add-canine').on('hidden.bs.modal', function() {
    $('img#imgPreview').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop').val('');
});

$('#modal-update-canine').on('hidden.bs.modal', function() {
    $('img#imgPreview-update').attr('src', base_url+'assets/oneui/img/avatars/avatar1.jpg');
    $('#srcDataCrop-update').val('');
});

// remove
$(document).on('change', '.data-canines input:checkbox', function() {
    if ($('.data-canines input:checkbox:checked').length > 0) {
        $('.btn-delete-canine').removeAttr('disabled');
        // ARTechnology
        $('.btn-activate-canine').removeAttr('disabled');
        $('.btn-deactivate-canine').removeAttr('disabled');
        // ARTechnology
    } 
    else {
        $('.btn-delete-canine').attr('disabled', 'disabled');
        // ARTechnology
        $('.btn-activate-canine').attr('disabled', 'disabled');
        $('.btn-deactivate-canine').attr('disabled', 'disabled');
        // ARTechnology
    }
});

$('.btn-delete-canine').click(function(e) {
    if ($('.data-canines input:checkbox:checked').length > 0) {
        var conf = confirm('Remove selected canine(s) ?');
        if (conf) {
            var data = $('.data-canines input:checkbox:checked').serialize();

            $.ajax({
                url:base_url+'backend/canines/remove',
                type:'POST',
                data:data,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.tablecanine.api().ajax.reload();
                        $('.btn-delete-canine').attr('disabled', 'disabled');
                        // ARTechnology
                        $('.btn-activate-canine').attr('disabled', 'disabled');
                        $('.btn-deactivate-canine').attr('disabled', 'disabled');
                        // ARTechnology
                        $('.data-canines input:checkbox:checked').removeAttr('checked');
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
        alert('Please select 1 or more canine first!');
    }
});

// ARTechnology
$('.btn-activate-canine').click(function(e) {
    if ($('.data-canines input:checkbox:checked').length > 0) {
        var conf = confirm('Activate selected canine(s) ?');
        if (conf) {
            var data = $('.data-canines input:checkbox:checked').serialize();

            $.ajax({
                url:base_url+'backend/canines/activate',
                type:'POST',
                data:data,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.tablecanine.api().ajax.reload();
                        $('.btn-delete-canine').attr('disabled', 'disabled');
                        $('.btn-activate-canine').attr('disabled', 'disabled');
                        $('.btn-deactivate-canine').attr('disabled', 'disabled');
                        $('.data-canines input:checkbox:checked').removeAttr('checked');
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
        alert('Please select 1 or more canine first!');
    }
});

$('.btn-deactivate-canine').click(function(e) {
    if ($('.data-canines input:checkbox:checked').length > 0) {
        var conf = confirm('Deactivate selected canine(s) ?');
        if (conf) {
            var data = $('.data-canines input:checkbox:checked').serialize();

            $.ajax({
                url:base_url+'backend/canines/deactivate',
                type:'POST',
                data:data,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.tablecanine.api().ajax.reload();
                        $('.btn-delete-canine').attr('disabled', 'disabled');
                        $('.btn-activate-canine').attr('disabled', 'disabled');
                        $('.btn-deactivate-canine').attr('disabled', 'disabled');
                        $('.data-canines input:checkbox:checked').removeAttr('checked');
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
        alert('Please select 1 or more canine first!');
    }
});
// ARTechnology
