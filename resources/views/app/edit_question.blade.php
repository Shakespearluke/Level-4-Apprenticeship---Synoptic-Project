<div style="opacity: -0.1; display: none;" class="fixed z-10 inset-0  overflow-hidden transition duration-150 ease-in-out" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="edit_question">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">  
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"  id="alert_node"></div>        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-lg transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="xl:w-full border-b border-gray-300 dark:border-gray-700 py-5">
                    <div class="flex items-center w-11/12 mx-auto">
                        <h1 aria-label="profile" class="text-lg text-gray-800 dark:text-gray-100 font-bold">Question #{{ $question_id }}</h1>
                    </div>
                    <a aria-label="close modal" onclick="bladeModalHandler(false,null,'edit_question')" class="cursor-pointer absolute top-0 right-0 mt-6 mr-6 dark:text-gray-100 text-gray-400 hover: dark:text-gray-100 text-gray-600 transition duration-150 ease-in-out focus:outline-none rounded focus:ring-black">
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
                            <label for="question" class="pb-2 text-sm font-normal text-gray-800 dark:text-gray-100">Question</label>
                            <input aria-label="enter question" type="text" id="question" name="question" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-cyan-700 text-gray-800 bg-transparent dark:text-gray-100" maxlength="100" value="{{ $question }}" placeholder="Question" />
                            <div id="question_error" name="question_error"></div>
                        </div>
                    </div>
                </div>
                @livewire('answers-table',['answers' => $answers, 'question_id' => $question_id])
            </div>
        </div>
    </div>
</div>