<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Country;
use App\Models\Admin\State;
use App\Models\Admin\City;
Use DB;

class CityController extends Controller
{
    //__shipping city index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $city="";
            $query=DB::table('cities')->leftJoin('countries','cities.country_id','countries.id')->leftJoin('states','cities.state_id','states.id');
            if($request->name)
            { 
                $query->where('name',$request->name);
            }
            if($request->state_id)
            { 
                $query->where('state_id',$request->state_id);
            }
            $city=$query->select('cities.*','countries.country_name','states.state')->get();
            return DataTables::of($city)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                         return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="city_show"><span class="badge badge-success">Show</span></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="city_hide"></i> <span class="badge badge-danger">Hide</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('shipping.city.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        $country=DB::table('countries')->where('status',1)->get();
        $state=DB::table('states')->where('status',1)->get();
        return view('admin.city.index',compact('country','state'));
    }

    //__shipping city store method__//
    public function store(Request $request)
    {
        $state=DB::table('states')->where('id',$request->state_id)->first();
        $data=array();
        $data['country_id']=$state->country_id;
        $data['state_id']=$request->state_id;
        $data['name']=$request->name;
        $data['status']=1;

        DB::table('cities')->insert($data);
        return response()->json('successfully city added!');
    }

    //__shipping city edit method__//
    public function edit($id)
    {
        $data=DB::table('cities')->where('id',$id)->first();
        $state=DB::table('states')->get();
        $country=DB::table('countries')->get();
        return view('admin.city.edit',compact('data','state','country'));
    }

    //__shipping city update method__//
    public function update(Request $request)
    {
        $state=DB::table('states')->where('id',$request->state_id)->first();
        $data=array();
        $data['country_id']=$state->country_id;
        $data['state_id']=$request->state_id;
        $data['name']=$request->name;
        $data['status']=$request->status;

        DB::table('cities')->where('id',$request->id)->update($data);
        return response()->json('successfully city updated!');
    }

    //__shipping city delete method__//
    public function destroy($id)
    {
        DB::table('cities')->where('id',$id)->delete();
        return response()->json('successfully city deleted!');
    }

    //__city hide method__//
    public function hide($id)
    {
        DB::table('cities')->where('id',$id)->update(['status'=>0]);
        return response()->json('city hide!');
    }

    //__city show method__//
    public function show($id)
    {
        DB::table('cities')->where('id',$id)->update(['status'=>1]);
        return response()->json('City show!');
    }
}

