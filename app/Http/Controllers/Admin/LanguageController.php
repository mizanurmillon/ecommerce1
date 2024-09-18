<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Language;
Use DB;

class LanguageController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__language index method__//
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data=Language::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                         return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="lang_active"><span class="badge badge-success">Active</span></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="lang_deactive"></i> <span class="badge badge-danger">Deactive</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('language.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        return view('admin.language.index');
    }

    //__language store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['code']=$request->code;
        $data['app_lang_code']=$request->app_lang_code;
        $data['status']=1;

        DB::table('languages')->insert($data);
        return response()->json('successfully Language added!');
    }

    //__language edit method__//
    public function edit($id)
    {
        $data=DB::table('languages')->where('id',$id)->first();
        return view('admin.language.edit',compact('data'));
    }

    //__language update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['code']=$request->code;
        $data['app_lang_code']=$request->app_lang_code;
        $data['status']=$request->status;

        DB::table('languages')->where('id',$request->id)->update($data);
        return response()->json('successfully Language updated!');
    }

    //__language delete method__//
    public function destroy($id)
    {
        DB::table('languages')->where('id',$id)->delete();
        return response()->json('successfully Language deleted!');
    }

    //__language deactive method__//
    public function deactive($id)
    {
        DB::table('languages')->where('id',$id)->update(['status'=>0]);
        return response()->json('languages deactive!');
    }

    //__language active method__//
    public function active($id)
    {
        DB::table('languages')->where('id',$id)->update(['status'=>1]);
        return response()->json('languages active!');
    }
}
