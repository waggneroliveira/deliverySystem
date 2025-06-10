<template>
  <div class="relative w-full h-[100dvh] sm:h-full top-0">
    <div class="slide relative z-0 w-full">
      <carousel :wrap-around="false" :autoplay="0" class="h-[100dvh] sm:h-full">
        <slide v-for="(banner, index) in banners" :key="index" class="bg-fundo relative">

          <template v-if="banner.link_youtube">
            <div class="video-wrapper absolute top-0 left-0 w-full h-[100dvh] sm:h-screen overflow-hidden z-0">
              <div :id="`video-bg-${index}`" class="w-full !h-[100dvh]"></div>
            </div>
          </template>
          
          <template v-else>
            <img :src="getImage(banner)" alt="Banner principal" :title="banner.title" class="w-full sm:h-screen h-[100dvh] object-cover"/>
          </template>

          <div class="description z-10 absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 text-left w-[90%] max-w-[1140px] h-[100dvh] sm:h-full max-h-[333px] flex flex-col items-start justify-start sm:justify-center gap-[30px] leading-[43px] sm:leading-[52px]">
            <h1 class="noto-sans-devanagari-semibold text-white font-normal text-[2.188rem] sm:text-[3.25rem]">
              {{ banner.title }}
            </h1>
            <p class="noto-sans-devanagari-regular text-white font-normal text-[0.938rem] sm:text-[1.5rem] leading-[28px] sm:leading-[32px] max-w-[630px]">
              {{ banner.description }}
            </p>
          </div>
          <div class="absolute bottom-[70px] sm:bottom-10 w-full flex justify-center z-10">
            <div class="cursor-pointer animate-bounce" @click="scrollToSection">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </div>
        </slide>

        <!-- Pagination Dots -->
        <template #addons>
          <pagination class="pagination flex flex-row justify-center items-center"></pagination>
        </template>
      </carousel>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination } from 'vue3-carousel';

export default {
  components: {
    Carousel,
    Slide,
    Pagination,
  },
  data() {
    return {
      banners: [],
      isMobile: false, // Variável para controle de resolução
    };
  },
  mounted() {
    this.getBanners();
    this.checkMobileResolution(); // Verifica a resolução ao montar
    window.addEventListener('resize', this.checkMobileResolution); // Atualiza ao redimensionar
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.checkMobileResolution); // Limpeza do evento
  },
  methods: {
    initYoutubeBackground() {
      if (window.jQuery && window.jQuery.fn.YTPlayer) {
        this.banners.forEach((banner, index) => {
          if (banner.link_youtube) {
            const id = `#video-bg-${index}`;
            let videoURL = banner.link_youtube;

            // Converte o link se for no formato youtu.be/XYZ
            if (videoURL.includes('youtu.be/')) {
              const videoId = videoURL.split('youtu.be/')[1];
              videoURL = `https://www.youtube.com/watch?v=${videoId}`;
            }

            window.jQuery(id).YTPlayer({
              videoURL: videoURL,
              mute: true,
              autoPlay: true,
              loop: true,
              showControls: false,
              containment: id,
              optimizeDisplay: true,
              startAt: 0,
              opacity: 1,
              quality: 'highres',
            });
          }
        });
      } else {
        console.warn('YTPlayer não carregado corretamente');
      }
    },

    scrollToSection() {
      const section = document.getElementById('product__categories');
      if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
      }
    },
    async getBanners() {
      try {
        const response = await axios.get('/api/slides');
        this.banners = response.data;

        // Aguarde renderização do DOM
        this.$nextTick(() => {
          const hasYoutube = this.banners.some(b => b.link_youtube);
          if (hasYoutube) {
            this.initYoutubeBackground();
          }
        });
      } catch (error) {
        console.error('Erro ao buscar os banners:', error);
      }
    },

    checkMobileResolution() {
      this.isMobile = window.innerWidth <= 768; // Define o limite para o mobile
    },
    getImage(banner) {
      // Se a tela for mobile, retorna a imagem mobile, caso contrário a imagem desktop
      return this.isMobile && banner.image_mobile ? banner.image_mobile : banner.image;
    },


  },
};
</script>

<style scoped>
  .video-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100dvh;
    overflow: hidden;
    z-index: 0;
  }

  .video-wrapper iframe {
    width: 100%;
    height: 100dvh;
    position: absolute;
    top: 0;
    left: 0;
  }
  .carousel .carousel__slide {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .pagination {
    position: absolute;
    left: 50px;
    transform: rotate(90deg);
    bottom: 100px;
  }
  .montagu-slab {
    font-family: "Montagu Slab", serif;
    font-optical-sizing: auto;
    font-weight: 400; 
    font-style: normal;
  }
  .bg-fundo::after{
    content: '';
    background: #00000050;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1;
  }
  @media screen and (max-width: 640px) {
    .pagination{
      left: 0;
    }
  }
</style>
