<template>
    <div class="flex flex-row justify-between relative z-10">
        <header class="w-10/12 h-full fixed top-0 lef-0">
            <div class="container mx-auto flex justify-between items-start content-center px-12 h-full py-3 mt-12">
                <!-- Logo -->
                <div class="logo flex justify-between items-center content-center">
                    <a href="/">
                        <img :src="logoPath" alt="Logo">
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
    header{
        max-width: 1360px;
    }

    .montagu-slab {
        font-family: "Montagu Slab", serif;
        font-optical-sizing: auto;
        font-style: normal;
    }
</style>
