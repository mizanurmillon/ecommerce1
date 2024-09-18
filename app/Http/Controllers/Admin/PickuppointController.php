<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Pickuppoint;
Use DB;

class PickuppointController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__pickuppoint index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Pickuppoint::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('pickuppoint.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);  
        }
        return view('admin.pickuppoint.index');
    }

    //__pickuppoint store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['address']=$request->address;
        $data['city']=$request->city;
        $data['state']=$request->state;
        $data['zip_code']=$request->zip_code;
        $data['phone']=$request->phone;

        DB::table('pickuppoints')->insert($data);
        return response()->json('successfully pickuppoint inserted!');
    }

    //__pickuppoint edit method__//
    public function edit($id)
    {
        $data=DB::table('pickuppoints')->where('id',$id)->first();
        return view('admin.pickuppoint.edit',compact('data'));
    }

    //__pickuppoint update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['address']=$request->address;
        $data['city']=$request->city;
        $data['state']=$request->state;
        $data['zip_code']=$request->zip_code;
        $data['phone']=$request->phone;

        DB::table('pickuppoints')->where('id',$request->id)->update($data);
        return response()->json('successfully pickuppoint updated!');
    }

    //pickuppoint delete method__//
    public function destroy($id)
    {
        DB::table('pickuppoints')->where('id',$id)->delete();
        return response()->json('pickuppoint deleted!');
    }
}
