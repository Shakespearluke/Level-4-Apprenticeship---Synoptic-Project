@extends('layouts.app')

@section('content')
<div class="mx-auto container bg-white dark:bg-gray-800 shadow-lg rounded-lg mb-10">
    <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
        <div class="w-full lg:w-1/3 flex flex-col lg:flex-row items-start lg:items-center">
            <h2 tabindex="0" class="focus:outline-none text-gray-600 dark:text-gray-100 text-lg font-semibold" id="table">Quizzes
            </h2> 
        </div>
        <div class="w-full lg:w-2/3 flex flex-col lg:flex-row items-start lg:items-center justify-end">
            <div class="lg:ml-2 flex items-center border-gray-300">
                <a href="{{ route('create_quiz')}}">
                    <button role="button" id="add_user" aria-label="add table" class="text-white ml-4 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-600 border border-transparent bg-cyan-600 transition duration-150 ease-in-out hover:bg-cyan-700 w-8 h-8 rounded flex items-center justify-center">
                        <svg class="icon icon-tabler icon-tabler-plus" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div id='dashboard_table'>
        @include('app.quizzes_table', $quizzes)
    </div>
</div>

@endsection