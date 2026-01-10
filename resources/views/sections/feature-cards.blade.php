<div class="w-full padding-x-lg">
  <div class="mx-auto grid-3-cols">
    @foreach ($features as $feature)
      <div class="card-border rounded-xl p-8 flex flex-col gap-4">
        <div class="size-14 flex items-center justify-center rounded-full">
          <img
            src="{{ asset($feature['img']) }}"
            alt="{{ $feature['title'] }}"
          >
        </div>

        <h3 class="text-white text-2xl font-semibold mt-2">
          {{ $feature['title'] }}
        </h3>

        <p class="text-white-50 text-lg">
          {{ $feature['desc'] }}
        </p>
      </div>
    @endforeach
  </div>
</div>
