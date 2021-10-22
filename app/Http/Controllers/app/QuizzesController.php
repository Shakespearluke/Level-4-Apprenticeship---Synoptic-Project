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
    | Quizzes controller to handle all actions on quizzes.
    |------------------------------------------------------------------------
    */

    // First check that this user is logged in.
    public function __construct(){
        $this->middleware(['auth']);
        $this->middleware(['role:1']);
    }

    // Load form to create a quiz.
    public function create_quiz(){
        return view('app.create_quiz');
    }

    // Load form to edit quiz.
    public function edit_quiz(Request $request){

        // Grab the quzzies and questions data.
        $quiz = Quizzes::find($request->quiz_id);
        $question_set = $quiz->questions;
        $questions = [];

        // Loop through the question data to build both the questions table and the answers table.
        foreach($question_set as $index=>$question){
            $answer_set = $question->answers;
            $answers = [];
            foreach($answer_set as $index=>$answer){
                $answers[] = array("answer"=>$answer->answer,"correct"=>$answer->correct);
            }
            $questions[] = array("question"=>$question->question,"answers"=>$answers);
        }
        
        // Return the edit quiz view loading the quiz and questions data.
        return view('app.edit_quiz',[
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }

    // Validate the newly created quiz and load the data into database.
    public function store_quiz(Request $request){        

        // Validate request data to ensure fields not yet checked are valid
        $this->validate($request,[
            'title' => 'required|unique:Quizzes|max:50',
            'description' => 'required|max:255',
            'topic' => 'required|max:50',
            "questions"  => "json|min:1",
        ],
        [
            'questions.json' => 'You must have at least one question'
        ]);

        // Create quiz in quizzes table 
        $quiz_id = Quizzes::create([
             'user_id' => Auth::id(),
             'title' => $request->title,
             'description' => $request->description,
             'topic' => $request->topic,
        ]);
        
        // Nested foreach loop to add questions and their answers into their respective tables.
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

    // Validate the edited quiz and update the data in the database.
    public function store_edited_quiz($quiz_id, Request $request){

        // Validate request data to ensure fields not yet checked are valid
        $this->validate($request,[
            'title' => 'required|max:50',
            'description' => 'required|max:255',
            'topic' => 'required|max:50',
            "questions"  => "json|min:1",
        ],
        [
            'questions.json' => 'You must have at least one question'
        ]);

        // Update quiz in quizzes table 
        $quiz = Quizzes::find($quiz_id)->update([
             'user_id' => Auth::id(),
             'title' => $request->title,
             'description' => $request->description,
             'topic' => $request->topic,
        ]);

        $quiz = Quizzes::find($quiz_id);

        // Nested foreach loop to delete all the currently stored questions in the database
        foreach($quiz->questions as $index=>$question){ 
            $question->delete();
            foreach($question->answers as $index=>$answer){
                $answer->delete();
            }
        }

        // Nested foreach loop to add newly updated question set and their answers into their respective tables.
        foreach(json_decode($request->questions) as $index=>$question){
            $question_id = Questions::create([
                'quiz_id' => $quiz->id,
                'question' => $question->question
            ]);
            
            foreach($question->answers as $index=>$answer){
                Answers::create([
                    'quiz_id' =>$quiz->id,
                    'question_id'=>$question_id->id,
                    'answer' =>$answer->answer,
                    'correct' =>$answer->correct,   
                ]);
            }
        }

        // Quiz has been updated successfully, return the user back to the dashboard.
        return redirect()->route('dashboard');
    }

    // Return the really? delete quiz modal uisng AJAX get request.
    public function modal_delete_quiz(Request $request){
        if($request->ajax()){
            // Get selected quiz id from the request.
            $quiz = $request->quiz_id;

            // Return modal
            return view('app.delete_quiz',[
                'quiz' => $quiz
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

    // Delete a quiz using a AJAX post request.
    public function delete_quiz(Request $request){
        if($request->ajax()){
            // Find the selected quiz based off quiz id
            $quizzes = Quizzes::find($request);
                    
            foreach($quizzes as $quiz){
                // Delete the quiz from the database.
                $quiz->delete();
            }
            // Return success response.
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Quiz Deleted Successfully'
                ]
            );
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

    // Load view to allow users to view quiz and it's quesitons.
    public function view_quiz($quiz_id){
        $quiz = Quizzes::find($quiz_id);

        return view('app.view_quiz',[
            'quiz' => $quiz,
        ]);
    }

}
