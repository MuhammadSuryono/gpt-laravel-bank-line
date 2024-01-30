

@include('_partials.header_content',['breadcrumb'=>[ str_replace('-',' ',$menu) ]])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">User Id</label>

                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control" autocomplete="off" value="" mmaxlength="40">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">User Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="" maxlength="100">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Unit</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="branchCode">
                                        <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="box-footer">
                    <button type="button" id="search" name="search" class="btn  btn-primary float-left">@lang('form.search')</button>
                    <button type="button" id="add" name="add" class="btn  btn-info float-right">@lang('form.add')</button>
                </div>

                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">User Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        <div class="container-fluid">
                           <div class="row">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Code</strong></th>
                                        <th align="center"><strong>Name</strong></th>
                                        <th align="center"><strong>Unit</strong></th>
                                        <th align="center" colspan="2"><strong>Action</strong></th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</section>

<script>

    var unitOption;
    var oTable;
    var id = '{{ $service }}';
    var menu = '{{ $menu }}';
    $(document).ready(function () {


        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';

        $('#list').hide();
        $('.list-title').hide();
        getBranchCode();

        $('#add').on('click', function () {
            var res = app.setView(id,'add');
            if(res =='done'){
                $('#type').val('add');
                getRoleCode();
            }
        });

        $('#list').on('click', 'a', function (e) {

            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }

            var code = $(this).data('code');

            if (code !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);

                    getData(code);
                }
            }
        });

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                code: $('#code').val(),
                name: $('#name').val(),
                branchCode: $('#branchCode').val(),
                currentPage: "1",
                pageSize: "20",
                orderBy: {"code": "ASC"}
            };

         oTable = $('#list').DataTable({
                "destroy": true,
                "drawCallback": function( settings ) {
                    $('#search').prop("disabled",false);
                    $('.reset').on('click', function () {
                       var user = $(this).attr('data-code');
                       var content ='{{trans('form.user_msg_reset',['user'=>'$user'])}}';

                        $.confirm({
                            title: 'Reset password',
                            content: content.replace('$user',user),
                            buttons: {
                                
                                cancel: {
                                    text: '{{trans('form.cancel')}}',
                                    btnClass: 'btn-default',
                                    action: function(){
                                        //$('#submit_view').prop('disabled',false);
                                    }
                                },
                                confirm: {
                                    text: '{{trans('form.confirm')}}',
                                    btnClass: 'btn-primary',
                                    action: function(){
                                        submitReset(user);
                                    }
                                }

                            }
                        });
                    });
                    $('.unlock').on('click', function () {
                        var user = $(this).attr('data-code');
                        var status = $(this).attr('data-status');

                        var content ='{{trans('form.user_msg_lock',['user'=>'$user','lock'=>'Unlock'])}}';
                        var content2 = content.replace('$user',user);

                        $.confirm({
                            title: 'Unlock Account',
                            content: content2,
                            buttons: {
                                
                                cancel: {
                                    text: '{{trans('form.cancel')}}',
                                    btnClass: 'btn-default',
                                    action: function(){
                                        //$('#submit_view').prop('disabled',false);
                                    }
                                },
                                confirm: {
                                    text: '{{trans('form.confirm')}}',
                                    btnClass: 'btn-primary',
                                    action: function(){
                                        submitUnlock(user);
                                    }
                                }

                            }
                        });
                    });

                },
                "select": false,
                "searching": false,
                "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "ScrollX": true,
                "columnDefs": [
                    {
                        targets: 0,
                        data: "code",
                        width: "20%",
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-code="'+data+'">'+data+'</a>';
                        },
                        orderable: true
                    },
                    {
                        targets: 1,
                        data: "name",
                        width: "30%",
                        orderable: true
                    },
                    {
                        targets: 2,
                        data: {
                            branchName: "branchName",
                            branchCode: "branchCode"
                        },
                        width: "30%",
                        render: function ( data, type, full, meta ) {
                            return data.branchCode+' - '+data.branchName;
                        },
                        orderable: true
                    },
                    {
                        targets: 3,
                        data: {
                            code: "code",
                            status: "status"
                        },
                        width: "10%",
                        render: function ( data, type, full, meta ) {
                            var disabled = '';
                            if(data.status=="RESET"){
                                disabled = '';
                            }else if(data.status=="ACTIVE"){
                                disabled = '';
                            }else if(data.status=="INACTIVE"){
                                disabled = 'disabled';
                            }else if(data.status=="LOCKED"){
                                disabled = 'disabled';
                            }else{
                                disabled = 'disabled';
                            }
                            return '<button data-code="'+data.code+'" class="btn btn-default reset" style="width:100px;" '+disabled+'>Reset</button>';
                        },
                        orderable: false
                    },
                    {
                        targets: 4,
                        data: {
                            code: "code",
                            status: "status"
                        },
                        width: "10%",
                        render: function ( data, type, full, meta ) {

                            var disabled = '';
                            if(data.status=="RESET"){
                                disabled = 'disabled';
                            }else if(data.status=="ACTIVE"){
                                disabled = 'disabled';
                            }else if(data.status=="INACTIVE"){
                                disabled = 'disabled';
                            }else if(data.status=="LOCKED"){
                                disabled = '';
                            }else{
                                disabled = 'disabled';
                            }
                            return '<button data-code="'+data.code+'" data-status="'+data.status+'" class="btn btn-default unlock" style="width:100px;" '+disabled+'>Unlock</button>';
                        },
                        orderable: false
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


        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
    });



    function getBranchCode() {
        var value = {
            code: "",
            name: ""
        };
        var url_action = 'searchBranch';
        var action = 'SEARCH';
        var menu = id;
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
                    unitOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '">' + obj.code + ' - ' + obj.name + '</option>';
                    });
                    $('#branchCode').html(unitOption);
                    $('#branchCode').select2();
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

    function submitReset(code) {
        var value = {
            code: code
        };
        var url_action = 'resetUser';
        var action = 'RESET';
        var menu = id;
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
                    flash('success', result.message);
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                oTable.ajax.reload();
            }
        });
    }

    function submitUnlock(code) {
        var value = {
            code: code
        };
        var url_action = 'unlockUser';

        var menu = id;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : 'UNLOCK',
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    flash('success', result.message);
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                oTable.ajax.reload();
            }
        });
    }




</script>