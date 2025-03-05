<template>
  <div class="relative w-full h-full top-0">
    <div class="slide relative z-0 w-full">
      <carousel :wrap-around="true" :autoplay="0" class="rounded-xl h-full">
        <slide v-for="(banner, index) in banners" :key="index">
          <img :src="getImage(banner)" :alt="banner.title" class="w-full h-screen object-cover" />
          <div class="description absolute top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2 text-left w-[90%] max-w-[1140px] h-full max-h-[333px] flex flex-col items-start justify-center gap-[30px] leading-[52px]">
            <h1 class="noto-sans-devanagari-semibold text-white font-normal text-[52px]">
              {{ banner.title }}
            </h1>
            <p class="noto-sans-devanagari-regular text-white font-normal text-[28px] leading-[45px] max-w-[475px]">
              {{ banner.description }}
            </p>
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
    async getBanners() {
      try {
        const response = await axios.get('/api/slides'); // Requisição para Laravel
        this.banners = response.data; // Atualiza o array com os dados da API
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
  @media screen and (max-width: 640px) {
    .pagination{
      left: 0;
    }
  }
</style>
