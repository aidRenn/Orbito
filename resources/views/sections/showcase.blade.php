<div id="work" class="app-showcase">
  <div class="w-full">
    <div class="showcaselayout">
      {{-- FIRST / MAIN PROJECT --}}
      <div class="first-project-wrapper showcase-card">
        <div class="image-wrapper">
          <img
            src="{{ asset('assets/images/project1.png') }}"
            alt="Ryde App Interface"
          >
        </div>
        <div class="text-content">
          <h2>
            On-Demand Rides Made Simple with a Powerful, User-Friendly App
            called Ryde
          </h2>
          <p class="text-white-50 md:text-xl">
            An app built with React Native, Expo, & TailwindCSS for a fast,
            user-friendly experience.
          </p>
        </div>
      </div>

      {{-- SECONDARY PROJECTS --}}
      <div class="project-list-wrapper overflow-hidden">
        <div class="project showcase-card">
          <div class="image-wrapper bg-[#FFEFDB]">
            <img
              src="{{ asset('assets/images/project2.png') }}"
              alt="Library Management Platform"
            >
          </div>
          <h2>The Library Management Platform</h2>
        </div>

        <div class="project showcase-card">
          <div class="image-wrapper bg-[#FFE7EB]">
            <img
              src="{{ asset('assets/images/project3.png') }}"
              alt="YC Directory App"
            >
          </div>
          <h2>YC Directory - A Startup Showcase App</h2>
        </div>
      </div>
    </div>
  </div>
</div>
