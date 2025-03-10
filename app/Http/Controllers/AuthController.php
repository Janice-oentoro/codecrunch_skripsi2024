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
use App\Rules\nameUnique;
use App\Rules\emailUnique;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function login(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if($request->remember) {
            Cookie::queue('mycookie', $request->email, 120);
        }

        if(Auth::attempt($credentials, true)){
            if(Auth::user()->suspend == false){
                Session::put('mysession','');
                return redirect()->route('land')->with('success','Login Success');
            } elseif(Auth::user()->suspend == true) {
                Auth::logout();
                return redirect(url('login'));
            }
        } else {
            return redirect()->back()->with('success','Login Failed');
        }
    }

    public function registerUser(Request $request) {
        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:255', 'unique:users'],
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|string|min:10|max:13',
            'role' => 'required'
        ];
        $msg = [
            'name.string' => 'Name must be string',
            'name.min' => 'Name must be filled with min 5 characters',
            'name.max' => 'Name must below than 255 characters',
            'name.unique' => 'This name has been taken',
            'email.email' => 'Please input valid email address',
            'email.unique' => 'This email has been taken',
            'password.min' => 'Minimum password 8 characters',
            'password.alpha_num' => 'Password must contain letter and number',
            'phone.required' => 'Phone number required.',
            'phone.string' => 'Phone number must be string',
            'phone.min' => 'Phone number 10-13 characters.',
            'phone.max' => 'Phone number 10-13 characters.',
            'role.required' => 'Role is required.'
        ];

       $request->validate($rules,$msg);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->save();

       return $this->login($request);
    }

    public function editProfileLogic(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:255', new nameUnique],
            'email' => ['required', 'email', 'max:255', new emailUnique],
            // 'password' => 'required|min:8',
            'phone' => 'required|string|min:10|max:13',
            'price' => 'numeric'
        ];
        $msg = [
            'name.string' => 'Name must be string',
            'name.min' => 'Name must be filled with min 5 characters',
            'name.max' => 'Name must below than 255 characters',
            'name.nameUnique' => 'This name has been taken',
            'email.email' => 'Please input valid email address',
            'email.emailUnique' => 'This email has been taken',
            // 'password.min' => 'Minimum password 8 characters',
            'phone.required' => 'Phone number required.',
            'phone.string' => 'Phone number must be string',
            'phone.min' => 'Phone number 10-13 characters.',
            'phone.max' => 'Phone number 10-13 characters.',
            'price.number' => 'Price in numerical values only.'
        ];

        $request->validate($rules,$msg);

        $user = User::find(auth()->user()->id);
        if($request->hasFile('avatar')) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'price' => $request->price,
                'avatar' => $this->newImage($request)
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'price' => $request->price
            ]);           
        }
            return redirect()->back()->with('success', 'Edit Profile Success');
    } 

    public function newImage(Request $request)
    {
        $fileObj = $request->file('avatar');
        $fileObj1 = $request->file('avatar');
        $name = str_replace(' ', '', $fileObj->getClientOriginalName());
        $ext = $fileObj->getClientOriginalExtension();
        $new_file_name = $name . time() . '.' .$ext;
        $fileObj->storeAs('public/user-avatars', $new_file_name);
        $fileObj1->storeAs('public/images', $new_file_name);
        return $new_file_name;
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            "old_password"=>"required|min:8",
            "new_password"=>"required|min:8",
            "confirm_password" => "required|same:new_password"
        ],[
            'old_password.required' => 'Password must be filled',
            'old_password.min'=>'Password must be filled with minimum 8 characters',
            'new_password.required' => 'Password must be filled',
            'new_password.min'=>'Password must be filled with minimum 8 characters',
            'confirm_password.required' => 'Please confirm your password',
            'confirm_password.same' => 'Password must be same'
        ]);
        if(!Hash::check($request->old_password, auth()->user()->password))
        {
            return redirect()->back()->with('success',"Password does not match");
        }
        if($request->old_password == $request->new_password)
        {
            return redirect()->back()->with('success',"Password same");
        }
        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($request->new_password);
        $user->update();
        return redirect()->route('land')->with('success','Password Successfuly Changed');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('land');
    }

    public static function imageAdapter($imageURL)
    {
        if(Str::contains($imageURL,'https://')  ||  Str::contains($imageURL,'data:image'))
        {
            return $imageURL;
        }
        return 'storage/images/'.$imageURL;
    }

    public static function matchUser($userMatch)
    {
        $user = User::where('name', $userMatch)->get(['name', 'avatar']);
        return $user;
    }

}
