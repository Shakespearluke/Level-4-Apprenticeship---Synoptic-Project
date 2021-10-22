{{-- HTML tags & main layout page. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- Include Tailwind CSS styles. --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Include global.js for global JS functions. --}}
    <script src="{{ asset('js/global.js') }}"></script>    
    {{-- Setup CSRF token for form submissions. --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- Set page title. --}}
    <title>Quiz Manager</title>
    {{-- Include Laravel Livewire styles & Jquery.js --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    {{-- Main page navbar. --}}
    <nav class="p-6 bg-white flex justify-between mb-6 shadow-md">
        <ul class="flex items-center">
            {{-- Display company branding. --}}
            <li>
                <img src="{{ asset(config('company.logo')) }}" class=" object-contain h-8"/>
            </li>
            <li>
                <a href="/" class="p-3">{{ config('company.name') }}</a>
            </li>
        </ul>
        <ul class="flex items-center">
            {{-- Check if user is currently logged in --}}
            @auth
                {{-- User logged in - Display the users name and logout button. --}}
                <li>
                    <a class="p-3">{{ auth()->user()->name }} </a>
                </li>
                <li> 
                    <form action="{{ route('logout') }}" method="post" type="submit" class="inline px-3">
                        @csrf
                        <button>Logout</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
    {{-- Div node to allow for pop-out alerts on the application. --}}
    <div id="alert_node"></div>
    {{-- Include the cotent of currently loaded view. --}}
    @yield('content')
    {{-- Include necessary livewire scripts to enable Laravel livewire. --}}
    @livewireScripts
</body>
</html>