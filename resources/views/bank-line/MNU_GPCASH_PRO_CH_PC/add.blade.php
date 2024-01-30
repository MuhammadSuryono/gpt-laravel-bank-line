@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div iclass="box">
                <div id="spinner" style="display:none"></div>
                
                <div class="box-header">
                     <h3 class="box-title">Fee Setup Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Fee Setup Code</label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="" data-error="This field is required." maxlength="40" required>
                                    <div class="help-block with-errors"></div>
                                    <label id="code_view" class="state_view">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Fee Setup Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="" data-error="This field is required." maxlength="100" required>
                                    <div class="help-block with-errors"></div>
                                    <label id="name_view" class="state_view">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row corp_limit" style="display:none">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Corporate with Special Fee</label>
                                <div class="col-md-4">
                                    <div class="state_edit">
                                    <input type="radio" id="isUpdateCorporateWithSpecialCharge_N" name="isUpdateCorporateWithSpecialCharge" value="N" checked> Do not update <br/>
                                    <input type="radio" id="isUpdateCorporateWithSpecialCharge_Y" name="isUpdateCorporateWithSpecialCharge" value="Y"> Update
                                    </div>
                                    <label id="specialCharge_view" class="state_view">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">Transactional Fee Listing</h3>
                    </div>
                    <div class="box-body">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th align="center"><strong>Service</strong></th>
                                        <th align="center"><strong>Fee Type</strong></th>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Fee Amount</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                            
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
    var currencyOption;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        $('.table-hidden').hide();

        $('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        var submit_data;
        getCurrency("IDR");

        oTable = $('#list').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "searching": false,
            "autoWidth": false,
            "ScrollX": '100%',
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    sortable: false,
                    width: "5%",
                    targets: 0,
                    checkboxes: {
                        selectRow: false,
                        selectAllPages: false
                    }
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "25%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "10%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "20%"
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
                    },

                }
            });

        });

        function submitData(){
            var value;

            if ($('#type').val() == 'add'){
                value = {
                    "code": $('#code').val(),
                    "name": $('#name').val(),
                    "transactionChargeList": submit_data
                };
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
                var special_charge = $('input[name="isUpdateCorporateWithSpecialCharge"]:checked').val();

                value = {
                    "code": $('#code').val(),
                    "name": $('#name').val(),
                    "transactionChargeList": submit_data,
                    "isUpdateCorporateWithSpecialCharge":special_charge
                };
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
                            $('#preview').text('ReferenceNo: ' + result.referenceNo);
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
            $('#form-area').validator('validate');
            if($('#form-area').validator('validate').has('.has-error').length!=0){
                return;
            }
            if(countMenu()==0){
                var content ='{{trans('form.alert_empty',['label'=>'Service'])}}';
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
                app.setView(id,'landing')
            }else{
            $('#back_view').prop('disabled',false);
            stateEdit();
            }
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            if ($('#type').val() == 'add') {
                app.setView(id,'landing')
            } else {
                var code = $('#code_edit').val();
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
                    getMatrix();
                }
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
        function getMatrixAdd() {

            var url_action = 'searchServiceChargeTRX';
            var action = 'SEARCH';
            var menu = id;
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                async: false,
                data: {menu:menu,url_action:url_action,action:action},
                success: function (data) {

                    var result = JSON.parse(data);
                    if (result.status=="200") {

                            var lastServiceName = '';
                            $.each(result.result, function (idx, obj) {
                                var serviceName = '';

                                if(lastServiceName!==obj.serviceName){
                                    serviceName = obj.serviceName;
                                }
                                oTable.row.add([
                                    '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                                    '<span id="service_name">'+serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                                    '<span id="service_charge_name">'+obj.serviceChargeName +'</span>'+'<input id="service_charge_id" name="service_charge_id" class="form-control state_edit" value="' + obj.serviceChargeId + '" type="hidden">',
                                    currencyOption + '<span id="currCode_view" class="state_view">-</span>',
                                    '<input id="value" name="value" class="form-control state_edit value" value="0" type="text" style="width:100%;text-align: right;"><span id="value_view" class="state_view" style="float: right;">-</span>'
                                ]).draw(false);
                                $('#service_code[value="'+obj.serviceCode+'"]').parent().prev().children().attr('name',obj.serviceCode);
                                if(lastServiceName==obj.serviceName){
                                    $('#service_charge_id[value="'+obj.serviceChargeId+'"]').parent().prev().prev().children().css('opacity','0')
                                }
                                lastServiceName = obj.serviceName;

                        });
                        $('.value').autoNumeric('init',{
                            emptyInputBehavior: 'zero',
                            digitGroupSeparator        : ',',
                            decimalCharacter           : '.',
                            decimalCharacterAlternative: '.',
                            allowDecimalPadding : false,
                            minimumValue:'0.00',maximumValue:'999999999999999.99'
                        });
                        stateEdit();
                    } else {
                        flash('warning', result.message);
                    }


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {
                    $('.table-hidden').show();
                    $('input[type="checkbox"]').change( function(){
                        if ($(this).is(':checked')) {
                            $('input[name="'+this.name+'"]').not(this).prop('checked',true)
                        }else{
                            $('input[name="'+this.name+'"]').not(this).prop('checked',false)
                        }
                    });
                    $('.value').keyup(function (e) {

                        var check = ($(this).parent().parent().find('td').eq(0).children().is(':checked') ? 1 : 0);

                        if(check==0){
                            $(this).parent().parent().find('td').eq(0).children().prop('checked',true);
                        }
                    });
                }
            });
        }

        function getMatrixEdit() {
            //getMatrixAdd();
            var code_id= $('#code_edit').val();
            var value = {
                code: code_id,
                name: "",
                currentPage: "1",
                pageSize: "20",
                orderBy: {"code": "ASC"}
            };
            var url_action = 'search';
            var action = 'DETAIL';
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
                    var data = JSON.parse(data);
                    if (data.status=="200") {
						var index = data.result.map(function(o) { return o.code; }).indexOf(code_id.toString());
                        var detail = data.result[index].transactionChargeList;

                        $('#code').val(data.result[index].code);
                        $('#code').attr('readonly', true);
                        $('#name').val(data.result[index].name);
                        //oTable.clear();
                        /*if(detail){
                        $.each(detail, function (idx, obj) {
                            $('input[name="'+obj.serviceCode+'"]').prop('checked',true);
                            $('input[name="'+obj.serviceCode+'"]').parent().parent().find('td').eq(3).find('#currCode').val(obj.currencyCode);
                            $('input[name="'+obj.serviceCode+'"]').parent().parent().find('td').eq(4).find('#value').val(obj.value);
                        });
                        }*/
                        oTable.clear();
                        if(detail) {
                            var lastServiceName = '';
                            $.each(detail, function (idx, obj) {
                                var serviceName = '';

                                if (lastServiceName !== obj.serviceName) {
                                    serviceName = obj.serviceName;
                                }
                                oTable.row.add([
                                    '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                                    '<span id="service_name">' + serviceName + '</span>' + '<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                                    '<span id="service_charge_name">' + obj.serviceChargeName + '</span>' + '<input id="service_charge_id" name="service_charge_id" class="form-control state_edit" value="' + obj.serviceChargeId + '" type="hidden">',
                                    currencyOption + '<span id="currCode_view" class="state_view">-</span>',
                                    '<input id="value" name="value" class="form-control state_edit value" value="'+obj.value+'" type="text" style="width:100%;text-align: right;"><span id="value_view" class="state_view" style="float: right;">-</span>'
                                ]).draw(false);
                                $('#service_code[value="' + obj.serviceCode + '"]').parent().prev().children().attr('name', obj.serviceCode);
                                if (lastServiceName == obj.serviceName) {
                                    $('#service_charge_id[value="' + obj.serviceChargeId + '"]').parent().prev().prev().children().css('opacity', '0')
                                }
                                lastServiceName = obj.serviceName;

                            });
                        }
                            if(detail){
                                $.each(detail, function (idx, obj) {
                                    $('input[name="'+obj.serviceCode+'"]').prop('checked',false);
                                    $('input[name="'+obj.serviceCode+'"]').parent().parent().find('td').eq(3).find('#currCode').val(obj.currencyCode);
                                    //$('input[name="'+obj.serviceCode+'"]').parent().parent().find('td').eq(4).find('#value').val(obj.value);
                                });
                            }
                        $('.value').autoNumeric('init',{
                            emptyInputBehavior: 'zero',
                            digitGroupSeparator        : ',',
                            decimalCharacter           : '.',
                            decimalCharacterAlternative: '.',
                            allowDecimalPadding : false,
                            minimumValue:'0.00',maximumValue:'999999999999999.99'
                        });
                        stateEdit();
                    } else {
                        flash('warning', data.message);
                    }


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {
                    $('.table-hidden').show();
                    $('.value').keyup(function (e) {

                        var check = ($(this).parent().parent().find('td').eq(0).children().is(':checked') ? 1 : 0);

                        if(check==0){
                            $(this).parent().parent().find('td').eq(0).children().prop('checked',true);
                        }
                    });
                }
            });
        }

        function getCurrency(kode) {
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
                        currencyOption = '<select id="currCode" class="form-control state_edit">';
                        $.each(result.result, function (idx, obj) {
                            if (obj.code == kode) {
                                currencyOption += '<option value="' + obj.code + '" selected="selected">' + obj.code + '</option>';
                            } else {
                                currencyOption += '<option value="' + obj.code + '">' + obj.code + '</option>';
                            }
                        });
                        currencyOption += '</select>';
                    } else {
                        flash('warning', result.message);
                    }



                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }, complete: function (data) {
                    if ($('#type').val() == 'edit') {
                        getMatrixEdit();
                    } else {
                        getMatrixAdd();
                    }
                }
            });
        }

        function countMenu(){
            var count = 0;
            $("#list").find("tbody tr").each(function () {
                var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);

                if (check == 1) {
                    count++;
                }
            });
            return count;
        }

        function getTableData() {
            var data = [];

            $("#list").find("tbody tr").each(function () {
                var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
                if (check == 0) {
                    $('td:eq(0)', $(this)).parent().hide();
                }
                var service_code = $('td:eq(1)', $(this)).find('#service_code').val();
                var service_name = $('td:eq(1)', $(this)).find('#service_name').text();
                var service_charge_id = $('td:eq(2)', $(this)).find('#service_charge_id').val();
                var service_charge_name = $('td:eq(2)', $(this)).find('#service_charge_name').text();
                var curr_code = $('td:eq(3)', $(this)).find('#currCode').val();
                $('td:eq(3)', $(this)).find('#currCode_view').text(curr_code);
                var value = $('td:eq(4)', $(this)).find('#value').autoNumeric('get');
                $('td:eq(4)', $(this)).find('#value_view').text($('td:eq(4)', $(this)).find('#value').val());

                var obj = {
                    serviceCode: service_code,
                    serviceName: service_name,
                    serviceChargeName: service_charge_name,
                    serviceChargeId: service_charge_id,
                    currencyCode: curr_code,
                    value: value
                };
                if (check == 1) {
                    data.push(obj);
                }
            });
            return data;
        }

        function stateEdit() {
            if ($('#type').val() == 'edit') {
                $('.corp_limit').show();
            } else {
                $('.corp_limit').hide();
            }
            oTable.column(0).visible(true);
            $('#save_screen').hide();
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $("#list").find("tbody tr").each(function () {

                $('td:eq(0)', $(this)).parent().show();

            });
            $('.help-block').show();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateView() {
            $('#state').val('view');
            oTable.column(0).visible(false);
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());
            if ($('#type').val() == 'edit') {
                var special_charge = $('input[name="isUpdateCorporateWithSpecialCharge"]:checked').val();
                if(special_charge =='Y'){
                    special_charge = 'Update';
                }else{
                    special_charge = 'Do not update';
                }
                $('#specialCharge_view').text(special_charge);
            }


            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);
             $('#save_screen').hide();
            $('.help-block').hide();
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