<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Dashboard – {{ config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('head')
</head>

<body class="bg-[#1c1b2d] text-white overflow-hidden">
  @yield('content')

</body>
</html>
