

@extends('layouts.login')
@section('content')

	<div class="wrapper">
		<div class="login-image-area">
	   		<img src="{{ assets_url('images/login-bg-bank-def.jpg') }}"/>
	   	</div>

		<div class="container-fluid">
			<div class="col-xs-12 col-sm-4 col-sm-push-4">
				<div id="login-box" >
				  
				  <!-- /.login-logo -->
				  <div  class="login-box-body text-center transparent">
				  	<img src="{{ assets_url('images/def-logo-bank.png') }}"/>
				  	<h3 class="white-txt">Identity Management</h3>
				  	<p>&nbsp;</p>
				  	<p>&nbsp;</p>
					<div id="notification"></div>
					@if($errors->any())
						<div class="alert alert-danger">
			                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			                  {{$errors->first()}}
			              </div>
					@endif
			        @if(session('message'))
			              <div class="alert alert-danger">
			                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			                  {{ session('message') }}
			              </div>
			        @endif

				    <form id="login-form" action="{{ route('login.post') }}" method="post" data-toggle="validator" role="form">

				    
				      {{-- <div class="form-group has-feedback">
				      	<span class="fa fa-institution form-control-feedback"></span>
				        <input type="text" name="companyId" class="form-control" placeholder="COMPANY ID" required>
				      </div> --}}

				      <div class="form-group has-feedback">
				      	<span class="fa fa-user left-icon"></span>
				        <input type="text" id="loginId" name="loginId" class="form-control" placeholder="USER ID" required>
						  <input type="hidden" id="key" name="key">

						  <span class="form-control-feedback"></span>
				      </div>
				      <div class="form-group has-feedback">
				      	<span class="fa fa-key left-icon"></span>
				        <input type="password" id="passwd" name="passwd" class="form-control" placeholder="PASSWORD" required>
				        <span class="form-control-feedback"></span>
				      </div>
				      
				      <div class="row">
						<p>&nbsp;</p>
				        <div class="col-xs-12 login-btn-area text-center">
				          <button type="submit" class="wire-btn full">Sign In</button>
						</div>
				        <!-- /.col -->
				      </div>

				      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
				    </form>



				  </div>
				  <!-- /.login-box-body -->
				</div>
			</div>
			@include('_partials.force_chpass')
		</div>

	</div>
   
@stop

@section('scripts')
	<script>
		$(document).ready(function(){
			$('#login-form').validator({
				feedback: {
				  success: 'fa fa-check',
				  error: 'fa fa-close'
				}
			});

			$('#form-area').validator().on('submit', function (e) {
				if (e.isDefaultPrevented()) {
					// handle the invalid form...
				} else {
					// everything looks good!
					//console.log('valid')
				}
			});

			$('#login-form').on('submit', function(e){
				e.preventDefault();
				var heartbeat = '';
				$.ajax({
					url: 'heartBeat',
					method: 'post',
					async:false,
					data: {	_token : '{{ csrf_token() }}'},
					success: function (data) {
						var result = JSON.parse(data);
						heartbeat = result.heartBeat;
					},
					error: function (xhr, ajaxOptions, thrownError) {
						msgError('No Connection to Server!');
						return;
					}
				});
				//return;
				//console.log(heartbeat);
				var passwd_plain = $('#passwd').val();
				var pssswd_encrypted = CryptoJS.AES.encrypt(passwd_plain,heartbeat).toString();
				//alert(pssswd_encrypted);
				//alert(heartbeat);
				//console.log(pssswd_encrypted);
				$('#passwd').val(pssswd_encrypted);
				$('#key').val(heartbeat);
				this.submit();
				//$('#passwd').val(passwd_plain);

			});

			$('#new_pwd').keyup(function(){
				var val = $('#new_pwd').val();
				var val2 = $('#new_pwd_confirm').val();
				var upperCase= new RegExp('[A-Z]');
				var lowerCase= new RegExp('[a-z]');
				var numbers = new RegExp('[0-9]');
				var special = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
				var hasTripple = /(.)\1\1/;
				$('.valid-txt').addClass('error');
				if(val.match(upperCase)){
					$('#valid-upper').removeClass('error').addClass('valid');
				}
				if(val.match(lowerCase)){
					$('#valid-lower').removeClass('error').addClass('valid');
				}
				if(val.match(numbers)){
					$('#valid-numbers').removeClass('error').addClass('valid');
				}
				if (special.test(val)) {
					$('#valid-special').removeClass('error').addClass('valid');
				}
				if(val.length>=8){
					$('#valid-length').removeClass('error').addClass('valid');
				}
				if(!hasTripple.test(val)) {
					$('#valid-repeated').removeClass('error').addClass('valid');
				}
				
				if(val===val2){
					$('#valid-same').removeClass('error').addClass('valid');
				}

			});

			 $('#new_pwd_confirm').keyup(function(){
            var val = $('#new_pwd').val();
            var val2 = $('#new_pwd_confirm').val();
            var upperCase= new RegExp('[A-Z]');
            var lowerCase= new RegExp('[a-z]');
            var numbers = new RegExp('[0-9]');
            var special = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
            var hasTripple = /(.)\1\1/;

            $('.valid-txt').addClass('error');
            if(val.match(upperCase)){
                $('#valid-upper').removeClass('error').addClass('valid');
            }
            if(val.match(lowerCase)){
                $('#valid-lower').removeClass('error').addClass('valid');
            }
            if(val.match(numbers)){
                $('#valid-numbers').removeClass('error').addClass('valid');
            }
            if (special.test(val)) {
                $('#valid-special').removeClass('error').addClass('valid');
            }
            if(val.length>=8){
                $('#valid-length').removeClass('error').addClass('valid');
            }
            if(!hasTripple.test(val)) {
                $('#valid-repeated').removeClass('error').addClass('valid');
            }

            if(val===val2){

                $('#valid-same').removeClass('error').addClass('valid');
            }


            //console.log(special.test(val));
        });
		
			function submitData(){
				var url_action = 'forceChangePassword';
				var action = 'RESET';
				var loginId = '<?php echo Session::get('login_id') ?>';

				var heartbeat = '';
				$.ajax({
					url: 'heartBeat',
					method: 'post',
					async:false,
					data: {	_token : '{{ csrf_token() }}'},
					success: function (data) {
						var result = JSON.parse(data);
						heartbeat = result.heartBeat;
					},
					error: function (xhr, ajaxOptions, thrownError) {
						msgError('No Connection to Server!');
						return;
					}
				});
				var passwd_plain = $('#new_pwd').val();
				var pssswd_encrypted = CryptoJS.AES.encrypt(passwd_plain,heartbeat).toString();
				var passwd_old_plain = $('#current_pwd').val();
				var pssswd_old_encrypted = CryptoJS.AES.encrypt(passwd_old_plain,heartbeat).toString();
				var value = {
					"loginId": loginId,
					"oldPassword": pssswd_old_encrypted.toString(),
					"newPassword": pssswd_encrypted.toString(),
					"newPassword2": pssswd_encrypted.toString(),
					"key": heartbeat
				};
				$.ajax({
					url: 'forceChangePassword',
					method: 'post',
					data: {"_token": "{{ csrf_token() }}", action:action,url_action:url_action,menu: '', value: value},
					success: function (data) {
						$('#confirm').prop('disabled',false);
						//console.log(data);
						//return;
						var result = JSON.parse(data);
						if (result.status=="200") {
							msgSuccess(result.message);
							$('#confirm').hide();
							$('#cancel').text('Done');
							$('#form-area').hide();
							//stateSuccess();
						} else {
							//$('#submit_view').prop('disabled',false);

							msgError(result.message);
						}

					}, error: function (xhr, ajaxOptions, thrownError) {
						//$('#confirm').prop('disabled',false);
						msgError('Form Submit Failed');
						console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
					}
				});

			}

			$('#confirm').on('click', function () {
				$('#form-area').validator('validate');
				if($('#form-area').validator('validate').has('.has-error').length!=0){
					return;
				}
				if($('#new_pwd').val()==""){
					$.alert({
						title: 'Attention!',
						content: 'New Password cannot empty.'
					});
					return;
				}
				if($('#new_pwd').val()!=$('#new_pwd_confirm').val()){
					$.alert({
						title: 'Attention!',
						content: 'Confirm New Password not match.'
					});
					return;
				}
				if($('.valid-txt').hasClass('error')){
					$.alert({
						title: 'Attention!',
						content: 'Password not valid.'
					});
					return;
				}
				$(this).prop('disabled',true);

				var content='{{trans('form.confirm_chpass')}}';

				$.confirm({
					title: '{{trans('form.submit')}}',
					content: content,
					buttons: {

						cancel: {
							text: '{{trans('form.cancel')}}',
							btnClass: 'btn-default',
							action: function(){
								$('#confirm').prop('disabled',false);
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
			$('#chPassModal').on('show.bs.modal', function (e) {
				$('#confirm').show();
				$('#cancel').text('Cancel');
				$('#form-area').show();
				$(".alert").alert("close");

			})


			@if(!empty(Session::get('login_id')))
				$('#chPassModal').modal('show');
			@endif


		});
		function msgError(message) {
			$('#alerts').append(
					'<div class="alert alert-warning">' +
					'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
					message + '</div>');
		}
		function msgSuccess(message) {
			$('#alerts').append(
					'<div class="alert alert-success">' +
					'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
					message + '</div>');
		}
	</script>
@stop
