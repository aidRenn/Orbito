@extends('layouts.dashboard')

@section('content')
  <x-dashboard.sidebar :categories="$categories" :stacks="$stacks" />
  <x-dashboard.topbar />

<main class="pt-20 lg:pl-64 h-screen overflow-y-auto pb-10">
  <div class="px-4 lg:px-10">


    <h2 class="text-3xl font-bold mb-6">Discover</h2>

      <x-dashboard.featured :items="$featuredProjects" />


    <h2 class="text-2xl font-bold mb-6">Projects</h2>

  {{-- =========================== --}}
        @php
          $activeCategories = collect(request('categories', []));
          $activeStacks = collect(request('stacks', []));
        @endphp

        @if ($activeCategories->isNotEmpty() || $activeStacks->isNotEmpty())
          <div class="flex flex-wrap items-center gap-2 mb-6">
            <span class="text-sm text-gray-400">Active filters:</span>

            @foreach ($activeCategories as $cat)
              <span class="px-3 py-1 text-xs rounded-full bg-indigo-600/20 text-indigo-300">
                {{ $cat }}
              </span>
            @endforeach

            @foreach ($activeStacks as $stk)
              <span class="px-3 py-1 text-xs rounded-full bg-emerald-600/20 text-emerald-300">
                {{ $stk }}
              </span>
            @endforeach

            <a
              href="{{ route('dashboard', ['search' => request('search')]) }}"
              class="ml-2 text-xs text-red-400 hover:text-red-300 underline"
            >
              Clear all
            </a>
          </div>
        @endif
  {{-- =========================== --}}

{{-- <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">
  @foreach ($projects as $project)
    <x-dashboard.project-card :project="$project" />
  @endforeach
</div> --}}


<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4
            gap-3 sm:gap-4 lg:gap-5">
    @foreach ($projects as $project)
        <x-dashboard.project-card :project="$project" />
    @endforeach
</div>


{{-- Pagination --}}
<div class="mt-12 flex justify-center">
    {{ $projects->onEachSide(1)->links() }}
</div>



    </div>
  </main>
@endsection
