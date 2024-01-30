@include('_partials.header_content',['breadcrumb'=>['Approval Mechanism','Search']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Approval Mechanism Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Menu</label>

                                <div class="col-md-5">
                                    <select class="form-control" id="appMenuCode">
                                        <option></option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="float-left">
                        <button type="button" id="search" name="search" class="btn btn-primary">@lang('form.search')</button>
                    </div>
                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Approval Mechanism Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Bank Approval Matrix Menu</strong></th>
                                        <th align="center"><strong>Number of Approver</strong></th>
                                        <th align="center"><strong>ID</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                    </tr>
                                    </tbody>
                                </table>
                        
                    </div>
            </div>
        </div>
    </div>

</section>

<script>


    $(document).ready(function () {
        var id = '{{ $service }}';

        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"id": "ASC"};

        $('#list').hide();
        $('.list-title').hide();

        getApprovalMatrixMenu();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                approvalMatrixMenuCode: $('#appMenuCode').val(),
                currentPage: "1",
                pageSize: "50",
                // orderBy: {"approvalMatrixMenuCode": "ASC"}
            };


            $('#list').DataTable({
                "destroy": true,
                "initComplete": function(settings, json) {
                    $('#search').prop("disabled",false);

                },
                "select": false,
                "searching": false,
                "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "ScrollX": '100%',
                "columnDefs": [
                    {
                        targets: 0,
                        data: {
                            menuCode:"menuCode",
                            menuName:"menuName",
                            id:"id",
                            noOfApprover:"noOfApprover"
                        },
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-id="'+data.id+'" data-noOfApprover="'+data.noOfApprover+'" data-menu-code="'+data.menuCode+'" data-menu-name="'+data.menuName+'">'+data.menuName+'</a>';
                        },
                        orderable: true
                    },
                    {
                        targets: 1,
                        data: "noOfApprover",
                        orderable: true
                    },
                    {
                        targets: 2,
                        data: "id",
                        orderable: true
                    }
                ],
                "ajax": {
                    url: "fetchDataTable",
                    type:'POST',
                    data: function ( d ) {
                        d.value = value;
                        d.menu = id;
                        d.url_action = url_action;
                        d.action = action;
                        d.result_key = result_key;
                        d.custom_order = custom_order;
                        d._token = '{{ csrf_token() }}';
                    },
                    error:function (jqXHR, textStatus, errorThrown) {

                        var msg = '{{trans('form.conn_error')}}';
                        flash('warning', msg);
                        $('#list').hide();
                        $('.list-title').hide();
                        $('#search').prop("disabled",false);
                    }
                }
            });
        });

        $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var menuCode = $(this).data('menuCode');
            var menuName = $(this).data('menuName');

            if (menuCode !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#appMenuCode').val(menuCode);
                    $('#appMenuName').val(menuName);
                    getDetail();
                }
            }
        });
        
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });


    function getApprovalMatrixMenu() {
        var menu = '{{ $service }}';
        var value = {
            code: "",
            name: "",
        };
        var url_action = 'getBankApprovalMatrixMenu';
        var action = 'SEARCH';
        
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    unitOption = '<option value="">all menu</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.menuCode + '">' + obj.menuName + '</option>';
                    });
                    $('#appMenuCode').html(unitOption);
                    $('#appMenuCode').select2();
                } else {
                    flash('warning', result.message);
                }
            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
            
            }
        });
    }


</script>