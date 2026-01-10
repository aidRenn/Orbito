@props(['photos'])

@if ($photos->count())
  <section class="mt-16">
    <div class="max-w-6xl mx-auto">

      <h2 class="text-xl font-bold mb-6">Gallery</h2>

      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($photos as $photo)
          <div class="rounded-xl overflow-hidden bg-[#25243a]">
            <img
              src="{{ $photo->photo }}"
              alt="Project image"
              class="w-full h-auto object-cover"
              loading="lazy"
            />
          </div>
        @endforeach
      </div>

    </div>
  </section>
@endif
