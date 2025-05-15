<template>
  <transition name="fade-slide">
    <div v-if="cartCount > 0" class="fixed bottom-4 right-4 z-50">
      <button
        class="bg-green-600 text-white px-4 py-2 rounded-full shadow-lg flex items-center gap-2 hover:bg-green-700 transition"
        @click="goToCart"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.5H19M7 13l-2 4m0 0a1 1 0 102 0m10 0a1 1 0 102 0" />
        </svg>
        Ver Carrinho ({{ cartCount }}) - {{ totalPriceFormatted }}
      </button>
    </div>
  </transition>
</template>

<script setup>
    import { computed } from 'vue';
    import { useCartStore } from '@/stores/cartStores';

    const cartStore = useCartStore();
    const cartCount = computed(() => cartStore.cartCount);// Total de itens no carrinho

    // Calcular o valor total do carrinho
    const totalPrice = computed(() =>
        cartStore.cart.reduce((total, item) => total + (item.price * item.quantity), 0)
    );

    // Formatar o valor para BRL (R$)
    // const totalPriceFormatted = computed(() =>
    //     totalPrice.value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
    // );
    
    // Formatar o valor para EUR (€)
    const totalPriceFormatted = computed(() =>
    totalPrice.value.toLocaleString('pt-PT', { style: 'currency', currency: 'EUR' })
);


    // Redirecionar para a rota /carrinho
    const goToCart = () => {
    window.location.href = '/carrinho';
    };
</script>

<style scoped>
    .fade-slide-enter-active, .fade-slide-leave-active {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .fade-slide-enter-from, .fade-slide-leave-to {
        opacity: 0;
        transform: translateY(20px);
    }
</style>
