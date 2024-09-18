<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Page;
use Illuminate\Support\Str;
Use DB;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__page index method__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Page::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if($row->status==1){
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('page.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);  
        }
        return view('admin.page.index');
    }

    //__page store method__//
    public function store(Request $request)
    {
        $data=array();
        $data['page_title']=$request->page_title;
        $data['slug']=str::slug($request->page_title,'-');
        $data['page_position']=$request->page_position;
        $data['content']=$request->content;
        $data['status']=1;

        DB::table('pages')->insert($data);
        return response()->json('successfully page inserted!');
    }

    //__page edit method__//
    public function edit($id)
    {
        $data=DB::table('pages')->where('id',$id)->first();
        return view('admin.page.edit',compact('data'));
    }

    //__page delete method__//
    public function destroy($id)
    {
        DB::table('pages')->where('id',$id)->delete();
        return response()->json('successfully page deleted!');
    }

    //__page update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['page_title']=$request->page_title;
        $data['slug']=str::slug($request->page_title,'-');
        $data['page_position']=$request->page_position;
        $data['content']=$request->content;
        $data['status']=$request->status;

        DB::table('pages')->where('id',$request->id)->update($data);
        return response()->json('successfully page updated!');
    }
}
