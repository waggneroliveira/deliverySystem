<template>
    <div class="flex flex-row justify-between relative z-20">
        <header class="h-auto absolute top-0 left-1/2 transform -translate-x-1/2 w-[90%]">
            <div class="mx-auto flex justify-between items-start h-auto mt-12 p-0 m-auto w-full max-w[79.188rem]">
                <!-- Logo -->
                <div class="logo flex justify-between items-center content-center">
                    <a href="/">
                        <img :src="logoPath" alt="Logo" class="w-[121px]">
                    </a>
                </div>

                <div class="flex space-x-5 gap-[35px]">
                    <a href="/" class="w-[48px] h-auto relative">
                        <span class="absolute flex justify-center items-center -top-2.5 -right-3 text-white bg-[#9F793A] w-[20px] h-auto rounded-full">0</span>
                        <img :src="logoCart" alt="Carrinho" class="w-100">
                    </a>
                </div>
            </div>
        </header>
    </div>
</template>

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
