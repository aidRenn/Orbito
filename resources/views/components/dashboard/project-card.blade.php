<div class="relative w-full sm:max-w-[20rem] bg-[#0f1322] rounded-3xl overflow-hidden shadow-xl group mx-auto">

  {{-- Placeholder Action --}}
@if ($project->github_url)
  <div class="absolute top-3 right-3 z-10">
    <a
      href="{{ $project->github_url }}"
      target="_blank"
      class="w-11 h-11 rounded-full bg-white/95 hover:bg-white transition flex items-center justify-center shadow-lg"
      title="View on GitHub"
    >
      <img
        src="{{ asset('images/github.png') }}"
        alt="GitHub"
        class="w-6 h-6 object-contain"
      />
    </a>
  </div>
@endif


  {{-- Thumbnail --}}
  <a href="{{ route('projects.show', $project->slug) }}" class="block relative h-44 sm:h-48 w-full overflow-hidden">
    <img
      src="{{ $project->thumbnail }}"
      alt="{{ $project->title }}"
      class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
    />
  </a>

  {{-- Body --}}
  <div class="relative p-4 sm:p-5 pt-9 sm:pt-10 space-y-3">

    {{-- Owner Avatar (overlap) --}}
<div class="absolute -top-7 sm:-top-8 right-4 sm:right-5">
  <div class="relative">

    {{-- Avatar Wrapper --}}
    <div class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-full border-4 border-[#0f1322] overflow-hidden bg-black/30 flex items-center justify-center">
      @if ($project->user->avatar)
        <img
          src="{{ $project->user->avatar }}"
          alt="{{ $project->user->name }}"
          class="w-full h-full object-cover"
        />
      @else
        <x-icones.person class="w-7 h-7 sm:w-8 sm:h-8 text-gray-400" />
      @endif
    </div>

    {{-- Badge (di luar avatar, tidak ter-clip) --}}
    <div class="absolute -bottom-1 -right-1 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-[#1c1b2d] border-2 border-[#0f1322] flex items-center justify-center">
      <x-icones.check class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-blue-500" />
    </div>

  </div>
</div>



    {{-- Title --}}
    <h4 class="text-white text-sm sm:text-base font-semibold leading-snug">
      <a href="{{ route('projects.show', $project->slug) }}">
        {{ $project->title }}
      </a>
    </h4>

    {{-- Category (Meta) --}}
    @if ($project->categories->isNotEmpty())
      <p class="text-[11px] sm:text-xs text-gray-400">
        {{ $project->categories->pluck('name')->join(' • ') }}
      </p>
    @endif

    {{-- Excerpt --}}
    <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
      {{ Str::limit($project->excerpt, 110) }}
    </p>

    {{-- Stack --}}
    <div class="flex flex-wrap gap-2 pt-1">
      @foreach ($project->stacks as $stack)
        <x-stack-badge :stack="$stack" />
      @endforeach
    </div>

    {{-- Footer --}}
    <div class="flex items-center gap-2 pt-3 border-t border-white/5 text-[11px] sm:text-xs text-gray-400">
      <span>by</span>
      <span class="text-gray-200">{{ $project->user->name }}</span>
    </div>

  </div>
</div>
