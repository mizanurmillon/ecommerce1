<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class WishlistController extends Controller
{
    //__wishlist index__//
    public function wishlist(){
        if(Auth::check()){
            $category = DB::table('categories')->get();
            $wishlist = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('product.wishlist',compact('wishlist','category'));
        }
        $notification=array('message' => 'Please Login First!','alert-type' => 'error'); 
        return redirect()->back()->with($notification);
    }
    //__add to wishlist__//
    public function addWishlist(Request $request , $id)
    {
        if(Auth::check()){
            $chack = DB::table('wishlists')->where('user_id',Auth::user()->id)->where('product_id',$id)->first();
            if($chack){
                return response()->json(['error'=>'Already Added To Wishlist!']);
            }
            else{
                $data = array();
                $data['user_id'] = Auth::user()->id;
                $data['product_id'] = $id;
                $data['date'] = date('d , F Y');
                DB::table('wishlists')->insert($data);
                return response()->json(['success'=>'Product Added on wishlist!']);
            }
        }
        else{
            return response()->json(['error' => 'Please Login First!']);
        }
    }
    //__count wishlist__//
    public function countWishlist()
    {
        $data = array();
        $data['wishlist_count'] = DB::table('wishlists')->where('user_id',Auth::user()->id)->count();
        return response()->json($data);
    }

    //__wishlist remove method__//
    public function WishlistRemove($id){
        DB::table('wishlists')->where('id',$id)->delete();
        $notification=array('message' => 'Item has been remove on wishlist!','alert-type' => 'error'); 
        return redirect()->back()->with($notification);
    }
    
    //__wishlist all delete method__//
    public function destroy(){
        DB::table('wishlists')->where('user_id',Auth::user()->id)->delete();
        $notification=array('message' => 'All Item has been remove on wishlist!','alert-type' => 'error'); 
        return redirect()->back()->with($notification);
    }
}
