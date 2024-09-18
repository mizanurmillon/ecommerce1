<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Tax;
Use DB;

class TaxController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__Tax index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Tax::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                         return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="active"><span class="badge badge-success">Active</span></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="deactive"></i> <span class="badge badge-danger">Deactive</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('tax.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        return view('admin.tax.index');
    }

    //__tax store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['tax_name']=$request->tax_name;
        $data['status']=1;

        DB::table('taxes')->insert($data);
        return response()->json('successfully tax added!');
    }

    //__tax edit method__//
    public function edit($id)
    {
        $data=DB::table('taxes')->where('id',$id)->first();
        return view('admin.tax.edit',compact('data'));
    }

    //__tax update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['tax_name']=$request->tax_name;
        $data['status']=1;

        DB::table('taxes')->where('id',$request->id)->update($data);
        return response()->json('successfully updated!');
    }

    //__tax delete method__//
    public function destroy($id)
    {
        DB::table('taxes')->where('id',$id)->delete();
        return response()->json('successfully tax deleted!');
    }

    //__deactive method__//
    public function deactive($id)
    {
        DB::table('taxes')->where('id',$id)->update(['status'=>0]);
        return response()->json('successfully tax deactive!');
    }

    //__active method__//
    public function active($id)
    {
        DB::table('taxes')->where('id',$id)->update(['status'=>1]);
        return response()->json('successfully tax active!');
    }
}
