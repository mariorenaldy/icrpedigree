/*
 *  Document   : base_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */
var base_url = $('.base_url').val();
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTablefaqs = function() {
        window.tablefaqs = jQuery('.data-faqss').dataTable({
            order: [[1, 'desc']],
            columnDefs: [{ orderable: false, targets: [0,2] }],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            tescessing: true,
            serverSide: true,
            ajax: {
              url: base_url+'backend/faqs/data',
              type: 'POST',
            },
            columns: [
                    { data: 'tes_id',
                      render:function(data, type, row) {
                          var str = '<div class="checkbox-faqs">' +
                                        '<input type="checkbox" name="faqsId[]" value="' + data + '" data-toggle="tooltip" title="Select to remove">' +
                                  '</div>';
                          return str;
                      },
                    },

                    { data: 'tes_email'},
                    { data: 'tes_content'},
                    { data: 'tes_type'},
                    // { data: 'tes_type'},
                  ],
        }).on('draw.dt', function() {
            $(this).removeAttr('style');
            $('[data-toggle="tooltip"]').tooltip();
            $('.checkbox-faqs').shiftcheckbox({
                checkboxSelector: ':checkbox',
                selectAll: $('.checkbox-faqs-all'),
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

    return {
        init: function() {
            // Init Datatables
            bsDataTables();
            initDataTablefaqs();

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
        $.get(base_url+'backend/faqs/data/'+id, function(res) {
            res = $.parseJSON(res);
            $('.form-update-faqs').attr('action', base_url+'backend/faqs/update/'+id);

            $('#author-update-faqs').val(res.tes_author);
            $('#content-update-faqs').val(res.tes_content);
        });
    }

    $(target).modal('show');
}


// remove
$(document).on('change', '.data-faqss input:checkbox', function() {
    if ($('.data-faqss input:checkbox:checked').length > 0) {
        $('.btn-delete-faqs').removeAttr('disabled');
    }else {
        $('.btn-delete-faqs').attr('disabled', 'disabled');
    }
});

$('.btn-delete-faqs').click(function(e) {
    if ($('.data-faqss input:checkbox:checked').length > 0) {
        var conf = confirm('Remove selected faqs(s) ?');
        if (conf) {
            var data = $('.data-faqss input:checkbox:checked').serialize();

            $.ajax({
                url:base_url+'backend/faqs/remove',
                type:'POST',
                data:data,
                success: function(res) {
                    res = $.parseJSON(res);
                    if (res.data == '1') {
                        window.tablefaqs.api().ajax.reload();
                        $('.btn-delete-faqs').attr('disabled', 'disabled');
                        $('.data-faqss input:checkbox:checked').removeAttr('checked');
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
        alert('Please select 1 or more faqs first!');
    }
});
