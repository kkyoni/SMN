@extends('admin.layouts.appAuth')

@section('authContent')

<style type="text/css">
	.ibox-content{
		width: 350px;
		height: 300px;
		top: 150px;
		position: absolute;
	}
	.alert{
		position:absolute;                  
		top:80px;
		left: 16%;                                  
	}
</style>
@php
$application_title = App\Models\Setting::where('code','application_title')->where('hidden','0')->first();
$application_logo = App\Models\Setting::where('code','application_logo')->where('hidden','0')->first();
@endphp
<div class="row">

	<div class="col-md-12">
		@if(Session::has('message'))
		<div class="row">
			<div class="col-lg-12">
				<div class=" alert alert-{!! Session::get('alert-type') !!}">
					{!! Session::get('message') !!} 
				</div>
			</div>
		</div>
		@endif
		<div class="ibox-content ibox-content_login">
		@if(!empty(@$application_logo->value))
        <img src="{!! @$application_logo->value !== '' ? asset("storage/setting/".@$application_logo->value) : asset('storage/default.png') !!}" style="height: auto;width: 20%; ">
        @else
        <img src="{!! asset('storage/setting/default.png') !!}" style="height: auto;width: 20%; ">
        @endif
			<h2 class="font-bold">Forgot password</h2>

			<div class="row">

				<div class="col-lg-12">
					<h3>{{@$application_title->value}}</h3>	
					<form class="m-t" role="form" method="POST" action="{{ route('admin.sendLinkToUser') }}">
						@csrf
						<div class="form-group">
							<input type="email"  name="email" class="form-control" placeholder="Email address" required="">

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<button type="submit" class="btn btn-primary block full-width m-b">Send new password</button>

					</form>
					<a href="{{route('admin.login')}}">{{ __('Back to login') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('authStyles')

@endsection

@section('authScripts')


@endsection






