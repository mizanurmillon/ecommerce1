<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__SEO setting index method__//
    public function seoSetting()
    {
        $data=DB::table('seos')->first();
        return view('admin.setting.seo',compact('data'));
    }

    //__SEO Setting update method__//
    public function update(Request $request,$id)
    {
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;

        DB::table('seos')->where('id',$id)->update($data);
        $notification=array('message' => 'successfully updated seo setting!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //__smtp setting method__//
    public function smtpSetting()
    {
        $data=DB::table('smtps')->first();
        return view('admin.setting.smtp',compact('data'));
    }

    //__smtp setting update method__//
    public function smtpUpdate(Request $request , $id)
    {
        $data=array();
        $data['type']=$request->type;
        $data['mail_host']=$request->mail_host;
        $data['mail_port']=$request->mail_port;
        $data['mail_username']=$request->mail_username;
        $data['mail_password']=$request->mail_password;
        $data['mail_encryption']=$request->mail_encryption;
        $data['mail_from_address']=$request->mail_from_address;
        $data['mail_from_name']=$request->mail_from_name;

        DB::table('smtps')->where('id',$id)->update($data);
        $notification=array('message' => 'successfully updated SMTP setting!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
