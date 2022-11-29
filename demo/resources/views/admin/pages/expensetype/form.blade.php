<div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>NAME</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('name',null,[
        'class' => 'form-control',
        'id'    => 'name',
        'maxlength' => '30'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('name') ? "".$errors->first('name')."" : '' }} </font>
        </span>
    </div>
</div>
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