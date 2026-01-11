<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-red-300">Danger Zone</h2>
        <p class="text-sm text-red-400/80 mt-1">
            Deleting your account is permanent and cannot be undone.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Delete Account
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-white">
                Confirm Account Deletion
            </h2>

            <p class="mt-2 text-sm text-gray-400">
                This action is irreversible. Enter your password to confirm.
            </p>

            <div class="mt-4">
                <input
                    name="password"
                    type="password"
                    placeholder="Password"
                    class="w-full h-11 rounded-lg bg-[#2a2940] border border-white/10 px-3 text-sm focus:outline-none"
                >

                @error('password', 'userDeletion')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-danger-button>
                    Delete Account
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
