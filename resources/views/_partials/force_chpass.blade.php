<div id="chPassModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Force Change Password</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<div id="alerts">

						</div>
						<form id="form-area" class="form-horizontal form-area">
							<input type="hidden" id="code_edit" value=""/>
							<div class="box-body">
								<div class="container-fluid">
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label"><strong>Current Password*</strong></label>
											<div class="col-md-9">
												<input type="password" id="current_pwd" name="current_pwd" class="form-control state_edit" maxlength="100" autocomplete="off" value="" data-error="This field is required." required>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label"></label>
											<div class="col-md-9">
												<div class="box-notif">
													<h6><strong>For your security, your password must alphanumeric and contains at least :</strong></h6>
													<div class="row">
														<div class="col-xs-12 col-md-6">
															<div id="valid-upper" class="valid-txt">
																<i class="fa fa-check green"></i>
																<span>1 uppercase</span>
															</div>
															<div id="valid-lower" class="valid-txt">
																<i class="fa fa-check green"></i>
																<span>1 lowercase</span>
															</div>
															<div id="valid-numbers" class="valid-txt">
																<i class="fa fa-check green"></i>
																<span>1 number</span>
															</div>
															<div id="valid-special" class="valid-txt">
																<i class="fa fa-check green"></i>
																<span>1 special character e.g space,._@!</span>
															</div>
														</div>
														<div class="col-xs-12 col-md-6">
															<div id="valid-length" class="valid-txt">
																<i class="fa fa-check green"></i>
																<span>min. 8 characters</span>
															</div>
															<div id="valid-repeated" class="valid-txt">
																<i class="fa fa-check green"></i>
																<span>no more than 2 repeated character in a row</span>
																<br/>
																<i class="fa fa-check green" style="opacity: 0"></i><span>(e.g 111 is not allowed)</span>
															</div>
															<div id="valid-same" class="valid-txt">
																<i class="fa fa-check green"></i>
																<span>repeat password matched</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label"><strong>New Password*</strong></label>
											<div class="col-md-9">
												<input type="password" id="new_pwd" name="new_pwd" class="form-control state_edit" maxlength="100" autocomplete="off" value="" data-error="This field is required." required>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label"><strong>Confirm New Password*</strong></label>
											<div class="col-md-9">
												<input type="password" id="new_pwd_confirm" name="new_pwd_confirm" class="form-control state_edit" maxlength="100" autocomplete="off" value="" data-error="Please enter the same value again." required>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">@lang('form.cancel')</button>
				<button type="button" id="confirm" name="confirm" class="btn btn-primary">@lang('form.submit')</button>
			</div>
		</div>

	</div>
</div>