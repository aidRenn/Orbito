<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 h-16 bg-[#141428] border-b border-white/10 z-50">
    <div class="max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-full">

            {{-- Left --}}
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}"
                   class="text-sm font-semibold tracking-wide text-white hover:text-indigo-400 transition">
                    PROJECT<span class="text-indigo-400">SHOW</span>
                </a>

                <div class="hidden sm:flex items-center gap-4 text-sm">
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition">
                        Showcase
                    </a>

                    @auth
                        <a href="{{ route('workspace.projects.index') }}"
                           class="px-3 py-2 rounded-lg {{ request()->routeIs('workspace.*') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition">
                            Workspace
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Right --}}
            <div class="hidden sm:flex items-center gap-3">
                @auth
                    <div class="relative" x-data="{ openUser: false }">
                        <button @click="openUser = !openUser"
                                class="flex items-center gap-2 h-9 px-3 rounded-lg bg-white/5 hover:bg-white/10 text-sm text-gray-200 transition">
                            <span class="truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openUser" @click.outside="openUser = false"
                             class="absolute right-0 mt-2 w-48 bg-[#1b1b33] border border-white/10 rounded-xl overflow-hidden shadow-xl">
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/10">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-white/10">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- Mobile --}}
            <div class="sm:hidden">
                <button @click="open = !open"
                        class="w-9 h-9 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center">
                    <svg class="h-5 w-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}"
                              class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}"
                              class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" class="sm:hidden border-t border-white/10 bg-[#141428]">
        <div class="px-4 py-3 space-y-1 text-sm">
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded-lg text-gray-300 hover:bg-white/10">
                Showcase
            </a>

            @auth
                <a href="{{ route('workspace.projects.index') }}"
                   class="block px-3 py-2 rounded-lg text-gray-300 hover:bg-white/10">
                    Workspace
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="block px-3 py-2 rounded-lg text-gray-300 hover:bg-white/10">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-3 py-2 rounded-lg text-red-400 hover:bg-white/10">
                        Log Out
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
