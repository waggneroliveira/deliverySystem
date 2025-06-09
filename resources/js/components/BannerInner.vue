<template>
  <div class="banner-inner h-[200px] sm:h-[300px] w-full relative z-10 flex items-center justify-center text-white text-4xl font-bold"
    :style="{ backgroundImage: 'url(' + image + ')' }">
    <div class="absolute bottom-0 sm:bottom-[1.25rem] flex flex-col h-[60px] m-auto w-[90%] max-w[79.188rem] items-start justify-start">
        <h2 class="text-[#FFF] text-[1.125rem] sm:text-[1.875rem] noto-sans-devanagari-semibold">{{ title }}</h2>
        <span 
          @click="scrollToProducts"
          class="scrollToProducts w-0 h-0 border-l-[12px] border-l-transparent cursor-pointer border-r-[12px] border-r-transparent border-t-[18px] border-t-[#CF1E0C] animate-smooth-bounce">
        </span>
    </div>
  </div>
</template>

<script setup>
import { defineProps, onMounted } from 'vue';

const props = defineProps({
  image: {
    type: String,
    required: true
  },
  title: {
    type: String,
    required: true
  }
});


const scrollToProducts = () => {
  setTimeout(() => {
    const targetSection = document.getElementById("products-inner");
    if (targetSection) {
      targetSection.scrollIntoView({ behavior: "smooth" });
    } else {
      console.error("Elemento #products-inner não encontrado.");
    }
  }, 100);
};
</script>


<style>
    .banner-inner{
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .banner-inner::after{
        content: '';
        background-image: url('../../assets/client/images/firula-banner-inner.png');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        z-index: -1;
    }
    @keyframes smooth-bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(8px);
      }
    }

    .animate-smooth-bounce {
      animation: smooth-bounce 1.5s ease-in-out infinite;
    }

</style>