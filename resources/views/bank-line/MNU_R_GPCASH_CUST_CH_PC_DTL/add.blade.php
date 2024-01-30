@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])

<section class="content">
    <div  class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div id="print" class="box">
                <div id="spinner" style="display:none"></div>
                
                <div class="box-header">
                     <h3 class="box-title">Transaction Fee </h3>
                </div>
                <form class="form-horizontal">
                <input type="hidden" id="customerId" value=""/>
                <input type="hidden" id="type" value="edit"/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">User ID</label>
                                <div class="col-md-6">
                                    <label id="userId">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Customer Name</label>
                                <div class="col-md-6">
                                    <label id="name_1">-</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                    <div class="box-header">
                        <h3 class="box-title table-hidden">Transaction Charge List</h3>
                    </div>
                    <div class="box-body">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>

                                        <th align="center"><strong>Menu</strong></th>
                                        <th align="center"><strong>Charge Type</strong></th>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Value</strong></th>
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


                </form>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        $('.table-hidden').hide();


        getCurrency("IDR");

        oTable = $('#list').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,
            "select": false,
            "searching": false,
            "autoWidth": false,
            "ScrollX": '100%',
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [

                {
                    targets: 0,
                    sortable: false,
                    width: "25%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "20%"
                },

                {
                    targets: 2,
                    sortable: false,
                    width: "10%"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "20%"
                }

            ]
        });

        stateEdit();

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content='{{trans('form.confirm_edit')}}';


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
                "customerId": $('#customerId').val(),
                "userId": $('#userId').text(),
                "name": $('#name_1').text(),
                "customerChargeList": submit_data
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

            setTimeout(function(){
                submit_data = getTableData();
                stateView();
            });
        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                var res = app.setView(id,'landing')
            }else{
            $('#back_view').prop('disabled',false);
            stateEdit();
            }
        });


        $('.back').on('click', function () {
            var customerId = $('#customerId').val();
            var name = $('#name_1').text();
            var userId = $('#userId').text();
            var res = app.setView(id,'detail');
            if(res=='done'){
                $('#customerId').val(customerId);
                $('#userId').text(userId);
                $('#name').val(name);
                $('#name_1').text(name);
                getMatrix();
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

        function getMatrix() {
            var customerId= $('#customerId').val();
            var value = {
                "customerId": customerId
            };
            var url_action = 'search';
            var action = 'SEARCH';
            var result_key='result';
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                async: false,
                data: {
                    value : value,
                    menu : id,
                    url_action : url_action,
                    action : action,
                    result_key : result_key,
                    _token : '{{ csrf_token() }}'
                },
                success: function (data) {
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        var detail = result.result;
                        oTable.clear();
                        var selected_services = JSON.parse($('#temp').attr('data-services'));
                        var lastServiceName = '';
                        // console.log(selected_services);
                        if(detail){
                        $.each(detail, function (idx, obj) {
                            var serviceName = '';
                            $.each(selected_services, function (idx2,obj2){
                                if(obj2.serviceCode==obj.serviceCode){

                                    if(lastServiceName!==obj.serviceName){
                                        serviceName = obj.serviceName;
                                    }
                                    oTable.row.add([
                                        '<span id="service_name">'+serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden"><input id="service_id" name="service_id" class="form-control state_edit" value="' + obj.id + '" type="hidden">',
                                        '<span id="service_charge_name">'+obj.serviceChargeName +'</span>'+'<input id="service_charge_id" name="service_charge_id" class="form-control state_edit" value="' + obj.serviceChargeId + '" type="hidden">',
                                        currencyOption + '<span id="currCode_view" class="state_view">-</span>',
                                        '<input id="value" name="value" class="form-control state_edit value" value="'+obj.value+'" type="text" style="width:100%;text-align: right;"><span id="value_view" class="state_view" style="float: right;">-</span>'
                                    ]).draw(false);
                                    $('#service_code[value="'+obj.serviceCode+'"]').parent().prev().children().attr('name',obj.serviceCode);
                                    if(lastServiceName==obj.serviceName){
                                        $('#service_charge_id[value="'+obj.serviceChargeId+'"]').parent().prev().prev().children().css('opacity','0')
                                    }
                                    lastServiceName = obj.serviceName;
                                }
                            });
                        });
                        }
                        $('#temp').attr('data-services','');
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
                    $('.value').autoNumeric('init',{
                        emptyInputBehavior: 'zero',
                        digitGroupSeparator        : ',',
                        decimalCharacter           : '.',
                        decimalCharacterAlternative: '.',
                        allowDecimalPadding : false,
                        minimumValue:'0.00',maximumValue:'999999999999999.99'
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
                    getMatrix();
                }
            });
        }

        function getTableData() {
            var data = [];

            $("#list").find("tbody tr").each(function () {
                /*var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
                if (check == 0) {
                    $('td:eq(0)', $(this)).parent().hide();
                }*/
                var service_code = $('td:eq(0)', $(this)).find('#service_code').val();
                var service_name = $('td:eq(0)', $(this)).find('#service_name').text();
                var service_id = $('td:eq(0)', $(this)).find('#service_id').val();
                var service_charge_name = $('td:eq(1)', $(this)).find('#service_charge_name').text();
                var curr_code = $('td:eq(2)', $(this)).find('#currCode').val();
                $('td:eq(2)', $(this)).find('#currCode_view').text(curr_code);
                var value = $('td:eq(3)', $(this)).find('#value').autoNumeric('get');
                $('td:eq(3)', $(this)).find('#value_view').text($('td:eq(3)', $(this)).find('#value').val());

                var obj = {
                    id: service_id,
                    serviceCode: service_code,
                    serviceName: service_name,
                    serviceChargeName: service_charge_name,
                    currencyCode: curr_code,
                    value: value
                };
                //if (check == 1) {
                    data.push(obj);
                //}
            });
            return data;
        }

        function stateEdit() {
           // oTable.column(0).visible(true);

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('.help-block').show();
            $('#done').hide();
            $('#next_user').hide();
            $("#list").find("tbody tr").each(function () {

                $('td:eq(0)', $(this)).parent().show();

            });
        }

        function stateView() {
            $('#state').val('view');
            //oTable.column(0).visible(false);
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());

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

    function groupColumn(){
        $("#list").find("tbody tr:visible").each(function (idx) {
            var current_value = $(this).children().eq(0).find('span').text();
            var next_value = $(this).next().children().eq(0).find('span').text();
            if (next_value==current_value) {
                $(this).next().children().eq(0).find('span').hide();
            }
        });
    }


</script>