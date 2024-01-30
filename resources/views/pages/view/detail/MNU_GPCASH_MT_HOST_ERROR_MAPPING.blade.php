@include('_partials.header_content',['breadcrumb'=>['Ongoing Task','Host Error Mapping']])

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div id="notification"></div>
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Host Error Mapping</h3>
				</div>
				<form class="form-horizontal">
					<div class="box-body">
						<div class="container-fluid">
							<div id="notification"></div>
							<input type="hidden" id="referenceNo" value=""/>
							<input type="hidden" id="taskId" value=""/>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3">Code</label>
									<div class="col-md-3">
										<span id="code">-</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3">Name in English</label>
									<div class="col-md-3">
										<span id="name">-</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3">Name in Indonesia</label>
									<div class="col-md-3">
										<span id="nameId">-</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3">RollBack</label>
									<div class="col-md-3">
										<span id="rollback">-</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3">Inactive</label>
									<div class="col-md-3">
										<span id="inactive">-</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3">System</label>
									<div class="col-md-3">
										<span id="system">-</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3">Created By</label>
									<div class="col-md-3">
										<span id="created_by">-</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">Updated By</label>
									<div class="col-md-3">
										<span id="updated_by">-</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3">Created Date</label>
									<div class="col-md-3">
										<span id="created_date">-</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">Updated Date</label>
									<div class="col-md-3">
										<span id="updated_date">-</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<button type="button" id="approve" name="approve" class="btn btn-success">APPROVE</button>
										<button type="button" id="reject" name="reject" class="btn btn-danger">REJECT</button>
										<button type="button" id="back" name="back" class="btn btn-default back">BACK</button>

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

	$(document).ready(function() {

		$('.back').on('click', function () {
			$.ajax({
				url: 'getView/MNU_GPCASH_PENDING_TASK',
				method: 'post',
				success: function (data) {
					$(window).scrollTop(0);
					$('#content-ajax').html(data);


				}, error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
				}
			});
		});

		$('#approve').on('click', function () {
			approve();
		});

	});

	function getData(){
		var id = 'MNU_GPCASH_PENDING_TASK';
		var value = {
			"referenceNo": $('#referenceNo').val()
		};
		var action = 'DETAIL';
		$.ajax({
			url: 'detail',
			method: 'post',
			data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'detailPendingTask',action:action},
			success: function (data) {
				data = JSON.parse(data);
				var details = data.details;
				$('#code').text(details.code);
				$('#name').text(details.name);
				$('#nameId').text(details.nameId);
				$('#rollback').text(details.rollBackFlag);

			}, error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
			},
			complete: function () {
			}
		});
	}

	function approve(){
		var id = 'MNU_GPCASH_PENDING_TASK';
		var value = {
			"referenceNo": $('#referenceNo').val(),
			"taskId": $('#taskId').val()
		};
		var action = 'APPROVE';
		$.ajax({
			url: 'detail',
			method: 'post',
			data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'approve',action:action},
			success: function (data) {
				result = JSON.parse(data);
				if(result.hasOwnProperty("referenceNo")){
					flash('success','ReferenceNo: '+result.referenceNo);
				}else{
					flash('warning','Task Approve Failed');
				}

			}, error: function (xhr, ajaxOptions, thrownError) {
				flash('warning','Task Approve Failed');
				console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
			}
		});
	}

</script>