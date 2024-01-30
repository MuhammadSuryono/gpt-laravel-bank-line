@include('_partials.header_content',['breadcrumb'=>['host error mapping','add']])


</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div id="notification"></div>
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Host Error Mapping Add</h3>
                    <span id="preview" class="state_view" style="color:darkred"><small><i>Preview</i></small></span>
				</div>
				<form class="form-horizontal">
					<div class="box-body">
						<div class="container-fluid">
						<div class="row">
							<div class="form-group">
								<label class="col-md-2">Code</label>
								<div class="col-md-6">
									<input type="text" id="code" name="code" class="form-control state_edit" data-validation="number">
                                    <span id="code_view" class="col-md-2 state_view">-</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="col-md-2">Name in English</label>
								<div class="col-md-6">
									<input type="text" id="name" name="name" class="form-control state_edit">
                                    <span id="name_view" class="col-md-2 state_view">-</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="col-md-2">Name in Indonesia</label>
								<div class="col-md-6">
									<input type="text" id="nameId" name="nameId" class="form-control state_edit">
                                    <span id="nameId_view" class="col-md-2 state_view">-</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="col-md-2">Roll Back</label>
								<div class="col-md-6">
									<input type="checkbox" class="form-check-input state_edit" id="rollback" name="rollback">
                                    <span id="rollback_view" class="col-md-2 state_view">-</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="col-md-2"></label>
								<div class="col-md-6 state_edit">
                                    <button type="button" id="submit_add" name="submit_add" class="btn btn-default">SUBMIT and ADD</button>
                                    <button type="button" id="submit_edit" name="submit_edit" class="btn btn-primary">SUBMIT</button>
                                    <button type="button" id="back_edit" name="back_edit" class="btn btn-default back">BACK</button>
                                </div>
                                <div class="col-md-6 state_view">
                                    <button type="button" id="submit_view" name="submit_view" class="btn btn-danger">SUBMIT</button>
                                    <button type="button" id="back_view" name="back_view" class="btn btn-default">BACK</button>
                                </div>
							</div>
						</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
    var id = 'MNU_GPCASH_MT_HOST_ERROR_MAPPING';
    var rollback = 'N';
	$(document).ready(function() {
        $.validate();

        stateEdit();
		$('#submit_view').on('click', function () {

			if($('#rollback').is(':checked')){
				rollback = 'Y';
			}
			var value = {
				"code":$('#code').val(),
				"name":$('#name').val(),
				"nameId":$('#nameId').val(),
				"rollBackFlag":rollback
			};
			$.ajax({
				url: 'add',
				method: 'post',
				data: {"_token": "{{ csrf_token() }}",menu:id,value:value},
				success: function (data) {
					result = JSON.parse(data);
					if(result.hasOwnProperty("referenceNo")){
						flash('success','ReferenceNo: '+result.referenceNo);
                        $('#submit_view').hide();
                        $('#preview').text(result.referenceNo);
                        stateSuccess();
					}else{
						flash('warning','Form Submit Failed');
					}

				}, error: function (xhr, ajaxOptions, thrownError) {
					flash('warning','Form Submit Failed');
					console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
				}
			});

		});
		$('.back').on('click', function () {

				$.ajax({
					url: 'getView/'+id,
					method: 'post',
					success: function (data) {
						$(window).scrollTop(0);
						$('#content-ajax').html(data);

					}, error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
					}
				});

		});

        $('#submit_edit').on('click', function () {
            stateView();
        });

        $('#back_view').on('click', function () {
            stateEdit();
        });

	});

    function stateEdit(){
        $('.state_view').hide();
        $('.state_edit').show();
    }

    function stateView(){

        if($('#rollback').is(':checked')){
            rollback = 'Y';
        }
        var code = ($('#code').val()==''?'-':$('#code').val());
        var name = ($('#name').val()==''?'-':$('#name').val());
        var nameId = ($('#nameId').val()==''?'-':$('#nameId').val());

        $('#preview').text('Preview');
        $('.state_edit').hide();
        $('.state_view').show();
        $('#code_view').text(code);
        $('#name_view').text(name);
        $('#nameId_view').text(nameId);
        $('#rollback_view').text(rollback);
    }

    function stateSuccess(){
        $('#code').val('');
        $('#name').val('');
        $('#nameId').val('');
        rollback = 'N';
        $('#rollback').attr('checked', false);
    }




</script>