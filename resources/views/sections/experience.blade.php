<section
  id="experience"
  class="flex-center md:mt-40 mt-20 section-padding xl:px-0"
>
  <div class="w-full h-full md:px-20 px-5">
    <x-title-header
      title="Professional Work Experience"
      sub="💼 My Career Overview"
    />

    <div class="mt-32 relative">
      <div class="relative z-50 xl:space-y-32 space-y-10">
        @foreach ($experiences as $card)
          <div class="exp-card-wrapper timeline-card">
            {{-- LEFT: IMAGE CARD --}}
            <div class="xl:w-2/6">
              <x-glow-card :card="$card">
                <div>
                  <img
                    src="{{ asset($card['img']) }}"
                    alt="exp-img"
                  >
                </div>
              </x-glow-card>
            </div>

            {{-- RIGHT: TIMELINE + TEXT --}}
            <div class="xl:w-4/6">
              <div class="flex items-start">
                <div class="timeline-wrapper">
                  <div class="timeline"></div>
                  <div class="gradient-line w-1 h-full"></div>
                </div>

                <div class="expText flex xl:gap-20 md:gap-10 gap-5 relative z-20">
                  <div class="timeline-logo">
                    <img
                      src="{{ asset($card['logo']) }}"
                      alt="logo"
                    >
                  </div>

                  <div>
                    <h1 class="font-semibold text-3xl">
                      {{ $card['title'] }}
                    </h1>

                    <p class="my-5 text-white-50">
                      🗓️&nbsp;{{ $card['date'] }}
                    </p>

                    <p class="text-[#839CB5] italic">
                      Responsibilities
                    </p>

                    <ul class="list-disc ms-5 mt-5 flex flex-col gap-5 text-white-50">
                      @foreach ($card['responsibilities'] as $responsibility)
                        <li class="text-lg">
                          {{ $responsibility }}
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
