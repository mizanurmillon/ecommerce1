<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Category;
use Illuminate\Support\Str;
use Image;
use File;
Use DB;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__category index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imageurl=asset('public/files/category/');
            $data=DB::table('categories')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('icon', function($row) use($imageurl){
                    return '<img src="'.$imageurl.'/'.$row->icon.'" width="30" height="30" />';
                })
                ->editColumn('cover_image',function($row) use($imageurl){
                    return '<img src="'.$imageurl.'/'.$row->cover_image.'" width="50" height="50"/>';
                })
                ->editColumn('status',function($row){
                    if($row->status==1){
                        return '<span class="badge badge-success">Active</span></a>';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('category.delete',[$row->id]).'" class="m-1" id="category_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','icon','status','cover_image'])
                ->make(true);  
        }
       return view('admin.category.index');
    }

    //__category store method__//
    public function store(Request $request)
    {
        
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name,'-');
        $data['type']=$request->type;
        $data['status']=$request->status;

        //icon
        $icon=$request->icon;
        $iconname=uniqid().'.'.$icon->getClientOriginalExtension();
        Image::make($icon)->resize(32,32)->save('public/files/category/'.$iconname);
        $data['icon']=$iconname;

        //Banner
        $banner=$request->banner;
        $bannername=uniqid().'.'.$banner->getClientOriginalExtension();
        Image::make($banner)->resize(200,200)->save('public/files/category/'.$bannername);
        $data['banner']=$bannername;

        //Cover Image
        $cover_image=$request->cover_image;
        $imagename=uniqid().'.'.$cover_image->getClientOriginalExtension();
        Image::make($cover_image)->resize(360,360)->save('public/files/category/'.$imagename);
        $data['cover_image']=$imagename;
        $data['meta_title']=$request->meta_title;
        $data['meta_description']=$request->meta_description;

        DB::table('categories')->insert($data);
        return response()->json('successfully category inserted!');

    }

    //__category edit method__//
    public function edit($id)
    {
        $data=DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }

    //__category update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name,'-');
        $data['type']=$request->type;
        $data['status']=$request->status;
        //Icon
        $icon=$request->file('icon');
        if($icon){
            $old_icon='public/files/category/'.$request->old_icon;
            if (File::exists($old_icon)) {
                File::delete($old_icon);
            }
            $icon=$request->icon;
            $iconname=uniqid().'.'.$icon->getClientOriginalExtension();
            Image::make($icon)->resize(32,32)->save('public/files/category/'. $iconname);
            $data['icon']=$iconname;
        }else{
            $data['icon']=$request->old_icon;
        }
        //Banner
        $banner=$request->file('banner');
        if($banner){
            $old_banner='public/files/category/'.$request->old_banner;
            if (File::exists($old_banner)) {
                File::delete($old_banner);
            }
            $banner=$request->banner;
            $bannername=uniqid().'.'.$banner->getClientOriginalExtension();
            Image::make($banner)->resize(200,200)->save('public/files/category/'. $bannername);
            $data['banner']=$bannername;
        }else{
            $data['banner']=$request->old_banner;
        }
        //Cover Image
        $cover_image=$request->file('cover_image');
        if($cover_image){
            $old_cover_image='public/files/category/'.$request->old_cover_image;
            if (File::exists($old_cover_image)) {
                File::delete($old_cover_image);
            }
            $cover_image=$request->cover_image;
            $imagename=uniqid().'.'.$cover_image->getClientOriginalExtension();
            Image::make($cover_image)->resize(360,360)->save('public/files/category/'. $imagename);
            $data['cover_image']=$imagename;
        }else{
            $data['cover_image']=$request->old_cover_image;
        }
        $data['meta_title']=$request->meta_title;
        $data['meta_description']=$request->meta_description;
        $data['category_slug']=$request->category_slug;

        DB::table('categories')->where('id',$request->id)->update($data);
        return response()->json('category updated!');

    }

    //__category delete method__//
    public function destroy($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
        if (File::exists('public/files/category/'.$category->icon)) {
            File::delete('public/files/category/'.$category->icon);
        }
        if (File::exists('public/files/category/'.$category->banner)) {
            File::delete('public/files/category/'.$category->banner);
        }
        if (File::exists('public/files/category/'.$category->cover_image)) {
            File::delete('public/files/category/'.$category->cover_image);
        }
        DB::table('categories')->where('id',$id)->delete();
        return response()->json('successfully category deleted!');
    }
    public function getchildcategory($id)
    {
        $data=DB::table('childcategories')->where('subcategory_id',$id)->get();
        return response()->json($data);
    }
}
