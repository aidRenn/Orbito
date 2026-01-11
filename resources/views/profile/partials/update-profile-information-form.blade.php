<section class="space-y-5">
    <header class="space-y-1">
        <h2 class="text-lg font-medium">Profile Information</h2>
        <p class="text-xs text-gray-400">
            Update your personal details and avatar.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="space-y-4 max-w-sm"
        enctype="multipart/form-data"
    >
        @csrf
        @method('patch')

        {{-- Avatar --}}
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-2xl bg-black/30 border border-white/10 flex items-center justify-center overflow-hidden">
                @if ($user->avatar)
                    <img src="{{ $user->avatar }}" class="w-full h-full object-cover">
                @else
                    <x-icones.person class="w-8 h-8 text-gray-500" />
                @endif
            </div>

            <div class="space-y-1">
                <label class="block text-xs text-gray-300">Avatar</label>
                <input
                    type="file"
                    name="avatar"
                    accept="image/*"
                    class="text-xs text-gray-400"
                >
                @error('avatar')
                    <p class="text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="space-y-1">
            <label class="block text-xs text-gray-300">Name</label>
            <input
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                class="w-full h-11 rounded-xl bg-[#1e1d33] border border-white/10 px-3 text-sm
                       focus:outline-none focus:border-indigo-500/60 focus:ring-1 focus:ring-indigo-500/40 transition"
                required
            >
            @error('name')
                <p class="text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label class="block text-xs text-gray-300">Email</label>
            <input
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                class="w-full h-11 rounded-xl bg-[#1e1d33] border border-white/10 px-3 text-sm
                       focus:outline-none focus:border-indigo-500/60 focus:ring-1 focus:ring-indigo-500/40 transition"
                required
            >
            @error('email')
                <p class="text-xs text-red-400">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-[11px] text-yellow-400/90 mt-1">
                    Your email is unverified.
                    <button form="send-verification" class="underline">
                        Resend verification email
                    </button>
                </p>
            @endif
        </div>

        <div class="flex items-center gap-3 pt-1">
            <button
                class="h-10 px-5 rounded-xl bg-indigo-600 hover:bg-indigo-500
                       focus:outline-none focus:ring-2 focus:ring-indigo-500/40 transition">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-xs text-green-400">Saved.</span>
            @endif
        </div>
    </form>
</section>
