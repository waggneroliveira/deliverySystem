<template>
  <div class="relative w-full h-screen top-[-107px]">
    <div class="slide relative z-0 w-full h-[100%] overflow-hidden">
      <carousel :wrap-around="true" :autoplay="false" class="rounded-xl h-full">
        <slide v-for="(banner, index) in banners" :key="index">
          <img :src="banner.image" :alt="banner.alt" class="w-full h-full object-cover" />
          <div class="description absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 text-left w-[90%] max-w-[1140px] h-full max-h-[333px] flex flex-col items-start justify-start gap-[100px] leading-[52px]">
            <h1 class="montagu-slab text-white font-normal text-[52px]">
              {{ banner.title }}
            </h1>
            <p class="montagu-slab text-white font-normal text-[28px] leading-[45px] max-w-[475px]">
              {{ banner.text }}
            </p>
          </div>
        </slide>
        <!-- Pagination Dots -->
        <template #addons>
          <pagination class="pagination flex flex-row justify-center items-center">
          </pagination>
        </template>
      </carousel>
    </div>
  </div>
</template>

<script>
  import 'vue3-carousel/dist/carousel.css';
  import { Carousel, Slide, Pagination } from 'vue3-carousel';

  export default {
    font: "MontaguFontExample",
    components: {
      Carousel,
      Slide,
      Pagination,
    },
    data() {
      return {
        banners: [
          {
            image: '/build/client/images/banner.png',
            alt: 'Banner 1',
            title: '',
            text: '',
          },
          {
            image: 'https://via.placeholder.com/1200x400/7fbfff/333333?text=Banner+2',
            alt: 'Banner 2',
            title: 'Descontos Incríveis!',
            text: 'Pureza que cuida, natureza que transforma!',
          },
          {
            image: 'https://via.placeholder.com/1200x400/ffb84d/333333?text=Banner+3',
            alt: 'Banner 3',
            title: 'Novo Lançamento!',
            text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit ips.',
          },
        ],
      };
    },
  };
</script>

<style scoped>
  .carousel .carousel__slide {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .pagination {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
  }
  .montagu-slab {
    font-family: "Montagu Slab", serif;
    font-optical-sizing: auto;
    font-weight: 400; 
    font-style: normal;
  }
</style>
