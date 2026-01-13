<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('iconweb.png') }}">
    <title>@yield('title', 'Landing Page')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@include('partials.navbar')

@yield('content')

@include('partials.footer')

<script>
  function closeContactModal() {
    const modal = document.getElementById('contact-modal');
    if (modal) {
      modal.classList.add('opacity-0');
      setTimeout(() => modal.remove(), 200);
    }
  }
</script>


</body>
</html>
