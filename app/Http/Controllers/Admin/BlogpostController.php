<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use App\Models\Admin\Blogcategory;
use App\Models\Admin\Blogpost;
use Image;
use File;
Use DB;

class BlogpostController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__blog post index  method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Blogpost::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name',function($row){
                    return $row->blogcategory->name;
                })
                ->editColumn('status',function($row){
                    if($row->status==1){
                        return '<span class="badge badge-success">Publise</span>';
                    }else{
                        return '<span class="badge badge-danger">Unpublise</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('blog.post.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','name','status'])
                ->make(true);  
        }
        $blogcategory=DB::table('blogcategories')->get();
        return view('admin.blog.post.index',compact('blogcategory'));
    }

    //__blog post store method__//
    public function store(Request $request)
    { 
        // $validatedData = $request->validate([
        //     'blog_title' => 'required|unique:blogposts|max:255',
        //     'blogcategory_id' => 'required',
        //     'short_description' => 'required|max:700',
        // ]);

        $data=array();
        $data['blogcategory_id']=$request->blogcategory_id;
        $data['blog_title']=$request->blog_title;
        $data['blog_slug']=str::slug($request->blog_title,'-');
        $data['short_description']=$request->short_description;
        $data['description']=$request->description;

        //banner Image
        $banner_image=$request->banner_image;
        $imagename=uniqid().'.'.$banner_image->getClientOriginalExtension();
        Image::make($banner_image)->resize(1300,650)->save('public/files/post/'. $imagename);
        $data['banner_image']=$imagename;

        $data['meta_title']=$request->meta_title;
        $data['meta_description']=$request->meta_description;
        $data['meta_keyword']=$request->meta_keyword;

        //banner Image
        $meta_image=$request->meta_image;
        $metaimagename=uniqid().'.'.$meta_image->getClientOriginalExtension();
        Image::make($meta_image)->resize(200,200)->save('public/files/post/'. $metaimagename);
        $data['meta_image']=$metaimagename;
        $data['status']=1;
        $data['date']=date('d-m-Y');

        DB::table('blogposts')->insert($data);
        return response()->json('successfully blog post inserted!');
    }

    //__blog post edit method__//
    public function edit($id)
    {
        $data=DB::table('blogposts')->where('id',$id)->first();
        $blogcategory=DB::table('blogcategories')->get();
        return view('admin.blog.post.edit',compact('data','blogcategory'));
    }

    //__blog post update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['blogcategory_id']=$request->blogcategory_id;
        $data['blog_title']=$request->blog_title;
        $data['blog_slug']=str::slug($request->blog_title,'-');
        $data['short_description']=$request->short_description;
        $data['description']=$request->description;
        //banner Image
        $banner_image=$request->file('banner_image');
        if($banner_image){
            $old_image='public/files/post/'.$request->old_image;
            if (File::exists($old_image)) {
                File::delete($old_image);
            }
            $banner_image=$request->banner_image;
            $imagename=uniqid().'.'.$banner_image->getClientOriginalExtension();
            Image::make($banner_image)->resize(1300,650)->save('public/files/post/'. $imagename);
            $data['banner_image']=$imagename;
        }else{
            $data['banner_image']=$request->old_image;
        }
        $data['meta_title']=$request->meta_title;
        $data['meta_description']=$request->meta_description;
        $data['meta_keyword']=$request->meta_keyword;

        //meta Image
        $meta_image=$request->file('meta_image');
        if ($meta_image) {
            $old_meta_image='public/files/post/'.$request->old_meta_image;
            if (File::exists($old_meta_image)) {
               File::delete($old_meta_image);
            }
            $meta_image=$request->meta_image;
            $metaimagename=uniqid().'.'.$meta_image->getClientOriginalExtension();
            Image::make($meta_image)->resize(200,200)->save('public/files/post/'. $metaimagename);
            $data['meta_image']=$metaimagename;
        }else{
            $data['meta_image']=$request->old_meta_image;
        }
        $data['status']=$request->status;
        $data['date']=date('d-m-Y');
        DB::table('blogposts')->where('id',$request->id)->update($data);
        return response()->json('successfully blog post updated!');
    }
    
    //__blog post delete method__//
    public function destroy($id)
    {
        $post=DB::table('blogposts')->where('id',$id)->first();
        if (File::exists('public/files/post/'.$post->banner_image)) {
            File::delete('public/files/post/'.$post->banner_image);
        }
        if (File::exists('public/files/post/'.$post->meta_image)) {
            File::delete('public/files/post/'.$post->meta_image);
        }
        DB::table('blogposts')->where('id',$id)->delete();
        return response()->json('successfully blog post deleted!');
    }
}
