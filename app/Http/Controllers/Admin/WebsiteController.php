<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
use Image;
use File;

class WebsiteController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__website setting index method__//
    public function index()
    {
        $website=DB::table('websites')->first();
        $language=DB::table('languages')->get();
        $currency=DB::table('currencies')->get();
        return view('admin.website.index',compact('website','language','currency'));
    }
    //__website update method__//
    public function websiteUpdate(Request $request , $id)
    {
        $data=array();
        //header logo----
        $header_logo=$request->file('header_logo');
        if($header_logo){
            $old_header_logo='public/files/website/'.$request->old_header_logo;
            if (File::exists($old_header_logo)) {
                File::delete($old_header_logo);
            }
            $header_logo=$request->header_logo;
            $heaberLogoName=uniqid().'.'.$header_logo->getClientOriginalExtension();
            Image::make($header_logo)->resize(244,40)->save('public/files/website/'. $heaberLogoName);
            $data['header_logo']=$heaberLogoName;
        }else{
            $data['header_logo']=$request->old_header_logo;
        }
        $data['language_id']=$request->language_id;
        $data['currency_id']=$request->currency_id;
        //banner large----
        $banner_large=$request->file('banner_large');
        if($banner_large){
            $old_banner_large='public/files/website/banner/'.$request->old_banner_large;
            if (File::exists($old_banner_large)) {
                File::delete($old_banner_large);
            }
            $banner_large=$request->banner_large;
            $bannerlargeName=uniqid().'.'.$banner_large->getClientOriginalExtension();
            Image::make($banner_large)->resize(1320,60)->save('public/files/website/banner/'. $bannerlargeName);
            $data['banner_large']=$bannerlargeName;
        }else{
            $data['banner_large']=$request->old_banner_large;
        }
        //banner Medium----
        $banner_medium=$request->file('banner_medium');
        if($banner_medium){
            $old_banner_large='public/files/website/banner/'.$request->old_banner_medium;
            if (File::exists($old_banner_medium)) {
                File::delete($old_banner_medium);
            }
            $banner_medium=$request->banner_medium;
            $bannerMediumName=uniqid().'.'.$banner_large->getClientOriginalExtension();
            Image::make($banner_large)->resize(810,40)->save('public/files/website/banner/'. $bannerMediumName);
            $data['banner_medium']=$bannerMediumName;
        }else{
            $data['banner_medium']=$request->old_banner_medium;
        }
        //banner small----
        $banner_small=$request->file('banner_small');
        if($banner_small){
            $old_banner_small='public/files/website/banner/'.$request->old_banner_small;
            if (File::exists($old_banner_small)) {
                File::delete($old_banner_small);
            }
            $banner_small=$request->banner_small;
            $bannerSmallName=uniqid().'.'.$banner_large->getClientOriginalExtension();
            Image::make($banner_large)->resize(428,40)->save('public/files/website/banner/'. $bannerSmallName);
            $data['banner_small']=$bannerSmallName;
        }else{
            $data['banner_small']=$request->old_banner_small;
        }
        $data['banner_link']=$request->banner_link;
        $data['phone']=$request->phone;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;

        DB::table('websites')->where('id',$id)->update($data);
        $notification=array('message' => 'successfully updated websites setting!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //__Footer setting method__//
    public function Footer()
    {
        $footer=DB::table('footer_widget')->first();
        $about=DB::table('about_widget')->first();
        $contact=DB::table('contact_widget')->first();
        $social_link=DB::table('social_link')->first();
        return view('admin.footer.index',compact('footer','about','contact','social_link'));
    }

    //__Footer widget update method__//
    public function update(Request $request,$id)
    {
        $data=array();
        $data['title']=$request->title;
        $data['description']=$request->description;

        DB::table('footer_widget')->where('id',$id)->update($data);
        $notification=array('message' => 'successfully updated Footer Widget setting!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //About widget update method__//
    public function aboutUpdate(Request $request , $id)
    {
        $data=array();
        $footer_logo=$request->file('footer_logo');
        if($footer_logo){
            $old_footer_logo='public/files/website/banner/'.$request->old_footer_logo;
            if (File::exists($old_footer_logo)) {
                File::delete($old_footer_logo);
            }
            $footer_logo=$request->footer_logo;
            $footerLogoName=uniqid().'.'.$footer_logo->getClientOriginalExtension();
            Image::make($footer_logo)->resize(244,40)->save('public/files/footer/'. $footerLogoName);
            $data['footer_logo']=$footerLogoName;
        }else{
            $data['footer_logo']=$request->old_footer_logo;
        }
        $data['about_description']=$request->about_description;
        $data['play_store_link']=$request->play_store_link;
        $data['app_store_link']=$request->app_store_link;

        DB::table('about_widget')->where('id',$id)->update($data);
        $notification=array('message' => 'successfully updated About Widget setting!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //__contact widget update method__//
    public function contactUpdate(Request $request , $id)
    {
        $data=array();
        $data['contact_address']=$request->contact_address;
        $data['contact_phone']=$request->contact_phone;
        $data['contact_email']=$request->contact_email;

        DB::table('contact_widget')->where('id',$id)->update($data);
        $notification=array('message' => 'successfully updated Contact Widget setting!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //__footer bottom update method__//
    public function footerBottomUpdate(Request $request , $id)
    {
        $data=array();
        $data['copyright_text']=$request->copyright_text;
        $data['status']=$request->status;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['youtube']=$request->youtube;
        $data['linkedin']=$request->linkedin;
        $data['seller_app_link']=$request->seller_app_link;
        $data['delivery_boy_app_link']=$request->delivery_boy_app_link;
        $payment_method_logo=$request->file('payment_method_logo');
        if($payment_method_logo){
            $old_payment_method_logo='public/files/website/banner/'.$request->old_payment_method_logo;
            if (File::exists($old_payment_method_logo)) {
                File::delete($old_payment_method_logo);
            }
            $payment_method_logo=$request->payment_method_logo;
            $paymentLogoName=uniqid().'.'.$payment_method_logo->getClientOriginalExtension();
            Image::make($payment_method_logo)->resize(244,40)->save('public/files/footer/'. $paymentLogoName);
            $data['payment_method_logo']=$paymentLogoName;
        }else{
            $data['payment_method_logo']=$request->old_payment_method_logo;
        }

        DB::table('social_link')->where('id',$id)->update($data);
        $notification=array('message' => 'successfully updated social links setting!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
