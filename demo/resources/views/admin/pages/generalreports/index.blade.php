@extends('admin.layouts.app')
@section('title')
General Reports
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<h2><i class="fa fa-columns" aria-hidden="true"></i> General Reports</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right" style="background-color: #5A8DEE;">General Reports Table</span>
				<!-- <strong>General Reports Table</strong> -->
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-6">
							<div class="widget style1 lazur-bg">
								<div class="row vertical-align">
									<div class="col-12 text-center">
										<h2 class="font-bold">Left Total <br> {{$LeftCount}}</h2>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="widget style1 lazur-bg">
								<div class="row vertical-align">
									<div class="col-12 text-center">
										<h2 class="font-bold">Right Total <br> {{$RightCount}}</h2>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 pull-left">
						<div class="table-responsive">
							<table class="table table-hover mb-0 mt-1 small-table">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>CODE</th>
                                    <th>CURRENT BALANCE</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($leftSideArray as $val)
                                <tr>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->code}}</td>
                                    <td>
                                    	@php
                                    	$jk = App\Helpers\Helper::decimalNumber($val->current_balance);
                                    	echo $jk; 
                                		@endphp
                                	</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
						</div>
					</div>


					<div class="col-md-6 pull-right">
						<div class="table-responsive">
							<table class="table table-hover mb-0 mt-1 small-table">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>CODE</th>
                                    <th>CURRENT BALANCE</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($rightSideArray as $val)
                                <tr>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->code}}</td>
                                    <td>
                                    	@php
                                    	$jk = App\Helpers\Helper::decimalNumber($val->current_balance);
                                    	echo $jk; 
                                		@endphp
                                	</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('styles')
@endsection
@section('scripts')
@endsection