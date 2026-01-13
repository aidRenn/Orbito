<header
  class="fixed top-0 left-0 lg:left-64 right-0 h-16 bg-[#1f1e33]
         flex items-center px-4 lg:px-8 z-50"
>

  {{-- LEFT --}}
  <div class="flex items-center gap-3 flex-1">

    {{-- Burger (mobile only) --}}
    <button
      id="burger-toggle"
      class="lg:hidden w-10 h-10 bg-[#2a2940] rounded-lg
             flex items-center justify-center
             hover:bg-[#34335a] transition"
      aria-label="Toggle sidebar"
    >
      <x-icones.burger class="w-5 h-5 text-gray-300" />
    </button>

    {{-- Search --}}
    <form method="GET" class="w-full max-w-xl">
      <input
        name="search"
        value="{{ request('search') }}"
        placeholder="Search projects..."
        class="w-full h-10 bg-[#2a2940] rounded-lg px-4 text-sm focus:outline-none"
      />
    </form>

  </div>

  {{-- RIGHT --}}
  <div class="flex items-center gap-3 ml-6">

    {{-- Plus --}}
    @auth
      <a href="{{ route('workspace.projects.create') }}"
         class="hidden sm:flex w-9 h-9 bg-[#2a2940] rounded-full
                items-center justify-center
                hover:bg-[#34335a] transition">
        <x-icones.plus-circle class="w-5 h-5 text-gray-300" />
      </a>
    @else
      <button
        data-intent="create"
        class="open-auth-modal hidden sm:flex w-9 h-9 bg-[#2a2940] rounded-full
               items-center justify-center
               hover:bg-[#34335a] transition"
        title="Login required">
        <x-icones.plus-circle class="w-5 h-5 text-gray-400" />
      </button>
    @endauth

    {{-- Bell --}}
    @auth
      <button
        class="hidden sm:flex w-9 h-9 bg-[#2a2940] rounded-full
               items-center justify-center
               hover:bg-[#34335a] transition">
        <x-icones.bell class="w-5 h-5 text-gray-300" />
      </button>
    @else
      <div
        class="hidden sm:flex w-9 h-9 bg-[#2a2940] rounded-full
               items-center justify-center opacity-50 cursor-not-allowed"
        title="Login to enable notifications">
        <x-icones.bell class="w-5 h-5 text-gray-400" />
      </div>
    @endauth

    {{-- Profile --}}
    @auth
      <a href="{{ route('profile.edit') }}"
         class="w-9 h-9 bg-[#2a2940] rounded-full overflow-hidden
                flex items-center justify-center
                hover:bg-[#34335a] transition">

        @if(auth()->user()->avatar)
          <img
            src="{{ auth()->user()->avatar }}"
            alt="{{ auth()->user()->name }}"
            class="w-full h-full object-cover"
          >
        @else
          <x-icones.person class="w-5 h-5 text-gray-300" />
        @endif

      </a>
    @else
      <button
        data-intent="profile"
        class="open-auth-modal w-9 h-9 bg-[#2a2940] rounded-full
               flex items-center justify-center
               hover:bg-[#34335a] transition"
        title="Login required">
        <x-icones.person class="w-5 h-5 text-gray-400" />
      </button>
    @endauth

  </div>

</header>
