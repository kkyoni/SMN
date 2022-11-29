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
use Event;
use App\Helpers\Helper;

class GeneralreportsController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * * Create a new controller instance.
     * * * *
     * * * * @return void
     * * * */

    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.generalreports.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------
    @Description: Function for Index
    ----------------------------------------------------------------------------------- */
    public function index(Request $request){
        $reqData = $request->all();
        $records = User::get();
        foreach ($records as $key => $value) {
            if($value['id'] == 1){
                $records[$key]['current_balance'] = $value['current_balance'] * -1;
            }
        }
        $leftSideArray = array();
        $leftSideCountArray = array();
        $rightSideArray = array();
        $rightSideCountArray = array();
        if(!empty($records)){
            foreach($records as $record){
                if($record['current_balance'] > 0 && $record['id'] != 1){
                    $rightSideArray[] = $record;
                    $rightSideCountArray[] = $record['current_balance'];
                }else if($record['current_balance'] < 0 || $record['id'] == 1){
                    $leftSideArray[] = $record;
                    $leftSideCountArray[] = $record['current_balance'];
                }
            }
        }
        $LeftCount = Helper::decimalNumber(array_sum($leftSideCountArray));
        $RightCount = Helper::decimalNumber(array_sum($rightSideCountArray));
        return view($this->pageLayout.'index',compact('leftSideArray','rightSideArray','LeftCount','RightCount'));
    }
}