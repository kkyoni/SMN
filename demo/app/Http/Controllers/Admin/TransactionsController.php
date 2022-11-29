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
use App\Models\Transactions;
use App\Models\User;
use Event;
use App\Helpers\Helper;

class TransactionsController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.transactions.';
        $this->middleware('auth');
    }
    /*-----------------------------------------------------------------------------------
    @Description: Function for Index User Listing
    ---------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $branches_list = User::where('user_type_id','!=','1')->pluck('name','id');
        $transactions = Transactions::where('transaction_type',4)->orderBy('id','desc');
        if(isset($request->filterby)){
            $type = $request->filterby;
            $transactions->where('from_user_id',$type)->orwhere('to_user_id',$type);
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
            ->editColumn('status', function (Transactions $transactions) {
                if($transactions->status == "1"){
                    return '<span class="label label-primary">Placed</span>';
                } elseif($transactions->status == "2") {
                    return '<span class="label label-success">Approved</span>';
                } elseif($transactions->status == "3") {
                    return '<span class="label label-danger">Rejected</span>';
                } 
            })
            ->editColumn('from_commission', function (Transactions $transactions) {
                return Helper::decimalNumber($transactions->from_commission);
            })
            ->editColumn('to_commission', function (Transactions $transactions) {
                return Helper::decimalNumber($transactions->to_commission);
            })
            ->editColumn('profit', function (Transactions $transactions) {
                return Helper::decimalNumber($transactions->profit);
            })
            ->editColumn('created_at', function (Transactions $transactions) {
                return Helper::date_format($transactions->created_at);
            })
            ->editColumn('action', function (Transactions $transactions) {
                $action  = '';
                $action .='<a class="btn btn-danger btn-circle btn-sm m-l-10 deletetransactions ml-1 mr-1" data-id ="'.$transactions->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';
                return $action;
            })
            ->rawColumns(['action','status','from_user_id','to_user_id','from_commission','to_commission','profit','created_at'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'10%',"orderable" => false, "searchable" => false],
            ['data' => 'from_user_id', 'name' => 'from_user_id', 'title' => 'SENDER BRANCH','width'=>'10%'],
            ['data' => 'to_user_id', 'name' => 'to_user_id', 'title' => 'RECEIVER BRANCH','width'=>'10%'],
            ['data' => 'from_commission', 'name' => 'from_commission', 'title' => 'SENDER AMOUNT','width'=>'10%'],
            ['data' => 'to_commission', 'name' => 'to_commission', 'title' => 'RECEIVER AMOUNT','width'=>'10%'],
            ['data' => 'profit', 'name' => 'profit', 'title' => 'VATAV','width'=>'10%'],
            ['data' => 'remarks', 'name' => 'remarks', 'title' => 'REMARKS','width'=>'10%'],
            ['data' => 'sender_name', 'name' => 'sender_name', 'title' => 'SENDER NAME','width'=>'10%'],
            ['data' => 'sender_contact', 'name' => 'sender_contact', 'title' => 'SENDER CONTACT','width'=>'10%'],
            ['data' => 'receiver_name', 'name' => 'receiver_name', 'title' => 'RECEIVER NAME','width'=>'10%'],
            ['data' => 'receiver_contact', 'name' => 'receiver_contact', 'title' => 'RECEIVER CONTACT','width'=>'10%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'STATUS','width'=>'10%'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'CREATED AT','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->ajax([
            'url' => route('admin.transactions.filter_by'),
            'type' => 'POST',
            'data' => 'function(d) { 
                d._token = "'.csrf_token().'";
                d.filterby = $("#name").val();
            }',
        ])
        ->parameters(['order' =>[],]);
        return view($this->pageLayout.'index',compact('html','branches_list'));
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Create Category
    ---------------------------------------------------------------------------------- */
    public function create(){
        $branches_list = User::where('user_type_id','!=','1')->pluck('name','id');
        return view($this->pageLayout.'create',compact('branches_list'));
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Store Category
    ---------------------------------------------------------------------------------- */
    public function store(Request $request){
        $reqData = $request->all();
        $validatedData = Validator::make($request->all(),[
            'from_branch_id' => 'required|numeric',
            'to_branch_id' => 'required|numeric',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $authDetail = Auth::user();
            $authID = $authDetail->id;
            $fromUserID = $reqData['from_branch_id'];
            $toUserID = $reqData['to_branch_id'];
            $fromUserDetail = User::find($fromUserID);
            $toUserDetail = User::find($toUserID);
            $vatavUserDetail = User::find(1);
            $record = new Transactions;
            $record->created_by = $authID;
            $record->from_name = $fromUserDetail->name;
            $record->from_user_id = $reqData['from_branch_id'];
            $record->to_user_id = $reqData['to_branch_id'];
            $record->from_commission = $reqData['from_commission'];
            $record->from_current_balance = $reqData['from_current_balance'];
            $record->from_total_balance = $reqData['from_total_balance'];
            $record->from_closing_balance = $reqData['from_closing_balance'];
            $record->from_commission_amount = NULL;
            $record->to_commission_amount = NULL;
            $record->amount = NULL;
            $record->to_name = $toUserDetail->name;
            $record->to_commission = $reqData['to_commission'];
            $record->to_current_balance = $reqData['to_current_balance'];
            $record->to_total_balance = $reqData['to_total_balance'];
            $record->to_closing_balance = $reqData['to_closing_balance'];
            $record->transaction_profit = $record->profit = !empty($reqData['profit']) ? $reqData['profit'] : NULL;
            $record->remarks = !empty($reqData['remarks']) ? $reqData['remarks'] : NULL;
            $record->sender_name = !empty($reqData['sender_name']) ? $reqData['sender_name'] : NULL;
            $record->sender_contact = !empty($reqData['sender_contact']) ? $reqData['sender_contact'] : NULL;
            $record->receiver_name = !empty($reqData['receiver_name']) ? $reqData['receiver_name'] : NULL;
            $record->receiver_contact = !empty($reqData['receiver_contact']) ? $reqData['receiver_contact'] : NULL;
            $record->transaction_type = 4;
            $status = 1;
            if($authDetail->user_type_id == 1 || $authDetail->is_head_office == 1){
                $status = 2;
            }
            $record->status = $status;
            $record->save();
            if($status == 2){
                $transactionID = $record->id;
                if(!empty($fromUserDetail)){
                    $openingBalance = $fromUserDetail->current_balance;
                    $fromUserDetail->current_balance = $record->from_closing_balance;
                    $fromUserDetail->save();
                }

                if(!empty($toUserDetail)){
                    $dOpeningBalance = $toUserDetail->current_balance;
                    $toUserDetail->current_balance = $record->to_closing_balance;
                    $toUserDetail->save();
                }

                if(!empty($vatavUserDetail)){
                    $vOpeningBalance = $vatavUserDetail->current_balance;
                    $vatavUserDetail->current_balance = $vatavUserDetail->current_balance + $record->transaction_profit;
                    $vatavUserDetail->save();
                }
            }
            Notify::success('Transactions Created Successfully..!');
            return redirect()->route('admin.transactions.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Delete Transaction
    ---------------------------------------------------------------------------------- */
    public function delete($id){
        try{
            $record = Transactions::where('id',$id)->first();
            if(!empty($record)){
                $fromUserDetail = User::find($record->from_user_id);
                if(!empty($fromUserDetail)){
                    $fromUserDetail->current_balance = $fromUserDetail->current_balance - $record->from_closing_balance;
                    $fromUserDetail->save();
                }
                $toUserDetail = User::find($record->to_user_id);
                if(!empty($toUserDetail)){
                    $toUserDetail->current_balance = $toUserDetail->current_balance - $record->to_closing_balance;
                    $toUserDetail->save();
                }
                $vatavUserDetail = User::find(1);
                if(!empty($vatavUserDetail)){
                    $vatavUserDetail->current_balance = $vatavUserDetail->current_balance - $record->profit;
                    $vatavUserDetail->save();
                }
                $record->delete();
                $transactions->delete();
            }
            Notify::success('Transactions Deleted Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Transactions Deleted Successfully..!'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Delete Transaction
    ---------------------------------------------------------------------------------- */
    public function get_form_user(Request $request){
        if($request->droup_down_id == "sender"){
            $currentBalance = User::where("id",$request->from_branch_id)->first();
            $current_commission = !empty($currentBalance->sender_commission) ? $currentBalance->sender_commission : 65;
        } else {
            $currentBalance = User::where("id",$request->to_branch_id)->first();
            $current_commission = !empty($currentBalance->receiving_commission) ? $currentBalance->receiving_commission : 35;
        }
        $data = Helper::decimalNumber($currentBalance->current_balance);
        return response()->json(['data' => $data,'commission' => $current_commission]);    
        
    }
}