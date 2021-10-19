<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quizzes;

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

        // Get a paginated list of the quizzes order by the lastest.
        $quizzes = Quizzes::latest()->paginate(5);

        return view('app.dashboard',[
            'quizzes' => $quizzes
        ]);
    }

        // Return quizzes table uisng AJAX get request, ensure this request is only from AJAX.
        public function get_quizzes_table(Request $request){
            if($request->ajax()){
                // Get a paginated list of the quizzes order by the lastest.
                $quizzes = Quizzes::latest()->paginate(5);
                
                return view('app.quizzes_table',[
                    'quizzes' => $quizzes
                ]);
            }else{
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'You do not have access to this page.'
                    ]
                );
            }
        }

}
