<template>
    <div class="box-product-category w-full grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-0">
        <div class="box-product-category__content relative" v-for="(category, index) in categories" :key="index" :class="!category.image ? 'bg-[#031d40bf]' : ''">
            <div v-if="category.image != null" class="box-product-category__image overflow-hidden">
                <img loading="lazy" :src="category.image" alt="Product Image" class="w-full h-full object-cover">
            </div>

            <div v-else class="box-product-category__image overflow-hidden bg-[#031d40bf] h-[231.26px] sm:h-[450.46px]">

            </div>

            <a :href="`/produtos/${category.slug}`">
                <div class="box-product-category__description rounded-lg absolute left-1/2 bottom-3 z-10 transform -translate-x-1/2 bg-[#031D40] h-[25px] sm:h-[2.651rem] w-[80%] max-w-[12.688rem] flex text-center items-center">
                    <h2 class="box-product-category__description--title uppercase text-[#FFF] text-[0.5rem] sm:text-[1rem] w-[90%] m-auto ">{{ category.title }}</h2>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'product-category',

    data(){
        return {
            categories: [],
        };
    },
    mounted(){
        this.getCategories();
    },

    methods: {
        async getCategories() { 
            try {
                const response = await axios.get('/api/categorias'); 
                this.categories = response.data;
            } catch (error) {
                console.error('Erro ao buscar os categorias:', error);
            }
        }
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
        background: #00000014;
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