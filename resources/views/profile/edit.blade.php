@extends('layouts.dashboard')

@section('content')
<div class="h-screen overflow-y-auto px-6 py-10">
    <div class="max-w-6xl mx-auto space-y-8">

        <div>
            <h1 class="text-3xl font-semibold">Profile Management</h1>
            <p class="text-sm text-gray-400 mt-1">
                Manage your identity, security, and account preferences.
            </p>
        </div>

        <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-medium">Project Workspace</h2>
                <p class="text-sm text-gray-400 mt-1">
                    Manage, create, and organize your showcase projects.
                </p>
            </div>

            <a href="{{ route('workspace.projects.index') }}"
            class="inline-flex items-center gap-2 h-11 px-5 rounded-xl bg-indigo-500 hover:bg-indigo-400 text-sm font-medium text-white transition">
                <x-icones.folder class="w-4 h-4" />
                Manage Projects
            </a>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6">
                @include('profile.partials.update-profile-information-form', ['user' => auth()->user()])
            </div>

            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6">
                @include('profile.partials.update-password-form', ['user' => auth()->user()])
            </div>
        </div>

        <div class="flex items-center justify-between bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-4">
    <div class="text-sm text-gray-400">
        You are logged in as <span class="text-gray-200">{{ auth()->user()->email }}</span>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
            type="submit"
            class="group inline-flex items-center gap-2 h-10 px-4 rounded-xl
                   bg-red-950/40 border border-red-500/30
                   text-red-300 hover:text-red-200
                   hover:bg-red-900/50 hover:border-red-400/50
                   transition"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
            </svg>
            Sign Out
        </button>
    </form>
</div>


        <div class="bg-red-950/40 backdrop-blur border border-red-500/20 rounded-2xl p-6">
            @include('profile.partials.delete-user-form', ['user' => auth()->user()])
        </div>

    </div>
</div>
@endsection
