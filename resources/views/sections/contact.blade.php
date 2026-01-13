<section id="contact" class="flex-center section-padding">
  <div class="w-full h-full md:px-10 px-5">
    <x-title-header
      title="Get in Touch – Let’s Connect"
      sub="💬 Have questions or ideas? Let’s talk! 🚀"
    />

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
              ></textarea>
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

          <img
            src="{{ asset('assets/images/earth.jpg') }}"
            alt="Earth"
            class="w-full h-full object-cover"
          >

          {{-- Optional overlay biar lebih elegan --}}
          <div class="absolute inset-0 bg-black/20"></div>

        </div>
      </div>
    </div>
  </div>
</section>
