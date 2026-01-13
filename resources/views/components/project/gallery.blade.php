@props(['photos'])

@if ($photos->count())
{{-- <section class="mt-20 w-full"> --}}
    <section {{ $attributes->merge(['class' => 'mt-20 w-full']) }}>
  <div class="w-full">

    <div class="flex items-center justify-between mb-8">
      <h2 class="text-2xl font-bold tracking-tight">Gallery</h2>
      <span class="text-xs text-gray-400">
        {{ $photos->count() }} visuals
      </span>
    </div>

    <div
      class="grid w-full gap-5
             [grid-template-columns:repeat(auto-fit,minmax(280px,1fr))]
             auto-rows-[200px]
             md:auto-rows-[220px]
             xl:auto-rows-[240px]"
    >
      @foreach ($photos as $i => $photo)
        @php
          // setiap 5 item, buat satu yang besar
          $isLarge = $i % 5 === 0;
          $rowSpan = $isLarge ? 'row-span-2' : '';
        @endphp

        <div
          class="relative group rounded-2xl overflow-hidden
                 bg-[#1c1b2d] border border-white/5
                 {{ $rowSpan }}
                 shadow-[0_0_40px_rgba(99,102,241,0.08)]
                 hover:shadow-[0_0_60px_rgba(99,102,241,0.18)]
                 transition"
        >
          <img
            src="{{ $photo->photo }}"
            alt="Project image"
            loading="lazy"
            class="w-full h-full object-cover
                   transition-transform duration-500
                   group-hover:scale-105"
          />

          <div
            class="absolute inset-0
                   bg-gradient-to-t from-black/60 via-transparent to-transparent
                   opacity-0 group-hover:opacity-100
                   transition"
          ></div>

          <div
            class="absolute inset-0
                   ring-1 ring-white/10
                   group-hover:ring-indigo-400/40
                   transition"
          ></div>
        </div>
      @endforeach
    </div>

  </div>
</section>
@endif
