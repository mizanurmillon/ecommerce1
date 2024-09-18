<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Shipping;
Use DB;

class ShippingController extends Controller
{
    /**
     * Create a new controller instance.
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__shipping index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Shipping::all();
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
                    <a href="'.route('shipping.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        return view('admin.shipping.index');
    }

    //__shipping charge store method__//
    public function store(Request $request)
     {
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'shipping_amount' => 'required',
        // ]);

        $data=array();
        $data['name']=$request->name;
        $data['shipping_amount']=$request->shipping_amount;
        $data['status']=$request->status;

        DB::table('shippings')->insert($data);
        return response()->json('successfully inserted shipping charge!');
    } 

    //__Shipping edit method__//
    public function edit($id)
    {
        $data=DB::table('shippings')->where('id',$id)->first();
        return view('admin.shipping.edit',compact('data'));
    }

    //__shipping update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['shipping_amount']=$request->shipping_amount;
        $data['status']=$request->status;
        DB::table('shippings')->where('id',$request->id)->update($data);
        return response()->json('successfully shipping charge updated!');
    }

    //__Shipping delete method__//
    public function destroy($id)
    {
        DB::table('shippings')->where('id',$id)->delete();
        return response()->json('successfully shipping charge deleted!');
    }

}
