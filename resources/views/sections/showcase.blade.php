@if ($featuredProjects->count() >= 1)
<div
  id="work"
  class="app-showcase"
  x-data="{
    items: {{ $featuredProjects->toJson() }},
    index: 0,
    visible: true,
    next() {
      this.visible = false;
      setTimeout(() => {
        this.index = (this.index + 1) % this.items.length;
        this.visible = true;
      }, 300);
    },
    start() {
      if (this.items.length > 1) {
        setInterval(() => this.next(), 5000);
      }
    }
  }"
  x-init="start()"
>
  <div class="w-full">
    <div class="showcaselayout">

      {{-- MAIN PROJECT --}}
      <a
        :href="`{{ url('/dashboard') }}/${items[index].slug}`"
        class="first-project-wrapper showcase-card block"
        x-show="visible"
        x-transition.opacity.duration.300ms
      >
        <div class="image-wrapper">
          <img :src="items[index].thumbnail" :alt="items[index].title">
        </div>

        <div class="text-content">
          <h2 x-text="items[index].title"></h2>
          <p class="text-white-50 md:text-xl"
             x-text="items[index].overview?.substring(0, 140)">
          </p>
        </div>
      </a>

      {{-- SECONDARY PROJECTS --}}
      <div class="project-list-wrapper overflow-hidden">
        <template x-for="(p, i) in items.slice(1,3)" :key="p.id">
          <a
            :href="`{{ url('/dashboard') }}/${p.slug}`"
            class="project showcase-card block"
            x-show="visible"
            x-transition.opacity.duration.300ms
          >
            <div class="image-wrapper bg-[#FFEFDB]">
              <img :src="p.thumbnail" :alt="p.title">
            </div>
            <h2 x-text="p.title"></h2>
          </a>
        </template>
      </div>

    </div>
  </div>
</div>
@endif
