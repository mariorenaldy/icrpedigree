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
        window.tablemember = jQuery('.data-requests').dataTable({
            order: [[1, 'desc']],
            columnDefs: [
                    { orderable: false, targets: [0, 8] },
                    { width: '1%', targets: 0 },
                ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            processing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/canines/data_logs_request',
              type: 'POST',
            },
            columns: [
                    { data: 'log_photo',
                        render: function(data, type, row) {
                            if (data == '-') {
                                return '';
                            }
                            else{
                                var str = '';
                                if (row.log_old_photo == '-') {
                                    str += '<img src="'+base_url+'assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%">';
                                }else{
                                    str += '<img src="'+base_url+'uploads/canine/'+ row.log_old_photo + '" width="100" class="img img-thumbnail" style="border-radius:5%">';
                                }
                                str += ' => <img src="'+base_url+'uploads/canine/'+ data + '" width="100" class="img img-thumbnail" style="border-radius:5%">';
                                return str;
                            }
                        },
                    },
                    { data: 'log_tanggal',
                        render: function(data, type, row) {
                            if (data){
                                var parts = data.split('-');
                                return parts[2].substring(0, 2) + '-' + parts[1] + '-'+ parts[0]; // + parts[2].substring(2, 11);
                            }
                            else
                                return '';
                        },
                    },
                    { data: 'can_a_s',
                        render: function(data, type, row) {
                            if (row.ken_type_id == 1){
                                return data + ' von ' + row.ken_name; 
                            }
                            else if (row.ken_type_id == 2){
                                return row.ken_name + '\' ' + data;
                            }
                            else
                                return data;
                        },
                    },
                    { data: 'log_cage'},
                    { data: 'log_address'},
                    { data: 'log_owner'},
                    { data: 'use_username'},
                    { data: 'req_app_date',
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

    return {
        init: function() {
            // Init Datatables
            bsDataTables();
            initDataTablemember();
        },
    };
}();

// Initialize when page loads
jQuery(function() {
    BaseTableDatatables.init();
});

/* PROCCESSING */
function approve(id) {
    var conf = confirm('Approve request(s) ?');
    if (conf) {
        $.ajax({
            url:base_url+'backend/canines/approve/'+id,
            type:'POST',
            success: function(res) {
                res = $.parseJSON(res);
                if (res.data == '1') {
                    window.tablemember.api().ajax.reload();
                    alert('Request berhasil di-approve!');
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

function reject(id) {
    var conf = confirm('Reject request(s) ?');
    if (conf) {
        $.ajax({
            url:base_url+'backend/canines/reject/'+id,
            type:'POST',
            success: function(res) {
                res = $.parseJSON(res);
                if (res.data == '1') {
                    window.tablemember.api().ajax.reload();
                    alert('Request berhasil di-reject!');
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