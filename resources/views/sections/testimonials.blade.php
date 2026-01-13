@php
$items = [
    [
        'name' => 'Alex Morgan',
        'role' => 'Startup Founder',
        'quote' => 'Working with this platform feels like collaborating with a true product-minded engineer. Every detail matters.',
        'img' => 'assets/images/client1.png',
    ],
    [
        'name' => 'Sarah Kim',
        'role' => 'Product Designer',
        'quote' => 'The way projects are presented here is stunning. It feels modern, intentional, and crafted with care.',
        'img' => 'assets/images/client2.png',
    ],
    [
        'name' => 'Daniel Wright',
        'role' => 'CTO, Fintech',
        'quote' => 'Clean architecture, beautiful UI, and strong execution. This is how a professional showcase should look.',
        'img' => 'assets/images/client3.png',
    ],
    [
        'name' => 'Maya Patel',
        'role' => 'Marketing Lead',
        'quote' => 'Every project feels alive. It tells a story, not just shows screenshots.',
        'img' => 'assets/images/client4.png',
    ],
    [
        'name' => 'Kevin Huang',
        'role' => 'Indie Hacker',
        'quote' => 'This is not just a portfolio. It is a product experience.',
        'img' => 'assets/images/client5.png',
    ],
    [
        'name' => 'Laura Stein',
        'role' => 'Agency Owner',
        'quote' => 'Clients instantly trust the quality when they see this showcase.',
        'img' => 'assets/images/client6.png',
    ],
];
@endphp



<section id="testimonials" class="section-padding">
  <div class="relative w-full md:px-10 px-5">

    {{-- Dark Panel --}}
    <div class="relative rounded-3xl p-10 md:p-14
                bg-gradient-to-b from-[#0b0b16] via-[#0f0e1f] to-[#0b0b16]
                border border-white/5
                shadow-[0_0_120px_rgba(0,0,0,0.8)]">

      {{-- Header --}}
      <div class="mb-14">
        <p class="text-sm tracking-widest text-gray-400 uppercase mb-2">
          What Others Say
        </p>
        <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white">
          Testimonials<span class="text-indigo-400">.</span>
        </h2>
      </div>

      {{-- Cards --}}
      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($items as $t)
          <div
            class="relative rounded-2xl p-7
                   bg-black/40 backdrop-blur-xl
                   border border-white/5
                   shadow-[0_20px_60px_rgba(0,0,0,0.6)]
                   hover:bg-black/50 transition"
          >
            {{-- Quote mark --}}
            <div class="text-6xl leading-none font-black text-white/90 mb-4">“</div>

            <p class="text-base md:text-lg font-semibold text-gray-100 leading-relaxed mb-10">
              {{ $t['quote'] }}
            </p>

            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-bold text-white">
                  {{ $t['name'] }}
                </p>
                <p class="text-xs font-medium text-gray-400">
                  {{ $t['role'] }}
                </p>
              </div>

              <img
                src="{{ asset($t['img']) }}"
                alt="{{ $t['name'] }}"
                class="w-11 h-11 rounded-full object-cover border border-white/20"
              >
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </div>
</section>
