@include('_partials.header_content',['breadcrumb'=>['Ongoing task','Corporate Account']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="referenceNo" value=""/>
            <input type="hidden" id="taskId" value=""/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Corporate Account Detail</h3><br>
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
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">CIF</label>
                                    <div class="col-md-6">
                                        <label id="cifid">-</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="box-header">
                    <h3 class="box-title table-hidden">Account Listing</h3>
                </div>
                    <div class="box-body">
                     <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Account Number</strong></th>
                                        <th align="center"><strong>Account Name</strong></th>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Account Type</strong></th>
                                        <th align="center"><strong>Allow Inquiry</strong></th>
                                        <th align="center"><strong>Allow Debit</strong></th>
                                        <th align="center"><strong>Allow Credit</strong></th>
                                        <th align="center"><strong>Status</strong></th>
                                    </tr>
                                    </thead>

                                </table>
                     </div>
                    <div class="box-footer">
                        <div class="state_view" data-html2canvas-ignore="true">
                            <div class="float-left">
                                <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                            </div>
                            <div class="float-right">
                                <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                                <button type="button" id="reject" name="reject" class="btn btn-danger">@lang('form.reject')</button>
                                <button type="button" id="approve" name="approve" class="btn btn-primary">@lang('form.approve')</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var id = 'MNU_GPCASH_CORP_ACCT';
    $(document).ready(function () {

        oTable = $('#list').DataTable({
            //"paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
               {
                    targets: 0,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "20%"
                },

                {
                    targets: 2,
                    sortable: true,
                    width: "5%",
                    className: "dt-center"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowInquiry" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowInquiry" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowDebit" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowDebit" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowCredit" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowCredit" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 7,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="N"){
                            return 'Inactive'
                        }else{
                            return 'Active'
                        }
                    }
                }

            ]
        });


        $('#approve').on('click', function () {
            $('#approve').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_approve')}}',
                buttons: {

                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#approve').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitTask('approve');
                        }
                    }

                }
            });
        });

        $('#reject').on('click', function () {
            $('#reject').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_reject')}}',
                buttons: {

                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#reject').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitTask('reject');
                        }
                    },

                }
            });
        });

        $('.back').on('click', function () {
            res = app.setView('MNU_GPCASH_PENDING_TASK','landing');
        });

    });

    function getData(){
        var referenceNo = $('#referenceNo').val();
        var value = {
            referenceNo : referenceNo
        };
        var url_action = 'detailPendingTask';
        var action = 'DETAIL';
        var menu = 'MNU_GPCASH_PENDING_TASK';
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
                if(result.referenceNo == undefined){
                    return;
                }
                var detail = result.details.accountList;
                $('#code_1').text(result.details.corporateId+' - '+result.details.name);
                $('#cifid').text(result.details.cifId);
                oTable.clear();
                if(detail){
                $.each(detail, function (idx, obj){
                    oTable.row.add([
                        obj.accountNo,
                        obj.accountName,
                        obj.accountCurrencyCode,
                        obj.accountTypeName,
                        obj.isAllowInquiry,
                        obj.isAllowDebit,
                        obj.isAllowCredit,
                        obj.accountStatus
                    ]).draw(true);
                });
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $('.table-hidden').show();

            }
        });
    }



    function submitTask(type){
        var id = 'MNU_GPCASH_PENDING_TASK';
        var value = {
            "referenceNo": $('#referenceNo').val(),
            "taskId": $('#taskId').val()
        };

        var action;
        var url_action;
        if(type=='approve'){
            action = 'APPROVE';
            url_action = 'approve';
        }else if(type=='reject'){
            action = 'REJECT';
            url_action = 'reject';
        }else{
            return;
        }

        $.ajax({
            url: 'detail',
            method: 'post',
            data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:url_action,action:action},
            success: function (data) {
                var result = JSON.parse(data);
                $(window).scrollTop(0);
                if (result.status=="200") {
                    flash('success', result.message+'<br>'+result.dateTimeInfo);
                    $('#approve').hide();
                    $('#reject').hide();
                    $('#save_screen').show();
                    $('#back').html('{{trans('form.done')}}');
                    $('#approve').prop('disabled',false);
                    $('#reject').prop('disabled',false);
                }else{
                    flash('warning',result.message+'<br>'+result.dateTimeInfo);
                    $('#approve').prop('disabled',false);
                    $('#reject').prop('disabled',false);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                $(window).scrollTop(0);
                $('#approve').prop('disabled',false);
                $('#reject').prop('disabled',false);
                $('#save_screen').hide();
                flash('warning','{{trans('form.pending_error')}}');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
    }

</script>