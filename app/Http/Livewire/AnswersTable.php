<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AnswersTable extends Component
{
    // Declare variables and listeners.
    public $answers = [];
    public $question_id = 0;
    public $answer_id = 0;

    protected $listeners = ['add-new-answer' => 'add_new_answer','edit-answer' => 'edit_answer'];

    // Add a new answer based off the entered answer and whether it is correct.
    public function add_new_answer($answer,$correct)
    {   
        $this->answers[] = array("answer"=>$answer,"correct"=>$correct);
    }

    // Save edited answer back to array.
    public function edit_answer($answer,$correct,$answer_id)
    {   
        $this->answers[$answer_id] = array("answer"=>$answer,"correct"=>$correct);
    }

    // Delete selected answer from question and re-index the answers.
    public function delete_answer($answer_id){
        unset($this->answers[$answer_id]);
        $this->answers = array_values($this->answers);
    }
    
    // Return the livewire component. 
    public function render()
    {
        return view('livewire.answers-table',[
            'answers' => $this->answers 
        ]);
    }
}
