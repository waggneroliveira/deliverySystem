<template>
    <div class="box-products cart">
        <div class="box-product__content flex flex-row flex-wrap gap-4 w-full rounded-r-[20px] relative mb-5 px-8 py-5 border border-[#CF1E0C] border-solid bg-gray-100"
            v-for="(item, index) in items" :key="index">
            
            <!-- Imagem do produto -->
            <div class="box-product__image flex items-center justify-center w-[120px] h-[120px] overflow-hidden">
                <img :src="item.image" alt="Product Image" class="w-full h-full object-cover transition-transform duration-700 ease-in-out transform hover:scale-110">
            </div>
            
            <!-- Descrição do produto -->
            <div class="flex-1 flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" class="w-4 h-4">
                        <h4 class="box-product__description--title text-[1.25rem] text-[#4C3A36] w-100 noto-sans-devanagari-semibold leading-none mt-1">{{ item.title }}</h4>
                        
                    </div>
                    <!-- Botão Remover -->
                    <button-component btnClass="w-[28px] h-[28px] rounded-md" imgClass="!w-[0.825rem]" :icon="'build/client/images/trash.png'" :label="''"></button-component>       
                </div>
                
                <div class="flex gap-2 text-sm">
                    <span class="box-product__description--content__price__old-price text-[#4C3A36] tex-[1.125rem] line-through noto-sans-devanagari-light">R$ {{ item.oldPrice }}</span>
                    <span class="box-product__description--content__price__price text-[#CF1E0C] text-[1.25rem] noto-sans-devanagari-semibold">R$ {{ item.price }}</span>
                </div>
                
                <p class="text-[#4C3A36] text-[15px] noto-sans-devanagari-regular">{{ item.text }}</p>
                
                <!-- Área de ações -->
                <div class="flex items-center justify-between mt-3">
                    <!-- Controle de Quantidade -->
                    <div class="flex items-center gap-2">
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
                </div>
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
                }
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