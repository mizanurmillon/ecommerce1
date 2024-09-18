<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class ReviewController extends Controller
{
    //__review store method__//
    public function reviewStore(Request $request){

        $request->validate([
            'rating' => 'required',
            'review' => ['required', 'max:800'],
        ]);

        $chack = DB::table('reviews')->where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->first();
        if($chack){
            return response()->json([
                'error' => 'Already you have a review with this product!'
            ]);
        }

        $data = array();
        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = $request->product_id;
        $data['rating'] = $request->rating;
        $data['review'] = $request->review;
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $data['date'] = date('d , F Y');
        DB::table('reviews')->insert($data);
        return response()->json(['success'=>'Thanks for your reviews!']);
    }
}
