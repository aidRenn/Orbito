@props(['project'])

<div class="relative bg-[#25243a] rounded-2xl p-4 group">
  <a href="{{ route('projects.show', $project->slug) }}" class="block overflow-hidden rounded-xl mb-4">
    <img
      src="{{ $project->thumbnail }}"
      alt="{{ $project->title }}"
      class="h-40 w-full object-cover transition-transform duration-300 group-hover:scale-105"
      loading="lazy"
    />
  </a>

  <h4 class="font-semibold text-sm mb-2">
    <a href="{{ route('projects.show', $project->slug) }}">
      {{ $project->title }}
    </a>
  </h4>

  <div class="flex flex-wrap gap-2 mb-2">
    @foreach ($project->stacks->take(3) as $stack)
      <span class="text-xs bg-[#1c1b2d] px-2 py-1 rounded">
        {{ $stack->name }}
      </span>
    @endforeach
  </div>

  @if ($project->category)
    <p class="text-xs text-gray-500">
      {{ $project->category->name }}
    </p>
  @endif
</div>
