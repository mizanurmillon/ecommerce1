<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use File;
use Image;

class ProfileController extends Controller
{
    //__user Logout method__//
    public function Logout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out!','alert-type'=>'error' );
        return redirect()->route('frontend')->with($notification);
    }
    //__User password update method__//
    public function userPasswordUpdate(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $current_password=Auth::user()->password;
        $oldpassword=$request->current_password;
        $password=$request->password;

        if(Hash::check($oldpassword , $current_password)){
            $user=User::findorfail(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification=array('message' => 'Your Password Changed successfully!', 'alert-type' => 'success');
            return redirect()->route('frontend')->with($notification);
        }else{
            $notification=array('message' => 'old password not matched!', 'alert-type' => 'error'); 
            return redirect()->back('#tab-password')->with($notification);
        }
    }

    //__Profile update method__
    public function prfileUpdate(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['type']='User';
        $avatar=$request->file('avatar');
        if($avatar){
            $old_avatar='public/files/user/'.$request->old_avatar;
            if (File::exists($old_avatar)) {
                File::delete($old_avatar);
            }
            $avatar=$request->avatar;
            $avatarName=uniqid().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(90,90)->save('public/files/user/'. $avatarName);
            $data['avatar']=$avatarName;
        }else{
            $data['avatar']=$request->old_avatar;
        }

        DB::table('users')->where('id',$request->id)->update($data);
        $notification=array('message' => 'successfully Your Profile Information Updated!', 'alert-type' => 'success');
        return redirect()->route('home')->with($notification);
    }

}
