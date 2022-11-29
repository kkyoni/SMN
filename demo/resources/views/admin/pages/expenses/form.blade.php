<div class="form-group row {{ $errors->has('from_user_id') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>SENDER BRANCH</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::select('from_user_id',['21' => 'Cash'],null,[
        'class' => 'select2_demo_1 form-control',
        'id'    => 'from_user_id',
        'disabled'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('from_user_id') ? "".$errors->first('from_user_id')."" : '' }} </font>
        </span>
    </div>
</div>
<div class="form-group row {{ $errors->has('to_user_id') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>RECEIVER BRANCH</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::select('to_user_id',$user_id_list,null,[
        'class' => 'select2_demo_2 form-control',
        'id'    => 'to_user_id',
        'placeholder'=>'Select Branches'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('to_user_id') ? "".$errors->first('to_user_id')."" : '' }} </font>
        </span>
    </div>
</div>
<div class="form-group row {{ $errors->has('expense_type_id') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Type</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::select('expense_type_id',$expense_type_list,null,[
        'class' => 'select2_demo_2 form-control',
        'id'    => 'expense_type_id',
        'placeholder'=>'Select Expense Type'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('expense_type_id') ? "".$errors->first('expense_type_id')."" : '' }} </font>
        </span>
    </div>
</div>
<!-- <div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>TITLE</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('title',null,[
        'class' => 'form-control',
        'id'    => 'title',
        'maxlength' => '30'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('title') ? "".$errors->first('title')."" : '' }} </font>
        </span>
    </div>
</div> -->
<div class="form-group row {{ $errors->has('amount') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>AMOUNT</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('amount',null,[
        'class' => 'form-control',
        'id'    => 'amount',
        'maxlength' => '30'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('amount') ? "".$errors->first('amount')."" : '' }} </font>
        </span>
    </div>
</div>
<!-- <div class="form-group row {{ $errors->has('date') ? 'has-error' : '' }}" id="data_1">
    <label class="col-sm-3 col-form-label font-normal">
        <strong>DATE</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        <div class="input-group date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input type="text" class="form-control" name="date" value="<?php echo date("Y/m/d") ?>">
        </div>
        <span class="help-block">
            <font color="red"> {{ $errors->has('date') ? "".$errors->first('date')."" : '' }} </font>
        </span>
    </div>
</div> -->
<!-- <div class="form-group row {{ $errors->has('note') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>NOTE</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('note',null,[
        'class' => 'form-control',
        'id'    => 'note',
        'maxlength' => '30'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('note') ? "".$errors->first('note')."" : '' }} </font>
        </span>
    </div>
</div> -->
@section('styles')
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $(".select2_demo_1").select2({
        placeholder: "Select Branches",
        allowClear: true
    });
    $(".select2_demo_2").select2({
        placeholder: "Select Expense Type",
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
});
</script>
@endsection