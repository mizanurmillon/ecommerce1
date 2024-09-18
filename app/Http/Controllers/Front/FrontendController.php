<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User\Review;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Product;
use DB;

class FrontendController extends Controller
{
    public function Frontend()
    {
        $category = DB::table('categories')->where('status',1)->orderBy('id','ASC')->get();
        $subcategory = DB::table('subcategories')->orderBy('id','ASC')->limit(8)->get();
        $brand = DB::table('brands')->where('status','Active')->get();
        $slider_product = Product::where('product_slider','Yes')->where('status',1)->latest()->get();
        $banner_1 = DB::table('banners')->where('type','Fix 1')->first();
        $banner_2 = DB::table('banners')->where('type','Fix 2')->first();
        $banner_3 = DB::table('banners')->where('type','Fix 3')->first();
        $featured_product = Product::where('featured','Yes')->where('status',1)->limit(8)->latest()->get();
        $today_deal = Product::where('today_deal','Yes')->where('status',1)->first();
        $random_product=Product::where('status',1)->inRandomOrder()->limit(2)->get();
        $trendy_product = Product::where('trendy','Yes')->where('status',1)->latest()->get();
        $populer_product = Product::where('status',1)->orderBy('product_views','DESC')->get();
        return view('welcome',compact('category','brand','slider_product','banner_1','banner_2','banner_3','featured_product','today_deal','random_product','subcategory','trendy_product','populer_product'));
    }
    //featured product filtring------
    public function featuredSubcategoryProduct(Request $request)
    {
        $featured_product = DB::table('products')->leftJoin('categories','products.category_id','categories.id')
            ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
            ->select('products.*','subcategories.subcategory_name','subcategories.subcategory_name','subcategories.subcategory_slug','categories.category_name','categories.category_slug')->where('products.subcategory_id',$request->subcategory_id)->limit(8)->get();

        $getSubcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();

        return response()->json([
            "ststus"=>true,
            "success" =>view('product.featured_product',compact('featured_product','getSubcategory'))->render(),

        ],200);
    }

    //__product details__//
    public function productDetails($slug)
    {
        $category = DB::table('categories')->where('status',1)->get();
        $product=Product::where('slug',$slug)->first();
        Product::where('slug',$slug)->increment('product_views');
        $related_product=Product::where('subcategory_id',$product->subcategory_id)->where('status',1)->orderBy('id','DESC')->get();
        $productReview = Review::where('product_id',$product->id)->paginate(5);
        $reviewCount = Review::where('product_id',$product->id)->count();
        $reviewAvg = Review::where('product_id',$product->id)->avg('rating');
        return view('product.product_details',compact('product','related_product','category','productReview','reviewCount','reviewAvg'));
    }

    //__quick view method__//
    public function quickView($id)
    {
        $product=Product::find($id);
        return view('product.quick_view',compact('product'));
    }

}
