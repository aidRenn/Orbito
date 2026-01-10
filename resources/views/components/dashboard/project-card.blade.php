<div class="relative bg-[#25243a] rounded-2xl p-4 group">
  <div class="absolute top-4 right-4">
    <div class="w-9 h-9 rounded-full bg-black/40 hover:bg-black/70 transition"></div>
  </div>

  <a href="{{ route('projects.show', $project->slug) }}" class="block overflow-hidden rounded-xl mb-4">
    <img
      src="{{ $project->thumbnail }}"
      alt="{{ $project->title }}"
      class="h-40 w-full object-cover transition-transform duration-300 group-hover:scale-105"
    />
  </a>

  <h4 class="font-semibold text-lg mb-1 flex items-center gap-2">
    <x-heroicon-o-cube class="w-4 h-4 text-indigo-400" />
    <a href="{{ route('projects.show', $project->slug) }}">
      {{ $project->title }}
    </a>
  </h4>

  <p class="text-sm text-gray-400 mb-4">
    {{ Str::limit($project->excerpt, 120) }}
  </p>

  <div class="flex flex-wrap gap-2 mb-3">
    @foreach ($project->stacks as $stack)
      <x-stack-badge :stack="$stack" />
    @endforeach
  </div>

  @if ($project->category)
    <p class="text-xs text-gray-500 flex items-center gap-1">
      <x-heroicon-o-folder class="w-3 h-3" />
      {{ $project->category->name }}
    </p>
  @endif
</div>
