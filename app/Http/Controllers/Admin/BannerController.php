<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Banner;
use Image;
use File;
Use DB;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__banner index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imageurl=asset('public/files/banner/small/');
            $data=Banner::all();
            return DataTables::of($data)
                ->addIndexColumn()
                 ->editColumn('image', function($row) use($imageurl){
                    return '<img src="'.$imageurl.'/'.$row->image.'" width="60" height="45" />';
                })
                ->editColumn('status',function($row){
                    if($row->status==1){
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="status_active"><span class="badge badge-success">Active</span></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="status_deactive"><span class="badge badge-danger">Deactive</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="'.route('banner.edit',[$row->id]).'" class="m-1 edit"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('banner.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);  
        }
        return view('admin.banner.index');
    }

    //__create method__//
    public function create()
    {
        return view('admin.banner.create');
    }

    //__banner store method__//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort' => 'required',
        ]);

        $data=array();
        $data['title']=$request->title;
        $data['type']=$request->type;
        $data['link']=$request->link;
        $data['alt']=$request->alt;
        $data['sort']=$request->sort;
        $data['status']=1;
        //banner small image--------
        $image=$request->image;
        $imagename=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,120)->save('public/files/banner/small/'. $imagename);
        $data['image']=$imagename;

        //banner big image--------
        $max_image=$request->max_image;
        $max_imagename=uniqid().'.'.$max_image->getClientOriginalExtension();
        Image::make($max_image)->resize(1370,420)->save('public/files/banner/big/'. $max_imagename);
        $data['max_image']=$max_imagename;

        DB::table('banners')->insert($data);
        $notification=array('message' => 'successfully banner inserted!', 'alert-type' => 'success');
        return redirect()->route('banner')->with($notification);

    }

    //__banner edit method__//
    public function edit($id)
    {
        $data=DB::table('banners')->where('id',$id)->first();
        return view('admin.banner.edit',compact('data'));
    }

    //__banner update method__//
    public function update(Request $request , $id)
    {
        $data=array();
        $data['title']=$request->title;
        $data['type']=$request->type;
        $data['link']=$request->link;
        $data['alt']=$request->alt;
        $data['sort']=$request->sort;
        //small banner image
        $image=$request->file('image');
        if ($image) {
            $old_image='public/files/banner/small/'.$request->old_image;
            if (File::exists($old_image)) {
                File::delete($old_image);
            }
            $image=$request->image;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(370,120)->save('public/files/banner/small/'. $imagename);
            $data['image']=$imagename;
        }else{
            $data['image'] = $request->old_image;
        }
        //Learg Banner Image-------
        $max_image=$request->file('max_image');
        if ($max_image) {
            $old_max_image='public/files/banner/big/'.$request->old_max_image;
            if (File::exists($old_max_image)) {
                File::delete($old_max_image);
            }
            $max_image=$request->max_image;
            $maximagename=uniqid().'.'.$max_image->getClientOriginalExtension();
            Image::make($max_image)->resize(1370,420)->save('public/files/banner/big/'. $maximagename);
            $data['max_image']=$maximagename;
        }else{
            $data['max_image'] = $request->old_max_image;
        }
        DB::table('banners')->where('id',$id)->update($data);
        $notification=array('message' => 'successfully banner updated!', 'alert-type' => 'success');
        return redirect()->route('banner')->with($notification);
    }

    //__banner delete method__//
    public function destroy($id)
    {
        $image=DB::table('banners')->where('id',$id)->first();
        if (File::exists('public/files/banner/small/'.$image->image)) {
            File::delete('public/files/banner/small/'.$image->image);
        }
        if (File::exists('public/files/banner/big/'.$image->max_image)) {
            File::delete('public/files/banner/big/'.$image->max_image);
        }
        DB::table('banners')->where('id',$id)->delete();
        return response()->json('successfully banner deleted!');
    }
    
    //__banner active method__//
    public function active($id)
    {
        DB::table('banners')->where('id',$id)->update(['status'=>0]);
        return response()->json('banner active!');
    }
    //__banner deactive method__//
    public function deactive($id)
    {
       DB::table('banners')->where('id',$id)->update(['status'=>1]);
       return response()->json('banner deactive!');
    }
}
