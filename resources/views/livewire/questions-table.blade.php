{{-- Questions tables Livewire view --}}
<div class="w-full overflow-x-scroll xl:overflow-x-visible">
    <table class="min-w-full bg-white dark:bg-gray-800 table-auto">
        <thead>
            {{-- Table heading. --}}
            <tr class="w-full h-16 border-gray-300 border-b py-8">
                <th role="columnheader" class="pl-8 text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Question No.</th>
                <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Question</th>
                <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">No. of Answers</th>
                <td role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">More</td>
            </tr>
        </thead>
        <tbody>
            {{-- Foreach loop over quiz's answers to build table body. --}}
            @foreach($this->questions as $key=>$question)
                <tr class="h-16 border-gray-300 border-b">
                    {{-- Question details. --}}
                    <td class="pl-8  text-sm  whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{$key+1}}</td>
                    <td class="text-sm whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{$question['question']}}</td>
                    <td class="text-sm whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">
                        {{-- Count the number of answers if at least 1 answer to the question. --}}
                        @if (count($question['answers']) > 0)
                        {{ count($question['answers']) }}
                        @endif
                    </td>
                    {{-- More dropdown for editing and deleting. --}}
                    <td class="relative wrapper">
                        <a onclick="dropdownFunction(this)" aria-label="dropdown" role="button" class="dropbtn text-gray-500 rounded cursor-pointer border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400">
                            <svg onclick="dropdownFunction(this)" class="icon icon-tabler icon-tabler-dots-vertical dropbtn" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <circle cx="12" cy="12" r="1" />
                                <circle cx="12" cy="19" r="1" />
                                <circle cx="12" cy="5" r="1" />
                            </svg>
                        </a>
                        <div class="dropdown-content mt-1 absolute left-0 -ml-12 shadow-md z-10 object-cover hidden w-32">
                            <ul class="bg-white dark:bg-gray-800 shadow rounded py-1">
                                {{-- Edit and delete a question. --}}
                                <li onclick="editQuestion(true,'modal-edit-question','edit_question','{{$question['question']}}','{{json_encode($question['answers'])}}','{{$key+1}}')" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-cyan-600 hover:text-white px-3 font-normal">Edit</li>
                                <li wire:click="delete_question({{$key}})" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-cyan-600 hover:text-white px-3 font-normal">Delete</li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Hidden form element to contain question data. --}}
    {!! Form::hidden('questions', json_encode($this->questions)) !!}
    {{-- Footer save & add form controls. --}}
    <div class="flex flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
        <div class="w-full flex flex-col lg:flex-row items-start lg:items-center">
            <div class="flex items-center border-gray-300">
                <button role="button" id="add_user" aria-label="add table" class="text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-600 border border-transparent bg-cyan-600 transition duration-150 ease-in-out hover:bg-cyan-700 w-16 h-8 rounded flex items-center justify-center">
                    Save
                </button>
            </div>
        </div>
        <div class="w-full lg:w-2/3 flex flex-row items-start lg:items-center justify-end">
            <div class="lg:ml-2 flex items-center border-gray-300">
                {{-- AJAX load the add question form. --}}
                <a onclick="bladeModalHandler(true,'modal-add-question','add_question')" role="button" id="add_user" aria-label="add table" class="text-white ml-4 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-600 border border-transparent bg-cyan-600 transition duration-150 ease-in-out hover:bg-cyan-700 w-8 h-8 rounded flex items-center justify-center">
                    <svg class="icon icon-tabler icon-tabler-plus" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>