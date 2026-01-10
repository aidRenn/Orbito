@props(['items'])

@if ($items->count() >= 1)
  <div
    x-data="featuredCarousel({{ $items->toJson() }})"
    x-init="start()"
    class="mb-14"
  >
    <div class="grid lg:grid-cols-3 gap-6">

      {{-- FEATURED MAIN --}}
      <div
        x-show="visible"
        x-transition.opacity.duration.400ms
        class="lg:col-span-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl p-8 h-64 flex justify-between"
      >
        <div>
          <h3 class="text-3xl font-bold mb-4" x-text="currentMain?.title"></h3>

          <p
            class="opacity-90 max-w-md line-clamp-3"
            x-text="currentMain?.overview"
          ></p>

          <div class="flex gap-2 mt-6 flex-wrap">
            <template x-for="stack in (currentMain?.stacks || []).slice(0,4)" :key="stack.id">
              <span
                class="text-xs bg-white/20 px-3 py-1 rounded-full"
                x-text="stack.name"
              ></span>
            </template>
          </div>
        </div>

        <img
          :src="currentMain?.thumbnail"
          class="w-40 h-40 object-cover rounded-xl"
        />
      </div>

      {{-- FEATURED SECOND --}}
      <div
        x-show="visible"
        x-transition.opacity.duration.400ms
        class="bg-gradient-to-r from-cyan-500 to-teal-500 rounded-2xl p-6 h-64 flex flex-col justify-between"
      >
        <div>
          <h3
            class="text-2xl font-bold mb-2"
            x-text="currentSecondary?.title"
          ></h3>

          <p
            class="text-sm opacity-80 line-clamp-2"
            x-text="currentSecondary?.overview"
          ></p>
        </div>

        <div class="flex items-end justify-between">
          <div class="flex gap-2">
            <template x-for="stack in (currentSecondary?.stacks || []).slice(0,2)" :key="stack.id">
              <span
                class="text-xs bg-white/20 px-3 py-1 rounded-full"
                x-text="stack.name"
              ></span>
            </template>
          </div>

          <img
            :src="currentSecondary?.thumbnail"
            class="w-14 h-14 object-cover rounded-lg opacity-90"
          />
        </div>
      </div>

    </div>
  </div>
@endif
