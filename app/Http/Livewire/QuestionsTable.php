<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class QuestionsTable extends Component
{   
    // Declare variables and listeners.
    public $questions = [];
    protected $listeners = ['add-new-question' => 'add_new_question','edit-question' => 'edit_question'];

    // Add a new question based off the entered question and answers.
    public function add_new_question($question,$answers)
    {     
        $this->questions[] = array("question"=>$question,'answers'=>$answers);
    }

    // Save edited question back to array.
    public function edit_question($question,$answers,$question_id)
    {     
        $this->questions[$question_id] = array("question"=>$question,'answers'=>$answers);
    }

    // Delete selected question from quiz and re-index the questions.
    public function delete_question($question_id){
        unset($this->questions[$question_id]);
        $this->questions = array_values($this->questions);
    }

    // Return the livewire component. 
    public function render()
    {    
        return view('livewire.questions-table',[ 
            'questions' => $this->questions 
        ]);        
    }
}
