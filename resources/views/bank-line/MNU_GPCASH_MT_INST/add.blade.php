@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
           <div class="box-header">
                     <h3 class="box-title">Institution Setup Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="submit_mode" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Institution Code&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="code_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Institution Name&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="name_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Institution Name English&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="nameEng" name="nameEng" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="nameEng_view" class="state_view"></label>
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
								<label class="col-md-2 control-label"><strong>Institution Category&ast;</strong></label>
								<div class="col-md-6">
									<div class="state_edit">
										<select class="form-control state_edit" id="institutionCategory" data-error="This field is required." required>
											<option></option>
										</select>
									</div>
                                    <div class="help-block with-errors"></div>
									<label id="institutionCategory_view" class="state_view">-</label>
								</div>
							</div>
						</div>  
						<div class="row">
							<div class="form-group">
								<label class="col-md-2 control-label"><strong>Amount Selection&ast;</strong></label>
								<div class="col-md-6">
									<div class="state_edit">
										<select class="form-control state_edit" id="amountSelection" data-error="This field is required." required>
											<option></option>
										</select>
									</div>
                                    <div class="help-block with-errors"></div>
									<label id="amountSelection_view" class="state_view">-</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
                                <label class="col-md-2 control-label">Bill Online Flag</label>
                                <div class="col-md-6">
									<div class="state_edit" id="billOnlineFlagCheck">										
									</div>
                                <label id="billOnlineFlag_view" class="state_view">-</label>
                            </div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="col-md-2 control-label"><strong>Institution Type&ast;</strong></label>
								<div class="col-md-6">
									<div class="state_edit">
										<select class="form-control state_edit" id="institutionType" data-error="This field is required." required>
											<option></option>
										</select>
									</div>
                                    <div class="help-block with-errors"></div>
									<label id="institutionType_view" class="state_view">-</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="col-md-2 control-label"><strong>AmountCurrency&ast;</strong></label>
								<div class="col-md-6">
									<div class="state_edit">
										<select class="form-control state_edit" id="amountCurrency" data-error="This field is required." required>
											<option></option>
										</select>
									</div>
                                    <div class="help-block with-errors"></div>
									<label id="amountCurrency_view" class="state_view">-</label>
								</div>
							</div>
						</div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Charges&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="charges" name="charges" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="15" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="charges_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
						
					</div>
                </div>
				<div class="box-header">
                        <h3 class="box-title">Billing Key</h3>
                    </div>
                    <div class="box-body">
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
	var oTable_billing;
	var instCatOption;
	var amountSelOption;
	var instTypeOption;
	var currencyOption;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        $('.table-hidden').hide();
		$('#billOnlineFlag').lc_switch();

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
                    width: "15%"
                },
                {
                    targets: 4,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 5,
                    sortable: true,
                    width: "15%"
                }
            ]
        });

        for (i = 0; i < 5; i++) {
            oTable_billing.row.add([
                '<input type="text" id="bk_name" class="form-control state_edit" style="width: 100%;" maxlength="100"><label id="bk_name_view" class="state_view">-</label>',
				'<input type="text" id="bk_nameEng" class="form-control state_edit" style="width: 100%;" maxlength="100"><label id="bk_nameEng_view" class="state_view">-</label>',
                '<input type="text" id="bk_regex" class="form-control state_edit" style="width: 100%;" maxlength="100"><label id="bk_regex_view" class="state_view">-</label>',
				'<select class="form-control state_edit" id="bk_type"><option value ="TEXTBOX">TEXTBOX</option><option value ="DROPLIST">DROPLIST</option></select><label id="bk_type_view" class="state_view">-</label>',				
				'<input type="text" id="bk_parameterType" class="form-control state_edit" style="width: 100%;" maxlength="100"><label id="bk_parameterType_view" class="state_view">-</label>',
				'<input type="text" id="bk_parameterDataMap" class="form-control state_edit" style="width: 100%;" maxlength="100"><label id="bk_parameterDataMap_view" class="state_view">-</label>',
            ]).draw(true);
        }
		
        $(document).validator().on('#form-area','submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

		

		getInstitutionCategory();
        getAmountSelection();
        getInstitutionType();
		getAmountCurrency();
        stateEdit();
		
		stateBillOnline();	

		
		
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
			var value = submit_data;
            

            var url_action = "";
            if ($('#type').val() == 'add'){
                url_action = "add";
            } else {
                url_action = "edit";
            }
            
             $.ajax({
                    url: url_action,
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

            $('#form-area').validator('validate');
            setTimeout(function(){
                if($('#form-area').validator('validate').has('.has-error').length==0){
                    $('#submit_type').val('submit');
                    stateView();
                }
            });
        });

        /*$('#submit_add').on('click', function () {
            $('#submit_type').val('submit_add');
            stateView();
        });*/

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);

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


        /*$('.back').on('click', function () {
            app.setView(id,'landing')

        });*/
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

        		
		$('.numeric').numeric({
            allowMinus: false,
            allowThouSep : false,
            allowDecSep : false,
        });
        
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
    });
	
	function getInstitutionCategory() {

        var url_action = 'search';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_INST_CAT';
		
		var value ={
				currentPage: "1",
				pageSize: "20",
				orderBy: {"code": "ASC"}
			};
			
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            type: 'json',
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
					instCatOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        instCatOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#institutionCategory').html(instCatOption);
                    $('#institutionCategory').select2({ width: '100%',placeholder: 'Select Institution Category' });				
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
	
	function getAmountSelection() {
		amountSelOption = '<option value=""></option>';
		amountSelOption += '<option value="' + 'User Input' + '">' + 'User Input' + '</option>';
		amountSelOption += '<option value="' + 'Any Payment' + '">' + 'Any Payment' + '</option>';
		amountSelOption += '<option value="' + 'Full Amount All Bills' + '">' + 'Full Amount All Bills' + '</option>';
		amountSelOption += '<option value="' + 'Full Amount Selected Bills' + '">' + 'Full Amount Selected Bills' + '</option>';
		$('#amountSelection').html(amountSelOption);
        $('#amountSelection').select2({ width: '100%',placeholder: 'Select Amount Selection' });			
    }
	function getInstitutionType() {
		instTypeOption = '<option value=""></option>';
		instTypeOption += '<option value="' + 'USER INPUT' + '">' + 'USER INPUT' + '</option>';
		instTypeOption += '<option value="' + 'FIX' + '">' + 'FIX' + '</option>';
		instTypeOption += '<option value="' + 'ANY' + '">' + 'ANY' + '</option>';
		$('#institutionType').html(instTypeOption);
        $('#institutionType').select2({ width: '100%',placeholder: 'Select Institution Type' });			
    }
	
    function getAmountCurrency() {

        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_PARAMETER';
		
		var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_CURRENCY"
        };

			
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            type: 'json',
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
					currencyOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        currencyOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#amountCurrency').html(currencyOption);
                    $('#amountCurrency').select2({ width: '100%',placeholder: 'Select Amount Currency' });				
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

	function stateBillOnline(){
			var unitCheck = '';
				unitCheck = '<input type="checkbox" id="billOnlineFlag" name="billOnlineFlag" value="Y"/>';
				$('#billOnlineFlagCheck').html(unitCheck);
				$('#billOnlineFlag').lcs_on();
			 
             $('#billOnlineFlag').lc_switch();
		}
    function getInstitutionEdit(code_id){

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

                    $('#code').val(detail.code);
                    $('#code').prop('disabled',true)
                    $('#name').val(detail.name);
                    $('#nameEng').val(detail.nameEng);
                    $('#dscp').val(detail.dscp);
                    $('#institutionCategory').val(detail.institutionCategoryCode).trigger('change');
                    $('#amountSelection').val(detail.amountSelection).trigger('change');
					$('#institutionType').val(detail.institutionType).trigger('change');
                    $('#charges').val(detail.charges);                    
                    $('#amountCurrency').val(detail.amountCurrencyCode).trigger('change');
					
					stateBillOnline();
					if(detail.billOnlineFlag=="Y"){
                       $('#billOnlineFlag').lcs_on();
                    }else{
                       $('#billOnlineFlag').lcs_off();
                    }
					
					var billingKeyList = detail.billingKeyList;
					if(billingKeyList){
                        $.each(billingKeyList, function (idx, obj){
                            $('#list_billing tr:eq('+(idx+1)+') td:eq(0)').find('#bk_name').val(obj.name);
                            $('#list_billing tr:eq('+(idx+1)+') td:eq(1)').find('#bk_nameEng').val(obj.nameEng);
                            $('#list_billing tr:eq('+(idx+1)+') td:eq(2)').find('#bk_regex').val(obj.regex);
                            $('#list_billing tr:eq('+(idx+1)+') td:eq(3)').find('#bk_type').val(obj.type);
                            $('#list_billing tr:eq('+(idx+1)+') td:eq(4)').find('#bk_parameterType').val(obj.parameterType);
							$('#list_billing tr:eq('+(idx+1)+') td:eq(5)').find('#bk_parameterDataMap').val(obj.parameterDataMap);
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
                

            }
        });

    }


        function stateEdit() {

            $('.parent_menu_name').show();

            $('input:checkbox').prop('disabled','');
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

            $('input:checkbox').prop('disabled','disabled');
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());
			var nameEng = ($('#nameEng').val() == '' ? '-' : $('#nameEng').val());
            var dscp = ($('#dscp').val() == '' ? '-' : $('#dscp').val());			
			var charges = ($('#charges').val() == '' ? '-' : $('#charges').val());
			var billOnlineFlagDisplay = ($('#billOnlineFlag').is(':checked') ? 'Yes' : 'No');
			var institutionCategoryName = ($('#institutionCategory option:selected').text() == '' ? '-' : $('#institutionCategory option:selected').text());
			var amountCurrencyName = ($('#amountCurrency option:selected').text() == '' ? '-' : $('#amountCurrency option:selected').text());
			
			var billOnlineFlag = ($('#billOnlineFlag').is(':checked') ? 'Y' : 'N');
			var institutionCategoryCode = ($('#institutionCategory option:selected').val() == '' ? '-' : $('#institutionCategory option:selected').val());
			var amountSelection = ($('#amountSelection option:selected').val() == '' ? '-' : $('#amountSelection option:selected').val());
			var institutionType = ($('#institutionType option:selected').val() == '' ? '-' : $('#institutionType option:selected').val());
			var amountCurrencyCode = ($('#amountCurrency option:selected').val() == '' ? '-' : $('#amountCurrency option:selected').val());
			
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
			
            $('#code_view').text(code);
            $('#name_view').text(name);
			$('#nameEng_view').text(nameEng);
            $('#dscp_view').text(dscp);
            $('#institutionCategory_view').text(institutionCategoryName);
            $('#amountSelection_view').text(amountSelection);
            $('#institutionType_view').text(institutionType);
            $('#amountCurrency_view').text(amountCurrencyName);
            $('#charges_view').text(charges);
            $('#billOnlineFlag_view').text(billOnlineFlagDisplay);

			var billingKeyList = [];
            $("#list_billing").find("tbody tr").each(function () {

                var bk_name = $('td:eq(0)', $(this)).find('#bk_name').val();
                $('td:eq(0)', $(this)).find('#bk_name_view').text(bk_name);
				var bk_nameEng = $('td:eq(1)', $(this)).find('#bk_nameEng').val();
                $('td:eq(1)', $(this)).find('#bk_nameEng_view').text(bk_nameEng);
				var bk_regex = $('td:eq(2)', $(this)).find('#bk_regex').val();
                $('td:eq(2)', $(this)).find('#bk_regex_view').text(bk_regex);
				var bk_type = $('td:eq(3)', $(this)).find('#bk_type').val();
                $('td:eq(3)', $(this)).find('#bk_type_view').text(bk_type);
				var bk_parameterType = $('td:eq(4)', $(this)).find('#bk_parameterType').val();
                $('td:eq(4)', $(this)).find('#bk_parameterType_view').text(bk_parameterType);
				var bk_parameterDataMap = $('td:eq(5)', $(this)).find('#bk_parameterDataMap').val();
                $('td:eq(5)', $(this)).find('#bk_parameterDataMap_view').text(bk_parameterDataMap);

                var obj = {
                    name: bk_name,
					nameEng: bk_nameEng,
                    regex: bk_regex,
                    type: bk_type,
                    parameterType: bk_parameterType,
                    parameterDataMap: bk_parameterDataMap
                };
                billingKeyList.push(obj);

            });
			
			submit_data = {
                code:code,
                name:name,
                nameEng:nameEng,
				dscp:dscp,
				charges : charges,
				billingKeyList : billingKeyList,
				billOnlineFlag : billOnlineFlag,
				billOnlineFlagDisplay: billOnlineFlagDisplay,
				institutionCategoryCode: institutionCategoryCode,
				institutionCategoryName: institutionCategoryName,
				amountSelection: amountSelection,
				amountType: amountSelection,
				institutionType: institutionType,
				amountCurrencyCode: amountCurrencyCode,
				amountCurrencyName: amountCurrencyName,
				name1:billingKeyList[0].name,
				name2:billingKeyList[1].name,
				name3:billingKeyList[2].name,
				name4:billingKeyList[3].name,
				name5:billingKeyList[4].name,
				nameEng1:billingKeyList[0].nameEng,
				nameEng2:billingKeyList[1].nameEng,
				nameEng3:billingKeyList[2].nameEng,
				nameEng4:billingKeyList[3].nameEng,
				nameEng5:billingKeyList[4].nameEng,
				regex1:billingKeyList[0].regex,
				regex2:billingKeyList[1].regex,
				regex3:billingKeyList[2].regex,
				regex4:billingKeyList[3].regex,
				regex5:billingKeyList[4].regex,
				type1:billingKeyList[0].type,
				type2:billingKeyList[1].type,
				type3:billingKeyList[2].type,
				type4:billingKeyList[3].type,
				type5:billingKeyList[4].type,
				parameterType1:billingKeyList[0].parameterType,
				parameterType2:billingKeyList[1].parameterType,
				parameterType3:billingKeyList[2].parameterType,
				parameterType4:billingKeyList[3].parameterType,
				parameterType5:billingKeyList[4].parameterType,
				parameterDataMap1:billingKeyList[0].parameterDataMap,
				parameterDataMap2:billingKeyList[1].parameterDataMap,
				parameterDataMap3:billingKeyList[2].parameterDataMap,
				parameterDataMap4:billingKeyList[3].parameterDataMap,
				parameterDataMap5:billingKeyList[4].parameterDataMap,
				
			};
			
			console.log(submit_data);
			
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