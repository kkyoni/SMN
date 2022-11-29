<?php
namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Str,Storage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Auth;
use App\Models\User;
use App\Models\Transactions;
use Event;
use App\Helpers\Helper;
use DB;

class BranchreportsController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */

    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.branchreports.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Index User Listing
    ---------------------------------------------------------------------------------- */
    public function index(Request $request){
        $branches_list = User::where('user_type_id','!=','1')->pluck('name','id');
        $records = array();
        $startAmount = array();
        $reqData = $request->all();
        $startAmount = 0;
        $query = Transactions::whereHas('toBranch')->whereHas('fromBranch')->with('toBranch','fromBranch');
        $branchID = "4";
        $fromDate = "2021-07-26";
        $toDate = "2021-07-27";
        $records = $query->where(function($q) use($branchID){
            $q->where('from_user_id',$branchID)->orWhere('to_user_id',$branchID);
        })->whereBetween(DB::Raw('DATE(created_at)'),[$fromDate,$toDate])->orderBy('id')->get()->toArray();
        if(!empty($records)){
            foreach($records as $key => $value){
                $records[$key]['created_at'] = $value['created_at'];
                $records[$key]['to_branch_name'] = $value['to_branch']['name'];
                $records[$key]['from_branch_name'] = $value['from_branch']['name'];
                $records[$key]['to_branch_code'] = $value['to_branch']['code'];
                unset($records[$key]['to_branch']);
            }
        }
        $firstTransaction = Transactions::where(function($q) use($branchID){
            $q->where('from_user_id',$branchID)->orWhere('to_user_id',$branchID);
        })->where(DB::Raw('DATE(created_at)'),'<',$fromDate)->orderByDesc('id')->first();
        if(!empty($firstTransaction)){
        if($firstTransaction->from_user_id == $branchID){
            $startAmount = $firstTransaction->from_closing_balance;
        }else{
            $startAmount = $firstTransaction->to_closing_balance;
        }
    }else{
        $firstTransaction = Transactions::where(function($q) use($branchID){
            $q->where('from_user_id',$branchID)->orWhere('to_user_id',$branchID);
        })->where(DB::Raw('DATE(created_at)'),'=',$fromDate)->orderBy('id')->first();
        if(!empty($firstTransaction)){
            if($firstTransaction->from_user_id == $branchID){
                $startAmount = $firstTransaction->from_current_balance;    
            }else{
                $startAmount = $firstTransaction->to_current_balance;
            }
        }else{
            $userDetail = User::find($branchID);
            if(!empty($userDetail)){
                $startAmount = $userDetail->current_balance;
            }
        }
    }
    return view($this->pageLayout.'index',compact('records','startAmount','branches_list'));
    }
}