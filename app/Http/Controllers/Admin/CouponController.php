<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Coupon;
Use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Create a new controller instance.
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__coupon index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('coupons')->orderBy('id','DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('discount_amount',function($row){
                    if ($row->type=="percent") {
                        return $row->discount_amount.'%';
                    }else{
                        return '$'.$row->discount_amount;
                    }
                })
                ->editColumn('status',function($row){
                    if($row->status==1){
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="'.route('coupon.edit',[$row->id]).'" class="m-1 edit"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('coupon.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status','discount_amount'])
                ->make(true);  
        }
        return view('admin.coupon.index');
    }

    //__coupon store method__//
    public function store(Request $request)
    {
        $Validator=Validator::make($request->all(),[
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);
        //starting date must be greator then current date
        if (!empty($request->starts_at)) {
            $now=Carbon::now();
            $startAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
            if ($startAt->lte($now) == true) {
                return response()->json([
                    'status'=> false,
                    'errors'=>['starts_at'=>'start date cen be less then current date time']
                ]);
            }
        }
        //expires date must be greator then start date
        if (!empty($request->starts_at) && !empty($request->expires_at)) {
            $expiresAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);
            $startAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
            if ($expiresAt->gt($startAt) == false) {
                return response()->json([
                    'status'=> false,
                    'errors'=>['expires_at'=>'Expires date must be greator then start date']
                ]);
            }
        }
        if($Validator->passes()){
            $data=array();
            $data['coupon_name']=$request->coupon_name;
            $data['coupon_code']=$request->coupon_code;
            $data['description']=$request->description;
            $data['max_uses']=$request->max_uses;
            $data['max_uses_user']=$request->max_uses_user;
            $data['type']=$request->type;
            $data['discount_amount']=$request->discount_amount;
            $data['min_amount']=$request->min_amount;
            $data['status']=$request->status;
            $data['starts_at']=$request->starts_at;
            $data['expires_at']=$request->expires_at;

            DB::table('coupons')->insert($data);
            return response()->json('successfully coupon inserted!');
        }else{
            return response()->json([
                'status'=> false,
                'errors'=>$Validator->errors()
            ]);
        }
    }

    //__coupon edit method__//
    public function edit($id)
    {
        $data=DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit',compact('data'));
    }

    //__coupon update method__//
    public function update(Request $request)
    {
        $Validator=Validator::make($request->all(),[
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);
        
        //expires date must be greator then start date
        if (!empty($request->starts_at) && !empty($request->expires_at)) {
            $expiresAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);
            $startAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
            if ($expiresAt->gt($startAt) == false) {
                return response()->json([
                    'status'=> false,
                    'errors'=>['expires_at'=>'Expires date must be greator then start date']
                ]);
            }
        }
        if($Validator->passes()){
            $data=array();
            $data['coupon_name']=$request->coupon_name;
            $data['coupon_code']=$request->coupon_code;
            $data['description']=$request->description;
            $data['max_uses']=$request->max_uses;
            $data['max_uses_user']=$request->max_uses_user;
            $data['type']=$request->type;
            $data['discount_amount']=$request->discount_amount;
            $data['min_amount']=$request->min_amount;
            $data['status']=$request->status;
            $data['starts_at']=$request->starts_at;
            $data['expires_at']=$request->expires_at;
            
            DB::table('coupons')->where('id',$request->id)->update($data);
            return response()->json('successfully coupon updateed!');
            
        }else{
            return response()->json([
                'status'=> false,
                'errors'=>$Validator->errors()
            ]);
        }
    }

    //__coupon deleted method__//
    public function destroy($id)
    {
        DB::table('coupons')->where('id',$id)->delete();
        return response()->json('successfully coupon deleted!');
    }
}
