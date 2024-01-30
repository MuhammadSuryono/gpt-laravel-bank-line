<?php echo $__env->make('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                
                <div class="box-header">
                     <h3 class="box-title"><label id="modelName_1"></label> Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
				<input type="hidden" id="modelCode" value=""/>
				<input type="hidden" id="modelName" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Code&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit codeVal" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="code_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Name&ast;</strong></label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="name_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="form-group ">
                                <label class="col-md-2 control-label">Description</label>

                                <div class="col-md-6">
                                    <input type="text" id="dscp" name="dscp" class="form-control state_edit" autocomplete="off" value="" maxlength="100">
                                    <div class="help-block with-errors"></div>
                                    <label id="dscp_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>												
						<div class="row stateParent">
							<div class="form-group">
                                <label class="col-md-2 control-label" id="parentLabel"></label>
                                <div class="col-md-6">
									<div class="state_edit">
										<select class="form-control" id="parentCode">
											<option></option>
										</select>
									</div>
                                <label id="parent_view" class="state_view">-</label>
                            </div>
							</div>
						</div>	
					</div>
				</div>
                </form>
                    
                <div class="box-footer">
                    <div class="col-md-12 state_edit text-center">
                        <button type="button" id="back" name="back" class="btn btn-default back float-left"><?php echo app('translator')->get('form.cancel'); ?></button>
                        <button type="button" id="confirm" name="confirm" class="btn btn-primary float-right "><?php echo app('translator')->get('form.confirm'); ?></button>
                    </div>
                    <div class="col-md-12 state_view text-center" data-html2canvas-ignore="true">
                        <div class="float-left">
                            <button type="button" id="back_view" name="back_view" class="btn btn-default"><?php echo app('translator')->get('form.cancel'); ?></button>
                            <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();"><?php echo app('translator')->get('form.save_pdf'); ?></button>
                        </div>
                        <div class="float-right" style="display:inline;">
                            <button type="button" id="next_user" name="next_user" class="btn btn-info"><?php echo app('translator')->get('form.next_user'); ?></button>
                            <button type="button" id="done" name="done" class="btn btn-primary" style="display:none"><?php echo app('translator')->get('form.done'); ?></button>
                            <button type="button" id="submit_view" name="submit_view" class="btn btn-primary"><?php echo app('translator')->get('form.submit'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo $__env->make('_partials.next_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var id = '<?php echo e($service); ?>';
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

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content ='';
            if ($('#type').val() == 'add'){
                content='<?php echo e(trans('form.confirm_add')); ?>';
            }else{
                content='<?php echo e(trans('form.confirm_edit')); ?>';
            }

            $.confirm({
                title: '<?php echo e(trans('form.submit')); ?>',
                content: content,
                buttons: {
                    
                    cancel: {
                        text: '<?php echo e(trans('form.cancel')); ?>',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '<?php echo e(trans('form.confirm')); ?>',
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
				"dscp": $('#dscp').val(),
				"modelCode": $('#modelCode').val(),				
				"parentCode": $('#parentCode').val(),
				"modelName": $('#modelName').val(),
				"parentLabel": $('#parentLabel').text(),
				"parentName": $('#parent_view').text(),				
            };
            if ($('#type').val() == 'add'){
                $.ajax({
                    url: 'add',
                    method: 'post',
                    data: {"_token": "<?php echo e(csrf_token()); ?>", menu: id, value: value},
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
                    data: {"_token": "<?php echo e(csrf_token()); ?>", menu: id, value: value},
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
                var modelName = $('#modelName').val();
				var modelCode = $('#modelCode').val();
				var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
					$('#modelName').val(modelName);
					$('#modelCode').val(modelCode);
                    getDetail();
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


        $('.codeVal').alphanum({
            allowSpace: false,
            allow : '-'
        });

        $('input[type="text"]').not('.codeVal').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });
       

        function getMappingEdit(code_id) {      
			$('#modelName_1').text($('#modelName').val());		
			var value ={
				code:code_id,
				name:'',
				modelCode:$('#modelCode').val(),
				currentPage: "1",
				pageSize: "20",
				orderBy: {"code": "ASC"}
			};
            var url_action= 'searchModel';
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
                    _token : '<?php echo e(csrf_token()); ?>'
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.status=="200") {
						var index = data.result.map(function(o) { return o.code; }).indexOf(code_id.toString());
						var detail = data.result[index];
                        $('#code').val(detail.code);
                        $('#code').attr('readonly', true);
						$('#name').val(detail.name);
                        $('#dscp').val(detail.dscp);
						if(detail.parentCode){
							$('.stateParent').show();
							$('#parentLabel').text(detail.parentLabel);
							getParentCodeDroplist(detail.parentModelCode,detail.parentCode);					
							
						}else{
							$('.stateParent').hide();
						}
                        stateEdit();
                    } else {
                        flash('warning', data.message);
                    }


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '<?php echo e(trans('form.conn_error')); ?>';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {
                   
                }
            });
        }
		
		function getMappingAdd(parentModelCode,parentLabel) {
			$('#modelName_1').text($('#modelName').val());
			if(parentModelCode){
				$('.stateParent').show();
				$('#parentLabel').text(parentLabel);
				getParentCodeDroplist(parentModelCode);								
			}else{
				$('.stateParent').hide();
			}
		
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
			var dscp = ($('#dscp').val() == '' ? '-' : $('#dscp').val());
			var parentName = $('#parentCode').find(':selected').attr('data-name');
			
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);
			$('#dscp_view').text(dscp);
			$('#parent_view').text(parentName); 
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

		function getParentCodeDroplist(modelCode,parentCode) {
			var menu = '<?php echo e($service); ?>';
			var value = {
				code: "",
				name: "",
				modelCode:modelCode
			};
			var url_action = 'searchModelForDroplist';
			var action = 'SEARCH';
			var menu = menu;
			$.ajax({
				url: 'getAPIData',
				method: 'post',
				data: {
					value : value,
					menu : menu,
					url_action : url_action,
					action : action,
					_token : '<?php echo e(csrf_token()); ?>'
				},
				success: function (data) {
					var result = JSON.parse(data);
					if (result.status=="200") {
						unitOption = '';
						$.each(result.result, function (idx, obj) {
							unitOption += '<option value="'+ obj.code +'"data-name = "'+obj.name+'">'+ obj.name + '</option>';
						});
						$('#parentCode').html(unitOption);
						$('#parentCode').select2();	
						if(parentCode){
							$('#parentCode').val(parentCode).trigger('change');
						}
					} else {
						flash('warning', result.message);
					}


				}, error: function (xhr, ajaxOptions, thrownError) {
					var msg = '<?php echo e(trans('form.conn_error')); ?>';
					flash('warning', msg);
					console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
				}, complete: function (data) {

				}
			});
		}



</script><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/bank-line/MNU_GPCASH_MT_PARAMETER/add.blade.php ENDPATH**/ ?>