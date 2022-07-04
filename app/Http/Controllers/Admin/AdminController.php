<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Toastr;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Admin after login
    public function admin()
    {
        return view('admin.home');
    }

    // Admin after logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
