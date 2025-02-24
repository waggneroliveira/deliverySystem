<template>
    <div class="box-product-category w-full grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-0">
        <div class="box-product-category__content relative" v-for="(item, index) in items" :key="index">
            <div class="box-product-category__image overflow-hidden">
                <img :src="item.image" alt="Product Image" class="w-full ">
            </div>
            <div class="box-product-category__description rounded-lg absolute left-1/2 bottom-3 z-10 transform -translate-x-1/2 bg-[#031D40] h-[2.651rem] w-[80%] max-w-[12.688rem] flex text-center items-center">
                <h4 class="box-product-category__description--title text-[#FFF] w-[90%] m-auto">{{ item.title }}</h4>
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
    .box-product-category__image {
        position: relative;
        overflow: hidden;
    }

    .box-product-category__image::after {
        content: '';
        background: #0000004a;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
        transition: transform 0.5s ease-in-out;
        transform: translateY(0);
    }

    .box-product-category__image:hover::after {
        transform: translateY(100%);
    }

    .box-product-category__image img {
        transition: transform 0.5s ease-in-out;
    }

    .box-product-category__image:hover img {
        transform: scale(1.2);
    }
    @media screen and (max-width: 376px) {
        .box-product {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>