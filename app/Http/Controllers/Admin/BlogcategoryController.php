<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Blogcategory;
use Illuminate\Support\Str;
use DB;

class BlogcategoryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__blog category index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Blogcategory::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('blogcategory.delete',[$row->id]).'" class="m-1" id="category_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);  
        }
        return view('admin.blog.blogcategory.index');
    }

    //__blog category store method__//
    public function store(Request $request)
    {  
        $data=array();
        $data['name']=$request->name;
        $data['slug']=str::slug($request->name,'-');

        DB::table('blogcategories')->insert($data);
        return response()->json('successfully blog category inserted!');
    }

    //__blog category edit method__//
    public function edit($id)
    {
        $data=DB::table('blogcategories')->where('id',$id)->first();
        return view('admin.blog.blogcategory.edit',compact('data'));
    }

    //__blog category update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['slug']=str::slug($request->name,'-');

        DB::table('blogcategories')->where('id',$request->id)->update($data);
        return response()->json('successfully blog category updated!');
    }

    //__blog category delete method__//
    public function destroy($id)
    {
        DB::table('blogcategories')->where('id',$id)->delete();
        return response()->json('blog category deleted!');
    }
}
