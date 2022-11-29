@extends('admin.layouts.appAuth')

@section('authContent')

<style type="text/css">
	.ibox-content{
		width: 350px;
		/*height: 374px;*/
		top: 150px;
		position: absolute;
	}
</style>

<div class="ibox-content ibox-content_login">
	@if(Session::has('message'))
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-{!! Session::get('alert-type') !!}">
			{!! Session::get('message') !!}
		</div>
	</div>
</div>
@endif
	<img src="{{ url(\Settings::get('application_logo')) }}" style="height: auto;width: 20%;">
	<h2 class="font-bold">Admin Login</h2>
	<div class="row">
		<div class="col-lg-12">

			<h3>Welcome to {{Settings::get('application_title')}}</h3>	
			<form method="POST" action="{{ url('admin/login') }}">
				@csrf

				<div class="form-group">
					<input id="exampleInputEmail_2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="admin@admin.com" required autocomplete="email" placeholder="Enter Email" autofocus>
					@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group">
					<input type="password" class="form-control" value="smn@1234" required="" id="exampleInputEmail_3" placeholder="Enter Password" name="password" autocomplete="current-password">
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror

				</div>
				<div class="form-group">
					<input class="form-check-input" type="checkbox" id="termscheckd" value="remmeber_me" name="remmeber"   <?php if(isset($_COOKIE['email_cookie'])){ ?> checked <?php }  ?>> &nbsp;
					<label class="form-check-label" for="termscheckd">
						Remember me
					</label>
					
				</div>
				<button type="submit" class="btn btn-primary block full-width m-b">Login</button>

				<a href="{{ route('admin.resetPassword') }}"><small>Forgot password?</small></a>

			</form>
<!-- 			<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p> -->
		</div>
	</div>
</div>
@endsection

@section('authStyles')

@endsection

@section('authScripts')


@endsection






