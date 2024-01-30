@include('_partials.header_content',['breadcrumb'=>['Special Rate','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="currencyCode" value=""/>
            <div class="box">
                
                
                <div class="box-header">
                    <h3 class="box-title">Special Rate Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Reference Number</label>
                                <div class="col-md-6">
                                    <label id="refNoSpecialRate">-</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Corporate ID</label>
                                <div class="col-md-6">
                                    <label id="corporate">-</label>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Foreign Currency</label>
                                <div class="col-md-6">
                                    <label id="foreignCurrency1">-</label>
                                </div>
                            </div>
                        </div>

                         <div class="row ">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Unit</label>
                                <div class="col-md-6">
                                    <label id="unit">-</label>
                                </div>
                            </div>
                        </div>

                        <div class="row local">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Special Rate</label>
                                <div class="col-md-6">
                                    <label id="specialRate" >-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row local">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Buy/Sell Amount</label>
                                <div class="col-md-6">
                                    <label id="buySellAmountRate" >-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Buy Rate</label>
                                <div class="col-md-6">
                                    <label id="transactionBuyRate" >-</label>
                                </div>
                            </div>
                        </div>

                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Foreign Currency 2</label>
                                <div class="col-md-6">
                                    <label id="foreignCurrency2">-</label>
                                </div>
                            </div>
                        </div>

                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Unit 2</label>
                                <div class="col-md-6">
                                    <label id="unit2">-</label>
                                </div>
                            </div>
                        </div>

                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Sell Rate</label>
                                <div class="col-md-6">
                                    <label id="transactionSellRate" >-</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Transaction Amount</label>
                                <div class="col-md-6">
                                    <label id="transactionAmountRate" >-</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Type</label>
                                <div class="col-md-6">
                                    <label id="type" >-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Valid Until</label>
                                <div class="col-md-6">
                                    <label id="expiryDate" >-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Remark</label>
                                <div class="col-md-6">
                                    <label id="remark">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Status Transaction</label>
                                <div class="col-md-6">
                                    <label id="status" >-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Created By</label>
                                <div class="col-md-6">
                                    <label id="createdBy" >-</label>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Created Date</label>
                                <div class="col-md-6">
                                    <label id="createdDate" >-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                            
                                <div class="state_view">
                                    <div class="float-left">
                                        <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                        <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                                    </div>
                                    <div class="float-right">
                                        <button type="button" id="delete" name="delete" class="btn btn-danger">@lang('form.delete')</button>
                                       <!--  <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button> -->
                                        <button type="button" id="next_user" name="next_user" class="btn btn-info" style="display:none">@lang('form.next_user')</button>
                                        <button type="button" id="done" name="done" class="btn btn-primary done" style="display:none">@lang('form.done')</button>

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
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        $('.state_delete').hide();


        $('#delete').on('click', function () {

            $(this).prop('disabled',true);
            $.confirm({
                title: '{{trans('form.delete')}}',
                content: '{{trans('form.confirm_delete')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#delete').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.delete')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submit_delete();
                        }
                    },

                }
            });
        });

        function submit_delete () {

            var value = {
                "refNoSpecialRate": $('#refNoSpecialRate').val(),
                "corporateId": $('#corporate').text(),
                "foreignCurrency1": $("#foreignCurrency1").text(),
                "unit": $("#unit").text(),
                "specialRate": $("#specialRate").text(),
                "transactionAmountRate": $("#transactionAmountRate").text(),
                "foreignCurrency2": $("#foreignCurrency2").text(),
                "unit2": $("#unit2").text(),
                "buySellAmountRate": $("#buySellAmountRate").text(),
                "transactionBuyRate": $("#transactionBuyRate").text(),
                "transactionSellRate": $("#transactionSellRate").text(),
                "type": $("#type").text(),
                "typeRate": $("#type").text(),
                "expiryDate": $("#expiryDate").text(),
                "remark": $("#remark").text(),
                "status": $("#status").text(),
                "createdBy": $("#createdBy").text(),
                "createdDate": $("#createdDate").text(),
            };
            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submit'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        noRef = result.referenceNo;
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                        $('#submit_view').hide();
                        $('#save_screen').show();
                        $('#next_user').show();
                        $('#done').show();
                        $('#back').hide();
                        $('#delete').hide();
                        $('#edit').hide();
                        $('#back').html('{{trans('form.done')}}');
                    } else {
                        $('#delete').prop('disabled',false);
                        flash('warning', result.message);
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#delete').prop('disabled',false);
                    flash('warning', 'Form Submit Failed');
                   console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        }

        

        $('#back_delete').on('click', function () {
            $('.state_delete').hide();
            $('.state_view').show();
        });

        $('.back').on('click', function () {
           var res = app.setView(id,'landing');
        });

        $('.done').on('click', function () {
           var res = app.setView(id,'landing');
        });

        $('#edit').on('click', function () {
            var code = $('#refNoSpecialRate').val();
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('edit');
                $('#breadcrumb-action').html('edit');
                $('#code_edit').val(code);
                getRateEdit(code);
            }
            
        });

    });

    function getMatrix(){
        var refNoSpecialRate = $('#refNoSpecialRate').val();
        var url_action = 'search';
        var value ={
            refNoSpecialRate:refNoSpecialRate,
            name:'',
            currentPage: "1",
            pageSize: "50",
            orderBy: {"refNoSpecialRate": "DESC"}
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {
                    var index = result.result.map(function(o) { return o.refNoSpecialRate; }).indexOf(refNoSpecialRate.toString());
                    var detail = result.result[index];

                    $('#refNoSpecialRate').text(detail.refNoSpecialRate);
                    $('#corporate').text(detail.corporate);
                    $('#foreignCurrency1').text(detail.foreignCurrency1);
                    $('#foreignCurrency2').text(detail.foreignCurrency2);
                    $('#unit').text(detail.unit);
                    $('#unit2').text(detail.unit2);
                    $('#specialRate').text(detail.specialRate);
                    $('#buySellAmountRate').text(detail.buySellAmountRate);
                    $('#transactionBuyRate').text(detail.transactionBuyRate);
                    $('#transactionSellRate').text(detail.transactionSellRate);
                    $('#transactionAmountRate').text(detail.transactionAmountRate);
                    $('#type').text(detail.type);
                    $('#expiryDate').text(detail.expiryDate);
                    $('#remark').text(detail.remark);
                    $('#status').text(detail.status);
                    $('#createdBy').text(detail.createdBy);
                    $('#createdDate').text(detail.createdDate);
     
                } else {
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {

                $('.rate').autoNumeric('init',{
                    emptyInputBehavior: 'focus',
                    digitGroupSeparator        : ',',
                    decimalCharacter           : '.',
                    decimalCharacterAlternative: '.',
                    // allowDecimalPadding : false,
                    minimumValue:'0.00',maximumValue:'999999999999999.99'
                });
            }
        });
    }


</script>