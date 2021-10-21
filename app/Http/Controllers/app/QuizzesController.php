<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quizzes;
use App\Models\Questions;
use App\Models\Answers;

class QuizzesController extends Controller
{
    /*
    |------------------------------------------------------------------------
    | Dashboard controller to handle all actions on quizzes.
    |------------------------------------------------------------------------
    */

    // Load form to create a quiz
    public function create_quiz(){
        return view('app.create_quiz');
    }

    public function edit_quiz(Request $request){

        $quiz = Quizzes::find($request->quiz_id);
        $question_set = $quiz->questions;
        $questions = [];

        foreach($question_set as $index=>$question){
            $answer_set = $question->answers;
            $answers = [];
            foreach($answer_set as $index=>$answer){
                $answers[] = array("answer"=>$answer->answer,"correct"=>$answer->correct);
            }
            $questions[] = array("question"=>$question->question,"answers"=>$answers);
        }
        
        return view('app.edit_quiz',[
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }

    // Validate 
    public function store_quiz(Request $request){        

        // Validate data
        $this->validate($request,[
            'title' => 'required|unique:Quizzes|max:50',
            'description' => 'required|max:255',
            'topic' => 'required|max:50',
        ]);

        // Create quiz in quizzes table 
        $quiz_id = Quizzes::create([
             'user_id' => Auth::id(),
             'title' => $request->title,
             'description' => $request->description,
             'topic' => $request->topic,
        ]);
        
        // Nest foreach loop to add questions and their answers in their respective tables.
        foreach(json_decode($request->questions) as $index=>$question){
            $question_id = Questions::create([
                'quiz_id' => $quiz_id->id,
                'question' => $question->question
            ]);
            
            foreach($question->answers as $index=>$answer){
                Answers::create([
                    'quiz_id' =>$quiz_id->id,
                    'question_id'=>$question_id->id,
                    'answer' =>$answer->answer,
                    'correct' =>$answer->correct,   
                ]);
            }
        }

        // New quiz has been successfully created, return the user back to the dashboard.
        return redirect()->route('dashboard');
    }

    public function store_edited_quiz(){


    }

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
