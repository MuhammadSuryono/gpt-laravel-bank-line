@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type ]])

<section class="content">
    <div  class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div id="print" class="box">
                
                <div class="box-header">
                     <h3 class="box-title">Corporate Detail</h3>
                </div>
                <form class="form-horizontal">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="name" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="corpId" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate</label>
                                <div class="col-md-6">
                                    <label id="code_1" name="code">-</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>

                <div class="box-header">
                    <h3 class="box-title">Device Listing</h3>
                </div>

                <div class="box-body">
                    <div class="row state_edit">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Serial Number</label>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <input type="text" class="form-control numeric" id="serialNo" name="serialNo" value="" maxlength="40">
                                    <button id="add_list" class="btn btn-default">Add to List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-6">
                            <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                   style="border-collapse:collapse;">
                                <thead>
                                <tr>
                                  <th align="left"><strong>Serial Number</strong></th>
                                  <th align="center"></th>
                                </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                       
                    </div>
                </div>

                <div class="box-footer">
                    <div class="col-md-12 state_edit text-center">
                        <button type="button" id="back" name="back" class="btn btn-default back float-left">@lang('form.cancel')</button>
                        <button type="button" id="confirm" name="confirm" class="btn btn-primary float-right ">@lang('form.confirm')</button>
                    </div>
                    <div class="col-md-12 state_view text-center" data-html2canvas-ignore="true">
                        <div class="float-left">
                            <button type="button" id="back_view" name="back_view" class="btn btn-default">@lang('form.cancel')</button>
                            <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                        </div>
                        <div class="float-right" style="display:inline;">
                            <button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
                            <button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>
                            <button type="button" id="submit_view" name="submit_view" class="btn btn-primary">@lang('form.submit')</button>
                        </div>
                    </div>
                </div>
                @include('_partials.next_user')
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var oTable_add;
    var currencyOption;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        //$('.list_add').hide();
        $('.table-hidden').hide();
        $('#filter_accountNo').hide();

        $('.numeric').autoNumeric('init', {decimalPlacesOverride: '0',digitGroupSeparator: '' });
        oTable = $('#list').DataTable({
            "paging" : false,
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
                    width: "75%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "25%",
                    className: "dt-center",
                    render: function ( data, type, full, meta ) {
                        return '<button data-cif="'+data+'" class="btn btn-danger" onClick="removeRow(this);" style="width:100px;">Remove</button>';
                    }
                }

            ]
        });

        stateEdit();

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content ='';
            if ($('#type').val() == 'add'){
                content='{{trans('form.confirm_add')}}';
            }else{
                content='{{trans('form.confirm_edit')}}';
            }

            $.confirm({
                title: '{{trans('form.submit')}}',
                content: content,
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitData();
                        }
                    }

                }
            });

        });

        function submitData(){
            var value = {
                "corporateId": $('#code_edit').val(),
                "name": $('#name').val(),
                "tokenList": submit_data

            };
            if ($('#type').val() == 'add'){
                $.ajax({
                    url: 'add',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.status=="200") {
                            noRef=result.referenceNo;
                            flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                            $('#submit_view').hide();
                            stateSuccess();
                        } else {
                            $('#submit_view').prop('disabled',false);
                            flash('warning', result.message);
                        }

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#submit_view').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }else{
                $.ajax({
                    url: 'edit',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.status=="200") {
                            noRef=result.referenceNo;
                            flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                            $('#submit_view').hide();
                            stateSuccess();
                        } else {
                            $('#submit_view').prop('disabled',false);
                            flash('warning', result.message);
                        }

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#submit_view').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }
        }


        $('#confirm').on('click', function () {
            if(oTable.data().count()<1){
                var content ='{{trans('form.alert_empty',['label'=>'Serial Number'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            setTimeout(function(){
            submit_data = getTableData();
            stateView();
            });
        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                var res = app.setView(id,'landing');
            }else{
            $('#back_view').prop('disabled',false);
            stateEdit();
            }
        });


        $('#add_list').on('click', function () {
            $(this).prop('disabled',true);
            var serialNo = $('#serialNo').val();
            if(serialNo==''){
                $.alert({
                    title: 'Attention!',
                    content: 'Please fill serial number.'
                });
                $(this).prop('disabled',false);
                $('#serialNo').focus();
                return;
            }
            searchToken(serialNo);

        });

        $('.back').on('click', function () {
            var code = $('#code_edit').val();
            var name = $('#name').val();
            var corpId = $('#corpId').val();
            // var res = app.setView(id,'detail');
            var res = app.setView(id,'landing');
            if(res=='done'){
                // $('#code').val(code);
                // $('#name').val(name);
                // $('#corpId').val(corpId);
                // getData(code,name);
            }

        });

       

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });

    function removeRow(el){
        var row = $(el).parent().parent();
        oTable.row(row).remove().draw(true);
    }

    function checkDuplicateList(tokenNo){
        var duplicate = 0;
        $("#list").find("tbody tr").each(function () {
            var serialNo = $('td:eq(0)', $(this)).find('#serialNo').val();
            if(tokenNo==serialNo){
                duplicate = 1;
            }
        });

        if(duplicate==1){
            return false;
        }else{
            return true;
        }

    }

    function searchToken(serialNo) {

        var corporateId = $('#code_edit').val();
        var value = {
            tokenNo: serialNo,
            corporateId: corporateId,
            tokenType: "TKN"
        };
        var url_action = 'searchToken';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : 'MNU_GPCASH_CORP',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    if(result.tokenNo !== undefined){
                        if(checkDuplicateList(serialNo)) {
                            oTable.row.add([
                                serialNo + '<input type=hidden id="serialNo" value="' + serialNo + '">'
                            ]).draw(true);
                            // tokenCount();
                        }
                    }else{
                        $.alert({
                            title: 'Attention!',
                            content: 'Serial Number not Found.'
                        });
                    }
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('#add_list').prop('disabled',false);

            }
        });
    }

       function getTableData() {
            var data = [];

            $("#list").find("tbody tr").each(function () {

                var tokenNo = $('td:eq(0)', $(this)).find('#serialNo').val();

                data.push(tokenNo);

            });
            return data;
        }


        function stateEdit() {
            if($('#type').val()=='add'){
            oTable.column(1).visible(true);
            }
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateView() {
            $('#state').val('view');
            if($('#type').val()=='add'){
                oTable.column(1).visible(false);
            }
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#save_screen').hide();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('#name').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }

</script>