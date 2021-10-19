<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/global.js') }}"></script>
    <script src="{{ asset('js/ui.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Quiz Manager</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body class="bg-gray-100">
    <nav class="p-6 bg-white flex justify-between mb-6 shadow-md">
        <ul class="flex items-center">
            @auth
                <li>
                    {{-- <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a> --}}
                </li>
            @endauth
            @guest
                <li>
                    <a href="/" class="p-3">Home</a>
                </li>
            @endguest
        </ul>
        <ul class="flex items-center">
            @auth
                <li>
                    <a href="" class="p-3">{{ auth()->user()->name }} </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post" type="submit" class="inline px-3">
                        @csrf
                        <button>Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('login')}}" class="p-3">Login</a>
                </li> 
            @endguest
        </ul>
    </nav>
    <div id="alert_node"></div>
    @yield('content')
</body>
</html>