<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Programming;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function editProfileLogic(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'price' => $request->price,
                'image' => $this->newImage($request)
            ]);
            return redirect()->route('land')->with('success', 'Edit Profile Success');
    }

    public function newImage(Request $request)
    {
        $fileObj = $request->file('image');
        $name = $fileObj->getClientOriginalName();
        $ext = $fileObj->getClientOriginalExtension();
        $new_file_name = $name . time() . '.' .$ext;
        $fileObj->storeAs('public/images', $new_file_name);
        return $new_file_name;
    }
    
    public function editSkill()
    {
        if(Auth::check() && Auth::user()->role == "consultant"){
            $programmings = Programming::all();
            $topics = Topic::all();
            return view('editskill', compact('programmings', 'topics'));
        }
       else{
        return redirect()->route('login')->with('success', "Login First");
       } 
    }
}
