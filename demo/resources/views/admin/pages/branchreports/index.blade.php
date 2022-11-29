@extends('admin.layouts.app')
@section('title')
Branch Reports
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<h2><i class="fa fa-columns" aria-hidden="true"></i> Branch Reports</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item active">
                <span class="label label-success float-right" style="background-color: #5A8DEE;">Branch Reports Table</span>
				<!-- <strong>Branch Reports Table</strong> -->
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
                            <div class="col-sm-12">
                                {!! Form::select('branch_id',$branches_list,null,[
                                'class' => 'select2_demo_1 form-control',
                                'id'    => 'branch_id',
                                'placeholder'=>'Select Branches'
                                ]) !!}
                                <span class="help-block">
                                    <font color="red"> {{ $errors->has('branch_id') ? "".$errors->first('branch_id')."" : '' }} </font>
                                </span>
                            </div>
                        </div>
                        <!-- <input type="text" name="from_date" value="2021-07-26" id="from_date">
                        <input type="text" name="to_date" value="2021-07-27" id="to_date"> -->
                        <div class="col-sm-3" id="data_1">
        <div class="input-group date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input type="text" class="form-control" name="from_date" value="<?php echo date("Y/m/d") ?>" id="from_date">
        </div>
        <span class="help-block">
            <font color="red"> {{ $errors->has('from_date') ? "".$errors->first('from_date')."" : '' }} </font>
        </span>
    </div>

    <div class="col-sm-3" id="data_1">
        <div class="input-group date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input type="text" class="form-control" name="to_date" value="<?php echo date("Y/m/d") ?>" id="to_date">
        </div>
        <span class="help-block">
            <font color="red"> {{ $errors->has('to_date') ? "".$errors->first('to_date')."" : '' }} </font>
        </span>
    </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-sm" id="report">Filter</button>
                            </div>
                        </div>
                    </div>

					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-hover mb-0 mt-1 small-table" id="dataTableBuilder" class='display dataTable'>
                            <thead>
                                <tr>
                                    <th>TOKEN</th>
                                    <th>DATE</th>
                                    <th>CREDIT</th>
                                    <th>DEBIT</th>
                                    <th>CLOSING BALANCE</th>
                                    <th>TO PARTY</th>
                                </tr>
                            </thead>
                             <tbody>
                                @if(sizeof($records) > 0)
                                <tr>
                                    <td colspan="2">Opening Balance</td>
                                    <td>0</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach($records as $val)
                                
                                <tr>
                                    <td> {{$val['id']}} </td>
                                    <td> {{$val['created_at']}} </td>
                                    <td>
                                        <span>{{$val['amount']}}</span>
                                    </td>
                                    <td>
                                        <span>{{$val['amount']}}</span>
                                    </td>
                                    <td>
                                        <span>{{$val['from_closing_balance']}}</span>
                                        <!-- <span>{{$val['to_closing_balance']}}</span> -->
                                    </td>
                                    <td>
                                        <!-- <span>{{$val['from_branch_name']}}</span> -->
                                        <span>{{$val['to_branch_name']}}</span>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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
<script type="text/javascript">
    $(".select2_demo_1").select2({
        placeholder: "Select Branches",
        allowClear: true
    });
    var mem = $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        format: "yyyy/mm/dd",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    $(document).on("click","#report",function(e){
    var branch_id = $("#branch_id").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    $.ajax({
      url:"{{ route('admin.branchreports.report') }}",
      type: 'post',
      data: {"_token": "{{ csrf_token() }}", branch_id: branch_id, from_date: from_date, to_date: to_date},
      success:function(result){
        // if(msg.status == 'success'){
            // var markup = '';
            // $.each(result, function(key, value) {
            //                  markup += '<tr> <td>' + value.id + '</td> </tr>';

            //             });
            // window.LaravelDataTables["dataTableBuilder"].ajax.reload();
            // $('table[id="dataTableBuilder"]').html(markup);
            alert("sucess");
        // window.LaravelDataTables["dataTableBuilder"].ajax.reload();
        // } else {
        //     alert("1");
        // }
        // alert("success");
        // $('.testdata').html(msg);
        // $('#basicModal').modal('show');
      },
      error:function(){
        alert("error");
        // swal("Error!", 'Error in Record Not Show', "error"); 
      }
    });
  });
    // $(document).on('click','#report',function (event) {
    //     // window.LaravelDataTables["dataTableBuilder"].ajax.reload();
    // });
</script>
@endsection