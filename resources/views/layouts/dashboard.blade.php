<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Dashboard – {{ config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('head')
</head>

{{-- <body class="bg-[#1c1b2d] text-white overflow-hidden"> --}}
<body class="bg-[#1c1b2d] text-white overflow-x-hidden">
  @yield('content')

  @guest
    <!-- Auth Confirmation Modal -->
    <div id="auth-modal" class="fixed inset-0 z-[999] hidden items-center justify-center">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <div class="relative w-full max-w-md mx-4 rounded-2xl bg-[#1f1e33] border border-white/10 shadow-2xl p-6 text-center">
            <h3 class="text-xl font-semibold mb-2">Authentication Required</h3>
            <p class="text-sm text-gray-400 mb-6">
                This action is available for registered users only.
                Sign in or create an account to continue.
            </p>

            <div class="flex gap-3">
                <button
                    id="auth-cancel"
                    class="flex-1 h-10 rounded-lg bg-[#2a2940] hover:bg-[#34335a] transition">
                    Cancel
                </button>

                <a
                    id="auth-continue"
                    href="{{ route('auth.page') }}"
                    class="flex-1 h-10 rounded-lg bg-indigo-600 hover:bg-indigo-500 transition flex items-center justify-center">
                    Continue
                </a>
            </div>
        </div>
    </div>


    <script>
      // =========================
      // AUTH MODAL
      // =========================
      const modal = document.getElementById('auth-modal');
      const cancelBtn = document.getElementById('auth-cancel');
      const continueLink = document.getElementById('auth-continue');

      document.querySelectorAll('.open-auth-modal').forEach(btn => {
          btn.addEventListener('click', () => {
              const intent = btn.dataset.intent || '';
              continueLink.href = `{{ route('auth.page') }}?intent=${intent}`;
              modal.classList.remove('hidden');
              modal.classList.add('flex');
          });
      });

      cancelBtn?.addEventListener('click', () => {
          modal.classList.add('hidden');
          modal.classList.remove('flex');
      });
    </script>
  @endguest

  <script>
    // =========================
    // MOBILE SIDEBAR (BURGER)
    // =========================
    const burger = document.getElementById('burger-toggle');
    const sidebar = document.getElementById('mobile-sidebar');

    if (burger && sidebar) {
        burger.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        document.addEventListener('click', (e) => {
            if (
                !sidebar.classList.contains('-translate-x-full') &&
                !sidebar.contains(e.target) &&
                !burger.contains(e.target)
            ) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    }
  </script>

</body>
</html>










{{-- <!DOCTYPE html>
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
</html> --}}
