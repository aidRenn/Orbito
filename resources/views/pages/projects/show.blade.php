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
    {{-- <main class="pt-20 lg:pl-64 h-screen overflow-y-auto overflow-x-hidden pb-10"> --}}
<main class="pt-20 lg:pl-64 min-h-screen overflow-y-auto overflow-x-hidden pb-10 w-full max-w-full">
  <div class="px-4 lg:px-10 min-w-0">


      {{-- THUMBNAIL --}}
      <div class="relative rounded-3xl mb-12 overflow-hidden bg-[#25243a]">
        <div class="aspect-[16/7] w-full">
          <img
            src="{{ $project->thumbnail }}"
            alt="{{ $project->title }}"
            class="w-full h-full object-cover object-top"
          />
        </div>

        {{-- Gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#1c1b2d]/80 via-transparent to-transparent"></div>
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

        <div class="flex flex-wrap gap-3">
          @if ($project->github_url)
            <a
              href="{{ $project->github_url }}"
              target="_blank"
              class="flex items-center gap-2 px-5 py-3 bg-[#25243a] hover:bg-[#2f2e4a] rounded-xl font-semibold transition"
            >
              <img
                src="{{ asset('images/github.png') }}"
                class="w-5 h-5"
                alt="GitHub"
              />
              GitHub
            </a>
          @endif

          @if ($project->project_url)
            <a
              href="{{ $project->project_url }}"
              target="_blank"
              class="flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-500 rounded-xl font-semibold transition"
            >
              Live Demo
            </a>
          @endif
        </div>

      </div>

      {{-- OWNER --}}
<div class="mb-12">
  <div class="flex items-center gap-4 p-5 rounded-2xl bg-[#25243a] border border-white/5 max-w-xl">
    
    <div class="w-12 h-12 rounded-full overflow-hidden bg-[#1c1b2d] flex items-center justify-center">
      @if ($project->user->avatar ?? false)
        <img
          src="{{ $project->user->avatar }}"
          alt="{{ $project->user->name }}"
          class="w-full h-full object-cover"
        />
      @else
        <x-icones.person class="w-6 h-6 text-gray-400" />
      @endif
    </div>

    <div class="flex-1 min-w-0">
      <p class="text-xs uppercase tracking-wider text-gray-400 mb-1">
        Created by
      </p>

      <p class="font-semibold leading-tight truncate">
        {{ $project->user->name }}
      </p>

      @if (!empty($project->user->bio))
        <p class="text-sm text-gray-400 leading-snug line-clamp-2">
          {{ $project->user->bio }}
        </p>
      @endif
    </div>

  </div>
</div>


      {{-- META --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-[#25243a] rounded-2xl p-6">
          <p class="text-xs uppercase tracking-wider text-gray-400 mb-3">Category</p>

          <div class="flex flex-wrap gap-2">
            @foreach ($project->categories as $cat)
              <span class="px-3 py-1.5 text-xs rounded-full
                          bg-indigo-500/10 text-indigo-300
                          border border-indigo-500/20">
                {{ $cat->name }}
              </span>
            @endforeach
          </div>
        </div>


        <div class="bg-[#25243a] rounded-2xl p-6 md:col-span-2">
          <p class="text-xs uppercase tracking-wider text-gray-400 mb-4">Tech Stack</p>

          <div class="flex flex-wrap gap-3">
            @foreach ($project->stacks as $stack)
              <div
                class="flex items-center gap-2 px-3 py-2
                      bg-[#1c1b2d] rounded-xl
                      border border-white/5
                      text-xs text-gray-200"
              >
                @if ($stack->icon)
                  <img
                    src="{{ $stack->icon }}"
                    class="w-4 h-4 object-contain opacity-80"
                    alt="{{ $stack->name }}"
                  />
                @endif

                <span>{{ $stack->name }}</span>
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

<div class="grid w-full min-w-0 max-w-full overflow-hidden
            gap-3 sm:gap-4 lg:gap-5
            [grid-template-columns:repeat(auto-fit,minmax(220px,1fr))]">


              @foreach ($similarProjects as $similar)
                  <x-project.similar-card :project="$similar" />
              @endforeach
          </div>
        </section>
      @endif


    </div>
  </main>
@endsection
