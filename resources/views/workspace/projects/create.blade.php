@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">

    <div>
        <h1 class="text-3xl font-semibold tracking-tight">Create Project</h1>
        <p class="text-sm text-gray-400 mt-1">
            Add a new project to your showcase workspace.
        </p>
    </div>

    <form method="POST"
          action="{{ route('workspace.projects.store') }}"
          enctype="multipart/form-data"
          class="space-y-10">
        @csrf

        {{-- Core Info --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-5">
            <h2 class="text-lg font-medium">Core Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Title</label>
                    <input name="title" required
                           class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                </div>

                {{-- <div>
                    <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Slug</label>
                    <input name="slug" required
                           class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                </div> --}}
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Thumbnail</label>
                <input type="file" name="thumbnail" required
                       class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-500 file:text-white hover:file:bg-indigo-400">
            </div>
        </div>

        {{-- Taxonomy --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-6">
            <h2 class="text-lg font-medium">Classification</h2>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-3">Categories</p>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($categories as $cat)
                        <label class="group cursor-pointer">
                            <input type="checkbox" name="categories[]" value="{{ $cat->id }}" class="hidden peer">
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
                        <label class="group cursor-pointer">
                            <input type="checkbox" name="stacks[]" value="{{ $stack->id }}" class="hidden peer">
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
                          class="w-full px-4 py-3 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm"></textarea>
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Features</label>
                <textarea name="features" rows="4"
                          class="w-full px-4 py-3 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm"></textarea>
            </div>
        </div>

        {{-- Links & Status --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-5">
            <h2 class="text-lg font-medium">Links & Status</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Project URL</label>
                    <input name="project_url"
                           class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">GitHub URL</label>
                    <input name="github_url"
                           class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                </div>
            </div>

            <div class="max-w-xs">
                <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">Status</label>
                <select name="status"
                        class="w-full h-11 px-4 rounded-xl bg-[#1b1b33] border border-white/10 focus:border-indigo-400 focus:outline-none text-sm">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
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
                    class="inline-flex items-center h-12 px-8 rounded-xl
                        bg-indigo-500 hover:bg-indigo-400
                        text-sm font-semibold text-white
                        shadow-lg shadow-indigo-500/20
                        transition">
                    Create Project
                </button>
            </div>



    </form>
</div>
@endsection
