@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-10">

    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight">Gallery</h1>
            <p class="text-sm text-gray-400 mt-1">
                {{ $project->title }} — manage visual assets for this project.
            </p>
        </div>

        <a href="{{ route('workspace.projects.edit', $project->id) }}"
           class="inline-flex items-center h-10 px-4 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-sm text-gray-200 transition">
            Back to Project
        </a>
    </div>

    {{-- Upload Panel --}}
    <form method="POST"
          action="{{ route('workspace.projects.photos.store', $project->id) }}"
          enctype="multipart/form-data"
          class="bg-white/5 border border-white/10 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4">
        @csrf

        <div class="flex-1">
            <label class="block text-xs uppercase tracking-wide text-gray-400 mb-1">
                Upload New Photo
            </label>
            <input type="file" name="photo" required
                   class="block w-full text-sm text-gray-400
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0
                          file:bg-indigo-500 file:text-white
                          hover:file:bg-indigo-400">
        </div>

        <button
            class="inline-flex items-center h-11 px-6 rounded-xl
                   bg-indigo-500 hover:bg-indigo-400
                   text-sm font-medium text-white
                   transition">
            Upload
        </button>
    </form>

    {{-- Grid --}}
    @if ($project->photos->isEmpty())
        <div class="border border-white/10 rounded-2xl p-10 text-center text-gray-400 bg-white/5">
            No photos yet. Upload your first image to start building the gallery.
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($project->photos as $photo)
                <div class="group relative rounded-2xl overflow-hidden border border-white/10 bg-white/5">
                    <img src="{{ $photo->photo }}"
                         class="w-full h-40 object-cover">

                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition"></div>

                    <form method="POST"
                          action="{{ route('workspace.projects.photos.destroy', [$project->id, $photo->id]) }}"
                          class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition"
                          onsubmit="return confirm('Delete this photo?')">
                        @csrf
                        @method('DELETE')

                        <button
                            class="h-8 px-3 rounded-lg
                                   bg-red-500/90 hover:bg-red-500
                                   text-xs font-medium text-white
                                   backdrop-blur transition">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
