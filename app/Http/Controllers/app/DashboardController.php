<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /*
    |------------------------------------------------------------------------
    | Dashboard controller to handle dashboard view.
    |------------------------------------------------------------------------
    */

    // First check that this user is logged in.
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        return view('app.dashboard');
    }
}
