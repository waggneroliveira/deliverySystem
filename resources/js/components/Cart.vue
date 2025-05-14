<template>
    <div class="remove-selected flex flex-row justify-between items-center mb-6 h-[35px]">
        <div class="flex flex-row justify-start gap-4 items-center">
            <a href="/" class="text-[#FFF] text-[0.75rem] sm:text-[1.125rem] bg-[#987F2D] h-[25px] sm:h-[35px] w-auto px-4 flex justify-center items-center gap-2 hover:bg-[#b8982c] noto-sans-devanagari-regular"><span><</span> Voltar</a>
            
            <form @submit.prevent="removeSelected">
                <button-component v-if="selectedItems.length >= 2" type="submit" btnClass="w-auto h-[25px] sm:h-[35px] px-3 sm:px-8 bg-[#CF1E0C] hover:bg-red-700 text-[0.75rem] sm:text-[1.125rem]" imgClass="!w-[0.825rem]" :icon="'build/client/images/trash.png'" :label="'Remover'"></button-component>
            </form>
        </div>

        <div class="selected-all flex justify-center items-center gap-1 sm:gap-4">
            <label for="selectAll" class="noto-sans-devanagari-thin text-[0.75rem] sm:text-[1.125rem] text-[#000]">Selecionar todos</label>
            <input type="checkbox" id="selectAll" @change="toggleSelectAll" :checked="allSelected">
        </div>
    </div>

    <div class="box-products cart">
        <div class="box-product__content flex flex-row flex-wrap gap-4 w-full rounded-r-[20px] relative mb-5 w-100 !max-w-full sm:max-w-[320px] pt-[0.5rem] p-[0.75rem] sm:pr-[1.5625rem] pb-[0.5rem] sm:pb-[1.296rem] pl-[0.75rem] sm:pl-[1.5625rem] border border-[#CF1E0C] border-solid"
            v-for="(item, index) in items" :key="item.id">
            
            <div class="box-product__image flex items-center justify-center w-[60px] sm:w-[120px] h-[60px] sm:h-[120px] overflow-hidden">
                <img :src="item.image" alt="Product Image" class="w-full h-full object-cover transition-transform duration-700 ease-in-out transform hover:scale-110">
            </div>
            
            <div class="flex-1 flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" class="w-4 h-4" :value="item.id" v-model="selectedItems">
                        <h4 class="box-product__description--title text-[0.813rem] sm:text-[1.25rem] text-[#4C3A36] w-100 noto-sans-devanagari-semibold leading-none mt-1">{{ item.title }}</h4>
                    </div>
                    <button-component btnClass="!w-full !h-[28px] rounded-md" imgClass="!w-[10px] !sm:w-[0.825rem]" :icon="'build/client/images/trash.png'" :label="''" @click="removeItem(item.id)"></button-component>
                </div>
                
                <div class="flex gap-2 text-sm">
                    <span
                        v-if="item.oldPrice && parseFloat(item.oldPrice) > 0"
                        class="box-product__description--content__price__old-price text-[#4C3A36] text-[0.75rem] sm:text-[1.125rem] line-through noto-sans-devanagari-light">
                        R$ {{ item.oldPrice }}
                    </span>
                    <span
                        class="box-product__description--content__price__price text-[#CF1E0C] text-[0.938rem] sm:text-[1.25rem] noto-sans-devanagari-semibold">
                        R$ {{ item.price }}
                    </span>
                </div>

                
                <p class="text-[#4C3A36] text-[0.625rem] sm:text-[1.5rem] noto-sans-devanagari-regular" v-html="item.text"></p>
                
                <div class="flex items-center justify-between mt-3">
                    <div class="flex items-center gap-0 sm:gap-2">
                        <button @click="decrement(item.id)" class="px-2 py-[0.20rem] sm:px-3 sm:py-1 bg-[#987F2D] text-sm sm:text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none">-</button>
                        <span class="mx-3 text-sm sm:text-xl noto-sans-devanagari-semibold">{{ item.quantity }}</span>
                        <button @click="increment(item.id)" class="px-2 py-[0.20rem] sm:px-3 sm:py-1 bg-[#987F2D] text-sm sm:text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useCartStore } from '@/stores/cartStores';
    import { computed, ref } from 'vue';

    const cartStore = useCartStore();
    const items = computed(() => cartStore.cart); // Itens do carrinho (reativo via store)
    const selectedItems = ref([]); // Itens selecionados para remoção
    const allSelected = computed(() => selectedItems.value.length === items.value.length); // Selecionar todos

    function toggleSelectAll() {
        if (allSelected.value) {
            selectedItems.value = [];
        } else {
            selectedItems.value = items.value.map(item => item.id);
        }
    }

    // Remover selecionados do carrinho
    function removeSelected() {
        selectedItems.value.forEach(id => cartStore.removeFromCart(id));
        selectedItems.value = [];
    }

    // Remover item individual do carrinho
    function removeItem(id) {
        cartStore.removeFromCart(id);
    }

    // Incrementar quantidade
    function increment(id) {
        const item = cartStore.cart.find(item => item.id === id);
        if (item && item.quantity < item.stock) {
            item.quantity++;
            cartStore.updateLocalStorage(); // Se tem persistência
        }
    }
    // Decrementar quantidade (mínimo 1)
    function decrement(id) {
        const item = cartStore.cart.find(item => item.id === id);
        if (item && item.quantity > 1) {
            item.quantity--;
            cartStore.updateLocalStorage();
        }
    }


    // Props (ex: voltar para a loja)
    const props = defineProps({
        redirectBack: {
            type: String,
            required: true
        }
    });
</script>

<style>
    @media screen and (max-width: 416px) {
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