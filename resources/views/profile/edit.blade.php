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

        <div class="bg-red-950/40 backdrop-blur border border-red-500/20 rounded-2xl p-6">
            @include('profile.partials.delete-user-form', ['user' => auth()->user()])
        </div>

    </div>
</div>
@endsection
