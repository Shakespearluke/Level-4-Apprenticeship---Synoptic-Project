{{-- Livewire view to start viewing quiz --}}
<div>
    <button wire:click="load_questions({{$quiz->id}})" id="start_quiz" type="submit" class="bg-custom hover:bg-custom-hover text-white px-4 py-3 rounded font-medium w-3/12">Click to view questions</button>
<div>