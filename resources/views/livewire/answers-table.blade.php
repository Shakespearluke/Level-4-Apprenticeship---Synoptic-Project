<div class="w-12/12 mx-auto mt-2">
    <div class="xl:w-full mx-auto xl:mx-0">
        <div class="flex flex-col xl:w-full lg:w-full w-full">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead>
                    <tr class="w-full h-16 border-gray-300 border-b py-8">
                        <th role="columnheader" class="pl-8 text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Answer</th>
                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Correct?</th>
                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">More</th>
                    </tr>
                </thead>
                @foreach($this->answers as $key=>$answer)
                <tr class="h-16 border-gray-300 border-b">
                    <td class="pl-8  text-sm  whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{$answer['answer']}}</td>
                    @if($answer['correct'] == 1)
                        <td class="text-sm whitespace-no-wrap text-green-500 dark:text-gray-100 tracking-normal leading-4">Yes</td>
                    @else
                        <td class="text-sm whitespace-no-wrap text-red-500 dark:text-gray-100 tracking-normal leading-4">No</td>
                    @endif
                    <td class="relative wrapper">
                        <button onclick="dropdownFunction(this)" aria-label="dropdown" role="button" class="dropbtn text-gray-500 rounded cursor-pointer border border-transparent  focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400">
                            <svg onclick="dropdownFunction(this)" class="icon icon-tabler icon-tabler-dots-vertical dropbtn" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <circle cx="12" cy="12" r="1" />
                                <circle cx="12" cy="19" r="1" />
                                <circle cx="12" cy="5" r="1" />
                            </svg>
                        </button>
                        <div class="dropdown-content mt-1 absolute left-0 -ml-12 shadow-md z-10 object-cover hidden w-32">
                            <ul class="bg-white dark:bg-gray-800 shadow rounded py-1">
                                <li onclick="editAnswer(true,'modal-edit-answer','edit_answer','{{$answer['answer']}}','{{($answer['correct'])}}','{{$key+1}}')" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-cyan-600 hover:text-white px-3 font-normal">Edit</li>
                                <li wire:click="delete_answer({{$key}})" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-cyan-600 hover:text-white px-3 font-normal">Delete</li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach 
            </table> 
            <div class="w-11/12 mx-auto">
                <div class="xl:w-full mx-auto xl:mx-0">
                    <div class="mt-1 flex flex-col xl:w-full lg:w-full w-full">
                        <div id="reports_error"></div>
                    </div>
                </div>
            </div>           
        </div>
    </div>
    <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
        <div class="w-full flex flex-col lg:flex-row items-start lg:items-center">
            <div class="flex items-center border-gray-300">
                <button role="button" id="save_question" aria-label="add table" class="text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-600 border border-transparent bg-cyan-600 transition duration-150 ease-in-out hover:bg-cyan-700 w-16 h-8 rounded flex items-center justify-center">
                    Save
                </button>
            </div>
        </div>
        <div class="w-full lg:w-2/3 flex flex-col lg:flex-row items-start lg:items-center justify-end">
            <div class="lg:ml-2 flex items-center border-gray-300">
                <button onclick="bladeModalHandler(true,'modal-add-answer','add_answer')" role="button" id="add_user" aria-label="add table" class="text-white ml-4 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-600 border border-transparent bg-cyan-600 transition duration-150 ease-in-out hover:bg-cyan-700 w-8 h-8 rounded flex items-center justify-center">
                    <svg class="icon icon-tabler icon-tabler-plus" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>
            </div>
        </div>
    <div style="display:none;" id="answers" data-answers="{{ json_encode($this->answers) }}"></div>
</div>

<script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#save_question").unbind( "click" );
    $('#save_question').on('click', function(e){
        
        e.preventDefault();

        update_element_styling('question','border-gray-300',true)
        update_element_styling('question','border-red-600',false)

        $('#question_error_p').remove();
        
        var question = $("input[name=question]").val();
        var answers = $('#answers').data('answers');
        var question_id = {{ $question_id }};

        if(question == ''){
            $('#question_error').append("<p class='text-red-600 pt-2' id='question_error_p'>The question field is required</p>")
            update_element_styling('question','border-gray-300',false)
            update_element_styling('question','border-red-600',true)
        }else{
            if({{ $question_id }} == 0){
                saveQuestion(question,answers);
                bladeModalHandler(false,null,'add_question');
            }else{
                saveEditedQuestion(question,answers,question_id-1);
                bladeModalHandler(false,null,'edit_question')
            }
        }
    });
</script>