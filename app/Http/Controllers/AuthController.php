<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request) {

        print_r($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);

        if($check) {
            $userCredentials = $request->only(['email', 'password']);
        
            if (Auth::attempt($userCredentials)) {
                return redirect()->intended('/');
            } else {
                return redirect(route('register_page'));
            };

        } else {
            return back();
        }
        
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    } 

    public function login(Request $request) {
        
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required',
        //     'password' => 'required|min:8',
        // ]);
 
        // if ($validator->fails()) {
        //     return redirect(route('login_page'))
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8',
        ]);
   
   
        $userCredentials = $request->only(['email', 'password']);

        if (Auth::attempt($userCredentials)) {
            return redirect()->intended('/');
        } else {
            return back()->with('authError', __('auth.failed'));
        };
    }
    
    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect(route('login_page'));
    }
}
