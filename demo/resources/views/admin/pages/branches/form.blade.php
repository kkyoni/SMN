<div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>NAME</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('name',null,[
        'class' => 'form-control',
        'id'    => 'name'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('name') ? "".$errors->first('name')."" : '' }} </font>
        </span>
    </div>
</div>
<div class="form-group row {{ $errors->has('code') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>CODE</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('code',null,[
        'class' => 'form-control',
        'id'    => 'code'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('code') ? "".$errors->first('code')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('username') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>USERNAME</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('username',null,[
        'class' => 'form-control',
        'id'    => 'username'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('username') ? "".$errors->first('username')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>PASSWORD</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('password',null,[
        'class' => 'form-control',
        'id'    => 'password'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('password') ? "".$errors->first('password')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('address') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>ADDRESS</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('address',null,[
        'class' => 'form-control',
        'id'    => 'address'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('address') ? "".$errors->first('address')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('city') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>CITY</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('city',null,[
        'class' => 'form-control',
        'id'    => 'city'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('city') ? "".$errors->first('city')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('phone_number') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>PHONE NUMBER</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        {!! Form::number('phone_number',null,[
        'class' => 'form-control',
        'id'    => 'phone_number'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('phone_number') ? "".$errors->first('phone_number')."" : '' }} </font>
        </span>
    </div>
</div>


<div class="form-group row {{ $errors->has('sender_commission') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>SENDER COMMISSION</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        {!! Form::number('sender_commission',null,[
        'class' => 'form-control',
        'id'    => 'sender_commission'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('sender_commission') ? "".$errors->first('sender_commission')."" : '' }} </font>
        </span>
    </div>
</div>


<div class="form-group row {{ $errors->has('receiving_commission') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>RECEIVING COMMISSION</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        {!! Form::number('receiving_commission',null,[
        'class' => 'form-control',
        'id'    => 'receiving_commission'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('receiving_commission') ? "".$errors->first('receiving_commission')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group row {{ $errors->has('limit') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>LIMIT</strong>
        <span class="text-danger"></span>
    </label>
    <div class="col-sm-6">
        {!! Form::number('limit',null,[
        'class' => 'form-control',
        'id'    => 'limit'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('limit') ? "".$errors->first('limit')."" : '' }} </font>
        </span>
    </div>
</div>

@if(!empty($branches))
@if(!empty($branches->is_head_office == "1"))
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        <strong>Is HO?</strong>
    </label>
    <div class="col-sm-10">
        <div class="i-checks">
            <label>
                {{ Form::checkbox('is_head_office', '1' ,true,['id'=> '1']) }} <i></i> 
            </label>
        </div>
    </div>
</div>
@else
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        <strong>Is HO?</strong>
    </label>
    <div class="col-sm-10">
        <div class="i-checks">
            <label>
                {{ Form::checkbox('is_head_office', '1' ,false,['id'=> '1']) }} <i></i> 
            </label>
        </div>
    </div>
</div>
@endif
@else
<div class="form-group row">
    <label class="col-sm-2 col-form-label">
        <strong>Is HO?</strong>
    </label>
    <div class="col-sm-10">
        <div class="i-checks">
            <label>
                {{ Form::checkbox('is_head_office', '1' ,false,['id'=> '1']) }} <i></i> 
            </label>
        </div>
    </div>
</div>
@endif

@section('styles')
<style type="text/css">
.help-block {display: inline-block; margin-top: 5px; margin-bottom: 0px; margin-left: 5px;}
.form-group {margin-bottom: 10px;}
.form-control {font-size: 14px; font-weight: 500;}
#hidden{display: none !important;}
</style>
@endsection

@section('scripts')
@endsection