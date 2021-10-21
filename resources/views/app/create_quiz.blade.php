@extends('layouts.app')
@section('content')
{{-- Create new quiz form and components. --}}
<div class="mx-auto container bg-white dark:bg-gray-800 shadow-lg rounded-lg mb-2 w-2/5">
    <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch">
        <div class="flex flex-col lg:flex-row items-start lg:items-center">
            <h2 tabindex="0" class="focus:outline-none text-gray-600 dark:text-gray-100 text-lg font-semibold" id="table">Create Quiz
            </h2> 
        </div>
    </div>
    {{-- Build HTML form using Laravel HTML collective --}}
    {!! Form::open(['route' => 'create_quiz']) !!}
    <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden transform transition-all pb-6 sm:align-middle sm:max-w-lg sm:w-full pl-2">
        <div class="w-11/12 mx-auto">
            <div class="xl:w-full mx-auto xl:mx-0">
                <div class="mt-2 flex flex-col xl:w-full lg:w-full w-full">
                    <label for="title" class="pb-2 text-sm font-normal text-gray-800 dark:text-gray-100">Title</label>
                    <input aria-label="enter title" type="text" id="title" name="title" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-cyan-700 text-gray-600 bg-transparent dark:text-gray-100 @error('title') border-red-500 @enderror" placeholder="Title" value="{{ old('title') }}"/>
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
                    <textarea aria-label="enter description" type="text" id="description" name="description" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-cyan-700 text-gray-600 bg-transparent dark:text-gray-100 lowercase @error('description') border-red-500 @enderror" placeholder="description">{{ old('description') }}</textarea>
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
                    <input aria-label="enter topic" type="text" id="topic" name="topic" class="border border-gray-300 dark:border-gray-700 pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-cyan-700 text-gray-600 bg-transparent dark:text-gray-100 @error('topic') border-red-500 @enderror" placeholder="Topic" value="{{ old('topic') }}"/>
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
    {{-- Load in the Livewire questions table conponent, load with previous data if form validation has failed. --}}
    @if(json_decode(old('questions'),true))
        @livewire('questions-table', ['questions' => json_decode(old('questions'),true)])
    @else
        @livewire('questions-table')
    @endif
    {!! Form::close() !!}
</div>

@endsection