<template>
  <div class="banner overflow-hidden">
    <Splide :options="splideOptions" aria-label="My Favorite Images">
      <SplideSlide v-for="(banner, index) in banners" :key="index">
        <img :src="banner.image" :alt="banner.alt" />
      </SplideSlide>
    </Splide>
  </div>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';

export default {
  components: {
    Splide,
    SplideSlide,
  },
  setup() {
    const splideOptions = {
      type: 'loop',
      autoplay: false,
      interval: 3000,
      pauseOnHover: true,
      perPage: 1,
      perMove: 1,
      rewind: true,
      pagination: true,
      arrows: false,
    };

    return {
      splideOptions,
      banners: [
        {
          image: '/build/client/images/banner.png', 
          alt: 'Banner 1',
        },
      ],
    };
  },
};
</script>

<style>
.splide__slide img {
  width: 100%;
  height: auto;
  object-fit: cover;
}
.banner{
    height: 70vh;
}
</style>
