<x-guest-layout>
    <main class="relative z-10 min-h-screen flex items-center justify-center px-4 pt-24">
        <div
    class="relative w-full max-w-7xl min-h-[720px] bg-cover bg-center rounded-2xl overflow-hidden flex"
    style="background-image: url('{{ asset('images/auth-bg.jpg') }}')"
>


            {{-- Left Content --}}
            <section class="w-[55%] p-16 hidden lg:flex flex-col justify-between">
                <h2 class="text-3xl font-semibold">Showcase</h2>

                <div>
                    <h2 class="text-5xl leading-tight">
                        Welcome<br>
                        <span class="text-2xl">Back to your space.</span>
                    </h2>
                    <p class="mt-4 max-w-md text-gray-200">
                        Manage and present your work beautifully.
                    </p>
                </div>
            </section>

            {{-- Form --}}
            <section class="relative w-full lg:w-[45%] flex items-center justify-center">
                <div class="absolute w-[85%] h-[85%] backdrop-blur-xl rounded-[48px] flex items-center justify-center">
                    <form method="POST" action="{{ route('login') }}" class="w-full px-12">
                        @csrf

                        <h2 class="text-3xl text-center mb-8">Sign In</h2>

                        <div class="relative border-b border-white mb-8">
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="w-full bg-transparent outline-none py-2"
                            />
                            <label class="absolute left-0 top-1/2 -translate-y-1/2 transition">Email</label>
                            @error('email')
                                <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative border-b border-white mb-6">
                            <input
                                type="password"
                                name="password"
                                required
                                class="w-full bg-transparent outline-none py-2"
                            />
                            <label class="absolute left-0 top-1/2 -translate-y-1/2 transition">Password</label>
                            @error('password')
                                <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between text-sm mb-6">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="remember" class="rounded">
                                Remember me
                            </label>

                            {{-- @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="underline">
                                    Forgot?
                                </a>
                            @endif --}}
                        </div>

                        <button class="w-full h-12 bg-pink-700 rounded">
                            Sign In
                        </button>

                        <p class="text-center text-sm mt-6">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="underline">Sign up</a>
                        </p>
                    </form>
                </div>
            </section>
        </div>
    </main>
</x-guest-layout>
