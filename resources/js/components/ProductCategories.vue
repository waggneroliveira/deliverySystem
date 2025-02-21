<template>
    <div class="box-product grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-0">
        <div class="box-product__content relative" v-for="(item, index) in items" :key="index">
            <div class="box-product__image overflow-hidden">
                <img :src="item.image" alt="Product Image" class="w-full transition-transform duration-700 ease-in-out transform hover:scale-110">
            </div>
            <div class="box-product__description rounded-lg absolute left-1/2 bottom-3 transform -translate-x-1/2 bg-[#031D40] h-[2.651rem] w-[80%] max-w-[12.688rem] flex text-center items-center">
                <h4 class="box-product__description--title text-[#FFF] w-[90%] m-auto">{{ item.title }}</h4>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'product-category',
    data(){
        return {
            font: "MontaguFontExample", 
            items:[
                {
                    title: 'SASHIMI',
                    image: 'build/client/images/category-1.png', 
                },
                {
                    title: 'HOSOMAKIS SASHIMI',
                    image: 'build/client/images/category-2.png', 
                },
                {
                    title: 'HOSOMAKIS',
                    image: 'build/client/images/category-3.png', 
                },
                {
                    title: 'SASHIMI',
                    image: 'build/client/images/category-1.png', 
                },
                {
                    title: 'HOSOMAKIS',
                    image: 'build/client/images/category-2.png', 
                },
                {
                    title: 'SASHIMI',
                    image: 'build/client/images/category-3.png', 
                },
                {
                    title: 'SASHIMI',
                    image: 'build/client/images/category-1.png', 
                },
                {
                    title: 'HOSOMAKIS',
                    image: 'build/client/images/category-2.png', 
                },
                {
                    title: 'HOSOMAKIS',
                    image: 'build/client/images/category-3.png', 
                },
                {
                    title: 'SASHIMI',
                    image: 'build/client/images/category-1.png', 
                },
                {
                    title: 'HOSOMAKIS',
                    image: 'build/client/images/category-2.png', 
                },
                {
                    title: 'SASHIMI',
                    image: 'build/client/images/category-3.png', 
                },
            ],            
        };
    },
}
</script>

<style>
    @media screen and (max-width: 376px) {
        .box-product {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>