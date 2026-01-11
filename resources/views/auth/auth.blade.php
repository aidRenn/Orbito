<x-guest-layout>
    <!-- Background blur layer -->
    <div
        class="fixed inset-0 bg-cover bg-center blur-lg scale-110"
        style="background-image: url('{{ asset('images/auth-bg.jpg') }}')"
    ></div>

    <!-- Header / Navbar -->
    <header class="fixed top-0 left-0 w-full py-6 z-20 flex justify-center">
        <nav class="flex gap-8 text-sm md:text-base">
            <a href="{{ route('home') }}" class="relative after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white after:opacity-0 hover:after:opacity-100 after:transition">Home</a>
            <a href="#" class="hover:opacity-80">About</a>
            <a href="#" class="hover:opacity-80">Services</a>
            <a href="#" class="hover:opacity-80">Contact</a>
        </nav>
    </header>

    <!-- Main -->
    <main class="relative z-10 min-h-screen flex items-center justify-center px-4 pt-24">
        <div
            class="relative w-full max-w-7xl min-h-[720px] bg-cover bg-center rounded-2xl overflow-hidden flex flex-col lg:flex-row"
            style="background-image: url('{{ asset('images/auth-bg.jpg') }}')"
        >
            <!-- Left Content -->
            <section class="w-full lg:w-[55%] p-8 md:p-12 lg:p-16 flex flex-col justify-between">
                <h2 class="text-2xl md:text-3xl font-semibold">Showcase</h2>

                <div class="mt-6 lg:mt-0">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl leading-tight">
                        Welcome<br>
                        <span class="text-lg md:text-2xl">To your creative space.</span>
                    </h2>
                    <p class="mt-4 text-sm md:text-base max-w-md">
                        Build, manage, and present your work beautifully.
                    </p>
                </div>
            </section>

            <!-- Form Box -->
            <section class="logreg-box relative w-full lg:w-[45%] flex items-center justify-center overflow-hidden py-12">

                <!-- Login -->
                <div class="from-box login absolute w-[85%] h-[85%] backdrop-blur-xl rounded-[48px] flex items-center justify-center">
                    <form method="POST" action="{{ route('login') }}" class="w-full px-8 md:px-12">
                        @csrf
                        <h2 class="text-2xl md:text-3xl text-center mb-8">Sign In</h2>

                        <div class="input-box relative border-b border-white mb-8">
                            <input name="email" value="{{ old('email') }}" required class="w-full bg-transparent outline-none py-2" />
                            <label class="absolute left-0 top-1/2 -translate-y-1/2 transition">Email</label>
                            @error('email')
                                <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-box relative border-b border-white mb-6">
                            <input type="password" name="password" required class="w-full bg-transparent outline-none py-2" />
                            <label class="absolute left-0 top-1/2 -translate-y-1/2 transition">Password</label>
                            @error('password')
                                <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="w-full h-12 bg-pink-700 rounded">Sign In</button>

                        <p class="text-center text-sm mt-6">
                            Don't have an account?
                            <a href="#" class="register-link underline">Sign up</a>
                        </p>
                    </form>
                </div>

                <!-- Register -->
                <div class="from-box register absolute w-[85%] h-[85%] backdrop-blur-xl rounded-[48px] flex items-center justify-center">
                    <form method="POST" action="{{ route('register') }}" class="w-full px-8 md:px-12">
                        @csrf
                        <h2 class="text-2xl md:text-3xl text-center mb-8">Sign Up</h2>

                        <div class="input-box relative border-b border-white mb-6">
                            <input name="name" value="{{ old('name') }}" required class="w-full bg-transparent outline-none py-2" />
                            <label class="absolute left-0 top-1/2 -translate-y-1/2 transition">Name</label>
                            @error('name')
                                <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-box relative border-b border-white mb-6">
                            <input name="email" value="{{ old('email') }}" required class="w-full bg-transparent outline-none py-2" />
                            <label class="absolute left-0 top-1/2 -translate-y-1/2 transition">Email</label>
                            @error('email')
                                <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-box relative border-b border-white mb-6">
                            <input type="password" name="password" required class="w-full bg-transparent outline-none py-2" />
                            <label class="absolute left-0 top-1/2 -translate-y-1/2 transition">Password</label>
                        </div>

                        <div class="input-box relative border-b border-white mb-6">
                            <input type="password" name="password_confirmation" required class="w-full bg-transparent outline-none py-2" />
                            <label class="absolute left-0 top-1/2 -translate-y-1/2 transition">Confirm</label>
                        </div>

                        <button class="w-full h-12 bg-pink-700 rounded">Sign Up</button>

                        <p class="text-center text-sm mt-6">
                            Already have an account?
                            <a href="#" class="login-link underline">Sign in</a>
                        </p>
                    </form>
                </div>

            </section>
        </div>
    </main>

    <script>
        const logregBox = document.querySelector(".logreg-box");
        const loginLink = document.querySelector(".login-link");
        const registerLink = document.querySelector(".register-link");

        registerLink.addEventListener("click", e => {
            e.preventDefault();
            logregBox.classList.add("active");
        });

        loginLink.addEventListener("click", e => {
            e.preventDefault();
            logregBox.classList.remove("active");
        });
    </script>

    <style>
        .input-box input:focus ~ label,
        .input-box input:valid ~ label {
            top: -6px;
            font-size: 12px;
        }

        .logreg-box .from-box.login {
            transform: translateX(0);
            transition: transform .6s ease;
            transition-delay: .6s;
        }

        .logreg-box.active .from-box.login {
            transform: translateX(110%);
            transition-delay: 0s;
        }

        .logreg-box .from-box.register {
            transform: translateX(110%);
            transition: transform .6s ease;
        }

        .logreg-box.active .from-box.register {
            transform: translateX(0);
            transition-delay: .6s;
        }
    </style>
</x-guest-layout>
