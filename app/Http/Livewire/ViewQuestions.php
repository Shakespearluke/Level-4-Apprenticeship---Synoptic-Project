<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quizzes;
use App\Models\Questions;
use App\Models\Answers;

class ViewQuestions extends Component
{
    // Declare variables.
    public $questions = [];
    public $answers = [];
    public $question = '';
    public $quiz = [];
    public $current_question = 0;
    public $quiz_loaded = 0;

    // Load the initial question and set of answers.
    public function load_questions($quiz_id){
        $this->quiz_loaded = 1;
        $this->quiz = Quizzes::find($quiz_id);
        $this->question = Quizzes::find($quiz_id)->questions[$this->current_question]->question;
        $this->answers = Quizzes::find($quiz_id)->questions[$this->current_question]->answers->toArray();
        $this->total_questions =  count(Quizzes::find($quiz_id)->questions);
    }
    // Load the next question and set of answers
    public function next_question($quiz_id)
    {   
        $this->current_question++;
        $this->quiz = Quizzes::find($quiz_id);
        $this->question = Quizzes::find($quiz_id)->questions[$this->current_question]->question;
        $this->answers = Quizzes::find($quiz_id)->questions[$this->current_question]->answers->toArray();  
    }

    // Load the previous question and set of answers
    public function previous_question($quiz_id)
    {   
        $this->current_question--;          
        $this->quiz = Quizzes::find($quiz_id);
        $this->question = Quizzes::find($quiz_id)->questions[$this->current_question]->question;
        $this->answers = Quizzes::find($quiz_id)->questions[$this->current_question]->answers->toArray();
    }

    // Return the correct view dependent on whether this is initial load or question request.
    public function render()
    {
        if ($this->quiz_loaded == 0){
            return view('livewire.start-viewing',[
                'quiz' => $this->quiz,
            ]);
        }else{
            return view('livewire.view-questions',[
                'quiz' => $this->quiz,
                'question' => $this->question,
                'answers' => $this->answers,
                'current_question' => $this->current_question,
                'total_questions' => $this->current_question,
            ]);
        }
    }
}
