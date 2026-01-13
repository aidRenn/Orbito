@props(['items'])

@if ($items->count() >= 1)
  <div
    x-data="featuredCarousel({{ $items->toJson() }})"
    x-init="start()"
    class="mb-14"
  >

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6">

  {{-- FEATURED MAIN --}}
<div
  x-show="visible"
  x-transition.opacity.duration.400ms
  @click="window.location = '/dashboard/' + currentMain?.slug"
  class="lg:col-span-2 rounded-2xl overflow-hidden
         bg-gradient-to-br from-indigo-500 to-purple-600
         grid grid-cols-1 lg:grid-cols-2
         cursor-pointer hover:brightness-110 transition"
>


  {{-- Image --}}
  <div class="relative aspect-[16/10] lg:aspect-auto">
    <img
      :src="currentMain?.thumbnail"
      class="absolute inset-0 w-full h-full object-cover"
    />
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
  </div>

  {{-- Content --}}
{{-- Content --}}
<div class="p-5 lg:p-8 flex flex-col justify-center gap-4 lg:gap-5">

  <h3
    class="text-xl lg:text-3xl font-bold leading-tight"
    x-text="currentMain?.title"
  ></h3>

  <p
    class="text-sm lg:text-base opacity-90 line-clamp-3 max-w-xl"
    x-text="currentMain?.overview"
  ></p>

  {{-- Categories --}}
  <div class="flex flex-wrap gap-2">
    <template x-for="cat in (currentMain?.categories || []).slice(0,2)" :key="cat.id">
      <span
        class="text-[11px] lg:text-xs
               px-3 py-1.5 rounded-full
               bg-white/15 border border-white/25"
        x-text="cat.name"
      ></span>
    </template>
  </div>

  {{-- Stacks --}}
  <div class="flex gap-3 flex-wrap">
    <template x-for="stack in (currentMain?.stacks || []).slice(0,4)" :key="stack.id">
      <span
        class="flex items-center gap-2
               text-xs lg:text-sm
               px-4 py-2 rounded-xl
               bg-white/25 border border-white/30"
      >
        <img
          :src="stack.icon"
          class="w-4 h-4 lg:w-5 lg:h-5 object-contain"
          :alt="stack.name"
        />
        <span x-text="stack.name"></span>
      </span>
    </template>
  </div>

</div>

</div>

  {{-- FEATURED SECOND --}}
<div
  x-show="visible"
  x-transition.opacity.duration.400ms
  @click="window.location = '/projects/' + currentSecondary?.slug"
  class="rounded-2xl overflow-hidden
         bg-gradient-to-br from-cyan-500 to-teal-500
         flex flex-col
         cursor-pointer hover:brightness-110 transition"
>


    <div class="relative w-full aspect-[16/10]">
      <img
        :src="currentSecondary?.thumbnail"
        class="absolute inset-0 w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
    </div>

    <div class="p-5 flex-1 flex flex-col justify-between">
      <div>
        <h3
          class="text-lg lg:text-xl font-bold mb-1"
          x-text="currentSecondary?.title"
        ></h3>

        <p
          class="text-xs lg:text-sm opacity-85 line-clamp-2"
          x-text="currentSecondary?.overview"
        ></p>
      </div>

      <div class="flex gap-2 mt-3 flex-wrap">
        <template x-for="stack in (currentSecondary?.stacks || []).slice(0,2)" :key="stack.id">
          <span
            class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full"
            x-text="stack.name"
          ></span>
        </template>
      </div>
    </div>
  </div>

</div>


  </div>
@endif
