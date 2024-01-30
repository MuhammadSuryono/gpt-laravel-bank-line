@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'Detail']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="pendingTaskId" value=""/>
			<form class="form-horizontal">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Activity Detail</h3><br>
					</div>
                
					<div class="box-body">
						<div class="container-fluid">						
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Activity By</label>
									<div class="col-md-6">
										<label id="activityBy">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Activity Date</label>
									<div class="col-md-6">
										<label id="activityDate">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Reference Number</label>
									<div class="col-md-6">
										<label id="refNo">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Menu</label>
									<div class="col-md-6">
										<label id="menuName">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Activity</label>
									<div class="col-md-6">
										<label id="activityType">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-6">
										<label id="statusActivity">-</label>
									</div>
								</div>
							</div>						
						</div>
					</div>

					<div id="detailDiv"></div>

					<div class="box-footer">
						<div class="state_view" data-html2canvas-ignore="true">
							<div class="float-left">
								<button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
							</div>
							<div class="float-right">
								<button type="button" id="save_screen" name="save_screen" class="btn btn-default" onclick="save_pdf();">@lang('form.save_pdf')</button>
							</div>
						</div>
					</div>
				</div>
            </form>
        </div>
    </div>

</section>

<script>
    var noRef = 'OT'+$('#refNo').val();
	var id = '{{ $service }}';
    $(document).ready(function () {

		$('.back').on('click', function () {
            res = app.setView(id,'landing');
        });
    });

	function getMenuDetail(menuCode){
		$.ajax({
            url: 'getViewWithURL',
            method: 'post',
            data: {
                viewURL : id + '.partial.' +  menuCode
            },
            success: function (data) {
				
				$('#detailDiv').html(data);	
			
            }, error: function (xhr, ajaxOptions, thrownError) {               
            }
        });
	}
</script>