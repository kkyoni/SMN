<?php

namespace App\Http\Controllers\Admin\Auth;


use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $redirectTo = '/admin/dashboard';
    protected $authLayout = 'admin.auth.';
    public function __construct()
    {
     $this->middleware('guest')->except('logout');
   }
   public function showLoginForm()
   {
    return view($this->authLayout.'login');
  }
  public function login(Request $request)
  {
    $validatedData = Validator::make($request->all(),[
            'username'    => 'required',
            'password' => 'required',
        ]);

    if($validatedData->fails()){
         return redirect()->back()->withErrors($validatedData)->withInput();
    }
    if (\Auth::attempt([
      'username'     => $request->get('username'),
      'password'  => $request->get('password'),
      'status'    => '1',
      ]))
    {
       // Updated this line

     if(!empty($request->has('remmeber'))){

      $username_cookie = $request->username;
      $password_cookie = $request->password;

      setcookie("username_cookie",$username_cookie,time() + 3600, '/');
      setcookie("password_cookie",$password_cookie,time() + 3600, '/');
    }else{

      if(isset($_COOKIE['username_cookie'])){

       setcookie( "username_cookie", "", time() + 3600, '/');
     }
     if(isset($_COOKIE['password_cookie'])){

       setcookie( "password_cookie", "", time() + 3600, '/');
     }

   }

   $remember_me = $request->has('remmeber') ? true : false;

   $loginAttempt = Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password')],$remember_me);

   if(Auth::user()->user_type_id == '1'){
     Notify::success('Welcome to Admin Panel.');
     return redirect()->route('admin.dashboard');
   }else{
     Auth::logout();
     Notify::error('User not found !!');
     return redirect()->route('admin.login');
   }
 }
 else
 {
  return $this->sendFailedLoginResponse($request, 'auth.failed_status');
}
}

public function logout()
{
  Auth::logout();
  return redirect()->route('admin.login');
}
}
