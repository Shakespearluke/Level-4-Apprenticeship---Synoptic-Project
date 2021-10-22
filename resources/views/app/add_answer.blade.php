{{-- Add a new answer to question modal. --}}
<div style="opacity: -0.1; display: none;" class="fixed z-10 inset-0  overflow-hidden transition duration-150 ease-in-out" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="add_answer">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">  
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"  id="alert_node"></div>        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-lg transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="xl:w-full border-b border-gray-300 dark:border-gray-700 py-5">
                    <div class="flex items-center w-11/12 mx-auto">
                        <h1 aria-label="profile" class="text-lg text-gray-800 dark:text-gray-100 font-bold">New Answer</h1>
                    </div>
                    {{-- Close add answer modal --}}
                    <a aria-label="close modal" onclick="bladeModalHandler(false,null,'add_answer')" class="cursor-pointer absolute top-0 right-0 mt-6 mr-6 dark:text-gray-100 text-gray-400 hover: dark:text-gray-100 text-gray-600 transition duration-150 ease-in-out focus:outline-none rounded focus:ring-black">
                        <svg class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </a>
                </div>
                <div class="w-11/12 mx-auto">
                    <div class="xl:w-full mx-auto xl:mx-0">
                        <div class="mt-5 flex flex-col xl:w-full lg:w-full w-full">
                            <label for="answer" class="pb-2 text-sm font-normal text-gray-800 dark:text-gray-100">Answer</label>
                            <input aria-label="enter answer" type="text" id="answer" name="answer" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-custom-hover text-gray-800 bg-transparent dark:text-gray-100" maxlength="50" placeholder="Answer" />
                            <div id="answer_error"></div>
                        </div>
                    </div>
                    <div class="xl:w-full mx-auto xl:mx-0">
                        <div class="mt-5 flex flex-col xl:w-full lg:w-full w-full">
                            <label for="correct" class="pb-2 text-sm font-normal text-gray-800 dark:text-gray-100">Correct?</label>
                            <input aria-label="correct?" type="checkbox" id="correct" name="correct" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-custom-hover text-gray-800 bg-transparent dark:text-gray-100" placeholder="Correct?" />
                        </div>
                    </div>
                </div>
                {{-- Footer save form controls. --}}
                <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
                    <div class="w-full flex flex-col lg:flex-row items-start lg:items-center">
                        <div class="flex items-center border-gray-300">
                            <button role="button" id="save_answer" aria-label="add table" class="text-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom border border-transparent bg-custom transition duration-150 ease-in-out hover:bg-custom-hover w-16 h-8 rounded flex items-center justify-center">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // AJAX post request to handle form validation and creation of new question
    // Set CSRF token    
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Form submission button click.
    $('#save_answer').on('click', function(e){
        e.preventDefault();

        // Reset form styling.
        update_element_styling('answer','border-gray-300',true)
        update_element_styling('answer','border-red-600',false)

        // Remove any error texts.
        $('#answer_error_p').remove();
        
        // Setup variables
        var answer = $("input[name=answer]").val();
        var correct = false
        
        // Check if correct checkbox is checked.
        if($('#correct').prop("checked")){
            correct = true;
        }

        // Check that answer input box isn't left blank.
        if(answer == ''){
            // Answer input box validation has failed. Notify user.
            $('#answer_error').append("<p class='text-red-600 pt-2' id='answer_error_p'>The answer field is required</p>")
            update_element_styling('answer','border-gray-300',false)
            update_element_styling('answer','border-red-600',true)
        }else{ 
            // Validated succesfully save the answer and close modal.
            saveAnswer(answer,correct);
            bladeModalHandler(false,null,'add_answer')
        }
    });
</script>


