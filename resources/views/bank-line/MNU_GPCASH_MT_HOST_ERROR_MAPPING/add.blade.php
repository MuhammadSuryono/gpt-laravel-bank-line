@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                
                <div class="box-header">
                     <h3 class="box-title">Language Mapping Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Code&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="code_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>English Language&ast;</strong></label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="name_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="form-group ">
                                <label class="col-md-2 control-label"><strong>Local Language&ast;</strong></label>

                                <div class="col-md-6">
                                    <input type="text" id="nameId" name="nameId" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="nameId_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="form-group">
								<label class="col-md-2 control-label">Type</label>
								<div class="col-md-6">
									<div class="state_edit">
										<input type="radio" id="typeSucess-rb" name="type-rb" value="N" checked>
										<label for="typeSucess-rb">Success Message</label>
									</div>
									<div class="state_edit">										
											<input type="radio" id="typeError-rb" name="type-rb" value="Y">
											<label for="typeError-rb">Error Message</label>
                                    </div>
									<div class="help-block with-errors"></div>
									<label id="type_view" class="state_view"></label>
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="form-group">
                                <label class="col-md-2 control-label">Rollback</label>
                                <div class="col-md-6">
									<div class="state_edit" id="rollbackCheck">
										
									</div>
                                <label id="isRollback_view" class="state_view">-</label>
                            </div>
							</div>
						</div>	
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

</section>

<script>
    var oTable;
    var currencyOption;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
		$('#isRollback').lc_switch();
        $('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        var submit_data;
       
        stateEdit();
		stateRollback();	
		
		$('input[name="type-rb"]').on('click', function () {
			 stateRollback();	
		});
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
		
            var value = {
                "code": $('#code').val(),
                "name": $('#name').val(),
				"nameId": $('#nameId').val(),
				"errorFlag": $('input[name="type-rb"]:checked').val(),
				"rollbackFlag" : ($('#isRollback').is(':checked') ? 'Y' : 'N')		
            };
            if ($('#type').val() == 'add'){
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
        }

        $('#confirm').on('click', function () {
            $('#form-area').validator('validate');
            if($('#form-area').validator('validate').has('.has-error').length!=0){
                return;
            }
            setTimeout(function(){
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

         $('#code').alphanum({
            allowSpace: false,
            allow : '-'
        });
         
    });
       

        function getMappingEdit(code_id) {
            
			var value ={
				code:code_id,
				name:'',
				currentPage: "1",
				pageSize: "20",
				orderBy: {"code": "ASC"}
			};
            var url_action= 'search';
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
						var detail = data.result[index];
                        $('#code').val(detail.code);
                        $('#code').attr('readonly', true);
						$('#name').val(detail.name);
                        $('#nameId').val(detail.nameId);
						if(detail.errorFlag == "Y"){
							$('#typeError-rb').attr('checked',true);
						}else{
							$('#typeSuccess-rb').attr('checked',true);
						}
						stateRollback();
						
						if(detail.rollbackFlag=="Y"){
                            $('#isRollback').lcs_on();
                        }else{
                            $('#isRollback').lcs_off();
                        }
						
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
                   
                }
            });
        }

		function stateRollback(){
			var unitCheck = '';
			if($('input[name="type-rb"]:checked').val() == 'Y'){
				unitCheck = '<input type="checkbox" id="isRollback" name="isRollback" value="Y"/>';
				$('#rollbackCheck').html(unitCheck);
				$('#isRollback').lcs_on();
			 }else if($('input[name="type-rb"]:checked').val() == 'N'){
				unitCheck = '<input type="checkbox" id="isRollback" name="isRollback" disabled value="N"/>';
				$('#rollbackCheck').html(unitCheck);
			 }
			 
             
             $('#isRollback').lc_switch();
		}
        function stateEdit() {
            $('#save_screen').hide();
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('.help-block').show();
            $('label.state_view').text('-');     
            $('#done').hide();
            $('#next_user').hide();
          
        }

        function stateView() {
            $('#state').val('view');
            $('#save_screen').hide();
            $('.help-block').hide();

            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());
			var nameId = ($('#nameId').val() == '' ? '-' : $('#nameId').val());
			var type = ($('input[name="type-rb"]:checked').val() == 'Y' ? 'Error Message' : 'Success Message');
			var isRollback = ($('#isRollback').is(':checked') ? 'Yes' : 'No');
			
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);
			$('#nameId_view').text(nameId);
			$('#type_view').text(type);
			$('#isRollback_view').text(isRollback);            
            $('#done').hide();
            $('#next_user').hide();


        }

        function stateSuccess() {
            $('#state').val('success');
            $('#name').val('');
			$('#code_1').val('');
            $('input.state_edit').val('');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }





</script>