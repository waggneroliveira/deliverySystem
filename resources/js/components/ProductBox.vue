<template>
    <div class="box-products grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 m-auto w-full max-w[79.188rem]">
        <div class="box-product__content rounded-tl-[0rem] rounded-tr-[0rem] rounded-br-[1.25rem] rounded-bl-[1.25rem] w-100 !max-w-full sm:max-w-[320px] relative pt-[0.5rem] p-[0.75rem] sm:pr-[1.5625rem] pb-[1.296rem] pl-[0.75rem] sm:pl-[1.5625rem] border border-[#CF1E0C] border-solid" 
            v-for="(item, index) in items" :key="index">
            
            <div class="box-product__image relative flex items-center justify-center w-full max-w-[362.89px] m-auto h-[10.625rem] sm:h-[215.68px] overflow-hidden">
                <div v-if="item.promotion" class="tag z-10 absolute top-[1.125rem] h-[1.563rem] sm:h-[2.125rem] left-0 bg-[#CF1E0C] text-[#FFF] w-[3.600rem] sm:w-[5.063rem] flex justify-center items-center">
                   <i class="w-full h-100 flex items-center justify-center text-[0.75rem] sm:text-[0.938rem] mt-[0.188rem] noto-sans-devanagari-regular">{{ item.tag }}</i> 
                </div>
                <img :src="item.image" alt="Product Image" class="w-full h-full object-cover transition-transform duration-700 ease-in-out transform hover:scale-110">
            </div>

            <div class="box-product__description flex flex-wrap text-left items-center gap-[0.063rem] sm:gap-[1.514rem] max-w-[362.89px] m-auto">
                <div class="box-product__description--content w-full flex flex-wrap justify-between mt-[0.625rem] sm:mt-[1.363rem]">
                    <h4 class="box-product__description--title uppercase text-[0.813rem] sm:text-[1.25rem] text-[#4C3A36] w-100 noto-sans-devanagari-semibold">{{ item.title }}</h4>
                    <div class="box-product__description--content__price flex gap-2">
                        <div v-if="item.oldPrice > 0" class="box-product__description--content__price__old-price text-[#4C3A36] text-[0.75rem] sm:text-[1.125rem] line-through noto-sans-devanagari-light">
                            R$ {{ item.oldPrice }}
                        </div>
                        <div v-if="item.price > 0" class="box-product__description--content__price__price text-[#CF1E0C] text-[0.938rem] sm:text-[1.25rem] noto-sans-devanagari-semibold">
                            R$ {{ item.price }}
                        </div>
                    </div>
                </div>
                <div class="box-product__description--text w-100">
                    <p class="text-[#4C3A36] text-[0.75rem] sm:text-[1.5rem] noto-sans-devanagari-regular" v-html="item.text"></p>
                </div>
            </div>

            <div class="actions flex items-center justify-between mt-[0.625rem] sm:mt-[2.5rem] max-w-[362.89px] m-auto">
                <div v-if="item.stock === 0" class="bg-red-500 text-white w-full text-[0.813rem] sm:text-[1.25rem] text-center h-[35px] py-2 px-4 font-bold">Produto Esgotado</div>
                
                <div v-else-if="item.price == 0" class="bg-red-500 text-white w-full text-[0.813rem] sm:text-[1.25rem] text-center h-[35px] py-2 px-4 font-bold">Indisponível</div>
                
                <div v-else class="count-item flex items-center">
                    <button 
                        @click="decrement(item.id)" 
                        class="px-2 py-[0.20rem] sm:px-3 sm:py-1 bg-[#987F2D] text-sm sm:text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none"
                        :disabled="item.quantity <= 1">
                        -
                    </button>
                    <span class="mx-3 text-sm sm:text-xl noto-sans-devanagari-semibold">{{ item.quantity }}</span>
                    <button 
                        @click="increment(item.id)" 
                        class="px-2 py-[0.20rem] sm:px-3 sm:py-1 bg-[#987F2D] text-sm sm:text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none"
                        :disabled="item.quantity >= item.stock">
                        +
                    </button>
                </div>

                <button-component v-if="item.stock > 0 && item.price > 0" class="none" :icon="'build/client/images/heart.png'" :label="'Quero!'"></button-component>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    name: 'products',
    data() {
        return {
            items: [],
            category: null,
        };
    },
    methods: {
        async fetchProducts() {
            // Verifica a URL atual para ver se contém uma categoria
            const urlParams = new URLSearchParams(window.location.search);
            const categoryId = window.location.pathname.split('/').pop();
            
            const url = categoryId ?? `/api/produtos/${categoryId}`;
            const response = await axios.get('/api/produtos');

            try {
                if (url) {
                    const response = await axios.get(url);
                    
                }else{
                    const response = await axios.get('/api/produtos');
                }
                // const response = await axios.get(url);
                this.items = response.data.map(item => ({
                    ...item,
                    quantity: 1, // Começa com 1 no carrinho
                    stock: item.stock, // Estoque real do backend
                    outOfStock: item.stock <= 0, // Verifica se está esgotado
                }));
            } catch (error) {
                console.error('Erro ao buscar os produtos:', error);
            }
        },
        increment(id) {
            const item = this.items.find(item => item.id === id);
            if (item && item.quantity < item.stock) {
                item.quantity++;
            }
        },
        decrement(id) {
            const item = this.items.find(item => item.id === id);
            if (item && item.quantity > 1) {
                item.quantity--;
            }
        },
    },
    mounted() {
        this.fetchProducts();
    }
}
</script>


<style>
    @media screen and (max-width: 416px) {
        .box-products {
            grid-template-columns: repeat(1, 1fr);
        }
    }
    @media screen and (min-width: 1441px) {
        .box-products{
            grid-template-columns: repeat(4, 1fr);
        }
    }
    .count-item button, .btn__buy {
        transition: background-color 0.3s;
    }
    .count-item button:disabled {
        background-color: #987F2D;
        cursor: not-allowed;
    }
    .tag i{
        font-style: normal;
    }
</style>