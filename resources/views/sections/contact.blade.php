<section id="contact" class="flex-center section-padding">
  <div class="w-full h-full md:px-10 px-5">
    <x-title-header
      title="Get in Touch – Let’s Connect"
      sub="💬 Have questions or ideas? Let’s talk! 🚀"
    />

    {{-- MODAL CONFIRMATION --}}
    @if(session('success') || session('error'))
      <div
        id="contact-modal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
      >
        <div class="relative w-full max-w-md mx-4 rounded-2xl border border-white/10 bg-[#0f0f14] p-6 shadow-2xl animate-modal-in">

          <button
            onclick="closeContactModal()"
            class="absolute top-3 right-3 text-white/50 hover:text-white transition"
          >
            ✕
          </button>

          @if(session('success'))
            <div class="flex items-start gap-4 text-green-400">
              <svg class="w-6 h-6 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <div>
                <h3 class="text-lg font-semibold text-green-300">Message Sent</h3>
                <p class="mt-1 text-sm text-green-200/80">
                  Your message has been delivered successfully.
                  <br>
                  <span class="text-xs opacity-70">(Captured by Mailtrap)</span>
                </p>
              </div>
            </div>
          @endif

          @if(session('error'))
            <div class="flex items-start gap-4 text-red-400">
              <svg class="w-6 h-6 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
              <div>
                <h3 class="text-lg font-semibold text-red-300">Send Failed</h3>
                <p class="mt-1 text-sm text-red-200/80">
                  Something went wrong. Please try again in a moment.
                </p>
              </div>
            </div>
          @endif

        </div>
      </div>
    @endif

    <div class="grid-12-cols mt-16">
      {{-- LEFT: FORM --}}
      <div class="xl:col-span-5">
        <div class="flex-center card-border rounded-xl p-10">
          <form
            method="POST"
            action="{{ route('contact.store') }}"
            class="w-full flex flex-col gap-7"
          >
            @csrf

            <div>
              <label for="name">Your name</label>
              <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="What’s your good name?"
                required
              >
            </div>

            <div>
              <label for="email">Your Email</label>
              <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="What’s your email address?"
                required
              >
            </div>

            <div>
              <label for="message">Your Message</label>
              <textarea
                id="message"
                name="message"
                placeholder="How can I help you?"
                rows="5"
                required
              >{{ old('message') }}</textarea>
            </div>

            <button type="submit">
              <div class="cta-button group">
                <div class="bg-circle"></div>
                <p class="text">Send Message</p>
                <div class="arrow-wrapper">
                  <img
                    src="{{ asset('assets/images/arrow-down.svg') }}"
                    alt="arrow"
                  >
                </div>
              </div>
            </button>
          </form>
        </div>
      </div>

      {{-- RIGHT: IMAGE --}}
      <div class="xl:col-span-7 min-h-96">
        <div class="bg-[#cd7c2e] w-full h-full rounded-3xl overflow-hidden relative">

          {{-- Image --}}
          <img
            src="{{ asset('assets/images/earth.jpg') }}"
            alt="Contact Visual"
            class="w-full h-full object-cover"
          >

          {{-- Overlay agar teks tetap kontras --}}
          <div class="absolute inset-0 bg-black/20"></div>

        </div>
      </div>
    </div>
  </div>
</section>
