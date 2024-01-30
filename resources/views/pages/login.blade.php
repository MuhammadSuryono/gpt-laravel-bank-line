

@extends('layouts.login')
@section('content')
{{ session('message') }}
	
	<div class="wrapper">
		<div class="login-image-area">
	   		<img src="{{ assets_url('images/login-bg-def.jpg') }}"/>
	   	</div>

		<div class="container-fluid">
			<div class="col-xs-12 col-sm-5 col-sm-push-7">
				<div id="login-box" >

				  <!-- /.login-logo -->
				  <div  class="login-box-body">
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
				        <input type="text" name="loginId" class="form-control" placeholder="USER ID" required>
				        <span class="form-control-feedback"></span>
				      </div>
				      <div class="form-group has-feedback">
				      	<span class="fa fa-key left-icon"></span>
				        <input type="password" name="passwd" class="form-control" placeholder="PASSWORD" required>
				        <span class="form-control-feedback"></span>
				        <div class="text-right">
					      	<a href="" class="small-btn-txt">forget password?</a>
					      </div>
				      </div>
				      
				      <div class="row">
						<div class="col-xs-6 login-btn-area">
							<div class="col-xs-6 no-padding">
							  <input type="radio" id="radio-en" name="language" value="en" checked="checked" />
							  <label for="radio-en" class="wire-btn full">ENG</label>
							</div>

							<div class="col-xs-6 no-padding">
							 <input type="radio" id="radio-id" name="language" value="id" />
							 <label for="radio-id" class="wire-btn full">IND</label>
							</div>
						</div>
				        <!-- /.col -->
				        <div class="col-xs-6 login-btn-area text-center">
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
			
		</div>

		<div class="container-fluid">

			<div class="col-sm-12 col-sm-6">
				<div id="home-left-area">
					<h1>Welcome to</h1>
					<h2 class="yellow-txt">bank bjb cash management</h2>
					<h2>enjoy banking with us securely and safely</h2>
					<p>&nbsp;</p>
					<p>To ensure you are the only person that knows your personal access information, all access to your computer and banking information should not be written down or accessible to other persons. Keep your Company ID, User ID and Password secret. Do not disclose your credential to anyone, including Bank.</p>
				</div>
			</div>
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
			})
		})
	</script>
@stop
