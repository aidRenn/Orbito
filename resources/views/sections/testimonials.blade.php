<section id="testimonials" class="flex-center section-padding">
  <div class="w-full h-full md:px-10 px-5">
    <x-title-header
      title="What People Say About Me?"
      sub="⭐️ Customer feedback highlights"
    />

    <div class="lg:columns-3 md:columns-2 columns-1 mt-16">
      @foreach ($testimonials as $testimonial)
        <x-glow-card :card="$testimonial">
          <div class="flex items-center gap-3">
            <div>
              <img
                src="{{ asset($testimonial['img']) }}"
                alt=""
              >
            </div>
            <div>
              <p class="font-bold">
                {{ $testimonial['name'] }}
              </p>
              <p class="text-white-50">
                {{ $testimonial['mentions'] }}
              </p>
            </div>
          </div>
        </x-glow-card>
      @endforeach
    </div>
  </div>
</section>
