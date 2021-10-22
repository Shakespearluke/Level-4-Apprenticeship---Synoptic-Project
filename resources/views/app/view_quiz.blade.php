@extends('layouts.app')
{{-- View to enable content for viewing a quiz --}}
@section('content')    
<div class="flex justify-center">
    <div class ="w-6/12 bg-white p-6 rounded-lg shadow-lg">
        <h1 class="mb-4 mt-2 text-xl text-center">
            {{ $quiz->title }}
        </h1>
        <div id="wrapper">
            <h1 class="mb-10 text-lg text-center">
                {{ $quiz->description }}
            </h1>
            <div class="text-center mb-2">
                @livewire('view-questions',['quiz' => $quiz])
            </div>
        </div>            
    </div>
</div>
@endsection