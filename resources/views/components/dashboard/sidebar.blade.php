@php
  use Illuminate\Support\Arr;

  $current = request()->query();
  $activeCategories = collect(request('categories', []));
  $activeStacks = collect(request('stacks', []));
@endphp

<aside class="hidden lg:flex fixed top-0 left-0 h-screen w-64 bg-[#171625] p-6 flex-col overflow-y-auto">
  <h1 class="text-xl font-bold mb-10 flex items-center gap-2">
    showcase
  </h1>

  {{-- CATEGORY --}}
  <div class="mb-10">
    <p class="text-xs text-gray-400 mb-4">CATEGORY</p>

      <div class="flex flex-col gap-2 text-sm">

        {{-- ALL --}}
        <a
          href="{{ route('projects.index', Arr::except($current, 'categories')) }}"
          class="px-3 py-2 rounded-lg border transition
            {{ $activeCategories->isEmpty()
              ? 'bg-indigo-500 border-indigo-500 text-white font-semibold'
              : 'bg-indigo-600/20 border-indigo-500 text-white font-semibold' }}"
        >
          All
        </a>

        @foreach ($categories as $category)
          @php
            $nextCategories = $activeCategories->contains($category->slug)
              ? $activeCategories->reject(fn ($c) => $c === $category->slug)->values()
              : $activeCategories->merge([$category->slug])->unique()->values();
          @endphp

          <a
            href="{{ route('projects.index', array_merge($current, ['categories' => $nextCategories->all()])) }}"
            class="px-3 py-2 rounded-lg border transition
              {{ $activeCategories->contains($category->slug)
                ? 'bg-indigo-500 border-indigo-500 text-white font-semibold'
                : 'bg-indigo-600/20 border-indigo-500 text-white font-semibold' }}"
          >
            {{ $category->name }}
          </a>
        @endforeach
      </div>
  </div>

  {{-- STACK --}}
  <div>
    <p class="text-xs text-gray-400 mb-4">STACK</p>

      <div class="flex flex-col gap-2 text-sm">
        @foreach ($stacks as $stack)
          @php
            $nextStacks = $activeStacks->contains($stack->slug)
              ? $activeStacks->reject(fn ($s) => $s === $stack->slug)->values()
              : $activeStacks->merge([$stack->slug])->unique()->values();
          @endphp

          <a
            href="{{ route('projects.index', array_merge($current, ['stacks' => $nextStacks->all()])) }}"
            class="flex items-center gap-2 px-3 py-2 rounded-lg border transition
              {{ $activeStacks->contains($stack->slug)
                ? 'bg-emerald-500 border-emerald-500 text-white font-semibold'
                : 'bg-emerald-600/20 border-emerald-500 text-white font-semibold' }}"
          >
            @if ($stack->icon)
              <img src="{{ $stack->icon }}" class="w-4 h-4 object-contain opacity-80" />
            @endif

            {{ $stack->name }}
          </a>
        @endforeach
      </div>
  </div>
</aside>
