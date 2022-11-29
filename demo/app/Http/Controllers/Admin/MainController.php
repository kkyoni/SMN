<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Str,Storage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\User;
use App\Models\Expenses;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Response;
use App\Models\Transactions;
use App\Models\Balance;
use Event;

class MainController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = 'admin.pages.';
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.';
        $this->middleware('auth');
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function Index Page
    ---------------------------------------------------------------------------------- */
    public function index(){
        return view('front.auth.login');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function Dashboard Page
    ---------------------------------------------------------------------------------- */
    public function dashboard(Builder $builder, Request $request){
        $authDetail = Auth::user();
        $authID = $authDetail->id;
        $authType = $authDetail->user_type_id;
        $is_head_office = $authDetail->is_head_office;
        $isAdmin = 2;
        if($authType == 1 || $is_head_office == 1){
            $isAdmin = 1;
        }
        $totalUser = User::where('user_type_id','!=','1')->count();
        $Expenses = Expenses::sum('amount');
        $totalExpenses = Helper::decimalNumber($Expenses);
        $vatavUser = User::find(1);
        $currentBalance = Helper::decimalNumber($vatavUser->current_balance);
        $branches_list = User::where('user_type_id','!=','1')->pluck('name','id');
        $transactions = Transactions::where('status',1)->latest();
        if(isset($request->sender_name) || isset($request->recevice_name)){
            $sender_name = $request->sender_name;
            $recevice_name = $request->recevice_name;
            $transactions->where('from_user_id',$sender_name)->orwhere('to_user_id',$recevice_name)->where('status',1);
        }
        if (request()->ajax()) {
            return DataTables::of($transactions->get())
            ->addIndexColumn()
            ->editColumn('from_user_id', function (Transactions $transactions) {
                return $transactions->from_user_list->name;
            })
            ->editColumn('to_user_id', function (Transactions $transactions) {
                return $transactions->to_user_list->name;
            })
            ->editColumn('transaction_type', function (Transactions $transactions) {
                if($transactions->transaction_type == "2") {
                    return '<span class="label label-success">Manual</span>';
                } elseif($transactions->transaction_type == "3") {
                    return '<span class="label label-danger">Normal</span>';
                } else {
                    return '<span class="label label-primary">Auto</span>';
                }
            })
            ->editColumn('status', function (Transactions $transactions) {
                if($transactions->status == "1"){
                    return "Placed";
                } 
            })
            ->editColumn('created_at', function (Transactions $transactions) {
                return Helper::date_format($transactions->created_at);
            })
            ->editColumn('action', function (Transactions $transactions) {
                $action  = '';

                $action .='<a class="btn btn-primary btn-circle btn-sm checktransactions" data-id ="'.$transactions->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-check"></i></a>';

                $action .='<a class="btn btn-danger btn-circle btn-sm deleteaccepttransactions" data-id ="'.$transactions->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';

                return $action;
            })
            ->rawColumns(['from_user_id','to_user_id','transaction_type','created_at','status','action'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'10%',"orderable" => false, "searchable" => false],
            ['data' => 'from_user_id', 'name' => 'from_user_id', 'title' => 'SENDER BRANCH','width'=>'10%'],
            ['data' => 'to_user_id', 'name' => 'to_user_id', 'title' => 'RECEIVER BRANCH','width'=>'10%'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'AMOUNT','width'=>'10%'],
            ['data' => 'remarks', 'name' => 'remarks', 'title' => 'REMARKS','width'=>'10%'],
            ['data' => 'sender_name', 'name' => 'sender_name', 'title' => 'SENDER NAME','width'=>'10%'],
            ['data' => 'sender_contact', 'name' => 'sender_contact', 'title' => 'SENDER CONTACT','width'=>'10%'],
            ['data' => 'receiver_name', 'name' => 'receiver_name', 'title' => 'RECEIVER NAME','width'=>'10%'],
            ['data' => 'receiver_contact', 'name' => 'receiver_contact', 'title' => 'RECEIVER CONTACT','width'=>'10%'],
            ['data' => 'transaction_type', 'name' => 'transaction_type', 'title' => 'Type','width'=>'10%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'10%'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'CREATED AT','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'15%',"orderable" => false, "searchable" => false],
        ])
        ->ajax([
            'url' => route('admin.filter_by'),
            'type' => 'POST',
            'data' => 'function(d) { 
                d._token = "'.csrf_token().'";
                d.sender_name = $("#sender_name").val();
                d.recevice_name = $("#recevice_name").val();
            }',
        ])
        ->parameters(['order' =>[],]);
        return view($this->pageLayout.'dashboard',compact('html','totalUser','totalExpenses','currentBalance','isAdmin','branches_list'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function Dashboard Table Accept
    ---------------------------------------------------------------------------------- */
    public function acceptTransaction($id){
        try{
            $record = Transactions::where('id',$id)->first();
            if(!empty($record)){
                $authID = Auth::user()->id;
                $fromUserID = $record->from_user_id;
                $toUserID = $record->to_user_id;
                $fromUserDetail = User::find($fromUserID);
                $toUserDetail = User::find($toUserID);
                $vatavUserDetail = User::find(1);
                $createdDate = now();
                $record->accepted_by = $authID;
                $record->status = 2;
                $record->save();
                $transactionID = $record->id;

                //Update from user
                if(!empty($fromUserDetail)){
                    $openingBalance = $fromUserDetail->current_balance;
                    $fromUserDetail->current_balance += $record->from_total_balance;
                    $fromUserDetail->save();

                    //Add Credit Records in Balances Table
                    $cBRecord = new Balance;
                    $cBRecord->user_id = $fromUserID;
                    $cBRecord->transaction_id = $transactionID;
                    $cBRecord->opening_balance = $openingBalance;
                    $cBRecord->closing_balance = $fromUserDetail->current_balance;
                    $cBRecord->commission = $record->from_commission_amount;
                    $cBRecord->save();
                }

                //Update to user
                if(!empty($toUserDetail)){
                    $dOpeningBalance = $toUserDetail->current_balance;
                    $toUserDetail->current_balance -= $record->to_total_balance;
                    $toUserDetail->save();

                    //Add Debit Records in Balances Table
                    $dBRecord = new Balance;
                    $dBRecord->user_id = $toUserID;
                    $dBRecord->transaction_id = $transactionID;
                    $dBRecord->opening_balance = $dOpeningBalance;
                    $dBRecord->closing_balance = $toUserDetail->current_balance;
                    $dBRecord->commission = $record->to_commission_amount;
                    $dBRecord->save();
                }

                if(!empty($vatavUserDetail) && !empty($record->profit)){
                //Add Vatav
                    $vOpeningBalance = $vatavUserDetail->current_balance;
                    $vatavUserDetail->current_balance = $vatavUserDetail->current_balance + $record->profit;
                    $vatavUserDetail->save();
                    $vRecord = new Balance;
                    $vRecord->user_id = 1;
                    $vRecord->transaction_id = $transactionID;
                    $vRecord->opening_balance = $vOpeningBalance;
                    $vRecord->closing_balance = $vatavUserDetail->current_balance;
                    $vRecord->commission = $record->profit;
                    $vRecord->created_at = $createdDate;
                    $vRecord->save();
                }
                Notify::success('Accept Transaction Successfully..!');
                return response()->json(['status'    => 'success','title'     => 'Success!!','message'   => 'Accept Transactions Successfully..!']);
            }
        }catch(\Exception $e){
            return back()->with(['alert-type'    => 'danger','message'       => $e->getMessage()]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function Dashboard Table Destory
    ---------------------------------------------------------------------------------- */
    public function destroyTransaction($id){
        try{
            $transactions = Transactions::where('id',$id)->first();
            $transactions->delete();
            Notify::success('Transactions Deleted Successfully..!');
            return response()->json(['status'    => 'success','title'     => 'Success!!','message'   => 'Transactions Deleted Successfully..!']);
        }catch(\Exception $e){
            return back()->with(['alert-type'    => 'danger','message'       => $e->getMessage()]);
        }
    }
}
