<header class="fixed top-0 left-0 lg:left-64 right-0 h-16 bg-[#1f1e33] flex items-center px-4 lg:px-8 z-50">
  <div class="lg:hidden w-10 h-10 bg-gray-600 rounded-lg mr-3"></div>

  <form method="GET" class="flex-1 max-w-xl">
    <input
      name="search"
      value="{{ request('search') }}"
      placeholder="Search projects..."
      class="w-full h-10 bg-[#2a2940] rounded-lg px-4 text-sm focus:outline-none"
    />
  </form>

  <div class="flex items-center gap-3 ml-auto">
    <div class="w-9 h-9 bg-gray-600 rounded-full"></div>
    <div class="hidden sm:block w-9 h-9 bg-gray-600 rounded-full"></div>
    <div class="hidden sm:block w-9 h-9 bg-gray-600 rounded-full"></div>
  </div>
</header>
