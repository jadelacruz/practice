@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>
            Post Page
        </h1>
    </div>

    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container">
            </div>
        </div>
        <div class="table-header">
            Results for "Latest Post"
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
            <tr role="row">
                <th class="center" rowspan="1">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace">
                        <span class="lbl"></span>
                    </label>
                </th>
                <th>Title</th>
                <th>Description</th>
                <th>No. of Recipient/s</th>
                <th>No. of Notified Recipient/s</th>
                <th>No. of Received Recipient/s</th>
                <th>No. of Confirmed Recipient/s</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($aPost as $oPost)
                <tr id="{{ $oPost->id }}">
                    <td class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace">
                            <span class="lbl"></span>
                        </label>
                    </td>

                    <td>{{ $oPost->title }}</td>

                    <td>{{ $oPost->description }}</td>

                    <td>{{ count($oPost->recipient) }}</td>

                    <td>{{ count($oPost->recipient()->viewed()->get()) }}</td>

                    <td>{{ count($oPost->recipient()->received()->get()) }}</td>

                    <td>{{ count($oPost->recipient()->confirmed()->get()) }}</td>

                    <td>
                        <span class="label label-sm label-{{ ($oPost->status === 'pending') ? 'warning' : 'success'}}">{{ strtoupper($oPost->status) }}</span>
                    </td>

                    <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                            <a class="blue btnView" href="#">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                            </a>
                            @if(Auth::user()->isAdmin() === true)
                            <a class="green" href="{{ route('post.edit', $oPost->id) }}">
                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                            </a>

                            <a class="red btnDelete" href="#">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div class="col-xs-12">
        <div id="dialog-confirm" class="hide">
            <div class="alert alert-info bigger-110">
                These items will be permanently deleted and cannot be recovered.
            </div>

            <div class="space-6"></div>

            <p class="bigger-110 bolder center grey">
                <i class="ace-icon fa fa-hand-o-right blue bigger-120"></i>
                Are you sure?
            </p>
        </div><!-- #dialog-confirm -->
    </div>

@endsection

@section('page-level-script')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.flash.min.js')  }}"></script>
    <script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script>
        $('#dynamic-table').on('click', '.btnView', function () {
            var sId = $(this).closest('tr').attr('id');
            $.ajax({
                method: 'GET',
                url: '/post/recipient/' + sId,
                dataType: 'json'
            }).done(function (response) {
                generateRecipientTableData(response);
                $('#modal-wizard').fadeToggle('slow', 'linear').modal('show');
            });
        });

        $('#dynamic-table').on('click', '.btnDelete', function () {
            var self = this;
            var sId = $(this).closest('tr').attr('id');
            var oSelectedTr = $(self).closest('tr');
            var oData = $('#dynamic-table').DataTable().row(oSelectedTr).data();
            /*oData[2] = 'new Description';
            $('#dynamic-table').DataTable().row(oSelectedTr).data(oData);*/
            $("#dialog-confirm").removeClass('hide').dialog({
                resizable: false,
                width: '320',
                modal: true,
                buttons: [
                    {
                        html: "<i class='ace-icon fa fa-trash-o bigger-110'></i>&nbsp; Delete all items",
                        "class": "btn btn-danger btn-minier",
                        click: function () {
                            $(this).dialog("close");
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                method: 'DELETE',
                                url: '/post/' + sId,
                                dataType: 'json'
                            }).done(function (response) {
                                if (response === true) {
                                    oSelectedTr.remove();
                                    $('#dynamic-table').DataTable().row(oSelectedTr).remove().draw();
                                }
                            });
                        }
                    },
                    {
                        html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Cancel",
                        "class": "btn btn-minier",
                        click: function () {
                            $(this).dialog("close");
                        }
                    }
                ]
            });
        });

        jQuery(function ($) {
            var myTable =
                $('#dynamic-table')
                    .DataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                            {"bSortable": false},
                            null, null, null, null, null, null, null,
                            {"bSortable": false}
                        ],
                        "aaSorting": [],
                        select: {
                            style: 'multi'
                        }
                    });

            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

            new $.fn.dataTable.Buttons(myTable, {
                buttons: [
                    {
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)'
                    },
                    {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "csv",
                        "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                    }
                ]
            });

            myTable.buttons().container().appendTo($('.tableTools-container'));

            //style the message box
            var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });

            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {
                defaultColvisAction(e, dt, button, config);
                if ($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                        .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });

            setTimeout(function () {
                $($('.tableTools-container')).find('a.dt-button').each(function () {
                    var div = $(this).find(' > div').first();
                    if (div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                    else $(this).tooltip({container: 'body', title: $(this).text()});
                });
            }, 500);

            myTable.on('select', function (e, dt, type, index) {
                if (type === 'row') {
                    $(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
                }
            });
            myTable.on('deselect', function (e, dt, type, index) {
                if (type === 'row') {
                    $(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
                }
            });

            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

            //select/deselect all rows according to table header checkbox
            $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function () {
                var th_checked = this.checked;//checkbox inside "TH" table header

                $('#dynamic-table').find('tbody > tr').each(function () {
                    var row = this;
                    if (th_checked) myTable.row(row).select();
                    else  myTable.row(row).deselect();
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
                var row = $(this).closest('tr').get(0);
                if (this.checked) myTable.row(row).deselect();
                else myTable.row(row).select();
            });

            $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });

            //And for the first simple table, which doesn't have TableTools or dataTables
            //select/deselect all rows according to table header checkbox
            var active_class = 'active';
            $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
                var th_checked = this.checked;//checkbox inside "TH" table header

                $(this).closest('table').find('tbody > tr').each(function () {
                    var row = this;
                    if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                    else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#simple-table').on('click', 'td input[type=checkbox]', function () {
                var $row = $(this).closest('tr');
                if ($row.is('.detail-row ')) return;
                if (this.checked) $row.addClass(active_class);
                else $row.removeClass(active_class);
            });

            /********************************/
            //add tooltip for small view action buttons in dropdown menu
            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

            $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');

            //tooltip placement on right or left
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();

                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
                return 'left';
            }

            /***************/
            $('.show-details-btn').on('click', function (e) {
                e.preventDefault();
                $(this).closest('tr').next().toggleClass('open');
                $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
            });
            /***************/
        });

        $('.steps li').tooltip();
    </script>
@endsection

@section('page-level-style')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}"/>
@endsection