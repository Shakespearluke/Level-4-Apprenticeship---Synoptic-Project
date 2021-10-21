<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AnswersTable extends Component
{
    public $answers = [];
    public $question_id = 0;
    public $answer_id = 0;

    protected $listeners = ['add-new-answer' => 'add_new_answer','edit-answer' => 'edit_answer'];

    public function add_new_answer($answer,$correct)
    {   
        $this->answers[] = array("answer"=>$answer,"correct"=>$correct);
    }

    public function edit_answer($answer,$correct,$answer_id)
    {   
        $this->answers[$answer_id] = array("answer"=>$answer,"correct"=>$correct);
    }

    public function delete_answer($answer_id){
        unset($this->answers[$answer_id]);
        $this->answers = array_values($this->answers);
    }

    public function render()
    {
        return view('livewire.answers-table',[
            'answers' => $this->answers 
        ]);
    }
}
