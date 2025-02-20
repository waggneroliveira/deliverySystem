<template>
    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-0">
        <div class="box-product relative" v-for="(item, index) in items" :key="index">
            <div class="box-product__image">
                <img :src="item.image" alt="Product Image">
            </div>
            <div class="box-product__description absolute left-0 bottom-0 bg-[#031D40] h-[2.651rem] w-full max-w-[12.688rem] flex text-center items-center">
                <h4 class="box-product__description--title text-[#FFF] w-full">{{ item.title }}</h4>
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

</style>