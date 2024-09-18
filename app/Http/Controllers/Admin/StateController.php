<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Country;
use App\Models\Admin\State;
Use DB;

class StateController extends Controller
{
    /**
     * Create a new controller instance.
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__shipping state index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $state="";
            $query=DB::table('states')->leftJoin('countries','states.country_id','countries.id');
            if($request->country_id)
            {
                $query->where('country_id',$request->country_id);
            }
            if($request->state)
            { 
                $query->where('state',$request->state);
            }
            $state=$query->select('states.*','countries.country_name')->get();
            return DataTables::of($state)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                         return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="state_show"><span class="badge badge-success">Show</span></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="state_hide"></i> <span class="badge badge-danger">Hide</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('shipping.state.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        $country=DB::table('countries')->where('status',1)->get();
        return view('admin.state.index',compact('country'));
    }

    //__shipping state store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['country_id']=$request->country_id;
        $data['state']=$request->state;
        $data['status']=1;

        DB::table('states')->insert($data);
        return response()->json('successfully state inserted!');
    }

    //__shipping state edit method__//
    public function edit($id)
    {
        $data=DB::table('states')->where('id',$id)->first();
        $country=DB::table('countries')->where('status',1)->get();
        return view('admin.state.edit',compact('data','country'));
    }

    //__shipping state update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['country_id']=$request->country_id;
        $data['state']=$request->state;
        $data['status']=$request->status;

        DB::table('states')->where('id',$request->id)->update($data);
        return response()->json('successfully state updated!');
    }

    //__shipping state delete method__//
    public function destroy($id)
    {
        DB::table('states')->where('id',$id)->delete();
        return response()->json('state deleted!');
    }

    //__state hide method__//
    public function hide($id)
    {
        DB::table('states')->where('id',$id)->update(['status'=>0]);
        return response()->json('state hide!');
    }

    //__state show method__//
    public function show($id)
    {
        DB::table('states')->where('id',$id)->update(['status'=>1]);
        return response()->json('state show!');
    }
}
