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
use App\Models\Expenses;
use App\Models\ExpenseType;
use App\Models\Transactions;
use Event;
use App\Helpers\Helper;

class ExpensesController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.expenses.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Index User Listing
    ---------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $branches_list = User::where('user_type_id','!=','1')->pluck('name','id');
        $expenses = Expenses::orderBy('id','desc');
        if(isset($request->filterby)){
            $type = $request->filterby;
            $expenses->where('to_user_id',$type);
        }
        if (request()->ajax()) {
            return DataTables::of($expenses->get())
            ->addIndexColumn()
            ->editColumn('to_user_id', function (Expenses $expenses) {
                return $expenses->to_user_list->name;
            })
            ->editColumn('from_user_id', function (Expenses $expenses) {
                return $expenses->form_user_list->name;
            })
            ->editColumn('expense_type_id', function (Expenses $expenses) {
                return $expenses->expense_type->name;
            })
            ->editColumn('action', function (Expenses $expenses) {
                $action  = '';
                $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.expenses.edit',[$expenses->id]).'><i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i></a>';
                $action .='<a class="btn btn-danger btn-circle btn-sm m-l-10 deleteexpenses ml-1 mr-1" data-id ="'.$expenses->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';
                return $action;
            })
            ->rawColumns(['action','to_user_id','from_user_id','expense_type_id'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'SR NO','width'=>'10%',"orderable" => false, "searchable" => false],
            ['data' => 'to_user_id', 'name' => 'to_user_id', 'title' => 'TO USER BRANCH','width'=>'10%'],
            ['data' => 'from_user_id', 'name' => 'from_user_id', 'title' => 'FROM USER BRANCH','width'=>'10%'],
            ['data' => 'expense_type_id', 'name' => 'expense_type_id', 'title' => 'EXPENSE TYPE','width'=>'10%'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'AMOUNT','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->ajax([
            'url' => route('admin.expenses.filter_by'),
            'type' => 'POST',
            'data' => 'function(d) { 
                d._token = "'.csrf_token().'";
                d.filterby = $("#name").val();
            }',
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => true,
            'searchDelay' => 350,
            'dom'         => 'lBfrtip',
            'buttons'     => [
                ['extend' => 'print','title' => "Transaction Report", 'text' => '<i class="fa fa-print" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4]]],
                ['extend' => 'excel','title' => "Transaction Report", 'text' => '<i class="fa fa-file-excel-o" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4]]],
                ['extend' => 'pdf','title' => "Transaction Report", 'text' => '<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4]]],
            ],
            'searching'   => true,
        ]);
        return view($this->pageLayout.'index',compact('html','branches_list'));
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Create Category
    -----------------------------------------------------------------------------------*/
    public function create(){
        $expense_type_list = ExpenseType::pluck('name','id');
        $user_id_list = User::where('user_type_id','!=','1')->pluck('name','id');
        return view($this->pageLayout.'create',compact('expense_type_list','user_id_list'));
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Store Category
    -----------------------------------------------------------------------------------*/
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'to_user_id' => 'required',
            'expense_type_id' => 'required',
            'amount' => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{

            $fromUserDetail = User::find(21);
            $toUserDetail = User::find($request->get('to_user_id'));

            $transactions = Transactions::create([
                'created_by' => Auth::user()->id,
                'from_user_id' => $fromUserDetail->id,
                'to_user_id' => @$request->get('to_user_id'),
                'from_name' => $fromUserDetail->name,
                'to_name' => $toUserDetail->name,
                'amount' => @$request->get('amount'),
                'transaction_type' => 4,
                'status' => 2,
            ]);
            if(!empty($transactions)){
                Expenses::create([
                'to_user_id' => @$request->get('to_user_id'),
                'expense_type_id' => @$request->get('expense_type_id'),
                'amount' => @$request->get('amount'),
                'from_user_id' => $fromUserDetail->id,
                'transactions_id' => $transactions->id,
            ]);    
            }
            
            Notify::success('Expenses Created Successfully..!');
            return redirect()->route('admin.expenses.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Edit Category
    ---------------------------------------------------------------------------------- */
    public function edit($id){
        $expenses = Expenses::where('id',$id)->first();
        $expense_type_list = ExpenseType::pluck('name','id');
        $user_id_list = User::where('user_type_id','!=','1')->pluck('name','id');
        if(!empty($expenses)){
            return view($this->pageLayout.'edit',compact('expenses','expense_type_list','user_id_list'));
        }else{
            return redirect()->route('admin.expenses.index');
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Update Category
    ---------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'to_user_id' => 'required',
            'expense_type_id' => 'required',
            'amount' => 'required',
        ]);
        try{
            $fromUserDetail = User::find(21);
            $toUserDetail = User::find($request->get('to_user_id'));
            $expenses_update = Expenses::where('id',$id)->first();
            $transactions_id =$expenses_update->transactions_id;
            $expenses_id =$expenses_update->id;
            $transactions = Transactions::where('id',$transactions_id)->update([
                'created_by' => Auth::user()->id,
                'from_user_id' => $fromUserDetail->id,
                'to_user_id' => @$request->get('to_user_id'),
                'from_name' => $fromUserDetail->name,
                'to_name' => $toUserDetail->name,
                'amount' => @$request->get('amount'),
                'transaction_type' => 4,
                'status' => 2
            ]);
                Expenses::where('id',$expenses_id)->update([
                'to_user_id' => @$request->get('to_user_id'),
                'expense_type_id' => @$request->get('expense_type_id'),
                'amount' => @$request->get('amount'),
                'from_user_id' => $fromUserDetail->id,
                'transactions_id' => $transactions_id
            ]);
            
            Notify::success('Expenses Updated Successfully..!');
            return redirect()->route('admin.expenses.index');
        } catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Delete Transaction
    --------------------------------------------------------------------------------- */
    public function delete($id){
        try{
            $expenses = Expenses::where('id',$id)->first();
            $transactions_id =$expenses->transactions_id;
            $transactions = Transactions::where('id',$transactions_id)->first();
            $expenses->delete();
            $transactions->delete();
            Notify::success('Expenses Deleted Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Expenses Deleted Successfully..!'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}
