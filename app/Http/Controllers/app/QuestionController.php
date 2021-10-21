<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /*
    |------------------------------------------------------------------------
    | Dashboard controller to handle all actions on quizzes.
    |------------------------------------------------------------------------
    */

    // Return the delete quiz modal uisng AJAX get request.
    public function modal_add_question(Request $request){
        if($request->ajax()){
            return view('app.add_question');
        }else{
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You do not have access to this page.'
                ]
            );
        }
    }

    // Return the delete quiz modal uisng AJAX get request.
    public function modal_edit_question(Request $request){
        if($request->ajax()){
            // Get select quiz id from  the request.
            

            $question_id = $request->question_id;
            $question = $request->question;
            $answers = json_decode($request->answers,true);
            
            return view('app.edit_question',[
                'question_id' => $question_id,
                'question' => $question,
                'answers' => $answers,
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

    // Return the delete quiz modal uisng AJAX get request.
    public function modal_add_answer(Request $request){
        if($request->ajax()){
            // Get select quiz id from  the request.
            
            // Return the add new question modal
            return view('app.add_answer');
        }else{
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You do not have access to this page.'
                ]
            );
        }
    }

        // Return the delete quiz modal uisng AJAX get request.
        public function modal_edit_answer(Request $request){
            if($request->ajax()){
                // Get select quiz id from  the request.
                
    
                $answer_id = $request->answer_id;
                $answer = $request->answer;
                $correct = $request->correct;
                
                return view('app.edit_answer',[
                    'answer_id' => $answer_id,
                    'answer' => $answer,
                    'correct' => $correct,
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
