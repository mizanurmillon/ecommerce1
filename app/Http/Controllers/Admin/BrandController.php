<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Brand;
use Illuminate\Support\Str;
use Image;
use File;
Use DB;

class BrandController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__brand index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imageurl=asset('public/files/brand/');
            $data=Brand::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($row) use($imageurl){
                    return '<img src="'.$imageurl.'/'.$row->image.'" width="30" height="30" />';
                })
                ->editColumn('status',function($row){
                    if($row->status=="Active"){
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('brand.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);  
        }
        return view('admin.brand.index');
    }

    //brand store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['brand_name']=$request->brand_name;
        $data['brand_slug']=str::slug($request->brand_name,'-');
        $data['status']=$request->status;
        $data['meta_title']=$request->meta_title;
        $data['meta_description']=$request->meta_description;

        //Brand Image
        $image=$request->image;
        $imageName=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,80)->save('public/files/brand/'. $imageName);
        $data['image']=$imageName;
        
        DB::table('brands')->insert($data);
        return response()->json('successfully brand inserted!');
    }

    //__brand edit method__//
    public function edit($id)
    {
        $data=DB::table('brands')->where('id',$id)->first();
        return view('admin.brand.edit',compact('data'));
    }

    //__brand updated method__//
    public function update(Request $request)
    {
        $data=array();
        $data['brand_name']=$request->brand_name;
        $data['brand_slug']=str::slug($request->brand_name,'-');
        $data['status']=$request->status;
        $data['meta_title']=$request->meta_title;
        $data['meta_description']=$request->meta_description;
        $image=$request->file('image');
        if($image){
            $old_image='public/files/brand/'.$request->old_image;
            if (File::exists($old_image)) {
                File::delete($old_image);
            }
            $image=$request->image;
            $imageName=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(120,80)->save('public/files/brand/'. $imageName);
            $data['image']=$imageName;
        }else{
            $data['image']=$request->old_image;
        }
        DB::table('brands')->where('id',$request->id)->update($data);
        return response()->json('Brand updated!');
    }

    //__brand delete method__//
    public function destroy($id)
     {
         $brand=DB::table('brands')->where('id',$id)->first();
         if(File::exists('public/files/brand/'.$brand->image)){
            File::delete('public/files/brand/'.$brand->image);
         }
         DB::table('brands')->where('id',$id)->delete();
         return response()->json('Brand deleted!');
     } 
}
