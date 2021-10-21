<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /*
    |------------------------------------------------------------------------
    | Questions controller to handle all actions on a quizzes questions and answers.
    |------------------------------------------------------------------------
    */

    // First check that this user is logged in.
    public function __construct(){
        $this->middleware(['auth']);
    }

    // Return the add question modal uisng AJAX get request.
    public function modal_add_question(Request $request){
        if($request->ajax()){
            // Return modal
            return view('app.add_question');
        }else{
            // Ensure this page is only loaded from a AJAX request
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You do not have access to this page.'
                ]
            );
        }
    }

    // Return the edit question modal with gathered request data uisng AJAX get request.
    public function modal_edit_question(Request $request){
        if($request->ajax()){
           
            // Return the question_id for use later and the questions & answers.
            $question_id = $request->question_id;
            $question = $request->question;
            $answers = json_decode($request->answers,true);
            
            // Return modal with variables gathered from request.
            return view('app.edit_question',[
                'question_id' => $question_id,
                'question' => $question,
                'answers' => $answers,
            ]);
        }else{
            // Ensure this page is only loaded from a AJAX request
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You do not have access to this page.'
                ]
            );
        }
    }

    // Return the add answer modal uisng AJAX get request.
    public function modal_add_answer(Request $request){
        if($request->ajax()){            
            // Return modal
            return view('app.add_answer');
        }else{
            // Ensure this page is only loaded from a AJAX request
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You do not have access to this page.'
                ]
            );
        }
    }

        // Return the edit answered modal with gathered request data uisng AJAX get request.
        public function modal_edit_answer(Request $request){
            if($request->ajax()){
                 
                // Return the answer_id for use later and the answer & whether it is correct.
                $answer_id = $request->answer_id;
                $answer = $request->answer;
                $correct = $request->correct;
                
                // Return modal with variables gathered from request. 
                return view('app.edit_answer',[
                    'answer_id' => $answer_id,
                    'answer' => $answer,
                    'correct' => $correct,
                ]);
            }else{
                // Ensure this page is only loaded from a AJAX request
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'You do not have access to this page.'
                    ]
                );
            }
        }
}
