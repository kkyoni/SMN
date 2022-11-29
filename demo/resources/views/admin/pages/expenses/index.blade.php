@extends('admin.layouts.app')
@section('title')
Expenses
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<h2><i class="fa fa-th-large" aria-hidden="true"></i> Expenses</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right all_backgroud">Expenses Table</span>
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
						<div class="col-sm-4 m-b-xs">
							{!! Form::select('user_id',$branches_list,null,[
							'class' => 'select2_demo_1 form-control get_name',
							'id'    => 'name',
							'placeholder'=>'Select Branches'
							]) !!}
						</div>
					</div>
					<div class="col-md-12 text-right">
						<a class="btn btn-primary btn-sm pull-right mb-3 op-btn them" href="{{route('admin.expenses.create')}}">
							<i class="icon-plus fa-fw"></i>
							Add Expenses
						</a>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-12">
						<div class="table-responsive">
							{!! $html->table(['class' => 'table table-striped table-bordered table-hover dataTables-example dataTable'], true) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('styles')
<style>
table.dataTable{width:100% !important;}
input, textarea, select, button, meter, progress {height: 2.05rem; width: 75px; display: inline-block; background-color: #FFFFFF; background-image: none; border: 1px solid #e5e6e7; border-radius: 1px; color: inherit; padding: 6px 12px; transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;}
</style>
<link rel="stylesheet" type="text/css"  href="{{ asset('new/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css"  href="{{ asset('new/buttons.dataTables.min.css') }}" />
@endsection
@section('scripts')
<script src="{{ asset('new/jszip.min.js') }}"></script>
<script src="{{ asset('new/pdfmake.min.js') }}"></script>
<script src="{{ asset('new/vfs_fonts.js') }}"></script>
<script src="{{ asset('new/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('new/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('new/buttons.flash.min.js') }}"></script>
<script src="{{ asset('new/buttons.html5.min.js') }}"></script>
<script src="{{ asset('new/buttons.print.min.js') }}"></script>
{!! $html->scripts() !!}
<script type="text/javascript">
	$(document).on("click","a.deleteexpenses",function(e){
		var row = $(this);
		var id = $(this).attr('data-id');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this record",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#e69a2a",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm){
			if (isConfirm) {
				$.ajax({
					url:"{{route('admin.expenses.delete',[''])}}"+"/"+id,
					type: 'post',
					data: {"_token": "{{ csrf_token() }}"
				},
				success:function(msg){
					if(msg.status == 'success'){
						swal({title: "Deleted",text: "Delete Record success",type: "success"},
							function(){
								location.reload();
							});
					}else{
						swal("Warning!", msg.message, "warning");
					}
				},
				error:function(){
					swal("Error!", 'Error in delete Record', "error");
				}
			});
			} else {
				swal("Cancelled", "Your Expenses is safe :)", "error");
			}
		});
		return false;
	})
</script>
<script type="text/javascript">
	$(document).on('change','.get_name',function (event) {
		window.LaravelDataTables["dataTableBuilder"].ajax.reload();
	});
</script>
@endsection