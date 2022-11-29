@extends('admin.layouts.app')
@section('title')
Dashboard
@endsection
@section('mainContent')
@php
$application_title = App\Models\Setting::where('code','application_title')->where('hidden','0')->first();
@endphp
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><i class="fa fa-home" aria-hidden="true"></i> Dashboard</h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-vehicles_count bg-darken-2">
                            <i class="fa fa-credit-card-alt fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-vehicles_count white media-body">
                            <h3>Branches</h3>
                            <h5 class="text-bold-400 mb-0"> {{$totalUser}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.branches.index')  }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($isAdmin == 1)
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch" style="height:98px;">
                        <div class="p-2 text-center bg-todayBooking_count bg-darken-2">
                            <i class="fa fa-credit-card-alt fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-todayBooking_count white media-body">
                            <h3>Profit</h3>
                            <h5 class="text-bold-400 mb-0">{{$currentBalance}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch" style="height:98px;">
                        <div class="p-2 text-center bg-review_count bg-darken-2">
                            <i class="fa fa-credit-card-alt fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-review_count white media-body">
                            <h3>Expenses</h3>
                            <h5 class="text-bold-400 mb-0">{{$totalExpenses}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch" style="height:98px;">
                        <div class="p-2 text-center bg-user_count bg-darken-2">
                            <i class="fa fa-credit-card-alt fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-user_count white media-body">
                            <h3>Total Profit</h3>
                            <h5 class="text-bold-400 mb-0">{{$currentBalance - $totalExpenses}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="form-inline">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    {!! Form::select('user_id',$branches_list,null,['class' => 'select2_demo_1 form-control','id' => 'sender_name','placeholder'=>'Select Branches']) !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::select('user_id',$branches_list,null,['class' => 'select2_demo_2 form-control get_name','id' => 'recevice_name','placeholder'=>'Select Branches']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary btn-sm" id="report">Filter</button>
                                </div>
                            </div>
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
</div>
@endsection
@section('styles')
<style type="text/css">
h3{font-size: 13px;}
.ibox-content{background-color:#fff; border: none; border-style:none !important;}
.wrapper-content{padding: 20px 10px 40px;}
.white{color:#FFF;}
.white:hover{color:#FFF;}
.bg-user_count {background-color: #00A5A8 !important;}
.bg-gradient-x-user_count {background-image: linear-gradient(to right, #00A5A8 0%, #4DCBCD 100%); background-repeat: repeat-x;}
.bg-todayBooking_count {background-color: #10C888 !important;}
.bg-gradient-x-todayBooking_count {background-image: linear-gradient(to right, #10C888 0%, #5CE0B8 100%); background-repeat: repeat-x;}
.bg-vehicles_count {background-color: #4b5ff1!important;}
.bg-gradient-x-vehicles_count {background-image: linear-gradient(to right, #4b5ff1 0%, #6CDDEB 100%); background-repeat: repeat-x;}
.bg-review_count {background-color: #fcbe03!important;}
.bg-gradient-x-review_count {background-repeat: repeat-x; background-image: linear-gradient(to right, #fcbe03 0%, #fdd868 100%);}
.card{color:#FFF!important; font-weight: 600!important; font-size: 1.14rem!important;}
.p-2 {padding: 1rem!important;}
.fa-3x {font-size: 3em;}
</style>
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
    $(".select2_demo_2").select2({
        placeholder: "Select Branches",
        allowClear: true
    });
    $(document).on("click","a.checktransactions",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e69a2a",
            confirmButtonText: "Yes, Accept Transaction it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:"{{route('admin.acceptTransaction',[''])}}"+"/"+id,
                    type: 'post',
                    data: {"_token": "{{ csrf_token() }}"
                },
                success:function(msg){
                    if(msg.status == 'success'){
                    swal({title: "Deleted",text: "Delete Record success",type: "success"}, function(){
                        location.reload();
                    });
                }else{
                    swal("Warning!", msg.message, "warning");
                }
            },error:function(){
                swal("Error!", 'Error in Accept Transaction Record', "error");
            }
        });
            } else {
                swal("Cancelled", "Your Accept Transactions is safe :)", "error");
            }
        });
        return false;
    })

    $(document).on("click","a.deleteaccepttransactions",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e69a2a",
            confirmButtonText: "Yes, Accept Transaction it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:"{{route('admin.destroyTransaction',[''])}}"+"/"+id,
                    type: 'post',
                    data: {"_token": "{{ csrf_token() }}"
                },
                success:function(msg){
                    if(msg.status == 'success'){
                    swal({title: "Deleted",text: "Delete Record success",type: "success"},function(){
                        location.reload();
                    });
                }else{
                    swal("Warning!", msg.message, "warning");
                }
            },error:function(){
                swal("Error!", 'Error in Accept Transaction Record', "error");
            }
        });
            } else {
                swal("Cancelled", "Your Accept Transactions is safe :)", "error");
            }
        });
        return false;
    })
</script>
<script type="text/javascript">
    $(document).on('click','#report',function (event) {
        window.LaravelDataTables["dataTableBuilder"].ajax.reload();
    });
</script>
@endsection