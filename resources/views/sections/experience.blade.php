<section
  id="experience"
  class="flex-center pb-40 md:pt-40 mt-20 section-padding xl:px-0 bg-black"
>
  <div class="w-full h-full md:px-20 px-5">

    {{-- BIG TITLE --}}
    <div class="text-center mb-16">
      <h1 class="text-5xl md:text-6xl font-extrabold tracking-widest text-white uppercase">
        Our Team
      </h1>
      <div class="w-24 h-1 bg-white mx-auto mt-6 opacity-30"></div>
    </div>

    {{-- HEADER --}}
    <div class="mb-20 pt-5">
      <x-title-header
        title="Tim Project"
        sub="Our Project Team"
      />
    </div>

    {{-- TEAM GRID --}}
    <div class="grid xl:grid-cols-5 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-10">

      @foreach ($experiences as $card)
        <div class="group relative bg-black rounded-2xl p-8 border border-white/20 shadow-lg hover:border-white transition-all duration-300 hover:scale-105">

          {{-- Avatar --}}
          <div class="flex justify-center -mt-20 mb-5">
            <div class="w-28 h-28 rounded-full overflow-hidden border-2 border-white shadow-xl bg-black">
              <img
                src="{{ asset($card['img']) }}"
                alt="profile"
                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300"
              >
            </div>
          </div>

          {{-- Info --}}
          <div class="text-center mt-5">

            {{-- Nama --}}
            <h1 class="text-2xl font-bold text-white tracking-wide">
              {{ $card['logo'] }}
            </h1>

            {{-- Role --}}
            <p class="mt-1 text-sm text-gray-300 uppercase tracking-widest">
              {{ $card['title'] }}
            </p>

            {{-- NIM --}}
            <p class="mt-2 text-gray-400 text-sm">
              NIM : {{ $card['date'] }}
            </p>

            {{-- Responsibilities --}}
            <div class="mt-6 text-left">
              <p class="text-xs text-gray-400 mb-3 italic uppercase tracking-widest">
                Experience
              </p>

              <ul class="list-disc ms-5 space-y-2 text-gray-300 text-sm">
                @foreach ($card['responsibilities'] as $responsibility)
                  <li>
                    {{ $responsibility }}
                  </li>
                @endforeach
              </ul>
            </div>

          </div>

        </div>
      @endforeach

    </div>
  </div>
</section>
