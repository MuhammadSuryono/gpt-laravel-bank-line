@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>

            <form id="form-area" class="form-horizontal form-area">
            <input type="hidden" id="state" value=""/>
            <input type="hidden" id="selected-table" data-services="" value=""/>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Parameter Listing</h3><br>
                </div>

                      <div class="box-body">
                        <div class="container-fluid">
                           
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                         <th align="center" ><strong>Parameter</strong></th>
                                         <th align="center" ><strong>Value</strong></th>
                                    </tr>
                                    </thead>
                                    <!-- <tbody>
                                        <tr>
                                            <td></td>
                                            <td><div class="form-group param" style="margin: 0"><input type="text" id="param_val" class="form-control state_edit" style="width: 100%;" maxlength="100" data-error="This field is required." required><div class="help-block with-errors"></div></div></td>
                                        </tr>
                                    </tbody>   -->          
                                </table>
                               </div>

                            

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
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        
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
                    width: "50%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "50%"
                }

            ]
        });

        stateEdit();

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);

            var content='{{trans('form.confirm_edit')}}';

            $('#form-area').validator('validate');

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

            /*if(checkMinMax()>0){
                var content ='{{trans('form.alert_minmax')}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }*/

            $('#form-area').validator('validate');

            setTimeout(function(){
                if($('#form-area').validator('validate').has('.has-error').length==0){
                    submit_data = getTableData();
                    console.log(submit_data);
                    stateView();
                }
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
                    $.each(detail, function (idx, obj){
                        $.each(selected_services, function (idx2,obj2){
                            if(obj2.paramCode==obj.code){
                                oTable.row.add([

                                    '<span id="param_name">'+obj.name +'</span>'+'<input id="param_code" name="param_code" class="form-control state_edit" value="' + obj.code + '" type="hidden">',
                                    '<form id="form-area" class="form-horizontal form-area"><div class="form-group param" style="margin: 0"><input id="param_value" class="form-control state_edit" value="'+obj.value+'" type="text" maxlength="100" style="width:100%;display:hidden;text-align: float-left;" data-error="This field is required." required><span id="value_param_id" class="state_view" style="float: left;">'+obj.value+'</span><div class="help-block with-errors"></div></div></form>'

                                    /*<div class="form-group param" style="margin: 0"><input type="text" id="param_val" class="form-control state_edit" style="width: 100%;" maxlength="100" data-error="This field is required." required><div class="help-block with-errors"></div></div>*/
                                ]).draw(false);
                            }
                        });
                    });
                    $('#temp').attr('data-services','');
                    $('#form-area').validator('validate');
                    
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

    getMatrix();

    function submitData(){
        var value = {
           "sysParamList": submit_data
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
            var param_code = $('td:eq(0)', $(this)).find('#param_code').val();
            var param_name = $('td:eq(0)', $(this)).find('#param_name').text();
            var param_value = $('td:eq(1)', $(this)).find('#param_value').val();
            $('td:eq(1)', $(this)).find('#value_param_id').text($('td:eq(1)', $(this)).find('#param_value').val());

            console.log("value: " + param_value + " " + "name: " + param_name + " " + "code: " + param_code);    

            var obj = {

                code: param_code,
                name: param_name,
                value: param_value
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

    /*function checkMinMax(){
        var count = 0;
        $("#list").find("tbody tr").each(function () {
            var min_limit = $('td:eq(3)', $(this)).find('#min_limit').autoNumeric('get');
            var max_limit = $('td:eq(4)', $(this)).find('#max_limit').autoNumeric('get');

            if (parseFloat(min_limit)>parseFloat(max_limit)) {
                count++;
            }

        });

        return count;

    }*/

</script>