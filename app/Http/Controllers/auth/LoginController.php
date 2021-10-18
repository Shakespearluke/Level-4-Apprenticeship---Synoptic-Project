<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |------------------------------------------------------------------------
    | Login controller to handle login view and login requests from the app.
    |------------------------------------------------------------------------
    */

    // First check that this user is not already logged in.
    public function __construct(){
        $this->middleware(['guest']);
    }

    // Return the index page view.
    public function index(){
        return view('auth.login');
    }

    // Validate incoming login request and authenticate hashed password with backend database.
    public function login(Request $request){
        // Validate request object from login form.
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check password against hashed password stored in database. If failed return with status.
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('status','Invalid Login Details.');
        }

        // User has successfully logged in and session updated, load into dashboard.
        return redirect()->route('dashboard');
    }
}
