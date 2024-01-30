@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="state" value=""/>
            <input type="hidden" id="selected-table" data-services="" value=""/>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Bank Global Limit Listing</h3><br>
                </div>

                      <div class="box-body">
                        <div class="container-fluid">
                           
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center" rowspan="2"><strong>Service</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency matrix</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency</strong></th>
                                        <th align="center"><strong>Minimum Transaction</strong></th>
                                        <th align="center"><strong>Maximum Transaction</strong></th>
                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Amount Transaction</strong></th>
                                        <th align="center"><strong>Amount Transaction</strong></th>
                                    </tr>
                                    </thead>

                                </table>
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
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        getCurrency("IDR");



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

        $('#confirm').on('click', function () {

            if(checkMinMax()>0){
                var content ='{{trans('form.alert_minmax')}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            setTimeout(function(){
                submit_data = getTableData();
                console.log(submit_data);
                stateView();
            });
        });


        $('#back_view').on('click', function () {
            stateEdit();
        });

        $('#back_success').on('click', function () {
            
            if($('#state').val() == 'success'){
                app.setView(id,'landing');
                
            }else{
                $('#back_success').prop('disabled',false);
                stateEdit();
            }
        });

        $('.back').on('click', function () {
            app.setView(id,'landing');

        });

        
        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

    });

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

    function getMatrix(){
        var value = {};
        var url_action = 'search';
        var action = 'SEARCH';
        var result_key='result';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:true,
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
                    //console.log(detail);
                    if(detail){
                    $.each(detail, function (idx, obj){
                        $.each(selected_services, function (idx2,obj2){
                            if(obj2.serviceCode==obj.serviceCode && obj2.currencyMatrixName==obj.currencyMatrixName){
                                oTable.row.add([

                                    '<span id="service_name">'+obj.serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden"><input id="service_id" name="service_id" class="form-control state_edit" value="' + obj.id + '" type="hidden">',
                                    '<span id="currency_matrix_name">'+obj.currencyMatrixName +'</span>',
                                    currencyOption + '<span id="currCode_view" class="state_view">'+obj.currencyCode+'</span>',
                                    '<input id="min_limit" name="min_limit" class="form-control state_edit min_limit" value="'+obj.minAmountLimit+'" type="text" style="width:100%;display:hidden;text-align: right;"><span id="min_limit_view" class="state_view" style="float: right;">'+obj.minAmountLimit+'</span>',
                                    '<input id="max_limit" name="max_limit" class="form-control state_edit max_limit" value="'+obj.maxAmountLimit+'" type="text" style="width:100%;display:hidden;text-align: right;"><span id="max_limit_view" class="state_view" style="float: right;">'+obj.maxAmountLimit+'</span>'
                                ]).draw(false);
                            }
                        });
                    });
                    }
                    $('#temp').attr('data-services','');

                    $('.min_limit').autoNumeric('init',{
                        emptyInputBehavior: 'zero',
                        digitGroupSeparator        : ',',
                        decimalCharacter           : '.',
                        decimalCharacterAlternative: '.',
                        allowDecimalPadding : false,
                        minimumValue:'0.00',maximumValue:'999999999999999.99'
                    });
                    $('.max_limit').autoNumeric('init',{
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
            complete: function(data) {

            }
        });
    }

    function getCurrency(){
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
                        if(obj.code=="IDR") {
                            currencyOption += '<option value="' + obj.code + '" selected="selected">' + obj.code + '</option>';
                        }else{
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
            },complete: function(data) {
                getMatrix();
            }
        });
    }

    function submitData(){
        var value = {
           "bankTransactionLimitList": submit_data
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
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);$('#submit_view').hide();
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

    function getTableData(){
        var data = [];

        $("#list").find("tbody tr").each(function(){
            /*var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
            if (check == 0) {
                $('td:eq(0)', $(this)).parent().hide();
            }*/
            var service_code = $('td:eq(0)', $(this)).find('#service_code').val();
            var service_name = $('td:eq(0)', $(this)).find('#service_name').text();
            var service_id = $('td:eq(0)', $(this)).find('#service_id').val();
           // var matrix_id = $('td:eq(1)', $(this)).find('#matrix_id').val();
            var currency_matrix_name = $('td:eq(1)', $(this)).find('#currency_matrix_name').text();
            var curr_code = $('td:eq(2)', $(this)).find('#currCode').val();
            $('td:eq(2)', $(this)).find('#currCode_view').text(curr_code);
            var min_limit = $('td:eq(3)', $(this)).find('#min_limit').autoNumeric('get');
            $('td:eq(3)', $(this)).find('#min_limit_view').text($('td:eq(3)', $(this)).find('#min_limit').val());
            var max_limit = $('td:eq(4)', $(this)).find('#max_limit').autoNumeric('get');
            $('td:eq(4)', $(this)).find('#max_limit_view').text($('td:eq(4)', $(this)).find('#max_limit').val());

            var obj = {
                id: service_id,
                serviceCode: service_code,
                serviceName: service_name,
                currencyMatrixName: currency_matrix_name,
                //serviceCurrencyMatrixId: matrix_id,
                currencyCode: curr_code,
                minAmountLimit: min_limit,
                maxAmountLimit: max_limit
            };

                data.push(obj);

        });
        return data;
    }

    function stateEdit() {
        //oTable.column(0).visible(true);

        $('#state').val('edit');
        $('.state_view').hide();
        $('.state_edit').show();
        $('label.state_view').text('-');
        $('#save_screen').hide();
        $("#list").find("tbody tr").each(function () {
            $('td:eq(0)', $(this)).parent().show();
        });
        $('#done').hide();
        $('#next_user').hide();
    }

    function stateView() {
        $('#state').val('view');
        //oTable.column(0).visible(false);

        $('#preview').text('Preview');
        $('.state_edit').hide();
        $('.state_view').show();
        $('#save_screen').hide();
        $('#done').hide();
        $('#next_user').hide();
    }

    function stateSuccess() {
        $('#state').val('success');
        $('input.state_edit').val('');
        $('input.check').attr('checked', '');
        $('#save_screen').show();
        $('#back_view').hide();
        $('#back_success').show();
        $('#done').show();
        $('#next_user').show();
    }

    function checkMinMax(){
        var count = 0;
        $("#list").find("tbody tr").each(function () {
            var min_limit = $('td:eq(3)', $(this)).find('#min_limit').autoNumeric('get');
            var max_limit = $('td:eq(4)', $(this)).find('#max_limit').autoNumeric('get');

            if (parseFloat(min_limit)>parseFloat(max_limit)) {
                count++;
            }

        });

        return count;

    }

</script>