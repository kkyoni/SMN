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
use App\Models\ExpenseType;
use Event;

class ExpensesTypesController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * Create a new controller instance.
     * * *
     * * * @return void
     * * */

    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.expensetype.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Index User Listing
    ---------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $expensetype = ExpenseType::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($expensetype->get())
            ->addIndexColumn()
            ->editColumn('action', function (ExpenseType $expensetype) {
                $action  = '';
                $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.expensetype.edit',[$expensetype->id]).'><i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i></a>';
                $action .='<a class="btn btn-danger btn-circle btn-sm m-l-10 deleteexpensetype ml-1 mr-1" data-id ="'.$expensetype->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'SR No','width'=>'10%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'NAME','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'ACTIONS','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([ 'order' =>[] ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Create Category
    ---------------------------------------------------------------------------------- */
    public function create(){
        return view($this->pageLayout.'create');
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Store Category
    ---------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'name' => 'required|unique:expense_types,name',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            ExpenseType::create(['name' => @$request->get('name'),]);
            Notify::success('Expense Type Created Successfully..!');
            return redirect()->route('admin.expensetype.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Edit Category
    -----------------------------------------------------------------------------------*/
    public function edit($id){
        $expensetype = ExpenseType::where('id',$id)->first();
        if(!empty($expensetype)){
            return view($this->pageLayout.'edit',compact('expensetype'));
        }else{
            return redirect()->route('admin.expensetype.index');
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Update Category
    ---------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'name'      => 'required|min:1|max:60|unique:expense_types,name,'.$id
        ]);
        try{
            ExpenseType::where('id',$id)->update(['name' => @$request->get('name')]);
            Notify::success('Expense Type Updated Successfully..!');
            return redirect()->route('admin.expensetype.index');
        } catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Delete Transaction
    -----------------------------------------------------------------------------------*/
    public function delete($id){
        try{
            $expensetype = ExpenseType::where('id',$id)->first();
            $expensetype->delete();
            Notify::success('Expense Type Deleted Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Expense Type Deleted Successfully..!'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}