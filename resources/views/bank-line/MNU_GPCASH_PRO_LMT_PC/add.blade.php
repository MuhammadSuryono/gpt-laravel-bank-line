@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div  class="box">
                <div id="spinner" style="display:none"></div>
                
                <div class="box-header">
                     <h3 class="box-title">Limit Setup Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Limit Setup Code&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="code_view" class="state_view">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Limit Setup Name&ast;</strong></label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="name_view" class="state_view">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row corp_limit" style="display:none">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Corporate with Special Limit</label>
                                <div class="col-md-4">
                                    <div class="state_edit">
                                    <input type="radio" id="isUpdateCorporateWithSpecialLimit_N" name="isUpdateCorporateWithSpecialLimit" value="N" checked> Do not update <br/>
                                    <input type="radio" id="isUpdateCorporateWithSpecialLimit_Y" name="isUpdateCorporateWithSpecialLimit" value="Y"> Update
                                    </div>
                                    <label id="specialLimit_view" class="state_view">-</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                    <div class="box-header">
                        <h3 class="box-title table-hidden">Limit Setup Listing</h3>
                    </div>
                    <div class="box-body">
                        
                           
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"></th>
                                        <th align="center" rowspan="2"><strong>Service</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency matrix</strong></th>
                                        <th align="center" rowspan="2"><strong>Max. No. Of Transaction / Day</strong></th>
                                        <th align="center" colspan="2"><strong>Maximum Transaction Amount / Day</strong></th>

                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Value</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                           
                            
                        
                    </div>
                </form>
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
    var id = 'MNU_GPCASH_PRO_LMT_PC';
    var noRef;

    $(document).ready(function () {


        $('.table-hidden').hide();

        var submit_data;
        getCurrency("IDR");

        $('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

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
                    width: "20%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "10%"
                },
                {
                    targets: 5,
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
                    }

                }
            });

        });

        function submitData(){
                var value;
            if ($('#type').val() == 'add'){
                value = {
                    "code": $('#code').val(),
                    "name": $('#name').val(),
                    "transactionLimitList": submit_data
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
                var special_limit = $('input[name="isUpdateCorporateWithSpecialLimit"]:checked').val();
                value = {
                    "code": $('#code').val(),
                    "name": $('#name').val(),
                    "transactionLimitList": submit_data,
                    "isUpdateCorporateWithSpecialLimit":special_limit

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
                var content ='{{trans('form.alert_empty',['label'=>'Services'])}}';
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
            var url_action = 'searchServiceCurrencyMatrixTRX';
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
                                    '<input id="check" name="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                                    '<span id="service_name">'+serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                                    '<span id="currency_matrix_name">'+obj.currencyMatrixName +'</span>'+'<input id="matrix_id" name="matrix_id" class="form-control state_edit" value="' + obj.serviceCurrencyMatrixId + '" type="hidden">',
                                    '<input id="num_trans" name="num_trans" class="form-control state_edit num_trans" value="0" type="text" style="width:100%;text-align: right;"><span id="num_trans_view" class="state_view" style="float: right;">-</span>',
                                    currencyOption + '<span id="currCode_view" class="state_view">-</span>',
                                    '<input id="max_trans" name="max_trans" class="form-control state_edit max_trans numeric" value="0" type="text" style="width:100%;text-align: right;"><span id="max_trans_view" class="state_view" style="float: right;">-</span>'
                                ]).draw(false);
                                $('#service_code[value="'+obj.serviceCode+'"]').parent().prev().children().attr('name',obj.serviceCode);
                                if(lastServiceName==obj.serviceName){
                                    $('#service_charge_id[value="'+obj.serviceChargeId+'"]').parent().prev().prev().children().css('opacity','0')
                                }
                                lastServiceName = obj.serviceName;

                        });
                        $('.num_trans').autoNumeric('init', {emptyInputBehavior: 'zero',decimalPlacesOverride: '0',minimumValue:'0',maximumValue:'999999999'});
                        $('.max_trans').autoNumeric('init',{
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
                    $('.num_trans').keyup(function (e) {

                        var check = ($(this).parent().parent().find('td').eq(0).children().is(':checked') ? 1 : 0);

                        if(check==0){
                            $(this).parent().parent().find('td').eq(0).children().prop('checked',true);
                        }
                    });
                    $('.max_trans').keyup(function (e) {

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
                        var detail = data.result[index].transactionLimitList;

                        $('#code').val(data.result[index].code);
                        $('#code').attr('readonly', true);
                        $('#name').val(data.result[index].name);
                        //oTable.clear();

                        var lastServiceName = '';
                        if(detail){
                        $.each(detail, function (idx, obj) {
                            var serviceName = '';

                            if(lastServiceName!==obj.serviceName){
                                serviceName = obj.serviceName;
                            }
                            oTable.row.add([
                                '<input id="check" name="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                                '<span id="service_name">'+serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                                '<span id="currency_matrix_name">'+obj.currencyMatrixName +'</span>'+'<input id="matrix_id" name="matrix_id" class="form-control state_edit" value="' + obj.serviceCurrencyMatrixId + '" type="hidden">',
                                '<input id="num_trans" name="num_trans" class="form-control state_edit num_trans" value="'+obj.maxTrxPerDay+'" type="text" style="width:100%;text-align: right;"><span id="num_trans_view" class="state_view" style="float: right;">-</span>',
                                currencyOption + '<span id="currCode_view" class="state_view">-</span>',
                                '<input id="max_trans" name="max_trans" class="form-control state_edit max_trans numeric" value="'+obj.maxTrxAmountPerDay+'" type="text" style="width:100%;text-align: right;"><span id="max_trans_view" class="state_view" style="float: right;">-</span>'
                            ]).draw(false);
                            $('#service_code[value="'+obj.serviceCode+'"]').parent().prev().children().attr('name',obj.serviceCode);
                            if(lastServiceName==obj.serviceName){
                                $('#service_charge_id[value="'+obj.serviceChargeId+'"]').parent().prev().prev().children().css('opacity','0')
                            }
                            lastServiceName = obj.serviceName;

                        });

                            $.each(detail, function (idx, obj) {
                                $('input[name="'+obj.serviceCode+'"]').prop('checked',false);
                                //$('input[name="'+obj.serviceCode+'"]').parent().parent().find('td').eq(3).find('#num_trans').val(obj.maxTrxPerDay);
                                $('input[name="'+obj.serviceCode+'"]').parent().parent().find('td').eq(4).find('#currCode').val(obj.currencyCode);
                                //$('input[name="'+obj.serviceCode+'"]').parent().parent().find('td').eq(5).find('#max_trans').val(obj.maxTrxAmountPerDay);
                            });
                        }
                        $('.num_trans').autoNumeric('init', {emptyInputBehavior: 'zero',decimalPlacesOverride: '0',minimumValue:'0',maximumValue:'999999999'});
                        $('.max_trans').autoNumeric('init',{
                            emptyInputBehavior: 'zero',
                            digitGroupSeparator        : ',',
                            decimalCharacter           : '.',
                            decimalCharacterAlternative: '.',
                            allowDecimalPadding : false,
                            minimumValue:'0.00',maximumValue:'999999999999999.99'
                        });

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
                    $('.num_trans').keyup(function (e) {

                        var check = ($(this).parent().parent().find('td').eq(0).children().is(':checked') ? 1 : 0);

                        if(check==0){
                            $(this).parent().parent().find('td').eq(0).children().prop('checked',true);
                        }
                    });
                    $('.max_trans').keyup(function (e) {

                        var check = ($(this).parent().parent().find('td').eq(0).children().is(':checked') ? 1 : 0);

                        if(check==0){
                            $(this).parent().parent().find('td').eq(0).children().prop('checked',true);
                        }
                    });
                    stateEdit();
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
                var matrix_id = $('td:eq(2)', $(this)).find('#matrix_id').val();
                var currency_matrix_name = $('td:eq(2)', $(this)).find('#currency_matrix_name').text();
                var num_trans = $('td:eq(3)', $(this)).find('#num_trans').autoNumeric('get');
                $('td:eq(3)', $(this)).find('#num_trans_view').text($('td:eq(3)', $(this)).find('#num_trans').val());
                var curr_code = $('td:eq(4)', $(this)).find('#currCode').val();
                $('td:eq(4)', $(this)).find('#currCode_view').text(curr_code);
                var max_trans = $('td:eq(5)', $(this)).find('#max_trans').autoNumeric('get');
                $('td:eq(5)', $(this)).find('#max_trans_view').text($('td:eq(5)', $(this)).find('#max_trans').val());

                var obj = {
                    serviceCode: service_code,
                    serviceName: service_name,
                    currencyMatrixName: currency_matrix_name,
                    serviceCurrencyMatrixId: matrix_id,
                    maxTrxPerDay: num_trans,
                    currencyCode: curr_code,
                    maxTrxAmountPerDay: max_trans
                };
                if (check == 1) {
                    data.push(obj);
                }
            });
            return data;
        }

        function stateEdit() {
            console.log('edit');

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
            console.log('view');
            $('#state').val('view');
            oTable.column(0).visible(false);

            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());
            if ($('#type').val() == 'edit') {
                var special_limit = $('input[name="isUpdateCorporateWithSpecialLimit"]:checked').val();
                if(special_limit =='Y'){
                    special_limit = 'Update';
                }else{
                    special_limit = 'Do not update';
                }
                $('#specialLimit_view').text(special_limit);

            }

            $('#save_screen').hide();
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);

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