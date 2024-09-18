<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Color;
Use DB;

class ColorController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__color index method__//
    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $data=Color::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if($row->status==1){
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('color.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        return view('admin.color.index');
    }

    //__color store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['color_name']=$request->color_name;
        $data['color_code']=$request->color_code;
        $data['status']=1;

        DB::table('colors')->insert($data);
        return response()->json('successfully color added!');
    }

    //__color edit method__//
    public function edit($id)
    {
        $data=DB::table('colors')->where('id',$id)->first();
        return view('admin.color.edit',compact('data'));
    }

    //__color update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['color_name']=$request->color_name;
        $data['color_code']=$request->color_code;
        $data['status']=$request->status;

        DB::table('colors')->where('id',$request->id)->update($data);
        return response()->json('successfully color updated!');
    }

    //__color delete method__//
    public function destroy($id)
    {
        DB::table('colors')->where('id',$id)->delete();
        return response()->json('color deleted!');
    }
}
