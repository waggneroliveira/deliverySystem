<template>
    <div class="box-products cart flex flex-row gap-4 m-auto w-full max-w[79.188rem]">
        <div class="box-product__content rounded-tl-[0rem] rounded-tr-[0rem] rounded-br-[1.25rem] rounded-bl-[1.25rem] w-100 relative pt-[0.5rem] pr-[1.5625rem] pb-[1.296rem] pl-[1.5625rem] border border-[#CF1E0C] border-solid" v-for="(item, index) in items" :key="index">
            <div class="box-product__image relative flex items-center justify-center w-full max-w-[362.89px] m-auto h-[215.68px] overflow-hidden">
                <div class="tag z-10 absolute top-[1.125rem] h-[2.125rem] left-0 bg-[#CF1E0C] text-[#FFF] w-[5.063rem] flex justify-center items-center">
                   <i class="w-full h-100 flex items-center justify-center mt-[0.188rem] noto-sans-devanagari-regular">{{ item.tag }}</i> 
                </div>
                <img :src="item.image" alt="Product Image" class="w-full h-full object-cover transition-transform duration-700 ease-in-out transform hover:scale-110">
            </div>
            <div class="box-product__description flex flex-wrap text-left items-center gap-[1.514rem] max-w-[362.89px] m-auto">
                <div class="box-product__description--content w-full flex flex-wrap justify-between mt-[1.363rem]">
                    <h4 class="box-product__description--title text-[1.25rem] text-[#4C3A36] w-100 noto-sans-devanagari-semibold">{{ item.title }}</h4>
                    <div class="box-product__description--content__price flex gap-2">
                        <div class="box-product__description--content__price__old-price text-[#4C3A36] tex-[1.125rem] line-through noto-sans-devanagari-light">R$ {{ item.oldPrice }}</div>
                        <div class="box-product__description--content__price__price text-[#CF1E0C] text-[1.25rem] noto-sans-devanagari-semibold">R$ {{ item.price }}</div>
                    </div>
                </div>
                <div class="box-product__description--text w-100">
                    <p class="text-[#4C3A36] text-[18px] noto-sans-devanagari-regular">{{ item.text }}</p>
                </div>
            </div>
            <div class="actions flex items-center justify-between mt-[2.5rem] max-w-[362.89px] m-auto">
                <div class="count-item flex items-center">
                    <!-- Botão de decremento -->
                    <button 
                    @click="decrement(item.id)" 
                    class="px-3 py-1 bg-[#987F2D] text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none">
                    -
                    </button>
                    
                    <!-- Quantidade de itens -->
                    <span class="mx-3 text-xl noto-sans-devanagari-semibold">{{ item.quantity }}</span>
                    
                    <!-- Botão de incremento -->
                    <button 
                    @click="increment(item.id)" 
                    class="px-3 py-1 bg-[#987F2D] text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none">
                    +
                    </button>
                </div>

                <button-component :icon="'build/client/images/heart.png'" :label="'Quero!'"></button-component>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'cart',
    data(){
        return {
            font: "MontaguFontExample",           
            items:[
                {
                    id: 1,
                    title: 'SUSHI TAMAKI',
                    image: 'build/client/images/teste.jpg',                    
                    text: 'Salmão, camarão panado, queijo creme, cebolinho, olho francês e molho tarê',
                    price: '59,90', 
                    oldPrice: '79,00', 
                    tag: '50'+'%'+' off',
                    quantity: 1
                },
                {
                    id: 2,
                    title: 'SUSHI TAMAKI 02',
                    image: 'build/client/images/product.png',                    
                    text: 'Salmão, camarão panado, queijo creme, cebolinho, olho francês e molho tarê',
                    price: '59,90', 
                    oldPrice: '79,00', 
                    tag: '50'+'%'+' off',
                    quantity: 1
                },
                {
                    id: 3,
                    title: 'SUSHI TAMAKI 03',
                    image: 'build/client/images/product.png',                    
                    text: 'Salmão, camarão panado, queijo creme, cebolinho, olho francês e molho tarê',
                    price: '59,90', 
                    oldPrice: '79,00', 
                    tag: '50'+'%'+' off',
                    quantity: 1
                },
                {
                    id: 4,
                    title: 'SUSHI TAMAKI 04',
                    image: 'build/client/images/product.png',                    
                    text: 'Salmão, camarão panado, queijo creme, cebolinho, olho francês e molho tarê',
                    price: '59,90', 
                    oldPrice: '79,00', 
                    tag: '50'+'%'+' off',
                    quantity: 1
                },
                {
                    id: 5,
                    title: 'SUSHI TAMAKI 05',
                    image: 'build/client/images/product.png',                    
                    text: 'Salmão, camarão panado, queijo creme, cebolinho, olho francês e molho tarê',
                    price: '59,90', 
                    oldPrice: '79,00', 
                    tag: '50'+'%'+' off',
                    quantity: 1
                },
                {
                    id: 6,
                    title: 'SUSHI TAMAKI 06',
                    image: 'build/client/images/product.png',                    
                    text: 'Salmão, camarão panado, queijo creme, cebolinho, olho francês e molho tarê',
                    price: '59,90', 
                    oldPrice: '79,00', 
                    tag: '50'+'%'+' off',
                    quantity: 1
                },
            ],            
        };
    },
    methods: {
        increment(id) {
        const item = this.items.find(item => item.id === id);
        if (item) item.quantity++;
        },
        decrement(id) {
        const item = this.items.find(item => item.id === id);
        if (item && item.quantity > 1) item.quantity--;
        },
    },
}
</script>

<style>
    @media screen and (max-width: 516px) {
        .box-products {
            grid-template-columns: repeat(1, 1fr);
        }
    }
    @media screen and (max-width: 415px) {
        .box-product__content {
            max-width: 320px;
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