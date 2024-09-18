<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use Illuminate\Support\Str;
use Image;
use File;
Use DB;

class SubcategoryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__subcategory index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imageurl=asset('public/files/subcategory/');
            $data=Subcategory::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category_name',function($row){
                    return $row->category->category_name;
                })
                ->editColumn('image', function($row) use($imageurl){
                    return '<img src="'.$imageurl.'/'.$row->image.'" width="30" height="30" />';
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('subcategory.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','image','category_name'])
                ->make(true);  
        }
        $category=Category::all();
        return view('admin.subcategory.index',compact('category'));
    }

    //__subcategory store method__//
    public function store(Request $request)
    {
        
        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['subcategory_slug']=str::slug($request->subcategory_name,'-');
        //Subcategory Image
        $image=$request->image;
        $imagename=uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(360,360)->save('public/files/subcategory/'. $imagename);
        $data['image']=$imagename;

        DB::table('subcategories')->insert($data);
        return response()->json('successfully subcategory inserted!');
    }

    //__subcategory edit method__//
    public function edit($id)
    {
        $category=Category::all();
        $data=DB::table('subcategories')->where('id',$id)->first();
        return view('admin.subcategory.edit',compact('data','category'));
    }

    //__subcategory update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['subcategory_slug']=str::slug($request->subcategory_name,'-');
        $image=$request->file('image');
        if($image){
            $old_image='public/files/subcategory/'.$request->old_image;
            if (File::exists($old_image)) {
                File::delete($old_image);
            }
            $image=$request->image;
            $imageName=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(360,360)->save('public/files/subcategory/'. $imageName);
            $data['image']=$imageName;
        }else{
            $data['image']=$request->old_image;
        }

        DB::table('subcategories')->where('id',$request->id)->update($data);
        return response()->json('successfully subcategory updated!');
    }

    //__subcategory delete method__//
    public function destroy($id)
    {
        $subcategory=DB::table('subcategories')->where('id',$id)->first();
        if (File::exists('public/files/subcategory/'.$subcategory->image)) {
            File::delete('public/files/subcategory/'.$subcategory->image);
        }
        DB::table('subcategories')->where('id',$id)->delete();
        return response()->json('subcategory deleted!');
    }
}
