@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight">My Projects</h1>
            <p class="text-sm text-gray-400 mt-1">
                Manage and curate your showcase portfolio.
            </p>
        </div>

        <a href="{{ route('workspace.projects.create') }}"
           class="inline-flex items-center h-11 px-5 rounded-xl bg-indigo-500 hover:bg-indigo-400 text-sm font-medium text-white transition">
            Create Project
        </a>
    </div>

    @if ($projects->isEmpty())
        <div class="border border-white/10 rounded-2xl p-10 text-center text-gray-400 bg-white/5">
            You haven't created any projects yet.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div class="group bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:border-white/20 transition">
                    <div class="relative">
                        <img
                            src="{{ $project->thumbnail }}"
                            alt="{{ $project->title }}"
                            class="w-full h-40 object-cover"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition"></div>
                    </div>

                    <div class="p-5 space-y-2">
                        <h3 class="font-medium text-lg">
                            {{ $project->title }}
                        </h3>

                        @if ($project->categories->isNotEmpty())
                            <p class="text-xs text-gray-400">
                                {{ $project->categories->pluck('name')->join(', ') }}
                            </p>
                        @endif

                        <div class="pt-3 flex items-center gap-4 text-xs">
                            <a href="{{ route('workspace.projects.edit', $project->id) }}"
                               class="text-indigo-400 hover:text-indigo-300 transition">
                                Edit
                            </a>

                            <a href="{{ route('workspace.projects.photos.index', $project->id) }}"
                               class="text-emerald-400 hover:text-emerald-300 transition">
                                Photos
                            </a>

                            <form action="{{ route('workspace.projects.destroy', $project->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this project?')">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-400 hover:text-red-300 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-8">
            {{ $projects->links() }}
        </div>
    @endif

</div>
@endsection
