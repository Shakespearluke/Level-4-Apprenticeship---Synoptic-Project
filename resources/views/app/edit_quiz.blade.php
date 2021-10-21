@extends('layouts.app')

@section('content')
<div class="mx-auto container bg-white dark:bg-gray-800 shadow-lg rounded-lg mb-2 w-2/5">
    <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch">
        <div class="flex flex-col lg:flex-row items-start lg:items-center">
            <h2 tabindex="0" class="focus:outline-none text-gray-600 dark:text-gray-100 text-lg font-semibold" id="table">Create Quiz
            </h2> 
        </div>
    </div>
    {!! Form::open(['route' => 'create_quiz']) !!}
    <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden transform transition-all pb-6 sm:align-middle sm:max-w-lg sm:w-full pl-2">
        <div class="w-11/12 mx-auto">
            <div class="xl:w-full mx-auto xl:mx-0">
                <div class="mt-2 flex flex-col xl:w-full lg:w-full w-full">
                    <label for="title" class="pb-2 text-sm font-normal text-gray-800 dark:text-gray-100">Title</label>
                    <input aria-label="enter title" type="text" id="title" name="title" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-cyan-700 text-gray-600 bg-transparent dark:text-gray-100 @error('title') border-red-500 @enderror" placeholder="Title" value="@if(old('title')){{ old('title') }}@else{{ $quiz->title }}@endif"/>
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
                    <textarea aria-label="enter description" type="text" id="description" name="description" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-cyan-700 text-gray-600 bg-transparent dark:text-gray-100 lowercase @error('description') border-red-500 @enderror" placeholder="description">@if(old('description')){{ old('description') }}@else{{ $quiz->description }}@endif</textarea>
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
                    <input aria-label="enter topic" type="text" id="topic" name="topic" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-cyan-700 text-gray-600 bg-transparent dark:text-gray-100 @error('topic') border-red-500 @enderror" placeholder="Topic" value="@if(old('topic')){{ old('topic') }}@else{{ $quiz->topic }}@endif"/>
                    @error('topic')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror 
                    @error('questions')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>
            </div>
        </div>
    </div>
    @livewire('questions-table', ['questions' => $questions,true])
    {!! Form::close() !!}
</div>

@endsection