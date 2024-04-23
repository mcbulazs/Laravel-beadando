<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <header class="sticky top-0 z-40 bg-gray-800 text-white p-5">
        <div class="mx-auto">
            <div class="flex justify-between items-center">
                <div class="w-1/3 text-start">
                </div>
                <div class="w-1/3 text-center">
                    <a class="text-3xl font-semibold">{{ $title }}</a>
                </div>
                <div class="w-1/3 text-end">
                    @auth
                    <a href="{{url('characters')}}" class="text-sky-400">{{ Auth::user()->name }}</a>
                    <form action="{{ route('logout') }}" method="post" class="inline">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    @endauth
                    @guest
                    <a href="{{ route('login') }}" class="text-white">Login</a>
                    <a href="{{ route('register') }}" class="text-white">Register</a>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    {{ $slot }}

    <footer class="bg-gray-800 text-white py-5 px-5 text-center absolute bottom-0 left-0 w-full">
        <div class="mx-auto">
            <p>&copy;All rights reserved</p>
        </div>
    </footer>
</body>

</html>
</div>
</div>
