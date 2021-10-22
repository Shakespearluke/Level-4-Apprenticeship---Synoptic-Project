{{-- Answers tables Livewire view --}}
<div class="w-12/12 mx-auto mt-2">
    <div class="xl:w-full mx-auto xl:mx-0">
        <div class="flex flex-col xl:w-full lg:w-full w-full">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead>
                    {{-- Table heading. --}}
                    <tr class="w-full h-16 border-gray-300 border-b py-8">
                        <th role="columnheader" class="pl-8 text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Answer</th>
                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Correct?</th>
                        <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">More</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Foreach loop over question's answers to build table body. --}}
                    @foreach($this->answers as $key=>$answer)
                    <tr class="h-16 border-gray-300 border-b">
                        {{-- Answer details. --}}
                        <td class="pl-8  text-sm  whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{$answer['answer']}}</td>
                        {{-- Check if the answer is correct and style depending on result. --}}
                        @if($answer['correct'] == 1)
                            <td class="text-sm whitespace-no-wrap text-green-500 dark:text-gray-100 tracking-normal leading-4">Yes</td>
                        @else
                            <td class="text-sm whitespace-no-wrap text-red-500 dark:text-gray-100 tracking-normal leading-4">No</td>
                        @endif
                        {{-- More dropdown for editing and deleting. --}}
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
                                    {{-- Edit and delete a answer. --}}
                                    <li onclick="editAnswer(true,'modal-edit-answer','edit_answer','{{$answer['answer']}}','{{($answer['correct'])}}','{{$key+1}}')" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-custom hover:text-white px-3 font-normal">Edit</li>
                                    <li wire:click="delete_answer({{$key}})" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-custom hover:text-white px-3 font-normal">Delete</li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table> 
            {{-- Form validation message --}}
            <div class="w-11/12 mx-auto">
                <div class="xl:w-full mx-auto xl:mx-0">
                    <div class="mt-1 flex flex-col xl:w-full lg:w-full w-full">
                        <div id="answers_error"></div>
                    </div>
                </div>
            </div>           
        </div>
    </div>
    {{-- Footer save & add form controls. --}}
    <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
        <div class="w-full flex flex-col lg:flex-row items-start lg:items-center">
            <div class="flex items-center border-gray-300">
                <button role="button" id="save_question" aria-label="add table" class="text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom border border-transparent bg-custom transition duration-150 ease-in-out hover:bg-custom-hover w-16 h-8 rounded flex items-center justify-center">
                    Save
                </button>
            </div>
        </div>
        <div class="w-full lg:w-2/3 flex flex-col lg:flex-row items-start lg:items-center justify-end">
            <div class="lg:ml-2 flex items-center border-gray-300">
                {{-- AJAX load the add answer form. --}}
                <button onclick="bladeModalHandler(true,'modal-add-answer','add_answer')" role="button" id="add_user" aria-label="add table" class="text-white ml-4 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom border border-transparent bg-custom transition duration-150 ease-in-out hover:bg-custom-hover w-8 h-8 rounded flex items-center justify-center">
                    <svg class="icon icon-tabler icon-tabler-plus" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>
            </div>
        </div>
    {{-- Secret Div containing answer data to help with pushing to Jquery. --}}
    <div style="display:none;" id="answers" >{{ json_encode($this->answers) }}</div>
</div>

<script type="text/javascript">
    // AJAX post request to handle form validation and adding of questions
    // Set CSRF token
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Firstly unbind click event to ensure this is only processed once per click.
    $("#save_question").unbind( "click" );
    // Form submission button click.
    $('#save_question').on('click', function(e){
        e.preventDefault();
        
        // Reset form styling.
        update_element_styling('question','border-gray-300',true)
        update_element_styling('question','border-red-600',false)

        // Remove any error texts.
        $('p').remove();
        // Setup variables
        var question = $("input[name=question]").val();
        var answers = jQuery.parseJSON($("#answers").html());
        var question_id = '{{ $question_id }}' ;
        var validate = 0;
        var correct = 0;

        // Check that question input box isn't left blank.
        if(question == ''){
            // Question input box validation has failed. Notify user.
            $('#question_error').append("<p class='text-red-600 pt-2' id='question_error_p'>The question field is required</p>")
            update_element_styling('question','border-gray-300',false)
            update_element_styling('question','border-red-600',true)
            validate++;
        }

        // Check that there is at least one answer
        if(answers.length < 3){
            $('#answers_error').append("<p class='text-red-600 pt-2' id='question_error_p'>You must have at least three answers</p>")
            validate++;
        }else{
            // Check there is at least one answer that is correct
            $.each( answers, function( key, answer ) {
                if(answer['correct'] == true){
                    correct++;
                };
            });
            if(correct == 0){
                $('#answers_error').append("<p class='text-red-600 pt-2' id='question_error_p'>At least one answer must be correct</p>")
                validate++
            }
        }

        // Check that there is only up-to 5 answers
        if(answers.length > 5){
            $('#answers_error').append("<p class='text-red-600 pt-2' id='question_error_p'>You can only have up-to 5 answers</p>")
            validate++;
        }

        if(validate == 0){
            // Check if this edit of an answer or a new answer
            if({{ $question_id }} == 0){
                // Validated succesful save the answer and close modal.
                saveQuestion(question,answers);
                bladeModalHandler(false,null,'add_question');
            }else{
                // Validated succesful save the answer and close modal.
                saveEditedQuestion(question,answers,question_id-1);
                bladeModalHandler(false,null,'edit_question')
            }
        }
    });
</script>