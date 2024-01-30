@include('_partials.header_content',['breadcrumb'=>['Fee Updates','Confirm']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Fee Updates</h3>
                </div>
                <form class="form-horizontal" id="form-area">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Fee Updates</label>
                                <div class="col-md-4">
                                   <label class="control-label" id="updateType"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group specialFeeRow">
                                 <label class="col-md-5 control-label">Corporate with Special Fee</label>
                                <div class="col-md-4 form-inline">
                                    <label class="control-label" id="isUpdate"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group feeSetupCode">
                                 <label class="col-md-5 control-label">Fee Setup Code</label>
                                <div class="col-md-4 form-inline">
                                    <label class="control-label" id="feeCode"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group feeSetupName">
                                 <label class="col-md-5 control-label">Fee Setup Name</label>
                                <div class="col-md-4 form-inline">
                                    <label class="control-label" id="feeName"></label>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
                </form>
                <div class="box-header list-title">
                    <h3 class="box-title">Fee Setup Detail</h3>
                </div>

                <div class="box-body list-title">
                    <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                           style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="center"><strong>Service</strong></th>
                                <th align="center"><strong>Fee Type</strong></th>
                                <th align="center"><strong>Currency</strong></th>
                                <th align="center"><strong>Fee Amount</strong></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer list-title">
                    <div class="float-left">
                        <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.cancel')</button>
                        <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                    </div>
                    <div class="float-right">
                        <button type="button" id="submitBtn" name="submitBtn" class="btn btn-primary">@lang('form.submit')</button>
                        <button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
                        <button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>            
                    </div>
                </div>
                @include('_partials.next_user')
            </div>
        </div>
    </div>

</section>

<script>
    var service = '{{ $service }}';
    var oTable;
    var currencyOption;
    var submitData;
    var noRef;

    $(document).ready(function () {

        $('#save_screen').hide();
        $('#next_user').hide();
        $('#done').hide();

        oTable = $('#list').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,
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
                    width: "20%",
                    className:'dt-body-right'
                }

            ]
        });

        $('.back').on('click', function () {
           var res = app.setView(service,'landing');
        });

        $('#submitBtn').on('click', function () {

            $.confirm({
                title: '{{trans('form.submit')}}',
                content: '{{trans('form.confirm_edit')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $(this).prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.submit')}}',
                        btnClass: 'btn-primary',
                        action: function(){

                            $.ajax({
                                url: 'edit',
                                method: 'post',
                                data: {"_token": "{{ csrf_token() }}", menu: service, value: submitData},
                                success: function (data) {
                                    var result = JSON.parse(data);
                                    if (result.status=="200") {
                                        noRef=result.referenceNo;
                                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                                        

                                        $('#save_screen').show();
                                        $('#done').show();
                                        $('#next_user').show();
                                        $('#back').hide();
                                        $('#submitBtn').hide();

                                    } else {
                                       
                                        flash('warning', result.message);
                                    }


                                }, error: function (xhr, ajaxOptions, thrownError) {
                                    flash('warning', 'Form Submit Failed');
                                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                                }, complete: function (data) {
                                    
                                }
                            });
                        }
                    },

                }
            });
        });

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(service,'landing');
        });

    });


    function prepareDetail(listData, dataSubmit) {

       
        submitData = dataSubmit;
        console.log("submitData", submitData);

        oTable.clear();
        $.each(listData, function (idx, obj) {
            oTable.row.add([
                obj.serviceName,
                obj.feeType,
                obj.currency,
                currencyFormat(obj.feeAmount)
            ]).draw(false);
        });
        
    }

    function currencyFormat (num) {
        return parseFloat(num).toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");  //<--- $1  is a special replacement pattern which holds a value of the first parenthesised submatch string 
    }

</script>
                