@include('_partials.header_content',['breadcrumb'=>['Institution','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div class="box">
                
                
                <div class="box-header">
                    <h3 class="box-title">Institution Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Institution Code</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Institution Name</label>
                                <div class="col-md-6">
                                    <label id="name">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Institution Name English</label>
                                <div class="col-md-6">
                                    <label id="nameEng">-</label>
                                </div>
                            </div>
                        </div>						
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-6">
                                    <label id="dscp">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Institution Category</label>
                                <div class="col-md-6">
                                    <label id="institutionCategoryName">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Amount Selection</label>
                                <div class="col-md-6">
                                    <label id="amountSelection">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Bill Online Flag</label>
                                <div class="col-md-6">
                                    <label id="billOnlineFlag">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Institution Type</label>
                                <div class="col-md-6">
                                    <label id="institutionType">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Amount Currency</label>
                                <div class="col-md-6">
                                    <label id="amountCurrencyName">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Charges</label>
                                <div class="col-md-6">
                                    <label id="charges">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="box-header table-hidden">
                        <h3 class="box-title">Billing Key</h3>
                    </div>
                    <div class="box-body table-hidden">
                        <table id="list_billing" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                       <th align="left"><strong>Name</strong></th>
                                        <th align="left"><strong>Name English</strong></th>
                                        <th align="left"><strong>Regex</strong></th>
                                        <th align="left"><strong>Type</strong></th>
                                        <th align="left"><strong>Parameter Type</strong></th>
                                        <th align="left"><strong>Parameter Data Map</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                    </div>
                <div class="box-footer">
                            
                                <div class="state_view">
                                    <div class="float-left">
                                        <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                        <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                                    </div>
                                    <div class="float-right">
                                        <button type="button" id="delete" name="delete" class="btn btn-danger">@lang('form.delete')</button>
                                        <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
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
	var oTable_billing;
    var id = '{{ $service }}';
    var noRef;
	var data_detail;

    $(document).ready(function () {
        $('.state_delete').hide();
		
		oTable_billing = $('#list_billing').DataTable({
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
                    width: "20%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 4,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 5,
                    sortable: true,
                    width: "20%"
                }
            ]
        });

        $('#delete').on('click', function () {
           // $('.state_view').hide();
           // $('.state_delete').show();
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
			var submit_data = data_detail;
			
			
            var value = {
                "code": $('#code').val(),
                "name": $('#name').text(),
				"nameEng": $('#nameEng').text(),
                "dscp": $("#dscp").text()                
            };
			
			$.extend(value,submit_data);

            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submitDelete'},
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
            var code = $('#code_1').text();
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('edit');
                $('#breadcrumb-action').html('edit');
                $('#code_edit').val(code);
                getInstitutionEdit(code);
            }
            
        });

    });

    function getMatrix(){
        var code_id= $('#code').val();
        var url_action= 'search';
        var value ={
            code:code_id,
            name:'',
			isFromBankLine:"Y",
            currentPage: "1",
            pageSize: "20",
            orderBy: {"code": "ASC"}
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {
                    var index = result.result.map(function(o) { return o.code; }).indexOf(code_id.toString());
                    var detail = result.result[index];
					data_detail = detail;
					
                    $('#code_1').text(detail.code);
                    $('#name').text(detail.name);
					$('#nameEng').text(detail.nameEng);
                    $('#dscp').text(detail.dscp);
                    $('#institutionCategoryName').text(detail.institutionCategoryName);
                    $('#amountSelection').text(detail.amountSelection);
                    $('#billOnlineFlag').text(detail.billOnlineFlagDisplay);
                    $('#charges').text(detail.charges);
                    $('#institutionType').text(detail.institutionType);
                    $('#amountCurrencyName').text(detail.amountCurrencyName);
					
					var billingKeyList = detail.billingKeyList;
					
					oTable_billing.clear();
                    if(billingKeyList){
                    $.each(billingKeyList, function (idx, obj){
                        oTable_billing.row.add([
                            obj.name,
                            obj.nameEng,
                            obj.regex,
                            obj.type,
                            obj.parameterType,
							obj.parameterDataMap,
                        ]).draw(true);
                    });
                    }
                } else {
                    flash('warning', result.message);
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


</script>