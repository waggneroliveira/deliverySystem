<template>
    <div class="flex flex-row justify-between relative z-20">
        <header class="h-auto absolute top-0 left-1/2 transform -translate-x-1/2 w-[90%]">
            <div class="mx-auto flex justify-between items-start h-auto mt-[18px] sm:mt-12 p-0 m-auto w-full max-w[79.188rem]">
                <!-- Logo -->
                <div class="logo flex justify-between items-center content-center -mt-2 sm:mt-0">
                    <a href="/">
                        <img :src="logoPath" alt="Logo" class="w-[60px] sm:w-[80px]">
                    </a>
                </div>

                <div class="flex space-x-5 gap-[35px]">
                    <a href="/carrinho" class="w-[48px] h-auto relative">
                        <span class="absolute flex justify-center items-center -top-2 sm:-top-2.5 right-[18px] sm:right-[6px] text-white text-[0.625rem] sm:text-[1rem] bg-[#9F793A] w-[15px] sm:w-[20px] h-[15px] sm:h-[20px] rounded-full">{{ cartCount }}</span>
                        <img :src="logoCart" alt="Carrinho" class="w-[25px] sm:w-[30px]">
                    </a>
                </div>
            </div>
        </header>
    </div>
</template>
<script setup>
    import { computed } from 'vue';
    import { useCartStore } from '@/stores/cartStores';

    const cartStore = useCartStore();
    const cartCount = computed(() => cartStore.cartCount);
</script>

<script>

export default {
    font: "MontaguFontExample",
    name: "Header",
        data() {
        return {
            logoPath: '/build/client/images/logo.png', 
            logoCart: '/build/client/images/carrinho.png', 
        };
    },
};
</script>

<style scoped>
    .montagu-slab {
        font-family: "Montagu Slab", serif;
        font-optical-sizing: auto;
        font-style: normal;
    }
</style>
