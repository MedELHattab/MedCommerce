<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{

    
    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }


        return view('profile', compact('user'));
    }


    function updateProfile(Request $request){
        $user = Auth::user();

        $all = $request->all();
        if ($request->hasFile("image")) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/users/';
            
           

            $file->move($path, $fileName);
            $all["image"] = $fileName;

        }
         
        $user->update($all); 

        return redirect()->back()->with("success","profile updated with success");
    }
}
