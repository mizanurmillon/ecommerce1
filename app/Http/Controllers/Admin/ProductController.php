<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Childcategory;
use App\Models\Admin\Brand;
use App\Models\Admin\Warehouse;
use App\Models\Admin\Pickuppoint;
use App\Models\Admin\Product;
use Illuminate\Support\Str;
use Image;
use File;
Use DB;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //product index method__//
    public function index(Request $request)
    {
       if ($request->ajax()) {
            $imageurl=asset('public/files/product/thumbnail/');
            $product="";
            $query=DB::table('products')->leftJoin('categories','products.category_id','categories.id')->leftJoin('subcategories','products.subcategory_id','subcategories.id')->leftJoin('brands','products.brand_id','brands.id');
            if($request->title)
            {
                $query->where('title',$request->title);
            }
            if($request->category_id)
            {
                $query->where('products.category_id',$request->category_id);
            }
            if($request->subcategory_id)
            {
                $query->where('products.subcategory_id',$request->subcategory_id);
            }
            if($request->brand_id)
            {
                $query->where('products.brand_id',$request->brand_id);
            }
            $product=$query->select('products.*','categories.category_name','categories.type','subcategories.subcategory_name','brands.brand_name')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('thumbnail',function($row) use($imageurl){
                    return '<img src="'.$imageurl.'/'.$row->thumbnail.'" width="50"/>';
                })
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="status_active"><i class="fa fa-thumbs-up text-success"></i></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="status_deactive"><i class="fa fa-thumbs-down text-danger"></i></a>';
                    }
                })
                ->editColumn('stock',function($row){
                    if ($row->stock_quantity > 0) {
                        if ($row->stock_quantity < 3) {
                            return '<span class="badge badge-warning text-white">Stock Low</span>';
                        }
                        return '<span class="badge badge-success">Stock In</span>';
                    }
                    else{
                        return '<span class="badge badge-danger">Stock Out</span>';
                    }

                })
                ->editColumn('type',function($row){
                    if($row->type=='Digital'){
                        return '<span class="badge badge-info text-white">Digital</span>';
                    }else{
                        return '<span class="badge badge-primary text-white">Physical</span>';
                    }
                })
                ->editColumn('featured',function($row){
                    if ($row->featured=="Yes") {
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="featured_active"><i class="fa fa-thumbs-up text-success"></i></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="featured_deactive"><i class="fa fa-thumbs-down text-danger"></i></a>';
                    }
                })
                ->editColumn('today_deal',function($row){
                    if ($row->today_deal=="Yes") {
                         return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="today_deal_deactive"><i class="fa fa-thumbs-up text-success"></i></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="today_deal_active"><i class="fa fa-thumbs-down text-danger"></i></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" class="m-1 edit"><i class="fa fa-eye text-success"></i></a>
                    <a href="'.route('product.edit',[$row->id]).'" class="m-1 edit"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('product.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status','featured','today_deal','stock','thumbnail','type'])
                ->make(true);
        }
        $category = DB::table('categories')->where('status',1)->get();
        $subcategory = DB::table('subcategories')->get();
        $brand = DB::table('brands')->where('status','Active')->get();
        return view('admin.product.index',compact('category','subcategory','brand'));
    }

    //__digital product method__//
    public function digital(Request $request)
    {
        if ($request->ajax()) {
            $imageurl=asset('public/files/product/thumbnail/');
            $data=DB::table('products')->leftJoin('categories.products.category_id','categories.id')->select('products.*','categories.category_name','categories.type')->where('categories.type','Digital')
                ->orderBy('id','DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('thumbnail',function($row) use($imageurl){
                    return '<img src="'.$imageurl.'/'.$row->thumbnail.'" width="50"/>';
                })
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="status_active"><i class="fa fa-thumbs-up text-success"></i></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="status_deactive"><i class="fa fa-thumbs-down text-danger"></i></a>';
                    }
                })
                ->editColumn('type',function($row){
                    if($row->type=='Digital'){
                        return '<span class="badge badge-info text-white">Digital</span>';
                    }else{
                        return '<span class="badge badge-primary text-white">Physical</span>';
                    }
                })
                ->editColumn('featured',function($row){
                    if ($row->featured=="Yes") {
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="featured_active"><i class="fa fa-thumbs-up text-success"></i></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="featured_deactive"><i class="fa fa-thumbs-down text-danger"></i></a>';
                    }
                })
                ->editColumn('today_deal',function($row){
                    if ($row->today_deal=="Yes") {
                         return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="today_deal_deactive"><i class="fa fa-thumbs-up text-success"></i></a>';
                    }else{
                        return '<a href="javascript:void(0)" data-id="'.$row->id.'" id="today_deal_active"><i class="fa fa-thumbs-down text-danger"></i></a>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" class="m-1 edit"><i class="fa fa-eye text-success"></i></a>
                    <a href="'.route('product.edit',[$row->id]).'" class="m-1 edit"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('product.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status','featured','today_deal','thumbnail','type'])
                ->make(true);
        }
        return view('admin.product.digital');
    }

    //__product create page method__//
    public function create()
    {
        $category=DB::table('categories')->where('status',1)->get();
        $childcategory=Childcategory::all();
        $brand=DB::table('brands')->where('status','Active')->get();
        $pickuppoint=Pickuppoint::all();
        $warehouse=Warehouse::all();
        return view('admin.product.create',compact('category','childcategory','brand','pickuppoint','warehouse'));
    }

    //__product store method__//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'subcategory_id' => 'required',
            'sku' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required',
            'thumbnail' => 'required',
        ]);
        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['admin_id']=Auth::id();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_id']=$request->childcategory_id;
        $data['brand_id']=$request->brand_id;
        $data['pickuppoint_id']=$request->pickuppoint_id;
        $data['warehouse_id']=$request->warehouse_id;
        $data['title']=$request->title;
        $data['slug']=Str::slug($request->title,'-');
        $data['sku']=$request->sku;
        $data['barcode']=$request->barcode;
        $data['size']=$request->size;
        $data['colors']=$request->colors;
        $data['unit']=$request->unit;
        $data['tag']=$request->tag;
        $data['video']=$request->video;
        $data['purchase_price']=$request->purchase_price;
        $data['price']=$request->price;
        $data['discount_price']=$request->discount_price;
        $data['stock_quantity']=$request->stock_quantity;
        $data['short_description']=$request->short_description;
        $data['description']=$request->description;
        $data['additional_information']=$request->additional_information;
        $data['shipping_returns']=$request->shipping_returns;
        $data['status']=$request->status;
        $data['featured']=$request->featured;
        $data['today_deal']=$request->today_deal;
        $data['trendy']=$request->trendy;
        $data['product_slider']=$request->product_slider;
        $data['date']=date('d-m-Y');
        //Single Image--------
        if($request->thumbnail){
            $thumbnail=$request->thumbnail;
            $thumbnailname=uniqid().'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(400,400)->save('public/files/product/thumbnail/'. $thumbnailname);
            $data['thumbnail']=$thumbnailname;
        }
        //Multiple Image----
        $images=array();
        if($request->hasFile('images')){
            foreach ($request->file('images') as $key => $image) {
                $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(600,600)->save('public/files/product/images/'. $image_name);
                $upload_image=$image_name;
                array_push($images, $upload_image);
            }
            $data['images']  = json_encode($images);
        }
        $product_id = DB::table('products')->insert($data);
        $notification=array('message' => 'successfully product inserted!','alert-type' => 'success');
        return redirect()->route('product')->with($notification);


    }

    //__product edit method__//
    public function edit($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        $category=DB::table('categories')->where('status',1)->get();
        $subcategory=DB::table('subcategories')->get();
        $childcategory=DB::table('childcategories')->where('category_id',$product->category_id)->get();
        $brand=DB::table('brands')->where('status','Active')->get();
        $pickuppoint=Pickuppoint::all();
        $warehouse=Warehouse::all();

        return view('admin.product.edit',compact('product','category','subcategory','childcategory','brand','pickuppoint','warehouse'));
    }

    //__product Update method__//
    public function update(Request $request)
    {
        $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data=array();
        $data['admin_id']=Auth::id();
        $data['category_id']=$subcategory->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['childcategory_id']=$request->childcategory_id;
        $data['brand_id']=$request->brand_id;
        $data['pickuppoint_id']=$request->pickuppoint_id;
        $data['warehouse_id']=$request->warehouse_id;
        $data['title']=$request->title;
        $data['slug']=Str::slug($request->title,'-');
        $data['sku']=$request->sku;
        $data['barcode']=$request->barcode;
        $data['size']=$request->size;
        $data['colors']=$request->colors;
        $data['unit']=$request->unit;
        $data['tag']=$request->tag;
        $data['video']=$request->video;
        $data['purchase_price']=$request->purchase_price;
        $data['price']=$request->price;
        $data['discount_price']=$request->discount_price;
        $data['stock_quantity']=$request->stock_quantity;
        $data['short_description']=$request->short_description;
        $data['description']=$request->description;
        $data['additional_information']=$request->additional_information;
        $data['shipping_returns']=$request->shipping_returns;
        $data['status']=$request->status;
        $data['featured']=$request->featured;
        $data['today_deal']=$request->today_deal;
        $data['trendy']=$request->trendy;
        $data['product_slider']=$request->product_slider;
        //Single Image--------
        $thumbnail=$request->file('thumbnail');
        if ($thumbnail) {
            $old_thumbnail='public/files/product/thumbnail/'.$request->old_thumbnail;
            if (File::exists($old_thumbnail)) {
                File::delete($old_thumbnail);
            }
            $thumbnail=$request->thumbnail;
            $thumbnailname=uniqid().'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(400,400)->save('public/files/product/thumbnail/'. $thumbnailname);
            $data['thumbnail']=$thumbnailname;
        }else{
            $data['thumbnail'] = $request->old_thumbnail;
        }
        //Multiple Image------
        $old_images=$request->has('old_image');
        if ($old_images) {
           $images=$request->old_images;
           $data['images']=json_encode($images);
        }else{
            $images=array();
            $data['images']=json_encode($images);
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(600,600)->save('public/files/product/images/'. $image_name);
                $upload_image=$image_name;
                array_push($images, $upload_image);
            }
            $data['images']  = json_encode($images);
        }
        DB::table('products')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Product Updated Successfully!','alert-type' => 'success');
        return redirect()->route('product')->with($notification);
    }

    //__product delete method__//
    public function destroy($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        if (File::exists('public/files/product/thumbnail/'.$product->thumbnail)) {
            File::delete('public/files/product/thumbnail/'.$product->thumbnail);
        }
        if (File::exists('public/files/product/images/'.json_encode($product->images))) {
            File::delete('public/files/product/images/'.json_encode($product->images));
        }

        DB::table('products')->where('id',$id)->delete();
        return response()->json('successfully product deleted!');
    }

    //status active method__//
    public function statusActive($id)
    {
       DB::table('products')->where('id',$id)->update(['status'=>0]);
       return response()->json('status deactive!');
    }
    //status deactive method__//
    public function statusDeactive($id)
    {
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return response()->json('status acive!');
    }
    //featured active method__//
    public function featuredActive($id)
    {
       DB::table('products')->where('id',$id)->update(['featured'=>"No"]);
       return response()->json('featured deactive!');
    }
    //featured deactive method__//
    public function featuredDeactive($id)
    {
        DB::table('products')->where('id',$id)->update(['featured'=>"Yes"]);
        return response()->json('featured acive!');
    }
    //featured active method__//
    public function todaydealActive($id)
    {
       DB::table('products')->where('id',$id)->update(['today_deal'=>"Yes"]);
       return response()->json('today deal active!');
    }
    //featured deactive method__//
    public function todaydealDeactive($id)
    {
        DB::table('products')->where('id',$id)->update(['today_deal'=>"No"]);
        return response()->json('today deal deacive!');
    }

}
