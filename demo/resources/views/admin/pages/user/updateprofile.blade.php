@extends('admin.layouts.app')
@section('title')
Admin Profile
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2><i class="fa fa-th-large" aria-hidden="true"></i> Admin Profile</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <span class="label label-success float-right" style="background-color: #5A8DEE;">Profile Update</span>
                <!-- <strong>Profile Update</strong> -->
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-6">
            {!! Form::open([
            'route' => 'admin.updateProfileDetail',
            'files' => true
            ]) !!}
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Profile update</h5>
                </div>

                <div class="ibox-content" id="imagePreview">
                   @if(!empty(\Auth::user()->image))
                   <!-- <i class="fa fa-pencil fa-2x"></i> -->
                   <img src="{!!  \Auth::user()->image !== '' ? url("storage/image/".\Auth::user()->image) : url('storage/default.png') !!}" alt="user-img" class="img-circle">
                   @else
                   <!-- <i class="fa fa-pencil fa-2x"></i> -->
                   <img src="{!! url('storage/image/default.png') !!}" name="image" alt="user-img" class="img-circle" accept="image/*">
                   @endif
                   <br>
                   <span >
                    <center>    <font color="red"> {{ $errors->has('image') ? "".$errors->first('image')."" : '' }} </font> </center>
                </span>
            </div>
            {!! Form::file('image',['id' => 'hidden','accept'=>'image/*','class'=>'user_profile_pic']) !!}

            <div class="ibox-content profile-content">
                <div class="ibox ">
                    <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-lg-12 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <input type="text" placeholder="Name"  value="{{$user->name}}" id="name" name="name" class="form-control" maxlength="30" required>
                            <span class="help-block">
                                <font color="red"> {{ $errors->has('name') ? "".$errors->first('name')."" : '' }} </font>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary mr-10 mb-30">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::open([
        'route' => 'admin.updatePassword',
        'files' => true
        ]) !!}

        <div class="ibox">
            <div class="ibox-title">
                <h5>Change Password</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group row {{ $errors->has('old_password') ? 'has-error' : '' }}"><label class="col-lg-4 col-form-label">Current Password <span class="text-danger">*</span></label>

                    <div class="col-lg-8"><input type="password" name="old_password" id="old_password" placeholder="Current Password" class="form-control" value="{{ old('old_password') }}">
                        <span class="help-blockk">
                            <font color="red"> {{ $errors->has('old_password') ? "".$errors->first('old_password')."" : '' }} </font>
                        </span>
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}"><label class="col-lg-4 col-form-label">New Password <span class="text-danger">*</span></label>

                    <div class="col-lg-8"><input type="password" name="password" id="password" placeholder="New Password"  class="form-control">
                        <span class="help-blockk">
                            <font color="red"> {{ $errors->has('password') ? "".$errors->first('password')."" : '' }} </font>
                        </span>
                    </div>

                </div>
                <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}"><label class="col-lg-4 col-form-label">Confirm Password <span class="text-danger">*</span></label>

                    <div class="col-lg-8"><input type="password"  name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control">
                       <span class="help-blockk">
                        <font color="red"> {{ $errors->has('password_confirmation') ? "".$errors->first('password_confirmation')."" : '' }} </font>
                    </span>

                </div>

            </div>
            <div class="form-group row">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary mr-10 mb-30">Save</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
</div>
@endsection
@section('styles')
<style type="text/css">
    .help-block {
        display: inline-block;
        margin-top: 5px;
        margin-bottom: 0px;
        margin-left: 8px;
    }
    .help-blockk{
     display: inline-block;
     margin-top:0px;
     margin-bottom: 0px;
     margin-left: 4px;
 }
</style>
<style type="text/css">
    .help-block {
        display: inline-block;
        margin-top: 5px;
        margin-bottom: 0px;
        margin-left: 5px;
    }
    .form-group {
        margin-bottom: 10px;
    }
    .form-control {
        font-size: 14px;
        font-weight: 500;
    }
    #imagePreview{
        width: 100%;
        height: 100%;
        text-align: center;
        margin: 0 auto;
        position: relative;
    }
    #hidden{
        display: none !important;
    }
    #imagePreview img {
        height: 150px;
        width: 150px;
        border: 3px solid rgba(0,0,0,0.4);
        padding: 3px;
    }
    #imagePreview i{
        position: absolute;
        right: -18px;
        background: rgba(0,0,0,0.5);
        padding: 5px;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        color: #fff;
        font-size: 18px;
    }
</style>
@endsection

@section('scripts')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#imagePreview img').on('click',function(){
        $('input[type="file"]').trigger('click');
        $('input[type="file"]').change(function() {
            readURL(this);
        });
    });
</script>
<!-- iCheck -->
<link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });


    $(".user_profile_pic").change(function() {
        var val = $(this).val();
        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'gif': case 'jpg': case 'png': case 'jpeg':
            //alert("an image");
            break;
            default:
            $(this).val('');
            // error message here
            alert("not an image");
            break;
        }
    });

    $('#last_name, #first_name').on('keyup onmouseout keydown keypress blur change', function (event) {
        var regex = new RegExp("^[a-zA-Z ._\\b]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $('#amount, #contact_number').on('keyup onmouseout keydown keypress blur change', function (e) {
        var regex = new RegExp("^[0-9 ._\\b\\t]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $('#old_password, #password, #password_confirmation').on('keyup onmouseout keydown keypress blur change', function (e) {
        var key = e.charCode || e.keyCode || 0;

        if(($(this).val().length > 20)){
            $(this).val('');
            return false;
        }
    });
</script>
@endsection
