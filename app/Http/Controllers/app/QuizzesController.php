<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quizzes;

class QuizzesController extends Controller
{
        /*
    |------------------------------------------------------------------------
    | Dashboard controller to handle all actions on quizzes.
    |------------------------------------------------------------------------
    */

    // Return the delete quiz modal uisng AJAX get request.
    public function modal_delete_quiz(Request $request){
        if($request->ajax()){
            // Get select quiz id from  the request.
            $quiz = $request->quiz_id;

            // Return 'Are you sure?' modal
            return view('app.delete_quiz',[
                'quiz' => $quiz
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

    // Delete a quiz using a AJAX post request.
    public function delete_quiz(Request $request){
        if($request->ajax()){
            // Find the selected quiz based off quiz id
            $quizzes = Quizzes::find($request);
                    
            foreach($quizzes as $quiz){
                // Delete the quiz from the database.
                $quiz->delete();
            }

            // Return success or failed response.
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Quiz Deleted Successfully'
                ]
            );
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
