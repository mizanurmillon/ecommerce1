<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Currency;
Use DB;

class CurrencyController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__Currency index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Currency::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                         return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="curr_active"><span class="badge badge-success">Active</span></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="curr_deactive"></i> <span class="badge badge-danger">Deactive</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('currency.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        return view('admin.currency.index');
    }

    //__currency store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['symbol']=$request->symbol;
        $data['code']=$request->code;
        $data['exchange_rate']=$request->exchange_rate;
        $data['status']=1;

        DB::table('currencies')->insert($data);
        return response()->json('successfully Currency added!');
    }

    //__currency edit method__//
    public function edit($id)
    {
        $data=DB::table('currencies')->where('id',$id)->first();
        return view('admin.currency.edit',compact('data'));
    }

    //__currency update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['symbol']=$request->symbol;
        $data['code']=$request->code;
        $data['exchange_rate']=$request->exchange_rate;
        $data['status']=$request->status;

        DB::table('currencies')->where('id',$request->id)->update($data);
        return response()->json('successfully Currency updated!');
    }

    //__currency delete method__//
    public function destroy($id)
    {
        DB::table('currencies')->where('id',$id)->delete();
        return response()->json('successfully Currency deleted!');
    }

    //__currency deactive method__//
    public function deactive($id)
    {
        DB::table('currencies')->where('id',$id)->update(['status'=>0]);
        return response()->json('currency deactive!');
    }

    //__currency active method__//
    public function active($id)
    {
        DB::table('currencies')->where('id',$id)->update(['status'=>1]);
        return response()->json('currency active!');
    }

}
