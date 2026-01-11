@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">

    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight">Edit Project</h1>
            <p class="text-sm text-gray-400 mt-1">
                Update and refine your project details.
            </p>
        </div>

        <a href="{{ route('workspace.projects.photos.index', $project->id) }}"
           class="inline-flex items-center h-10 px-4 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-sm text-gray-200 transition">
            Manage Photos
        </a>
    </div>

    <form method="POST"
          action="{{ route('workspace.projects.update', $project->id) }}"
          enctype="multipart/form-data"
          class="space-y-10">
        @csrf
        @method('PUT')

        {{-- Core Info --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-5">
            <h2 class="text-lg font-medium">Core Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Title</label>
                    <input type="text" name="title"
                           value="{{ old('title', $project->title) }}" required
                           class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Thumbnail</label>
                <input type="file" name="thumbnail"
                       class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-500 file:text-white hover:file:bg-indigo-400">
                <p class="text-xs text-gray-500 mt-1">
                    Leave empty to keep the current thumbnail.
                </p>
            </div>
        </div>

        {{-- Classification --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-6">
            <h2 class="text-lg font-medium">Classification</h2>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-3">Categories</p>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($categories as $cat)
                        <label class="cursor-pointer">
                            <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                   class="hidden peer"
                                   @checked($project->categories->contains($cat->id))>
                            <div class="px-3 py-2 rounded-xl border border-white/10 text-sm text-gray-300
                                        peer-checked:border-indigo-400 peer-checked:bg-indigo-500/10
                                        hover:bg-white/5 transition">
                                {{ $cat->name }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-3">Stacks</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    @foreach ($stacks as $stack)
                        <label class="cursor-pointer">
                            <input type="checkbox" name="stacks[]" value="{{ $stack->id }}"
                                   class="hidden peer"
                                   @checked($project->stacks->contains($stack->id))>
                            <div class="px-3 py-2 rounded-xl border border-white/10 text-sm text-gray-300
                                        peer-checked:border-emerald-400 peer-checked:bg-emerald-500/10
                                        hover:bg-white/5 transition">
                                {{ $stack->name }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-5">
            <h2 class="text-lg font-medium">Content</h2>

            <div>
                <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Overview</label>
                <textarea name="overview" rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">{{ old('overview', $project->overview) }}</textarea>
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Features</label>
                <textarea name="features" rows="5"
                          class="w-full px-4 py-3 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">{{ old(
                    'features',
                    is_array($project->features)
                        ? collect($project->features)->pluck('text')->implode("\n")
                        : ''
                ) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">
                    One feature per line. Each line becomes a bullet point.
                </p>
            </div>
        </div>

        {{-- Links & Status --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-5">
            <h2 class="text-lg font-medium">Links & Status</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Live URL</label>
                    <input name="project_url"
                           value="{{ old('project_url', $project->project_url) }}"
                           class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">GitHub URL</label>
                    <input name="github_url"
                           value="{{ old('github_url', $project->github_url) }}"
                           class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                </div>
            </div>

            <div class="max-w-xs">
                <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Status</label>
                <select name="status"
                        class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                    @foreach (['draft','published','archived'] as $st)
                        <option value="{{ $st }}" @selected($project->status === $st)>
                            {{ ucfirst($st) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Action --}}
        <div class="flex items-center justify-end gap-4 pt-4">
            <a href="{{ route('workspace.projects.index') }}"
               class="">
                Cancel
            </a>

            <button
                class="inline-flex items-center h-12 px-8 rounded-2xl
                       bg-indigo-500 hover:bg-indigo-400
                       text-sm font-semibold text-white
                       shadow-lg shadow-indigo-500/20
                       transition">
                Update Project
            </button>
        </div>

    </form>
</div>
@endsection
