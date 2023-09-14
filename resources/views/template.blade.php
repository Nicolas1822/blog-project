<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Creative Code</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div class="container px-4 mx-auto">
    <header class="flex justify-between items-center py-4">
      <div class="flex items-center flex-grow gap-4">
        <a href="{{ route('home') }}">
          <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12">
        </a>
        <form action="{{ route('home') }}" method="GET" class="flex-grow">
          <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="border border-gray-200 rounded py-2 px-4 w-1/2">
        </form>
      </div>
      @auth
        <a href="{{ route('posts.index') }}">Dashboard</a>
        @else
        <a style="padding-right: 10px" href="{{ route('register') }}">Register</a>
        <a href="{{ route('login') }}">Login</a>
      @endauth
    </header>
    <div class="opacity-60 h-px mb-8" style="
    background: linear-gradient(to right,
				rgba(200, 200, 200, 0) 0%,
				rgba(200, 200, 200, 1) 30%,
				rgba(200, 200, 200, 1) 70%,
				rgba(200, 200, 200, 0) 100%
			);
    ">
    </div>
    @yield('content')
    <p class="py-1">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 mx-auto">
    </p>
  </div>
</body>
</html>
