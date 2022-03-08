<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;

use App\Models\User;
use App\Models\Transaction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //Méthode d'inscription d'un utilisateur
    public function register(Request $request) {

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
                Transaction::create([
                    'libelle' => 'Inscription',
                    'url' =>  url(Route::getCurrentRoute()->uri),
                    'user_id' => Auth::user()->id,
                ]);
                return redirect()->intended('/');
            } else {
                return redirect(route('register_page'));
            };

        } else {
            return back();
        }
        
    }

    //Méthode de création d'un utilisateur dans la base de données
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    } 

    //Méthode de connexion utilisateur
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
            Transaction::create([
                'libelle' => 'Connexion',
                'url' =>  url(Route::getCurrentRoute()->uri),
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->intended('/');
        } else {
            return back()->with('authError', __('auth.failed'));
        };
    }
    
    //Méthode de déconnexion utilisateur
    public function logout() {
        Transaction::create([
            'libelle' => 'Deconnexion',
            'url' =>  url(Route::getCurrentRoute()->uri),
            'user_id' => Auth::user()->id,
        ]);
        Session::flush();
        Auth::logout();
        return redirect(route('login_page'));
    }
}
