<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Country;
Use DB;

class CountryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__shipping country index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Country::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                         return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="show"><span class="badge badge-success">Show</span></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="hide"></i> <span class="badge badge-danger">Hide</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('shipping.country.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        return view('admin.countries.index');
    }

    //__shipping Country store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['country_name']=$request->country_name;
        $data['country_code']=$request->country_code;
        $data['status']=1;

        DB::table('countries')->insert($data);
        return response()->json('successfully country inserted!');
    }

    //__country hide method__//
    public function hide($id)
    {
        DB::table('countries')->where('id',$id)->update(['status'=>0]);
        return response()->json('countries hide!');
    }
    //__country show method__//
    public function show($id)
    {
        DB::table('countries')->where('id',$id)->update(['status'=>1]);
        return response()->json('countries show!');
    }

    //__shipping country edit method__//
    public function edit($id)
    {
        $data=DB::table('countries')->where('id',$id)->first();
        return view('admin.countries.edit',compact('data'));
    }

    //__shipping country update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['country_name']=$request->country_name;
        $data['country_code']=$request->country_code;
        $data['status']=$request->status;

        DB::table('countries')->where('id',$request->id)->update($data);
        return response()->json('successfully country updated!');
    }

    //__shipping country delete method__//
    public function destroy($id)
    {
        DB::table('countries')->where('id',$id)->delete();
        return response()->json('successfully shipping country deleteed!');
    }
}
