@extends('layouts.app')

@section('content')
{{-- Login form to handle user logins. --}}
<div class="flex justify-center">
    <div class ="w-4/12 bg-white p-6 rounded-lg shadow-lg">
        <h1 class="mb-4 text-xl">
            Login
        </h1>
        {{-- Form with Laravel login route. --}}
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-4">  
                <label for="Email" class="sr-only">Email</label>
                {{-- Populate with old email if unsuccessful validation on form post. --}}
                <input type="text" name="email" id="Email" placeholder="Your Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                {{-- Form validation message --}}
                @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">  
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">
                {{-- Form validation message. --}}
                @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- Remember me button to remember outside of session. --}}
            <div class='mb-4'>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember">Remember me</label>
                </div>
            </div>
            {{-- Form validation status message. --}}
            @if (session('status'))
            <div class="text-red-500 mb-4">
                {{ session('status') }}
            </div>        
            @endif
            {{-- Submit form. --}}
            <div>
                <button type="submit" class="bg-custom hover:bg-custom-hover text-white px-4 py-3 rounded font-medium w-full">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection