<script setup>
    import { computed } from 'vue';
    import { useCartStore } from '@/stores/cartStores';

    const cartStore = useCartStore();

    // Soma total dos produtos (preço * quantidade)
    const productsTotal = computed(() =>
        cartStore.cart.reduce((total, item) => total + (item.price * item.quantity), 0)
    );

    // Exemplo fixo de taxa e troco (depois pode vir do store ou props)
    const troco = 0;
    const taxa = 0;

    // Total geral (produtos + taxa - troco)
    const total = computed(() => productsTotal.value + taxa - troco);
</script>

<template>
    <div class="order-summary bg-[#031D40] text-white p-4 w-full relative">
        <span class="rounded-full bg-[#CF1E0C] w-[41px] h-[41px] absolute top-[-20px] left-1/2 transform -translate-x-1/2"></span>

        <div class="w-[90%] m-auto pt-[20px] sm:pt-[41px] pb-0 sm:pb-[25px]">
            <h2 class="text-center text-lg text-[0.938rem] sm:text-[1.25rem] noto-sans-devanagari-semibold mb-4">Resumo do pedido</h2>
            
            <!-- Produtos -->
            <div class="flex justify-between mb-3 pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[0.938rem] sm:text-[1.125rem] text-[#FFF]">Produtos:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[0.875rem] sm:text-[1.125rem]">€ {{ productsTotal.toFixed(2) }}</span>
            </div>
            
            <!-- Troco -->
            <div class="flex justify-between mb-3 pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[0.938rem] sm:text-[1.125rem] text-[#FFF]">Troco:</span>
                <span class="bg-[#987F2D] text-white px-4 py-0 leading-[23px] text-[0.875rem] sm:text-[1.125rem]">Sim</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[0.875rem] sm:text-[1.125rem]">€ {{ troco.toFixed(2) }}</span>
            </div>
            
            <!-- Taxa -->
            <div class="flex justify-between pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[0.938rem] sm:text-[1.125rem] text-[#FFF]">Taxa:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[0.875rem] sm:text-[1.125rem]">€ {{ taxa.toFixed(2) }}</span>
            </div>
            
            <!-- Total -->
            <div class="flex justify-between mt-5 mb-4 pt-2 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-semibold text-[0.938rem] sm:text-[1.375rem] text-[#FFF]">Total:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[1.125rem] sm:text-[1.375rem]">€ {{ total.toFixed(2) }}</span>
            </div>
            
            <!-- Endereço -->
            <div class="mb-4 gap-7 flex justify-between items-baseline">
                <span class="inline-block noto-sans-devanagari-medium text-[0.938rem] sm:text-[1.125rem] text-[#FFF]">Entrega:</span>
                <span class="text-sm noto-sans-devanagari-light leading-[15px] sm:leading-[23px] text-[0.594rem] sm:text-[0.938rem] text-[#FFF]">Apartado 1, Freixo de Espada À Cinta 5181-909 FREIXO DE ESPADA À CINTA</span>
            </div>
            
            <div class="flex justify-center items-center mt-9 btn-go">
                <button class="w-full max-w-[141.1px] bg-[#CF1E0C] hover:bg-red-700 text-white py-2 rounded font-bold">Avançar</button>
            </div>
        </div>
    </div>
</template>
