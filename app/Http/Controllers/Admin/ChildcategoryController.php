<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Childcategory;
use Illuminate\Support\Str;
use DataTables;
Use DB;

class ChildcategoryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__childcategory index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Childcategory::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category_name',function($row){
                    return $row->category->category_name;
                })
                ->editColumn('subcategory_name',function($row){
                    return $row->subcategory->subcategory_name;
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('childcategory.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','category_name','subcategory'])
                ->make(true);  
        }
        $category=Category::all();
        $subcategory=Subcategory::all();
        return view('admin.childcategory.index',compact('category','subcategory'));
    }

    //__childcategory store method__//
    public function store(Request $request)
    {
        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_name']=$request->childcategory_name;
        $data['childcategory_slug']=str::slug($request->childcategory_name,'-');

        DB::table('childcategories')->insert($data);
        return response()->json('successfully childcategory inserted!');
    }

    //__childcategory edit method__//
    public function edit($id)
    {
        $data=DB::table('childcategories')->where('id',$id)->first();
        $category=Category::all();
        $subcategory=Subcategory::all();
        return view('admin.childcategory.edit',compact('data','category','subcategory'));
    }

    //__childcategory update method__//
    public function update(Request $request)
    {
        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_name']=$request->childcategory_name;
        $data['childcategory_slug']=$request->childcategory_slug;

        DB::table('childcategories')->where('id',$request->id)->update($data);
        return response()->json('successfully childcategory updated!');
    }

    //__childcategory deleted method__//

    public function destroy($id)
    {
        DB::table('childcategories')->where('id',$id)->delete();
        return response()->json('childcategory deleteed!');
    }
}
