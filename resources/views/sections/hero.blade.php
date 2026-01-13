<section id="hero" class="relative overflow-hidden">
  {{-- Background --}}
  <div class="absolute top-0 left-0 z-10">
    <img src="{{ asset('assets/images/bg.png') }}" alt="">
  </div>

  <div class="hero-layout">
    {{-- LEFT: Hero Content --}}
    <header class="flex flex-col justify-center md:w-full w-screen md:px-20 px-5">
      <div class="flex flex-col gap-7">

        {{-- Hero Text --}}
        <div class="hero-text">
          <h1>
            Shaping
            <span class="slide">
              <span class="wrapper">
                @foreach ($words as $word)
                  <span class="flex items-center md:gap-3 gap-1 pb-2">
                    <img
                      src="{{ asset($word['img']) }}"
                      alt="person"
                      class="xl:size-12 md:size-10 size-7 md:p-2 p-1 rounded-full bg-white-50"
                    >
                    <span>{{ $word['text'] }}</span>
                  </span>
                @endforeach
              </span>
            </span>
          </h1>
          <h1>into Real Projects</h1>
          <h1>that Deliver Results</h1>
        </div>

        {{-- Description --}}
        <p class="text-white-50 md:text-xl relative z-10 pointer-events-none">
          Hi, We are developers based in Universitas Bumigora with a passion for code.
        </p>

        {{-- Explore Button --}}
        <div>
          <a
            href="/dashboard"
            class="inline-flex items-center justify-center md:w-64 md:h-14 w-52 h-12
                   rounded-full border border-white text-white font-semibold tracking-wide
                   hover:bg-white hover:text-black transition-all duration-300"
          >
            Explore →
          </a>
        </div>

        {{-- Existing Button --}}
        <x-button
          text="See My Work"
          target="counter"
          class="md:w-80 md:h-16 w-60 h-12"
        />
      </div>
    </header>

    {{-- RIGHT: 3D PLACEHOLDER --}}
    <figure>
      <div class="hero-3d-layout"></div>
    </figure>
  </div>

  {{-- Animated Counter --}}
  {{-- @include('components.animated-counter') --}}
</section>
