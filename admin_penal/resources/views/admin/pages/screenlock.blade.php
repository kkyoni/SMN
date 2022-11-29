<body class="gray-bg">

<div class="lock-word animated fadeInDown">
    <span class="first-word">LOCKED</span><span>SCREEN</span>
</div>
    <div class="middle-box text-center lockscreen animated fadeInDown">
        <div>
            <div class="m-b-md">
                @if(!empty(Auth::user()->avatar))
            <img alt="image" class="rounded-circle circle-border" src="{!!  \Auth::user()->avatar !== '' ? asset("storage/avatar/".\Auth::user()->avatar) : asset('storage/avatar/default.png') !!}" height="60px" width="60px">
            @else
            <img alt="image" class="rounded-circle circle-border" src="{!! asset('storage/avatar/default.png') !!}" height="60px" width="60px">
            @endif
            </div>
            <h3>{{  \Auth::user()->fname }}</h3>
            <p>Your are in lock screen. Main app was shut down and you need to enter your passwor to go back to app.</p>
            {!! Form::open([
            'class' => 'm-t',
            'role'  => 'form',
            'route' => 'admin.screenlock.screenunlock'
            ]) !!}
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="******" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width">Unlock</button>
            {!! Form::close() !!}
        </div>
    </div>

<link href="http://webapplayers.com/inspinia_admin-v2.8/css/bootstrap.min.css" rel="stylesheet">
<link href="http://webapplayers.com/inspinia_admin-v2.8/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="http://webapplayers.com/inspinia_admin-v2.8/css/animate.css" rel="stylesheet">
<link href="http://webapplayers.com/inspinia_admin-v2.8/css/style.css" rel="stylesheet">
<script src="http://webapplayers.com/inspinia_admin-v2.8/js/jquery-3.1.1.min.js"></script>
<script src="http://webapplayers.com/inspinia_admin-v2.8/js/popper.min.js"></script>
<script src="http://webapplayers.com/inspinia_admin-v2.8/js/bootstrap.js"></script>
