@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'Search']])


<section class="content">
    <div class="row divLanding">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Corporate Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate ID</label>
                                <div class="col-md-6">
                                    <input type="text" id="corporateId" name="corporateId" class="form-control" autocomplete="off" value="" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="" maxlength="100">
                                </div>
                            </div>
                        </div>
                       
                </div>
                <div class="box-footer">
                    <button type="button" id="search" name="search" class="btn  btn-primary float-left">@lang('form.search')</button>
                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Corporate Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Corporate Id</strong></th>
                                        <th align="center"><strong>Corporate Name</strong></th>
                                    </tr>
                                    </thead>

                                </table>
                        
                    </div>
            </div>
        </div>
    </div>
    <div class="row divDetail">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="name" value=""/>
            <div class="box">
                
                
                <div class="box-header">
                    <h3 class="box-title">Corporate Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">Device Listing</h3>
                    </div>
                    
                    <div class="box-body">
                       
                            <table id="listDetail" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                   style="border-collapse:collapse;">
                                <thead>
                                <tr>

                                    <th align="left"><strong>Serial Number</strong></th>
                                    <th align="left"><strong>Assigned To</strong></th>
                                    <th align="left"><strong>Assigned By</strong></th>
                                    <th align="left"><strong>Assigned Date</strong></th>
                                    <th align="left"><strong>Status</strong></th>
                                    <th align="left" colspan="3"><strong></strong></th>
                                </tr>
                                </thead>
                            </table>
                           
                    </div>
                    

                    <div class="box-footer">
                           <div class="state_view">
                                   <div class="float-left">
                                       
                                       <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                   </div>
                                   <div class="float-right">

                                   </div>
                           </div>
                       </div>
            </div>
        </div>
    </div>

</section>
<div id="unlockModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Unlock Authentication Device</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="alerts">

                        </div>
                        <form id="form-area" class="form-horizontal form-area">
                            <input type="hidden" id="code_edit" value=""/>
                            <div class="box-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Serial Number</label>
                                            <div class="col-md-8">
                                                <label id="tokenNo-modal" class="state_view">-</label>
                                                <input type="hidden" id="userId-modal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label"><strong>Token Challenge Code*</strong></label>
                                            <div class="col-md-8">
                                                <input type="text" id="randomLockedCode" name="randomLockedCode" class="form-control" autocomplete="off" value="" maxlength="20" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">@lang('form.cancel')</button>
                <button type="button" id="confirm" name="confirm" class="btn btn-primary">@lang('form.submit')</button>
            </div>
        </div>

    </div>
</div>
<script>

    var id = '{{ $service }}';

    $(document).ready(function () {

        var url_action = 'searchCorporate';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"id": "ASC"};

        $('#list').hide();
        $('.list-title').hide();
        $('.divDetail').hide();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var corporateId = $('#corporateId').val();
            var name = $('#name').val();

            var value = {
                "corporateId": '%' + corporateId + '%',
                "name": name
            };

            $('#list').DataTable({
                "destroy": true,
                "initComplete": function(settings, json) {
                    $('#search').prop("disabled",false);
                    $('#list tbody').on('click', 'a', function (e) {

                        if(e.handled !== true) // This will prevent event triggering more then once
                        {
                            e.handled = true;
                        }
                        var code = $(this).data('code');
                        var name = $(this).parent().next().text();
                        preloaderVisible(true);
                        if (code !== undefined) {
                            /*var res = app.setView(id,'detail');
                            if(res=='done'){
                                $('#code').val(code);
                                getData(code,name);
                            }*/

                            $('#code_1').text(code + " - " + name);
                            $('#code').val(code);
                            $('#name').val(name);

                            var value = {
                                corporateId: code
                            };
                            var result_key = 'result';
                            var url_action = 'search';
                            var action = 'DETAIL';
                            var menu = id;
                            var custom_order = {"tokenNo": "ASC"};

                            oTable = $('#listDetail').DataTable({
                                //"paging" : false,
                                "ordering" : false,
                                "info": false,
                                "destroy": true,

                                "processing": true,
                                "serverSide": true,

                                "searching": false,
                                "autoWidth":false,
                                "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                                "columnDefs": [

                                    {
                                        targets: 0,
                                        sortable: true,
                                        width: "12%",
                                        data: "tokenNo"
                                    },
                                    {
                                        targets: 1,
                                        sortable: true,
                                        width: "20%",
                                        data: {
                                            userId: "userId",
                                            userName: "userName"
                                        },
                                        render: function ( data, type, full, meta ) {
                                            return data.userId+' - '+data.userName;
                                        },
                                    },
                                    {
                                        targets: 2,
                                        sortable: true,
                                        width: "18%",
                                        data: "assignedBy"
                                    },
                                    {
                                        targets: 3,
                                        sortable: true,
                                        width: "15%",
                                        data: "assignedDate"
                                    },
                                    {
                                        targets: 4,
                                        sortable: false,
                                        width: "10%",
                                        data: "status"
                                    },
                                    {
                                        targets: 5,
                                        sortable: true,
                                        width: "5%",
                                        data: {
                                            status: "status",
                                            tokenNo: "tokenNo",
                                            userId: "userId",
                                            userName: "userName"
                                        },
                                        render: function ( data, type, full, meta ) {
                                            var disabled_unblock = '';
                                            var color_unblock = 'blue';
                                            if(data.status=="Active"){
                                                disabled_unblock = 'disabled';
                                                color_unblock = 'gray';
                                            }
                                            if (data.userId==""&&data.userName=="") {
                                                disabled_unblock = 'disabled';
                                                color_unblock = 'gray';
                                            }

                                            return '<button data-tokenNo="'+data.tokenNo+'" data-userId="'+data.userId+'" class="unblock btn btn-default" style="border-color:'+color_unblock+';" onClick="unblockAction(this);" '+disabled_unblock+'><span style="color:'+color_unblock+';">Unblock</span></button>';
                                        },
                                    },
                                    {
                                        targets: 6,
                                        sortable: true,
                                        width: "5%",
                                        data: {
                                            tokenNo: "tokenNo",
                                            userId: "userId",
                                            userName: "userName"
                                        },
                                        render: function ( data, type, full, meta ) {
                                            var disabled_unlock = '';
                                            var color_unlock = 'blue';
                                            if (data.userId==""&&data.userName=="") {
                                                disabled_unlock = 'disabled';
                                                color_unlock = 'gray';
                                            }
                                                
                                            return '<button data-tokenNo="'+data.tokenNo+'" data-userId="'+data.userId+'" class="unlock btn btn-default" style="border-color:'+color_unlock+';" onClick="unlockAction(this);" '+disabled_unlock+'><span style="color:'+color_unlock+';">Unlock</span></button>';
                                        },
                                    },
                                    {
                                        targets: 7,
                                        sortable: true,
                                        width: "5%",
                                        data: {
                                            status: "status",
                                            tokenNo: "tokenNo",
                                            userId: "userId",
                                            userName: "userName",
                                            assignedBy: "assignedBy",
                                            assignedDate: "assignedDate",

                                        },
                                        render: function ( data, type, full, meta ) {
                                            var disabled_unassign = '';
                                            var color_unassign = 'red';
                                            if (data.userId==""&&data.userName=="") {
                                                disabled_unassign = 'disabled';
                                                color_unassign = 'gray';
                                            }
                                                
                                            return '<button data-tokenNo="'+data.tokenNo+'" data-userId="'+data.userId+'" data-userName="'+data.userName+'" data-assignedBy="'+data.assignedBy+'" data-assignedDate="'+data.assignedDate+'" data-status="'+data.status+'" class="unassign btn btn-default" style="border-color:'+color_unassign+';" onClick="unassignAction(this);" '+disabled_unassign+'><span style="color:'+color_unassign+';">Unassign</span></button>';
                                        },
                                    }
                                ],
                                "dom": "lfBrtip",
                                "buttons": [{
                                    text: 'Add Device',
                                    action: function ( e, dt, node, config ) {
                                        var code = $('#code').val();
                                        var name = $('#name').val();
                                        var corporate = $('#code_1').text();

                                        var res = app.setView(id,'add');
                                        if(res=='done'){
                                            $('#type').val('add');
                                            $('#code_edit').val(code);
                                            $('#name').val(name);
                                            $('#code_1').text(corporate);
                                            $('#corpId').val(code);
                                        }
                                        
                                    }
                                }],
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
                                        console.log(jqXHR.status + " ," + " " + textStatus + ", " + errorThrown);

                                    },complete: function(data) {
                                        $('.table-hidden').show();
                                        $('.divDetail').show();
                                        $('.divLanding').hide();
                                        $('div.dt-buttons').css('float','right');
                                        $('a.dt-button').addClass('btn btn-primary');
                                    }
                                }
                            });

                        }
                    });
                    
                    $('.back').on('click', function () {
                        var res = app.setView(id,'landing');
                    });

                    $('#confirm').on('click', function () {
                        $('#form-area').validator('validate');
                        if($('#form-area').validator('validate').has('.has-error').length!=0){
                            return;
                        }

                        $(this).prop('disabled',true);

                        $.confirm({
                            title: '{{trans('form.submit')}}',
                            content: 'Confirm Unlock Serial Number?',
                            buttons: {

                                cancel: {
                                    text: '{{trans('form.cancel')}}',
                                    btnClass: 'btn-default',
                                    action: function(){
                                        $('#confirm').prop('disabled',false);
                                    }
                                },
                                confirm: {
                                    text: '{{trans('form.confirm')}}',
                                    btnClass: 'btn-primary',
                                    action: function(){
                                        unlockSubmit();
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
                "ScrollX": '100%',
                "columnDefs": [
                    {
                        targets: 0,
                        data: {corporateId:"corporateId",cifId:"cifId"},
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-cifid="'+data.cifId+'" data-code="'+data.corporateId+'">'+data.corporateId+'</a>';
                        },
                        orderable: true
                    },
                    {
                        targets: 1,
                        data: "name",
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


        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');

    });



    function unblockAction(e){
        $.confirm({
            title: '{{trans('form.submit')}}',
            content: 'Confirm Unblock Serial Number?',
            buttons: {

                cancel: {
                    text: '{{trans('form.cancel')}}',
                    btnClass: 'btn-default',
                    action: function(){
                        $('#confirm').prop('disabled',false);
                    }
                },
                confirm: {
                    text: '{{trans('form.confirm')}}',
                    btnClass: 'btn-primary',
                    action: function(){
                        unblockSubmit(e);
                    }
                }
            }
        });
    }

    function unblockSubmit(e){
        var url_action = 'unblockToken';
        var action = 'UNBLOCK';

        var value = {
            "userId": $(e).attr('data-userid'),
            "corporateId": $('#code').val(),
            "tokenNo": $(e).attr('data-tokenNo')

        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {"_token": "{{ csrf_token() }}", action:action,url_action:url_action,menu: id, value: value},
            success: function (data) {
                $('#confirm').prop('disabled',false);
                //console.log(data);
                //return;
                var result = JSON.parse(data);
                if (result.status=="200") {
                    flash('success',result.message);
                    //$('#unlockModal').modal('hide');
                    //stateSuccess();
                } else {
                    //$('#submit_view').prop('disabled',false);

                    flash('warning',result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                //$('#confirm').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });

    }

    function unlockSubmit(){
        var url_action = 'unlockToken';
        var action = 'UNLOCK';

        var value = {

            "userId": $('#userId-modal').val(),
            "corporateId": $('#code').val(),
            "tokenNo": $('#tokenNo-modal').text(),
            "randomLockedCode": $('#randomLockedCode').val()
        };

        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {"_token": "{{ csrf_token() }}", action:action,url_action:url_action,menu: id, value: value},
            success: function (data) {
                $('#confirm').prop('disabled',false);
                //console.log(data);
                //return;
                var result = JSON.parse(data);
                if (result.status=="200") {
                    flash('success',result.message);
                    $('#unlockModal').modal('hide');
                    //stateSuccess();
                } else {
                    //$('#submit_view').prop('disabled',false);

                    flash('warning',result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                //$('#confirm').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });

    }

    function unassignAction(e){
        $.confirm({
            title: '{{trans('form.submit')}}',
            content: 'Confirm Unassign Serial Number?',
            buttons: {

                cancel: {
                    text: '{{trans('form.cancel')}}',
                    btnClass: 'btn-default',
                    action: function(){
                        $('#confirm').prop('disabled',false);
                    }
                },
                confirm: {
                    text: '{{trans('form.confirm')}}',
                    btnClass: 'btn-primary',
                    action: function(){
                        unassignSubmit(e);
                    }
                }
            }
        });
    }

    function unassignSubmit(e){
        var url_action = 'unassignToken';
        var action = 'UNASSIGN';

        var value = {
            "userId": $(e).attr('data-userid'),
            "userName": $(e).attr('data-userName'),
            "assignedBy": $(e).attr('data-assignedBy'),
            "assignedDate": $(e).attr('data-assignedDate'),
            "status": $(e).attr('data-status'),
            "corporateId": $('#code').val(),
            "name": $('#name').val(),
            "tokenNo": $(e).attr('data-tokenNo')

        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {"_token": "{{ csrf_token() }}", action:action,url_action:url_action,menu: id, value: value},
            success: function (data) {
                $('#confirm').prop('disabled',false);
                //console.log(data);
                //return;
                var result = JSON.parse(data);
                if (result.status=="200") {
                    flash('success',result.message);
                    //$('#unlockModal').modal('hide');
                    //stateSuccess();
                } else {
                    //$('#submit_view').prop('disabled',false);

                    flash('warning',result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                //$('#confirm').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });

    }

    function unlockAction(e){

        $('#unlockModal').modal('show');
        $('#tokenNo-modal').text($(e).attr('data-tokenNo'));
        $('#userId-modal').val($(e).attr('data-userid'));
    }
    


</script>