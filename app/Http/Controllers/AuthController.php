<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return view('auth.login');
    }

    public function register()
    {
        if(Auth::check()){
            return view('dashboard');
        }
        
        return view('auth.register');
    }
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $remember_me = $request->has('remember_me') ? true : false; 
   
        if (auth()->attempt(['email'=>$email, 'password'=>$password], $remember_me)) {
            return redirect()->intended('/')->withSuccess('Signed in');
        }

        return Redirect::back()->withErrors('Login details are invalid');  
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect()->intended('/')->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'fname' => $data['fname'],
        'lname' => $data['lname'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ])->attachRole('user');
    }    
    
    public function signOut() {
        $user = Auth::user();
        $user->setRememberToken('');
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
