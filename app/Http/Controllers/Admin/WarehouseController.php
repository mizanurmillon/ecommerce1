<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Warehouse;
Use DB;

class WarehouseController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__warehouse index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Warehouse::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('warehouse.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);  
        }
        return view('admin.warehouse.index');
    }

    //__warehouse store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;

        DB::table('warehouses')->insert($data);
        return response()->json('successfully warehouse inserted!');
    }

    //__warehouse edit method__//
    public function edit($id)
    {
        $data=DB::table('warehouses')->where('id',$id)->first();
        return view('admin.warehouse.edit',compact('data'));
    }

    //__warehouse update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;

        DB::table('warehouses')->where('id',$request->id)->update($data);
        return response()->json('successfully warehouse updated!');
    }

    //__warehose delete method__//
    public function destroy($id)
    {
       DB::table('warehouses')->where('id',$id)->delete();
       return response()->json('warehouse deleted!');
    }
}
