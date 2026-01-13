<header id="navbar" class="navbar not-scrolled">
  <div class="inner">
    {{-- Logo --}}
    <a href="#hero" class="logo">
      Buildra
    </a>

    {{-- Desktop Navigation --}}
    <nav class="desktop">
      <ul>
        @foreach ($navLinks as $item)
          <li class="group">
            <a href="{{ $item['link'] }}">
              <span>{{ $item['name'] }}</span>
              <span class="underline"></span>
            </a>
          </li>
        @endforeach
      </ul>
    </nav>

    {{-- Contact Button --}}
    <a href="#contact" class="contact-btn group">
      <div class="inner">
        <span>Contact us</span>
      </div>
    </a>
  </div>
</header>
