@php
$application_logo = App\Models\Setting::where('code','application_logo')->where('hidden','0')->first();
$favicon_logo = App\Models\Setting::where('code','favicon_logo')->first();
@endphp
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Coming Soon</title>
@if(!empty(@$favicon_logo->value))
	<link rel="icon" href="{!! @$favicon_logo->value !== '' ? asset("storage/setting/".@$favicon_logo->value) : asset('storage/default.png') !!}" type="image/gif" sizes="16x16">
	@else
	<link rel="icon" href="{!! asset('storage/setting/default.png') !!}" type="image/gif" sizes="16x16">
	@endif
<link rel="stylesheet" href="{{ asset('assets/front/js/main.css') }}" media="all">
<script src="{{ asset('assets/front/js/jquery-1.12.4.min.js') }}"></script>
</head>
<body class="">
	<div id="page">
		<header class="site-header light-color">
			<div class="container">
				<div class="row align-items-center justify-content-between">
					<div class="logo-block col-auto">
						<div class="site-logo">
							<a href="#">
								@if(!empty(@$application_logo->value))
        <img class="light" src="{!! @$application_logo->value !== '' ? asset("storage/setting/".@$application_logo->value) : asset('storage/default.png') !!}" alt="Somo">
        @else
        <img class="light" src="{!! asset('storage/setting/default.png') !!}" alt="Somo">
        @endif
								
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<section class="banner-area coming-soon-banner bsl-left">
			<div class="banner-item">
				<div class="bg-overlay">
					<div class="image" style="background-image: url(assets/front/img/backgroud.jpg);">
					</div>
				</div>
				<div class="container" style="text-align: center;">
					<div class="row align-items-center full-height" style="height: 237px;">
						<div class="col-12">
							<div class="heading-block" style="color:#FFF">
								<div class="h h2">Coming Soon</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<script src="{{ asset('assets/front/js/swiper.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/scripts.js') }}"></script>
</body>
</html>