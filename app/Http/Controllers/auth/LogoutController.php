<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /*
    |------------------------------------------------------------------------
    | Logout controller to handle logout requests from the app.
    |------------------------------------------------------------------------
    */

    public function logout(){
        // Tell the laravel auth handler to log user out of current session.
        auth()->logout();

        // Redirect the user back to the login page.
        return redirect()->route('login');
    }
}
