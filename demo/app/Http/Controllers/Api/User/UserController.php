<?php
namespace App\Http\Controllers\Api\User;
use App\Jobs\sendNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\PasswordResetRequest;
use App\Helpers\GlobalH;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Ixudra\Curl\Facades\Curl;
use Carbon\Carbon;
use App\Models\Setting;
use App\Helpers\Helper;
use Event;
use PushNotification;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Log;

class UserController extends Controller{
    public function __construct(){}
    public function getAuthenticatedUser(){
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Mobile Screen Login
    -------------------------------------------------------------------------------------------- */
    public function Mobileverify(Request $request){
        $validation_array = [
            'contact_number'         => 'required',
            'device_type'   => 'required',
            'device_token'  => 'required',
        ];
        $validation = Validator::make($request->all(),$validation_array);
        if($validation->fails()){
            return response()->json(['status' => 'error','message' => $validation->messages()->first()],200);
    }
    try{
        $otpNumber = random_int(1000, 9999);
        $check_number = User::where('contact_number',$request->contact_number)->first();
        if(empty($check_number)){
            $password = "smn@1234";
            $user = User::firstOrCreate([
                'contact_number' => (string)$request->contact_number,
                'device_type' => $request->device_type,
                'device_token' => $request->device_token,
                'otp_number'    => $otpNumber,
                'status' => 'active',
                'user_type' => 'user',
                'password' =>   bcrypt($password),
            ]);
            $user->save();
            $token = JWTAuth::fromUser($user);
            $data = User::where('id',$user->id)->first();
            $data->save();
            $data['token']=$token;
            return response()->json(['status' => 'success','message' => 'Login successfully','data'=>$data], 200);
        }else{
            $password = "smn@1234";
            $user_type = "user";
            $credentials =[ 'contact_number'=>$request->contact_number,'password'=>$password ,'user_type'=>$user_type];
            // dd($credentials);
            $data= [];
            if(! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['status' => 'error','message' => 'Invalid Credentials, Please try again', 'data' => (object)[]], 200);
            }
                $data1 = User::where('id',$check_number->id)->first();
                User::where('id',(string)$data1->id)->update([
                    'contact_number'    => (string)$request->contact_number,
                    'device_type'    => $request->device_type,
                    'device_token'    => $request->device_token,
                    'otp_number'    => $otpNumber,
                    'otp_expire'    => $check_number->updated_at->addSeconds(180),
                ]);
                $data = User::where('id',$check_number->id)->first();
                $data['token'] = $token;
                return response()->json(['status' => 'success','message' => 'Login successfully','data'=>$data], 200);

            
        }
    }catch (Exception $e) {
        return response()->json(['status' => 'error','message' => 'Something went Wrong.....', 'data' => (object)[]],200);
    }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Verify Otp
    -------------------------------------------------------------------------------------------- */
    public function verifyOtp(Request $request){
        $validator =  Validator::make($request->all(),[
            'contact_number' => 'required',
            'otp_number'    => 'required|max:4|min:4'
        ]);
        if($validator->fails()){
            return response()->json(['status'    => 'error','message'   => $validator->messages()->first()]);
        }
        try{
            $getOtpData = User::where('otp_number',$request->get('otp_number'))->where('contact_number',$request->get('contact_number'))->first();
            if($getOtpData !== null){
                if( Carbon::now() >= Carbon::parse()){
                    return response()->json(['status' => 'error','message' => 'Otp Expired']);
                }
                $getOtpuser = User::where('contact_number',$request->get('contact_number'))->first();
                if(!empty($getOtpuser->email)){
                    $getOtpuser['email_verify'] = "verify";
                } else {
                    $getOtpuser['email_verify'] = "Not verify";
                }
                return response()->json(['status'    => 'success','message'   => 'OTP is Verified.','data'      => $getOtpuser]);
            }
            return response()->json(['status'    => 'error','message'   => 'Invalid Otp Details',]);
        }catch (\Exception $exception){
            return response()->json(['message'   => $exception->getMessage()]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for ReSend Otp
    -------------------------------------------------------------------------------------------- */
    public function ReSendOtp(Request $request){
        $validator =  Validator::make($request->all(),[
            'contact_number' => 'required|min:7'
        ]);
        if($validator->fails()){
            return response()->json(['status' => 'error','message'=> $validator->messages()->first()]);
        }
        try{
            $otpNumber = random_int(1000, 9999);
            $checkContactNumInUser = User::where('contact_number',$request->get('contact_number'))->first();
            if($checkContactNumInUser !== null){
                $checkIfUserOtpExist = User::where('contact_number',(string)$checkContactNumInUser->contact_number)->first();
                User::where('id',$checkIfUserOtpExist->id)->where('contact_number',(string)$checkContactNumInUser->contact_number)->update([
                    'otp_number'    => $otpNumber,
                    'otp_expire'    => $checkIfUserOtpExist->updated_at->addSeconds(180)
                ]);
            }else{
                return response()->json(['status' => 'error','message'=> 'Mobile number does not exist.']);
            }
            return response()->json(['status'=> 'success','message' => 'Otp sent successfully','data'=> $otpNumber ]);
        }catch (\Exception $exception){
            return response()->json(['message'=> $exception->getMessage()]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Update Own Profile
    -------------------------------------------------------------------------------------------- */
    public function updateProfile(Request $request){
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user){
                return response()->json(['status'=>'error','message' => 'You are not able login from this application...'],200);
            }
            // dd($user);
            $user_data = User::where('id',$user->id)->first();
            if($user_data){
                if($request->hasFile('avatar')){
                    $file = $request->file('avatar');
                    $extension = $file->getClientOriginalExtension();
                    $filename = Str::random(10).'.'.$extension;
                    Storage::disk('public')->putFileAs('avatar', $file,$filename);
                }else if($user_data->avatar){
                    $filename = $user_data->avatar;
                }else{
                    $filename = '';
                }
                $user_data->username      = request('username');
                $user_data->email           = request('email');
                $user_data->avatar          = $filename;
                $user_data->save();
                return response()->json(['status' => 'success','message' => 'Profile Update Successfully..!','data' => $user_data]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error','message' => $e->getMessage()], 200);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Logout
    -------------------------------------------------------------------------------------------- */
    public function logout(Request $request){
    try {
        $user = JWTAuth::parseToken()->authenticate();
        if(!$user){
            return response()->json(['status'=>'error','message' => 'You are not able login from this application...'],200);
        }
        $user = User::find($user->id);
        $user->save();
        JWTAuth::invalidate($request->token);
        return response()->json(['status'  => 'success','message' => 'User logged out successfully']);
    }catch (\Exception $e) {
        return response()->json(['status'  => 'error','message' => $e->getMessage()]);
    }
}


}