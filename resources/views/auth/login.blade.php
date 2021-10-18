@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class ="w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <h1 class="mb-4 text-xl">
                Login
            </h1>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="mb-4">  
                    <label for="Email" class="sr-only">Email</label>
                    <input type="text" name="email" id="Email" placeholder="Your Email" 
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">  
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" 
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">
                    
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class='mb-4'>
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember">Remember me</label>
                    </div>
                </div>
                @if (session('status'))
                <div class="text-red-500 mb-4">
                    {{ session('status') }}
                </div>        
                @endif
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Login</button>
                </div>
            </form>

        </div>
    </div>
@endsection