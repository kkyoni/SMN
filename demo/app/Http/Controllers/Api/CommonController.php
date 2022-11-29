<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Mail;
use Event;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Setting;
use App\Models\Otp;
use Response;
use Illuminate\Support\Facades\Log;

class CommonController extends Controller{
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
        } catch (Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e) {
            return response()->json(['token_session'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for invite contact list
    -------------------------------------------------------------------------------------------- */
    public function invitecontactlist(Request $request){
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user){
                return response()->json(['status'=>'error','message' => 'You are not able login from this application...'],200);
            }
            $updatedContactData = explode(',', $request->contact_number);
            $usernameData = [];
            foreach ($updatedContactData  as $key=>$value) {
                $usernameData['contact'][$key]['number'] = $value;
            }
            $userDetailsusername[] = $usernameData['contact'];
            $number = Arr::pluck($userDetailsusername[0], 'number');
            $register_contact = User::pluck('contact_number');
            $regiserUser = [];
            for ($i=0; $i <count($number) ; $i++) {
                if(in_array($number[$i],$register_contact->toArray())){
                    $regiserUser[] = [
                        'contact_number'  => $number[$i],
                    ];
                }
            }
            return Response::json(['status'=> 'success','register_contact'=> $regiserUser]);
        }catch (Exception $e) {
            return response()->json(['status' => 'error','message' => "Something went Wrong....."],200);
        }
    }
}