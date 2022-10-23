<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerStoreRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function registerPage(){
        return view('frontend.pages.auth.register');
    }

    public function loginPage(){
        return view('frontend.pages.auth.login');
    }

    public function registerStore(CustomerStoreRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Make a credential array
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // login attempt, if success then redirect to home
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            Toastr::success('Registration Success and redirected to dashboard');
            return redirect()->route('customer.dashboard');
        }
    }

    public function loginStore(Request $request){
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:4'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Login Attempt if success then redirect to home

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            Toastr::success('Successfully Logged in');
            return redirect()->route('customer.dashboard');
        }

        // return error message
        return back()->withErrors([
            'email' => 'Wrong credentials found!'
        ])->onlyInput('email');


    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->route('login.page');
    }
}
