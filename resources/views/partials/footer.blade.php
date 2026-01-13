<footer class="footer">
  <div class="footer-container">
    {{-- Left --}}
    <div class="flex flex-col justify-center">
      <p>Terms & Conditions</p>
    </div>

    {{-- Social Icons --}}
    <div class="socials">
      @foreach ($socials as $social)
        <div class="icon">
          <img
            src="{{ asset($social['img']) }}"
            alt="social icon"
          >
        </div>
      @endforeach
    </div>

    {{-- Right --}}
    <div class="flex flex-col justify-center">
      <p class="text-center md:text-end">
        © {{ now()->year }} Buildra. All rights reserved.
      </p>
    </div>
  </div>
</footer>
