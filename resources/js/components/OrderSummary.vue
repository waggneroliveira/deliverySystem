<template>
    <div class="order-summary bg-[#031D40] text-white p-4 w-full relative">
        <span class="rounded-full bg-[#CF1E0C] w-[41px] h-[41px] absolute top-[-20px] left-1/2 transform -translate-x-1/2"></span>

        <div class="w-[90%] m-auto pt-[20px] sm:pt-[41px] pb-0 sm:pb-[25px]">
            <h2 class="text-center text-lg text-[0.938rem] sm:text-[1.25rem] noto-sans-devanagari-semibold mb-4">Resumo do pedido</h2>
            
            <!-- Produtos -->
            <div class="flex justify-between mb-3 pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[0.938rem] sm:text-[1.125rem] text-[#FFF]">Produtos:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[0.875rem] sm:text-[1.125rem]">{{ formatEuro(productsTotal.toFixed(2)) }}</span>
            </div>
            
            <!-- Troco -->
            <div class="flex justify-between mb-3 pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[0.938rem] sm:text-[1.125rem] text-[#FFF]">Troco:</span>
                <span class="bg-[#987F2D] text-white px-4 py-0 leading-[23px] text-[0.875rem] sm:text-[1.125rem]">Sim</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[0.875rem] sm:text-[1.125rem]">{{ formatEuro(troco.toFixed(2)) }}</span>
            </div>
            
            <!-- Taxa -->
            <div class="flex justify-between pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[0.938rem] sm:text-[1.125rem] text-[#FFF]">Taxa:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[0.875rem] sm:text-[1.125rem]">{{ formatEuro(taxa.toFixed(2)) }}</span>
            </div>
            
            <!-- Total -->
            <div class="flex justify-between mt-5 mb-4 pt-2 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-semibold text-[0.938rem] sm:text-[1.375rem] text-[#FFF]">Total:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[1.125rem] sm:text-[1.375rem]">{{ formatEuro(total.toFixed(2)) }}</span>
            </div>
            
            <!-- Endereço -->
            <div class="mb-4 gap-7 flex justify-between items-baseline">
                <span class="inline-block noto-sans-devanagari-medium text-[0.938rem] sm:text-[1.125rem] text-[#FFF]">Entrega:</span>
                <span class="text-sm noto-sans-devanagari-light leading-[15px] sm:leading-[23px] text-[0.594rem] sm:text-[0.938rem] text-[#FFF]">Apartado 1, Freixo de Espada À Cinta 5181-909 FREIXO DE ESPADA À CINTA</span>
            </div>
            
            <div v-if="showButton" class="flex justify-center items-center mt-9"><!-- class -> btn-go -->
                <button
                    :disabled="!hasProducts"
                    :class="[
                        'w-full max-w-[141.1px] py-2 rounded font-bold',
                        hasProducts ? 'bg-[#CF1E0C] hover:bg-red-700 cursor-pointer' : 'bg-gray-400 opacity-50 cursor-not-allowed'
                    ]"
                    @click="goToCheckout"
                >
                    Avançar
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { computed } from 'vue';
    import { useCartStore } from '@/stores/cartStores';

    const cartStore = useCartStore();

    const showButton = computed(() => window.location.pathname !== '/finalizar-pedido')

    const productsTotal = computed(() =>
        cartStore.cart.reduce((total, item) => total + (item.price * item.quantity), 0)
    );

    const troco = 0;
    const taxa = 0;

    const total = computed(() => productsTotal.value + taxa - troco);
    
    const formatEuro = (value) => {
        return new Intl.NumberFormat('pt-PT', {
            style: 'currency',
            currency: 'EUR',
            minimumFractionDigits: 2
        }).format(value);
    };

    const hasProducts = computed(() => cartStore.cart.length > 0);

    function goToCheckout() {
        if (hasProducts.value) {
            window.location.href = '/finalizar-pedido';
        }
    }
</script>