/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */
var base_url = $('.base_url').val();
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableCanine = function() {
        window.tablecanine = jQuery('.data-canines').dataTable({
            order: [[1, 'desc']],
            columnDefs: [{ orderable: false, targets: [0,3,4,5,6] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            cancessing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/canines/approve_data',
              type: 'POST',
            },
            columns: [ { data: 'can_photo',
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
                    { data: 'can_a_s'},
                    { data: 'can_breed'},
                    { data: 'can_gender'},
                    { data: 'can_color'},
                    { data: 'can_date_of_birth',
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
                    { data: 'can_owner_name'},
                    { data: 'can_cage'},
                    { data: 'can_owner'},
                    { data: 'can_address'},
                    { data: 'can_id',
                      render: function(data, type, row) {
                            if (row.can_app_stat == 0)
                                return '<button class="btn btn-success" onClick="openModal(\'#modal-approve-canine\', \'approve\', \'' + data + '\')" data-toggle="tooltip" title="Approve canine"><i class="si si-check"></i></button>';
                            else
                                return '';
                      },
                    },
                    { data: 'can_id',
                      render: function(data, type, row) {
                            if (row.can_app_stat == 0)
                                return '<button class="btn btn-danger" onClick="openModal(\'#modal-reject-canine\', \'reject\', \'' + data + '\')" data-toggle="tooltip" title="Tolak canine"><i class="si si-close"></i></button>';
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

    var initValidationApprove = function() {
        jQuery('.form-approve-canine').validate({
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
                            alert('Data canine berhasil di-approve!');
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

    var initValidationReject = function() {
        jQuery('.form-reject-canine').validate({
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
                            window.location.reload();
                            alert('Data canine berhasil ditolak');
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
            initValidationApprove();
            initValidationReject();
            bsDataTables();
            initDataTableCanine();
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
    $.get(base_url+'backend/canines/approve_data/'+id, function(res) {
        res = $.parseJSON(res);

        parts = res.can_date_of_birth.split('-');
        if (type == 'approve') {
            $('.form-approve-canine').attr('action', base_url+'backend/canines/approve_canine/'+id);
            
            if (res.can_photo == '-')
                $('img#imgCanine_approve').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgCanine_approve').attr('src', base_url+'uploads/canine/'+res.can_photo);

            $('#can_a_s_approve').html(res.can_a_s);
            $('#can_current_reg_number_approve').html(res.can_current_reg_number);
            $('#can_breed_approve').html(res.can_breed);
            $('#can_gender_approve').html(res.can_gender);
            $('#can_color_approve').html(res.can_color);

            $('#can_date_of_birth_approve').html(parts[2].substring(0, 2) + '-' + parts[1] + '-'+ parts[0]);

            $('#can_owner_name_approve').html(res.can_owner_name);
            $('#can_cage_approve').html(res.can_cage);
            $('#can_owner_approve').html(res.can_owner);
            $('#can_address_approve').html(res.can_address);
        }
        else{
            $('.form-reject-canine').attr('action', base_url+'backend/canines/reject_canine/'+id);

            if (res.can_photo == '-')
                $('img#imgCanine_reject').attr('src', base_url+'assets/oneui/img/avatars/image.png');
            else
                $('img#imgCanine_reject').attr('src', base_url+'uploads/canine/'+res.can_photo);

            $('#can_a_s_reject').html(res.can_a_s);
            $('#can_current_reg_number_reject').html(res.can_current_reg_number);
            $('#can_breed_reject').html(res.can_breed);
            $('#can_gender_reject').html(res.can_gender);
            $('#can_color_reject').html(res.can_color);

            $('#can_date_of_birth_reject').html(parts[2].substring(0, 2) + '-' + parts[1] + '-'+ parts[0]);

            $('#can_owner_name_reject').html(res.can_owner_name);
            $('#can_cage_reject').html(res.can_cage);
            $('#can_owner_reject').html(res.can_owner);
            $('#can_address_reject').html(res.can_address);
        }
    });

    $(target).modal('show');
}