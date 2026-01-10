@extends('layouts.dashboard')

@push('head')
  <title>{{ $seo['title'] }}</title>

  <meta name="description" content="{{ $seo['description'] }}">

  {{-- Open Graph --}}
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $seo['title'] }}">
  <meta property="og:description" content="{{ $seo['description'] }}">
  <meta property="og:image" content="{{ $seo['image'] }}">
  <meta property="og:url" content="{{ $seo['url'] }}">

  {{-- Twitter --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $seo['title'] }}">
  <meta name="twitter:description" content="{{ $seo['description'] }}">
  <meta name="twitter:image" content="{{ $seo['image'] }}">
@endpush

@section('content')
  <x-dashboard.sidebar :categories="$categories" :stacks="$stacks" />
  <x-dashboard.topbar />

  {{-- <main class="pt-20 lg:pl-64 h-screen overflow-y-auto pb-10"> --}}
    <main class="pt-20 lg:pl-64 h-screen overflow-y-auto overflow-x-hidden pb-10">
    <div class="px-4 lg:px-10">

      {{-- THUMBNAIL --}}
      <div class="rounded-2xl h-72 mb-10 overflow-hidden">
        <img
          src="{{ $project->thumbnail }}"
          alt="{{ $project->title }}"
          class="w-full h-full object-cover"
        />
      </div>

      {{-- TITLE + ACTION --}}
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
        <div>
          <h1 class="text-3xl font-bold mb-2">
            {{ $project->title }}
          </h1>

          @if ($project->overview)
            <p class="text-gray-400 max-w-2xl">
              {{ $project->overview }}
            </p>
          @endif
        </div>

        <div class="flex gap-4">
          @if ($project->github_url)
            <a
              href="{{ $project->github_url }}"
              target="_blank"
              class="px-6 py-3 bg-gray-700 rounded-lg font-semibold"
            >
              GitHub
            </a>
          @endif

          @if ($project->project_url)
            <a
              href="{{ $project->project_url }}"
              target="_blank"
              class="px-6 py-3 bg-indigo-600 rounded-lg font-semibold"
            >
              Live Demo
            </a>
          @endif
        </div>
      </div>

      {{-- META --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-[#25243a] rounded-2xl p-6">
          <p class="text-xs text-gray-400 mb-2">CATEGORY</p>
          <p class="font-semibold">
            {{ $project->category?->name }}
          </p>
        </div>

        <div class="bg-[#25243a] rounded-2xl p-6 md:col-span-2">
          <p class="text-xs text-gray-400 mb-4">TECH STACK</p>

          <div class="flex gap-4 flex-wrap">
            @foreach ($project->stacks as $stack)
              <div
                class="w-16 h-16 bg-[#1c1b2d] rounded-xl flex items-center justify-center text-xs"
              >
                {{ $stack->name }}
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- OVERVIEW & FEATURES --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-16">

        {{-- OVERVIEW --}}
        <div class="bg-[#25243a] rounded-2xl p-6">
          <h2 class="text-xl font-bold mb-4">Overview</h2>

          <p class="text-gray-300 leading-relaxed">
            {{ $project->overview }}
          </p>
        </div>

        {{-- FEATURES --}}
        @if (!empty($project->features))
          <div class="bg-[#25243a] rounded-2xl p-6">
            <h2 class="text-xl font-bold mb-4">Features</h2>

            <ul class="space-y-3 list-disc list-inside text-gray-300">
              @foreach ($project->features as $feature)
                <li>
                  {{ is_array($feature) ? $feature['text'] : $feature }}
                </li>
              @endforeach
            </ul>
          </div>
        @endif

        <x-project.gallery :photos="$project->photos" />

      </div> {{-- END GRID --}}

      {{-- SIMILAR PROJECTS --}}
      @if ($similarProjects->count())
        <section class="mt-20">
          <h2 class="text-xl font-bold mb-6">
            Similar Projects
          </h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($similarProjects as $similar)
              <x-project.similar-card :project="$similar" />
            @endforeach
          </div>
        </section>
      @endif

    </div>
  </main>
@endsection
