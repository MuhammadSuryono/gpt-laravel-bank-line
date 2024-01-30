@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
           <div class="box-header">
                     <h3 class="box-title">BANK CALENDAR</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="submit_mode" value=""/>
                <div class="box-body form_add" style="display:none">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>From Date&ast;</strong></label>
                                <div class="col-md-3">
                                    <div class="input-group state_edit">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    <input type="text" id="holidayDateFrom" name="holidayDateFrom" class="form-control" autocomplete="off" value="" maxlength="40" data-error="This field is required." readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <label id="holidayDateFrom_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>To Date&ast;</strong></label>
                                <div class="col-md-3">
                                    <div class="input-group state_edit">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    <input type="text" id="holidayDateTo" name="holidayDateTo" class="form-control" autocomplete="off" value="" maxlength="40" data-error="This field is required." readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <label id="holidayDateTo_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Description&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="dscp" name="dscp" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="dscp_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Type&ast;</strong></label>
                                <div class="col-md-8">
                                    <label class="radio-inline state_edit">
                                        <input type="radio" id="type_holiday" name="type" value="HOLIDAY" checked> HOLIDAY <br/>
                                    </label>
                                    <label class="radio-inline state_edit">
                                        <input type="radio" id="type_event" name="type" value="EVENT"> EVENT
                                    </label>
                                    <label class="radio-inline state_edit">
                                        <input type="radio" id="type_currency" name="type" value="CURRENCY"> CURRENCY HOLIDAY
                                    </label>
                                    <div class="radio-inline state_edit currClass">
                                        <select class="form-control" id="currencyCode">
                                            <option></option>
                                       </select>
                                    </div>
                                    <label id="type_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="box-body form_edit" style="display:none">
                        <div class="row state_edit">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Date</label>
                                <div class="col-md-4">
                                    <div class="form-inline" style="margin-left:-15px">
                                        <label id="holidayDate" name="holidayDate"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row state_edit">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Description&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="dscp_edit" name="dscp_edit" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="dscp_edit_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row state_edit">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Type&ast;</strong></label>
                                <div class="col-md-6">
                                    <label class="radio-inline" style="margin-left:5px">
                                        <input type="radio" id="type_edit_holiday" name="type_edit" value="HOLIDAY" checked> HOLIDAY <br/>
                                    </label>
                                    <label class="radio-inline" style="margin-left:5px">
                                        <input type="radio" id="type_edit_event" name="type_edit" value="EVENT"> EVENT
                                    </label>
                                    <label class="radio-inline" style="margin-left:5px">
                                        <input type="radio" id="type_edit_currency" name="type_edit" value="CURRENCY"> CURRENCY HOLIDAY
                                    </label>
                                    <div class="radio-inline currClass">
                                        <select class="form-control" id="currencyCode_edit">
                                            <option></option>
                                       </select>
                                    </div>
                                    <label id="type_edit_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row state_edit">
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-6">
                                    <button id="add_list" class="btn btn-primary btn-outline">Add to List</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-9">
                                    <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                           style="border-collapse:collapse;">
                                        <thead>
                                        <tr>
                                            <th align="left"><strong>Date</strong></th>
                                            <th align="left"><strong>Description</strong></th>
                                            <th align="left"><strong>Type</strong></th>
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
                </form>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var submit_data;
    var holiday_date = '';
    var today_event = '';
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        $('.table-hidden').hide();


        $(document).validator().on('#form-area','submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        
        getCurrency();

        stateEdit();
        $('.currClass').hide();

        $('input[name="type"]').on('change', function(e) {
            if(this.value=='CURRENCY'){
                $('.currClass').show();
            }else{
                $('.currClass').hide();
            }
        });

        $('input[name="type_edit"]').on('change', function(e) {
            if(this.value=='CURRENCY'){
                $('.currClass').show();
            }else{
                $('.currClass').hide();
            }
        });


        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content ='';
            if ($('#type').val() == 'add'){
                //content='{{trans('form.confirm_add')}}';
                content = 'Please make sure if there is pending transaction in this date, kindly check in menu Transaction Holiday Update '
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
                    },

                }
            });

        });

        function submitData(){
            var url_action = "";
            var url='';
            var loginId = '<?php echo Session::get('userId') ?>';
            var type = $('input[name="type"]:checked').val();
            var value = '';

            if ($('#type').val() == 'add'){
                url = 'add';
                url_action = "submit";
                value = {
                    "holidayDateFrom": ($('#holidayDateFrom').val() == '' ? '' : $("#holidayDateFrom").data('datepicker').getFormattedDate('dd/mm/yyyy')),
                    "holidayDateTo": ($('#holidayDateTo').val() == '' ? '' : $("#holidayDateTo").data('datepicker').getFormattedDate('dd/mm/yyyy')),
                    "dscp": $('#dscp').val(),
                    "action": 'CREATE',
                    "loginId":loginId,
                    "type": type,
                    "currencyCode": $('#currencyCode').val()
                };
            } else {
                var holiday_list = getTableData();
                url = 'edit';
                url_action = "submitUpdate";
                value = {
                    "holidayDate": holiday_date,
                    "holidayList": holiday_list,
                    "action": 'UPDATE',
                    "loginId":loginId

                };
            }

             $.ajax({
                    url: url,
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:url_action},
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


        $('#confirm').on('click', function () {
            if($("#type").val()=='add') {
                $('#form-area').validator('validate');
                setTimeout(function () {
                    if ($('#form-area :visible').validator('validate').has('.has-error').length == 0) {
                        $('#submit_type').val('submit');
                        stateView();
                    }
                });
            }else {
                if (oTable.data().count() < 1) {
                    var content = '{{trans('form.alert_empty',['label'=>'List Event'])}}';
                    $.alert({
                        title: '{{trans('form.warning')}}',
                        content: content
                    });
                    return;
                }
                setTimeout(function () {
                    //submit_data = getTableData();
                    stateView();
                });
            }
        });

        /*$('#submit_add').on('click', function () {
            $('#submit_type').val('submit_add');
            stateView();
        });*/

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#type').val()=='edit'){
                oTable.column(3).visible(true);
            }
            if($('#state').val() == 'success'){
                var action = '';
                if($('#submit_type').val()=='submit'){
                    action = 'landing';
                }else{
                    action = 'add';
                }
                app.setView(id,action)
                return;
            }else{
            $('#back_view').prop('disabled',false);

            stateEdit();
            }
        });

        $('#add_list').on('click', function () {
            $(this).prop('disabled',true);
            var dscp_edit = $('#dscp_edit').val();
            var type_edit = $('input[name="type_edit"]:checked').val();
            var curr_edit = $('#currencyCode_edit').val();
            if(dscp_edit==''){
                $.alert({
                    title: 'Attention!',
                    content: 'Please fill description.'
                });
                $(this).prop('disabled',false);
                //$('#dscp_edit').focus();
                return;
            }
            oTable.row.add([
                moment(holiday_date, 'DD/MM/YYYY').format("dddd, DD-MMMM-YYYY"),
                dscp_edit,
                (type_edit != 'CURRENCY' ? type_edit : (type_edit + "  -  " + curr_edit)),
                ''
            ]).draw(true);
            $(this).prop('disabled',false);
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            if ($('#type').val() == 'add') {
                app.setView(id,'landing')
            } else {
               var res = app.setView(id,'detail');
                if(res=='done'){
                    getMatrix(holiday_date,today_event);
                }
            }
        });

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('#type_currency').on('click', function () {
           
        });

        		
		$('.numeric').numeric({
            allowSpace: false,
            allow : ''
        });
        
        $('#dscp').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
        $('#dscp_edit').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });


    });

    function getTableData() {
        var holidayList = [];

        $("#list").find("tbody tr").each(function () {

            var dscp = $('td:eq(1)', $(this)).text();
            var typeTable = $('td:eq(2)', $(this)).text();
            var type = typeTable;
            var currency = '';
            if (typeTable.includes('CURRENCY')) {
                type = typeTable.split(" - ")[0];
                currency = typeTable.split(" - ")[1];
            }
            // var type = typeTable.split(" - ")[0];
            // var currency = typeTable.split(" - ")[1];
            var value = {
                "dscp": dscp,
                "type": type,
                "currencyCode":currency
            };

            holidayList.push(value);

        });
        return holidayList;
    }

    function setForm(holidayDate,todayEvent){
        holiday_date = holidayDate;
        today_event = todayEvent;
        //console.log("holidayDate",holidayDate);
        //console.log("todayEvent",todayEvent);
        if ($('#type').val() == 'add'){
            $('.form_add').show();
            $('.form_edit').hide();
            $('#holidayDateFrom').datepicker({
                format: "dd-MM-yyyy",
                locale: 'id',
                autoclose:true
            });
            $('#holidayDateTo').datepicker({
                format: "dd-MM-yyyy",
                locale: 'id',
                autoclose:true
            });
            $("#holidayDateFrom").datepicker({ dateFormat: "dd-MM-yyyy"}).datepicker("setDate", "0");
            $("#holidayDateTo").datepicker({ dateFormat: "dd-MM-yyyy"}).datepicker("setDate", "0");
        } else {
            $('.form_add').hide();
            $('.form_edit').show();
            $("#holidayDate").html(moment(holidayDate, 'DD/MM/YYYY').format("dddd, DD-MMMM-YYYY"));
            oTable = $('#list').DataTable({
                "paging" : false,
                "ordering" : false,
                "info": false,
                "destroy": true,

                "searching": false,
                "autoWidth":false,
                "columnDefs": [

                    {
                        targets: 0,
                        sortable: false,
                        width: "200px"
                    },
                    {
                        targets: 1,
                        sortable: false,
                        width: "350px"
                    },
                    {
                        targets: 2,
                        sortable: false,
                        width: "100px"
                    },
                    {
                        targets: 3,
                        sortable: false,
                        width: "100px",
                        className: "dt-center",
                        render: function ( data, type, full, meta ) {
                            return '<button class="btn btn-danger btn-outline" onClick="removeRow(this);" style="width:100px;">Remove</button>';
                        }
                    }

                ]
            });
            $.each(todayEvent, function (idx, obj){

                oTable.row.add([
                    moment(obj.start, 'DD/MM/YYYY').format("dddd, DD-MMMM-YYYY"),
                    obj.title,
                    obj.type,
                    ''

                ]).draw(true);
            });
            //var addRow
        }
    };


        function stateEdit() {


            $('.parent_menu_name').show();

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('.help-block').show();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateView() {
            $('#state').val('view');
            $('.parent_menu_name').show();
            if($("#type").val()=='add') {
                $('input:checkbox').prop('disabled', 'disabled');
                var dscp = ($('#dscp').val() == '' ? '-' : $('#dscp').val());
                var holidayDateFrom = ($('#holidayDateFrom').val() == '' ? '-' : moment($('#holidayDateFrom').val(), 'DD-MMMM-YYYY').format("dddd, DD-MMMM-YYYY"));
                var holidayDateTo = ($('#holidayDateTo').val() == '' ? '-' : moment($('#holidayDateTo').val(), 'DD-MMMM-YYYY').format("dddd, DD-MMMM-YYYY"));
                var type = $('input[name="type"]:checked').val();
                if (type == 'HOLIDAY') {
                    type = 'HOLIDAY';
                } else if (type == 'EVENT'){
                    type = 'EVENT';
                } else {
                    type = 'CURRENCY HOLIDAY' + ' - ' + $('#currencyCode').val();
                }
                $('#type_view').text(type);
                $('#dscp_view').text(dscp);
                $('#holidayDateFrom_view').text(holidayDateFrom);
                $('#holidayDateTo_view').text(holidayDateTo);
            }else{

                oTable.column(3).visible(false);

            }
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();

            $('#save_screen').hide();
            $('.help-block').hide();
            $('#done').hide();
            $('#next_user').hide();

        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('input.state_edit').val('');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }

    function removeRow(el){
        var row = $(el).parent().parent();
        oTable.row(row).remove().draw(true);
    }

    function getCurrency() {
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_CURRENCY"
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_PARAMETER';
        
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
                    // unitOption = '<option value=""></option>';
                    unitOption = '';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '">'+ obj.code + /*' - ' + obj.name +*/ '</option>';
                    });
                    $('#currencyCode').html(unitOption);
                    $('#currencyCode').select2();
                    $('#currencyCode_edit').html(unitOption);
                    $('#currencyCode_edit').select2();
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