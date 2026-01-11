<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium">Security</h2>
        <p class="text-sm text-gray-400 mt-1">
            Change your password to keep your account secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-sm">
        @csrf
        @method('put')

        <div>
            <label class="block text-sm text-gray-300 mb-1">Current Password</label>
            <input
                type="password"
                name="current_password"
                class="w-full h-11 rounded-lg bg-[#2a2940] border border-white/10 px-3 text-sm focus:outline-none"
            >
            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm text-gray-300 mb-1">New Password</label>
            <input
                type="password"
                name="password"
                class="w-full h-11 rounded-lg bg-[#2a2940] border border-white/10 px-3 text-sm focus:outline-none"
            >
            @error('password', 'updatePassword')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm text-gray-300 mb-1">Confirm Password</label>
            <input
                type="password"
                name="password_confirmation"
                class="w-full h-11 rounded-lg bg-[#2a2940] border border-white/10 px-3 text-sm focus:outline-none"
            >
        </div>

        <div class="flex items-center gap-4">
            <button class="h-10 px-5 rounded-lg bg-indigo-600 hover:bg-indigo-500 transition">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-sm text-green-400">Updated.</span>
            @endif
        </div>
    </form>
</section>
