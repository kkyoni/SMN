@extends('admin.layouts.appAuth')
@section('authContent')
<style type="text/css">
.ibox-content{width: 350px; height: 425px; top: 90px; position: absolute;}
</style>
@if(Session::has('message'))
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-{!! Session::get('alert-type') !!}">
			{!! Session::get('message') !!}
		</div>
	</div>
</div>
@endif
@php
$application_title = App\Models\Setting::where('code','application_title')->where('hidden','0')->first();
$application_logo = App\Models\Setting::where('code','application_logo')->where('hidden','0')->first();
@endphp
<div class="ibox-content" style="width: 852px; box-shadow: -8px 20px 25px 0 rgb(25 42 70 / 30%);">
	<div class="row">
		<div class="col-sm-6 b-r">
			<h3 class="m-t-none m-b">Welcome Back</h3>
			<p>LOGIN WITH USERNAME</p>
			<form role="form" method="POST" action="{{ url('admin/login') }}">
				@csrf
				<div class="form-group">
					<label class="pull-left"><strong>User Name</strong></label>
					<input id="exampleInputEmail_2" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="maet1947" required autocomplete="username" placeholder="Enter username" autofocus>
					@error('username')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group">
					<label class="pull-left"><strong>Password</strong></label>
					<input type="password" class="form-control" value="123456" required="" id="exampleInputEmail_3" placeholder="Enter Password" name="password" autocomplete="current-password">
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="pull-left" style="margin-left: 20px;">
					<div class="form-group">
						<input class="form-check-input" type="checkbox" id="termscheckd" value="remmeber_me" name="remmeber"   <?php if(isset($_COOKIE['email_cookie'])){ ?> checked <?php }  ?>> &nbsp;
						<label class="form-check-label" for="termscheckd">
							Keep me logged in
						</label>
					</div>
				</div>
				<div>
					<button type="submit" class="btn btn-primary block full-width m-b">Login</button>
				</div>
			</form>
		</div>
		<div class="col-sm-6">
			<p class="text-center">
				<img src="{{ asset('images/login.png')}}" style="max-width: 100%; height: auto;">
			</p>
		</div>
	</div>
</div>
@endsection
@section('authStyles')
@endsection
@section('authScripts')
@endsection