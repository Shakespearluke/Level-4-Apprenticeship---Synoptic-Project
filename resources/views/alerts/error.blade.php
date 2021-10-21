{{-- Error alert notification --}}
<div class="fixed inset-0" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">  
        <div class="flex items-center justify-center px-4 sm:px-0">
            <div role="alert" id="alert-error" class="lg:w-10/12 transition duration-150 ease-in-out bg-red-100 shadow rounded-md md:flex justify-between items-center top-0 -mt-8 mb-8 py-4 px-4">
                <div class="sm:flex items-center">
                    <div class="flex items-end">
                        <div class="mr-2 mt-0.5 sm:mt-0 text-red-700">
                            <svg role="alert" tabindex="0" aria-label="information" class="focus:outline-none" viewBox="0 0 24 24" width="22" height="22" fill="currentColor">
                                <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0v-4a1 1 0 0 1 1-1zm0-4a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                        </div>
                        <p class="mr-2 text-base font-bold text-red-700">Error</p>
                    </div>
                    <div class="h-1 w-1 bg-red-700 rounded-full mr-2 hidden xl:block"></div>
                    {{-- Populate with custom error message --}}
                    <p id='alert-message' class="text-base text-red-700">**ALERT_MESSAGE**</p>
                </div>
                <div class="flex justify-end mt-4 md:mt-0 md:pl-4 lg:pl-0">
                    {{-- Dismiss alert notification --}}
                    <button onclick="alertHandler(null,'alert-error',false);" class="focus:outline-none focus:text-white hover:text-gray-400 focus:outline-none text-sm cursor-pointer text-gray-600">Dismiss</button>
                </div>
            </div>
        </div>
    </div>
</div>