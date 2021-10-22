{{-- Answers Livewire view --}}
<div class="w-full overflow-x-scroll xl:overflow-x-visible">
    <h1 class="mb-10 text-lg text-center">
        {{ $question }}
    </h1>
    <div class="flex flex-col mb-4">
        {{-- Foreach loop over answers to build answer list. --}}
        @foreach($this->answers as $key=>$answer)
            <div class="h-16 border-gray-300 border-b4">
                 {{-- Color correct and incorret answers only if user is of succiffient access level. --}}
                 @if (Auth::user()->access_level < 3)
                    @if ($answer['correct'] == true)
                        <button class="bg-green-500 cursor-default text-white px-4 py-3 rounded font-medium w-5/12">{{chr(str_pad((65 + $key), 3, '0', STR_PAD_LEFT))}}: {{$answer['answer']}}</button>   
                    @else
                        <button class="bg-red-600 cursor-default text-white px-4 py-3 rounded font-medium w-5/12">{{chr(str_pad((65 + $key), 3, '0', STR_PAD_LEFT))}}: {{$answer['answer']}}</button>   
                    @endif
                @else
                    <button class="bg-custom cursor-default text-white px-4 py-3 rounded font-medium w-5/12">{{chr(str_pad((65 + $key), 3, '0', STR_PAD_LEFT))}}: {{$answer['answer']}}</button>   
                @endif
            </div>
        @endforeach
    </div>
    {{-- Footer next & previous question form controls. --}}
    <div class="flex felx-row justify-between"> 
        <div class="flex items-center border-gray-300">
            @if($current_question == 0)
                <a href="{{ route('dashboard')}}">    
                    <button role="button" aria-label="add table" class="text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom border border-transparent bg-custom transition duration-150 ease-in-out hover:bg-custom-hover w-18 h-12 rounded flex items-center justify-center px-4">
                        Back to Dashboard
                    </button>    
                </a>
            @else
                <button wire:click="previous_question({{$quiz->id}})" role="button" aria-label="add table" class="text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom border border-transparent bg-custom transition duration-150 ease-in-out hover:bg-custom-hover w-18 h-12 rounded flex items-center justify-center px-4">
                    Previous Question
                </button>
            @endif
        </div>
        <div class="flex items-center border-gray-300">
            @if($current_question+1 == $total_questions)
                <a href="{{ route('dashboard')}}">    
                    <button role="button" aria-label="add table" class="text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom border border-transparent bg-custom transition duration-150 ease-in-out hover:bg-custom-hover w-18 h-12 rounded flex items-center justify-center px-4">
                        Back to Dashboard
                    </button>    
                </a>
            @else
                <button wire:click="next_question({{$quiz->id}})" role="button" aria-label="add table" class="text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom border border-transparent bg-custom transition duration-150 ease-in-out hover:bg-custom-hover w-18 h-12 rounded flex items-center justify-center px-4">
                    Next Question
                </button>
            @endif
        </div>
    </div>
</div>
