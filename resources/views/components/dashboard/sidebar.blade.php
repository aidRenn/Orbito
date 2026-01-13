@php
  use Illuminate\Support\Arr;

  $current = request()->query();
  $activeCategories = collect(request('categories', []));
  $activeStacks = collect(request('stacks', []));
@endphp

<aside
  id="mobile-sidebar"
  class="fixed top-0 left-0 h-screen w-64 bg-[#171625] p-6 flex flex-col z-50
         -translate-x-full lg:translate-x-0
         transition-transform duration-300"
>

  {{-- LOGO --}}
  <a href="/"
     class="block text-3xl font-extrabold mb-5 tracking-wide
            hover:text-indigo-400 transition-all duration-300 hover:scale-105">
    Buildra
  </a>

  {{-- DIVIDER --}}
  <div class="w-full h-px bg-white/20 mb-6"></div>

  {{-- CATEGORY --}}
  <div class="mb-8">
    <p class="text-xs text-gray-400 mb-3 tracking-widest">
      CATEGORY
    </p>

    <div class="flex flex-col gap-2 text-sm">

      {{-- ALL --}}
      <a
        href="{{ route('dashboard', Arr::except($current, 'categories')) }}"
        class="group px-3 py-2 rounded-lg border transition-all duration-300
          hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-500/20
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
          href="{{ route('dashboard', array_merge($current, ['categories' => $nextCategories->all()])) }}"
          class="group px-3 py-2 rounded-lg border transition-all duration-300
            hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-500/20
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
    <p class="text-xs text-gray-400 mb-3 tracking-widest">
      STACK
    </p>

    <div class="flex flex-col gap-2 text-sm">
      @foreach ($stacks as $stack)
        @php
          $nextStacks = $activeStacks->contains($stack->slug)
            ? $activeStacks->reject(fn ($s) => $s === $stack->slug)->values()
            : $activeStacks->merge([$stack->slug])->unique()->values();
        @endphp

        <a
          href="{{ route('dashboard', array_merge($current, ['stacks' => $nextStacks->all()])) }}"
          class="group flex items-center gap-2 px-3 py-2 rounded-lg border transition-all duration-300
            hover:-translate-y-0.5 hover:shadow-lg hover:shadow-emerald-500/20
            {{ $activeStacks->contains($stack->slug)
              ? 'bg-emerald-500 border-emerald-500 text-white font-semibold'
              : 'bg-emerald-600/20 border-emerald-500 text-white font-semibold' }}"
        >
          @if ($stack->icon)
            <img src="{{ $stack->icon }}"
                 class="w-4 h-4 object-contain opacity-80 group-hover:scale-110 transition" />
          @endif

          {{ $stack->name }}
        </a>
      @endforeach
    </div>
  </div>

</aside>
