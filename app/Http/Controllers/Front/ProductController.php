<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Product;
use DB;

class ProductController extends Controller
{
    public function getProduct()
    {
        $category = DB::table('categories')->where('status',1)->get();
        $brand = DB::table('brands')->where('status','Active')->get();
        $getProduct = Product::where('status',1)->paginate(20);
        return view('product.get_product',compact('category','getProduct','brand'));
    }

    public function FilterProduct($category_slug='' , $subcategory_slug='')
    {
        $category = DB::table('categories')->where('status',1)->get();
        $getCategory = DB::table('categories')->where('status',1)->where('category_slug',$category_slug)->first();
        $getSubcategory = DB::table('subcategories')->where('category_id',$getCategory->id)->where('subcategory_slug',$subcategory_slug)->first();
        $data['brand'] = DB::table('brands')->where('status','Active')->get();
        if(!empty($getCategory) && !empty($getSubcategory)){
            $data['category'] = $category;
            $data['getCategory'] = $getCategory;
            $data['getSubcategory'] = $getSubcategory;
            $data['getProduct'] = Product::where('category_id',$getCategory->id)->where('subcategory_id',$getSubcategory->id)->orderBy('id','ASC')->where('status',1)->paginate(20);
            $data['getSubcategoryFilter'] = Subcategory::where('category_id',$getCategory->id)->orderBy('id','ASC')->get();
            return view('product.list',$data);
        }
        else if(!empty($getCategory)){
           $data['category'] =$category;
           $data['getCategory'] =$getCategory;
           $data['getSubcategory'] =$getSubcategory;
           $data['getSubcategoryFilter'] = Subcategory::where('category_id',$getCategory->id)->orderBy('id','ASC')->get();
           $data['getProduct'] = Product::where('category_id',$getCategory->id)->where('status',1)->orderBy('id','ASC')->paginate(20);
            return view('product.list',$data);
        }else{
            about(404);
        }
    }

    function productFilter(Request $request)
    {
        $query = Product::where('status', 1)->orderBy('id', 'ASC');
        if (!empty($request->subcategory_id)) {
            $subcategory_id = rtrim($request->subcategory_id, ',');
            $subcategory_id_array = explode(",", $subcategory_id);
            $query->whereIn('subcategory_id', $subcategory_id_array);
        }
        if (!empty($request->brand_id)) {
            $brand_id = rtrim($request->brand_id, ',');
            $brand_id_array = explode(",", $brand_id);
            $query->whereIn('brand_id', $brand_id_array);
        }
        $getProduct = $query->paginate(20);
        return response()->json([
            'status' => true,
            'success' => view("product._list", compact('getProduct'))->render(),
        ], 200);
    }

}
