{{-- Quizzes tables view --}}
<div class="w-full overflow-x-scroll xl:overflow-x-visible">
    <table class="min-w-full bg-white dark:bg-gray-800 table-auto">
        <thead>
            {{-- Table heading. --}}
            <tr class="w-full h-16 border-gray-300 border-b py-8">
                <th role="columnheader" class="pl-8 text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Title</th>
                <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Topic</th>
                <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Questions</th>
                <th role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">Created</th>
                <td role="columnheader" class="text-gray-600 dark:text-gray-400 font-normal text-left text-sm tracking-normal leading-4">More</td>
            </tr>
        </thead>
        <tbody>
            {{-- Foreach loop over all available quizzes to build table body. --}}
            @foreach($quizzes as $quiz)
            <tr class="h-16 border-gray-300 border-b">
                {{-- Quiz details. --}}
                <td class="pl-8  text-sm  whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{$quiz->title}}</td>
                <td class="text-sm whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{$quiz->topic}}</td>
                <td class="text-sm whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{$quiz->questions($quiz->id)->count()}}</td>
                <td class="text-sm whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{$quiz->created_at->diffforhumans()}}</td>
                {{-- More dropdown for editing, viewing and deleting. --}}
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
                            {{-- Edit, view and delete a quiz. --}}
                            <a href="{{ route('edit_quiz',$quiz->id)}}"><li onclick="" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-cyan-600 hover:text-white px-3 font-normal">Edit</li></a>
                            <li onclick="" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-cyan-600 hover:text-white px-3 font-normal">View</li>
                            <li onclick="bladeModalHandler(true,'dashboard/modal-delete-quiz','delete_quiz','{{ $quiz->id }}')" class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-cyan-600 hover:text-white px-3 font-normal">Delete</li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- Laravel Tailwind pagination buttons. --}}
<div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
    <div class="w-full lg:w-1/3 flex flex-col lg:flex-row items-start lg:items-center">
    </div>
    <div class="w-full lg:w-2/3 flex flex-col lg:flex-row items-start lg:items-center justify-end">
        <div class="flex items-center lg:border-l lg:border-r border-gray-300 py-3 lg:py-0 lg:px-6 pagination">
            {{ $quizzes->links(); }}
        </div>
    </div>
</div>

<script>
    // Control pagiantion using AJAX request.
    $(".pagination a").click(function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        bladeTableHandler(true,'dashboard/table-quizzes','dashboard_table',page)
    });

    // Add a 5 margin to the right to fix broken Tailwind Pagination styling.
    $( document ).ready(function() {
        $(".pagination p").addClass('mr-5');
    });
</script>