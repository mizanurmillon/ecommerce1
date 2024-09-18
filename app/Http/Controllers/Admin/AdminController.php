<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use File;
use DB;
use Image;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__admin after login__//
    public function Admin()
    {
       return view('admin.home');
    }

    //__admin Logout method__//
    public function adminLogout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out!','alert-type'=>'warning' );
        return redirect()->route('admin.login')->with($notification);
    }

    //__admin password change page__//
    public function passwordChange()
    {
        return view('admin.profile.password_change');
    }

    //__admin password update method__//
    public function passwordUpdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $current_password=Auth::user()->password;
        $oldpassword=$request->old_password;
        $password=$request->password;

        if(Hash::check($oldpassword , $current_password)){
            $user=User::findorfail(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification=array('message' => 'Your Password Changed!', 'alert-type' => 'success');
            return redirect()->route('admin.login')->with($notification);
        }else{
            $notification=array('message' => 'old password not matched!', 'alert-type' => 'error'); 
            return redirect()->back()->with($notification);
        }
    } 

    //__admin profile method__//
    public function AdminProfile()
    {
        $data=DB::table('users')->where('is_admin',1)->where('type','Admin')->first();
        return view('admin.profile.admin_profile',compact('data'));
    }
    //__admin profile update method__//
    public function profileUpdate(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['type']='Admin';
        $avatar=$request->file('avatar');
        if ($avatar) {
            $old_avatar='public/files/admin/profile/'.$request->old_avatar;
            if (File::exists($old_avatar)) {
                File::delete($old_avatar);
            }
            $image=$request->avatar;
            $imagename=uniqid().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(90,90)->save('public/files/admin/profile/'. $imagename);
            $data['avatar']=$imagename;
        }else{
            $data['avatar']=$request->old_avatar;
        }
        DB::table('users')->where('id',$request->id)->update($data);
        $notification=array('message' => 'successfully profile updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
