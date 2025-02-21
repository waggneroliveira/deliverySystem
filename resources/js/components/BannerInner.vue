<template>
  <div class="banner-inner h-[540px] w-full relative z-10 flex items-center justify-center text-white text-4xl font-bold"
    :style="{ backgroundImage: `url(${image || defaultImage})` }"
  >
    <h1>Escolha seu Sushi abaixo</h1>
    <div class="absolute inset-0 bg-cover bg-center" :style="{ backgroundImage: `url(${overlayImage})` }"></div>
  </div>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
    image: { type: String, default: '' },
    });

    const defaultImage = '/assets/client/images/banner-inner-1.png';
const overlayImage = '/assets/client/images/firula-banner-inner.png';
</script>


<style>
    .banner-inner{
        background-image: url('../../assets/client/images/banner-inner-1.png');
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
</style>