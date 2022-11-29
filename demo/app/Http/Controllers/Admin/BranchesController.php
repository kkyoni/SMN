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
use DB;

class BranchesController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * * Create a new controller instance.
     * * * *
     * * * * @return void
     * * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.branches.';
        $this->middleware('auth');
    }
    /*-----------------------------------------------------------------------------------
    @Description: Function for Index Branches Listing
    ---------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $branches_list = User::pluck('name','id');
        $branches = User::where('user_type_id','!=','1')->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($branches->get())
            ->addIndexColumn()
            ->editColumn('status', function (User $branches) {
                if($branches->status == "1"){
                    return '<div class="switch" value="1" data-id ="'.$branches->id.'"><div class="onoffswitch"><input type="checkbox" checked class="onoffswitch-checkbox" id="example1"><label class="onoffswitch-label" for="example1"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div></div>';
                } else {
                    return '<div class="switch" value="2" data-id ="'.$branches->id.'"><div class="onoffswitch"><input type="checkbox" class="onoffswitch-checkbox" id="example2"><label class="onoffswitch-label" for="example2"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div></div>';
                }
            })
            ->editColumn('action', function (User $branches) {
                $action  = '';
                $action .='<a class="btn btn-primary btn-circle btn-sm balance" data-id ="'.$branches->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-credit-card-alt"></i></a>';
                $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.branches.edit',[$branches->id]).'><i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i></a>';
                $action .='<a class="btn btn-danger btn-circle btn-sm deletebranches" data-id ="'.$branches->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'NAME','width'=>'5%'],
            ['data' => 'code', 'name' => 'code', 'title' => 'CODE','width'=>'5%'],
            // ['data' => 'username', 'name' => 'username', 'title' => 'USERNAME','width'=>'5%'],
            // ['data' => 'address', 'name' => 'address', 'title' => 'ADDRESS','width'=>'5%'],
            ['data' => 'city', 'name' => 'city', 'title' => 'CITY','width'=>'5%'],
            // ['data' => 'phone_number', 'name' => 'phone_number', 'title' => 'PHONE NUMBER','width'=>'5%'],
            ['data' => 'sender_commission', 'name' => 'sender_commission', 'title' => 'SENDER COMMISSION','width'=>'5%'],
            ['data' => 'receiving_commission', 'name' => 'receiving_commission', 'title' => 'RECEIVING COMMISSION','width'=>'5%'],
            ['data' => 'current_balance', 'name' => 'current_balance', 'title' => 'BALANCE','width'=>'5%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'STATUS','width'=>'5%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'15%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([ 'order' =>[], ]);
        return view($this->pageLayout.'index',compact('html','branches_list'));
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Create Branches
    --------------------------------------------------------------------------------- */
    public function create(){
        return view($this->pageLayout.'create');
    }
    /* ----------------------------------------------------------------------------------
    @Description: Function for Store Branches
    ---------------------------------------------------------------------------------- */
    public function store(Request $request){
        $reqData = $request->all();
        $id = !empty($reqData['id'])?$reqData['id']:0;
        $tableName = User::getTableName();
        $validatedData = Validator::make($request->all(),[
            'name' => 'required',
            'code' => 'required|unique:'.$tableName.',code,'.$id.',id',
            'username' => 'required|unique:'.$tableName.',username,'.$id.',id',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $authDetail = Auth::user();
            $authID = $authDetail->id;
            $record = $id > 0 ? User::find($id) : new User;
            $record->created_by = $authID;
            $record->name = $reqData['name'];
            $record->code = $reqData['code'];
            $record->username = $reqData['username'];
            $record->password = $reqData['password'];
            $record->address = !empty($reqData['address']) ? $reqData['address'] : NULL;
            $record->city = !empty($reqData['city']) ? $reqData['city'] : NULL;
            $record->phone_number = !empty($reqData['phone_number']) ? $reqData['phone_number'] : NULL;
            $record->sender_commission = !empty($reqData['sender_commission']) ? $reqData['sender_commission'] : NULL;
            $record->receiving_commission = !empty($reqData['receiving_commission']) ? $reqData['receiving_commission'] : NULL;
            $record->limit = !empty($reqData['limit']) ? $reqData['limit'] : NULL;
            $record->is_head_office = !empty($reqData['is_head_office']) ? $reqData['is_head_office'] : 0;
            $record->save();
            Notify::success('Branches Created Successfully..!');
            return redirect()->route('admin.branches.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Edit Branches
    ---------------------------------------------------------------------------------- */
    public function edit($id){
        $branches = User::where('user_type_id','!=','1')->where('id',$id)->first();
        if(!empty($branches)){
            return view($this->pageLayout.'edit',compact('branches'));
        }else{
            return redirect()->route('admin.branches.index');
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Update Branches
    ---------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $reqData = $request->all();
        $id = $id;
        $tableName = User::getTableName();
        $validatedData = Validator::make($request->all(),[
            'name' => 'required',
            'code' => 'required|unique:'.$tableName.',code,'.$id.',id',
            'username' => 'required|unique:'.$tableName.',username,'.$id.',id',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $authDetail = Auth::user();
            $authID = $authDetail->id;
            $record = $id > 0 ? User::find($id) : new User;
            $record->created_by = $authID;
            $record->name = $reqData['name'];
            $record->code = $reqData['code'];
            $record->username = $reqData['username'];
            $record->password = $reqData['password'];
            $record->address = !empty($reqData['address']) ? $reqData['address'] : NULL;
            $record->city = !empty($reqData['city']) ? $reqData['city'] : NULL;
            $record->phone_number = !empty($reqData['phone_number']) ? $reqData['phone_number'] : NULL;
            $record->sender_commission = !empty($reqData['sender_commission']) ? $reqData['sender_commission'] : NULL;
            $record->receiving_commission = !empty($reqData['receiving_commission']) ? $reqData['receiving_commission'] : NULL;
            $record->limit = !empty($reqData['limit']) ? $reqData['limit'] : NULL;
            $record->is_head_office = !empty($reqData['is_head_office']) ? $reqData['is_head_office'] : 0;
            $record->save();
            Notify::success('Branches Updated Successfully..!');
            return redirect()->route('admin.branches.index');
        } catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Delete Branches
    ---------------------------------------------------------------------------------- */
    public function delete($id){
        try{
            $id = $id;
            $tableName = User::getTableName();
            $record = User::find($id);
            if(!empty($record)){
                $code = $id.'_'.$record->code;
                $username = $id.'_'.$record->username;
                DB::update('update '.$tableName.' set username=?,code=? where id = ?',array($username,$code,$id));
                $record->delete();
                Notify::success('Branches Deleted Successfully..!');
                return response()->json([
                    'status'    => 'success',
                    'title'     => 'Success!!',
                    'message'   => 'Branches Deleted Successfully..!'
                ]);
            }
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Change Status Branches
    ---------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $branches = User::where('id',$request->id)->first();
            if($branches === null){
                return redirect()->back()->with([
                    'status'    => 'warning',
                    'title'     => 'Warning!!',
                    'message'   => 'Branches not found !!'
                ]);
            }else{
                if($branches->status == "1"){
                    User::where('id',$request->id)->update([
                        'status' => "2",
                    ]);
                }
                if($branches->status == "2"){
                    User::where('id',$request->id)->update([
                        'status'=> "1",
                    ]);
                }
            }
            Notify::success('Branches status Updated Successfully..!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Branches Status Updated Successfully..!'
            ]);
        }catch (Exception $e){
            return response()->json([
                'status'    => 'error',
                'title'     => 'Error!!',
                'message'   => $e->getMessage()
            ]);
        }
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for show Branches
    ---------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $branches = User::find($request->id);
        return view($this->pageLayout.'show',compact('branches'));
    }

    /* ----------------------------------------------------------------------------------
    @Description: Function for Update Balance Branches
    ---------------------------------------------------------------------------------- */
    public function updatebalance(Request $request,$id){
        $validatedData = $request->validate(['current_balance' => 'required',]);
        try{
            User::where('id',$id)->update(['current_balance' => @$request->get('current_balance')]);
            Notify::success('Branches Updated Balance Successfully..!');
            return redirect()->route('admin.branches.index');
        }catch (Exception $e){
            return response()->json(['status' => 'error','title' => 'Error!!','message'   => $e->getMessage()]);
        }
    }
}