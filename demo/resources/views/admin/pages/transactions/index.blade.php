@extends('admin.layouts.app')
@section('title')
Transactions
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<h2><i class="fa fa-th-large" aria-hidden="true"></i> Transactions</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right" style="background-color: #5A8DEE;">Transactions Table</span>
				<!-- <strong>Transactions Table</strong> -->
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-content">
					<div class="form-inline">
						<div class="form-group">
							<div class="col-sm-3">
								{!! Form::select('user_id',$branches_list,null,[
								'class' => 'select2_demo_1 form-control get_name',
								'id'    => 'name',
								'placeholder'=>'Select Branches'
								]) !!}
							</div>
						</div>
					</div>
					<div class="col-md-12 text-right">
						<a class="btn btn-primary btn-sm pull-right mb-3 op-btn them" href="{{route('admin.transactions.create')}}">
							<i class="icon-plus fa-fw"></i>Add Transactions
						</a>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-12">
						<div class="table-responsive">
							{!! $html->table(['class' => 'table table-striped table-bordered dt-responsive'], true) !!}
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
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
{!! $html->scripts() !!}
<script type="text/javascript">
	$(".select2_demo_1").select2({
        placeholder: "Select Branches",
        allowClear: true
    });
	$(document).on("click","a.deletetransactions",function(e){
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
					url:"{{route('admin.transactions.delete',[''])}}"+"/"+id,
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
				swal("Cancelled", "Your Transactions is safe :)", "error");
			}
		});
		return false;
	})
</script>
<script type="text/javascript">
	$(document).on('click','#report',function (event) {
		window.LaravelDataTables["dataTableBuilder"].ajax.reload();
	});
	$(document).on('change','.get_name',function (event) {
		window.LaravelDataTables["dataTableBuilder"].ajax.reload();
	});
</script>

@endsection