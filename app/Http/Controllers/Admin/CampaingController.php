<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Campaing;
Use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Image;
use File;
use Illuminate\Support\Facades\Session;

class CampaingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__campaing index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imageurl=asset('public/files/campaing/');
            $data=Campaing::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($row) use($imageurl){
                    return '<img src="'.$imageurl.'/'.$row->image.'" width="60" height="30" />';
                })
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
                        return '<span class="badge badge-danger">Close</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="'.route('campaing.edit',[$row->id]).'" class="m-1 edit"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('campaing.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','status','discount_amount'])
                ->make(true);  
        }
        return view('admin.campaing.index');
    }

    //__campaing store method__//
    public function store(Request $request)
    {
        $Validator=Validator::make($request->all(),[
            'campaing_title' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required'
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
        if (!empty($request->starts_at) && !empty($request->ends_at)) {
            $endsAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->ends_at);
            $startAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
            if ($endsAt->gt($startAt) == false) {
                return response()->json([
                    'status'=> false,
                    'errors'=>['ends_at'=>'End date must be greator then start date']
                ]);
            }
        }
        if($Validator->passes()){
            $data=array();
            $data['campaing_title']=$request->campaing_title;
            $data['discount_amount']=$request->discount_amount;
            $data['type']=$request->type;
            $data['status']=$request->status;
            $data['starts_at']=$request->starts_at;
            $data['ends_at']=$request->ends_at;
            //Campaing Image
            $image=$request->image;
            $imageName=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1300,650)->save('public/files/campaing/'. $imageName);
            $data['image']=$imageName;

            DB::table('campaings')->insert($data);
            return response()->json('successfully campaing inserted!');

        }else{
            return response()->json([
                'status'=> false,
                'errors'=>$Validator->errors()
            ]);
        }
    }

    //__campaing edit method__//
    public function edit($id)
    {
       $data=DB::table('campaings')->where('id',$id)->first();
       return view('admin.campaing.edit',compact('data'));
    }

    //__campaing update method__//
    public function update(Request $request)
    {
       $Validator=Validator::make($request->all(),[
            'campaing_title' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required'
        ]);
        //expires date must be greator then start date
        if (!empty($request->starts_at) && !empty($request->ends_at)) {
            $endsAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->ends_at);
            $startAt=Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
            if ($endsAt->gt($startAt) == false) {
                return response()->json([
                    'status'=> false,
                    'errors'=>['ends_at'=>'End date must be greator then start date']
                ]);
            }
        }
        if($Validator->passes()){
            $data=array();
            $data['campaing_title']=$request->campaing_title;
            $data['discount_amount']=$request->discount_amount;
            $data['type']=$request->type;
            $data['status']=$request->status;
            $data['starts_at']=$request->starts_at;
            $data['ends_at']=$request->ends_at;
            //Campaing Image
            $image=$request->file('image');
            if($image){
                $old_image='public/files/campaing/'.$request->old_image;
                if (File::exists($old_image)) {
                    File::delete($old_image);
                }
                $image=$request->image;
                $imageName=uniqid().'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(1300,650)->save('public/files/campaing/'. $imageName);
                $data['image']=$imageName;
            }else{
                $data['image']=$request->old_image;
            }

            DB::table('campaings')->where('id',$request->id)->update($data);
            return response()->json('successfully campaing updated!');

        }else{
            return response()->json([
                'status'=> false,
                'errors'=>$Validator->errors()
            ]);
        }
    }

    //__campaing delete method__//
    public function destroy($id)
    {
        $campaing=DB::table('campaings')->where('id',$id)->first();
         if(File::exists('public/files/campaing/'.$campaing->image)){
            File::delete('public/files/campaing/'.$campaing->image);
         }
        DB::table('campaings')->where('id',$id)->delete();
        return response()->json('successfully campaing deleted!');
    }

}
