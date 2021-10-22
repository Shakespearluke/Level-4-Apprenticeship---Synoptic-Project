@extends('layouts.app')

@section('content')
{{-- Edit a pre-existing quiz form and components. --}}
<div class="mx-auto container bg-white dark:bg-gray-800 shadow-lg rounded-lg mb-2 w-2/5">
    <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch">
        <div class="flex flex-col lg:flex-row items-start lg:items-center">
            {{-- Load title with title of quiz being editing --}}
            <h2 tabindex="0" class="focus:outline-none text-gray-600 dark:text-gray-100 text-lg font-semibold" id="table">Editing Quiz: {{$quiz->title}}
            </h2> 
        </div>
        {{-- Close edit quiz form --}}
        <a href="{{ route('dashboard')}}" aria-label="close modal" class="cursor-pointer dark:text-gray-100 text-gray-400 hover: dark:text-gray-100 text-gray-600 transition duration-150 ease-in-out focus:outline-none rounded focus:ring-black">
            <svg class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </a>
    </div>
    {{-- Build HTML form using Laravel HTML collective and quiz data --}}
    {!! Form::open(['route' =>  array('edit_quiz',$quiz->id)]) !!}
    <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden transform transition-all pb-6 sm:align-middle sm:max-w-lg sm:w-full pl-2">
        <div class="w-11/12 mx-auto">
            <div class="xl:w-full mx-auto xl:mx-0">
                <div class="mt-2 flex flex-col xl:w-full lg:w-full w-full">
                    <label for="title" class="pb-2 text-sm font-normal text-gray-800 dark:text-gray-100">Title</label>
                    {{-- Prepopulate quiz title input box with title. --}}
                    <input aria-label="enter title" type="text" id="title" name="title" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-custom-hover text-gray-600 bg-transparent dark:text-gray-100 @error('title') border-red-500 @enderror" placeholder="Title" value="@if(old('title')){{ old('title') }}@else{{ $quiz->title }}@endif"/>
                    {{-- Form validation message --}}
                    @error('title')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>
            </div>
        </div>
        <div class="w-11/12 mx-auto">
            <div class="xl:w-full mx-auto xl:mx-0">
                <div class="mt-2 flex flex-col xl:w-full lg:w-full w-full">
                    <label for="description" class="pb-2 text-sm font-normal text-gray-800 dark:text-gray-100">Description</label>
                    <textarea aria-label="enter description" type="text" id="description" name="description" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-custom-hover text-gray-600 bg-transparent dark:text-gray-100 lowercase @error('description') border-red-500 @enderror" placeholder="description">@if(old('description')){{ old('description') }}@else{{ $quiz->description }}@endif</textarea>
                    {{-- Form validation message --}}
                    @error('description')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>
            </div>
        </div>
        <div class="w-11/12 mx-auto">
            <div class="xl:w-full mx-auto xl:mx-0">
                <div class="mt-2 flex flex-col xl:w-full lg:w-full w-full">
                    <label for="topic" class="pb-2 text-sm font-normal text-gray-800 dark:text-gray-100">Title</label>
                    <input aria-label="enter topic" type="text" id="topic" name="topic" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-custom-hover text-gray-600 bg-transparent dark:text-gray-100 @error('topic') border-red-500 @enderror" placeholder="Topic" value="@if(old('topic')){{ old('topic') }}@else{{ $quiz->topic }}@endif"/>
                    {{-- Form validation message --}}
                    @error('topic')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>
            </div>
        </div>
    </div>
    {{-- Include the livewire questions table conponent passing through the necessary data required for editing. --}}
    @livewire('questions-table', ['questions' => $questions,true])
    {!! Form::close() !!}
</div>

@endsection