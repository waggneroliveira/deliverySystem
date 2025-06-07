<template>
    <div class="remove-selected flex flex-row justify-between items-center mb-6 h-[35px]">
        <div class="flex flex-row justify-start gap-4 items-center">
            <a href="/" class="text-[#FFF] rounded text-[0.75rem] sm:text-[1.125rem] bg-[#987F2D] h-[25px] sm:h-[35px] w-auto px-4 flex justify-center items-center gap-2 hover:bg-[#b8982c] noto-sans-devanagari-regular"><span><</span> Voltar</a>
            
            <form @submit.prevent="removeSelected">
                <button-component v-if="selectedItems.length >= 2" type="submit" btnClass="w-auto h-[25px] sm:h-[35px] px-3 sm:px-8 bg-[#CF1E0C] hover:bg-red-700 text-[0.75rem] sm:text-[1.125rem]" imgClass="!w-[0.825rem]" :icon="'build/client/images/trash.png'" :label="'Remover'"></button-component>
            </form>
        </div>
        <div v-if="items.length > 1">
            <div class="selected-all flex justify-center items-center gap-1 sm:gap-4">
                <label for="selectAll" class="noto-sans-devanagari-thin text-[0.75rem] sm:text-[1.125rem] text-[#000]">Selecionar todos</label>
                <input type="checkbox" id="selectAll" @change="toggleSelectAll" :checked="allSelected">
            </div>
        </div>
    </div>
    
    <div class="box-products cart">
        <div v-if="items.length">
            <div class="box-product__content flex flex-row flex-wrap gap-4 w-full rounded-r-[20px] relative mb-5 w-100 !max-w-full sm:max-w-[320px] pt-[0.5rem] p-[0.75rem] sm:pr-[1rem] pb-[0.5rem] sm:pb-[0.5rem] pl-[0.75rem] sm:pl-[1rem] border border-[#CF1E0C] border-solid"
                v-for="(item, index) in items" :key="item.id">
                
                <div class="box-product__image flex items-center justify-center w-[75px] sm:w-[120px] h-[90px] sm:h-[155px] overflow-hidden">
                    <div v-if="item.promotion" class="tag z-10 absolute top-[1.125rem] h-[1.25rem] sm:h-[2.125rem] left-0 bg-[#CF1E0C] text-[#FFF] w-[3.000rem] sm:w-[5.063rem] flex justify-center items-center">
                        <i class="w-full h-100 flex items-center justify-center text-[0.625rem] sm:text-[0.938rem] mt-[0.188rem] noto-sans-devanagari-regular">{{ item.tag }}</i>
                    </div>
                    <img loading="lazy" :src="item.image" alt="Product Image" class="w-full h-full object-cover transition-transform duration-700 ease-in-out transform hover:scale-110">
                </div>
                
                <div class="flex-1 flex flex-col gap-1 sm:gap-2">
                    <div class="flex flex-col items-start justify-between">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" class="w-4 h-4" :value="item.id" v-model="selectedItems">
                            <h4 class="box-product__description--title text-[0.75rem] sm:text-[1.25rem] uppercase text-[#4C3A36] w-100 noto-sans-devanagari-semibold leading-none mt-1">{{ item.title }}</h4>

                        </div>
                        <i @click="removeItem(item.id)" class="text-[#CF1E0C] text-[0.75rem] sm:text-[1.25rem] noto-sans-devanagari-semibold mt-2 cursor-pointer">Excluir</i>
                    </div>
                    
                    <div class="box-product__description--text w-100">
                        <p class="text-[#4C3A36] text-[0.938rem] hidden md:block sm:text-[1.25rem] noto-sans-devanagari-regular" v-html="truncate(stripTags(item.text), 100)"></p>
                    </div>
                    
                    <div class="flex items-center justify-between mt-1">
                        <div class="flex items-center gap-0 sm:gap-2">
                            <button @click="decrement(item.id)" class="px-2 py-[0.10rem] sm:px-3 sm:py-1 bg-[#987F2D] text-sm sm:text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none">-</button>
                            <span class="mx-3 text-sm sm:text-xl noto-sans-devanagari-semibold">{{ item.quantity }}</span>
                            <button @click="increment(item.id)" class="px-2 py-[0.10rem] sm:px-3 sm:py-1 bg-[#987F2D] text-sm sm:text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none">+</button>
                        </div>
                        <div class="flex gap-2 text-sm">
                            <div
                                v-if="item.oldPrice && parseFloat(item.oldPrice) > 0"
                                class="box-product__description--content__price__old-price mt-[-2.5px] text-[#4C3A36] text-[0.75rem] sm:text-[0.938rem] line-through noto-sans-devanagari-light">
                                {{ formatPrice(item.oldPrice) }}
                            </div>
                            <div
                                class="box-product__description--content__price__price text-[#CF1E0C] text-[1.063rem] sm:text-[1.25rem] noto-sans-devanagari-semibold">
                                {{ formatPrice(item.price) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="flex flex-col items-center justify-center text-center gap-3 py-5 px-0">
            <div class=" w-full flex flex-col items-center justify-center text-center py-3 border border-[#CF1E0C] bg-[#FFE5E5] text-[#CF1E0C] rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-[35px] w-[35px]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.5H19M7 13l-2 4m0 0a1 1 0 102 0m10 0a1 1 0 102 0" />
                </svg>

                <h3 class="text-lg sm:text-xl font-semibold mb-1">Seu carrinho está vazio</h3>
                <p class="text-sm sm:text-base text-[#CF1E0C] mb-0 w-full">
                    Explore nossos produtos e adicione ao carrinho para continuar.
                </p>
            </div>

            <button
                @click="goToProducts"
                class="bg-[#CF1E0C] hover:bg-red-700 text-white px-6 py-2 rounded text-sm sm:text-base transition">
                Ver produtos
            </button>
        </div>

    </div>

</template>

<script setup>
    import { useCartStore } from '@/stores/cartStores';
    import { computed, ref, onMounted } from 'vue';
    import { useToast } from 'vue-toastification';  // <-- Importa o toast

    const cartStore = useCartStore();
    const toast = useToast(); // <-- Inicializa o toast

    onMounted(() => {
        cartStore.loadCart();
    });

    const items = computed(() => cartStore.cart);
    const selectedItems = ref([]);
    const allSelected = computed(() => selectedItems.value.length === items.value.length);

    function stripTags(text) {
        return text.replace(/<\/?[^>]+(>|$)/g, "");
    }

    function truncate(text, length) {
        if (!text) return '';
        return text.length > length ? text.substring(0, length) + '...' : text;
    }


    // Formatar para EUR
    function formatPrice(value) {
        if (!value) return '€ 0,00';
        return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(value);
    }

    function toggleSelectAll() {
        if (allSelected.value) {
            selectedItems.value = [];
        } else {
            selectedItems.value = items.value.map(item => item.id);
        }
    }

    function removeSelected() {
        // Mostra toast para cada item removido
        selectedItems.value.forEach(id => {
            const item = cartStore.cart.find(i => i.id === id);
            if (item) {
                toast.success(`"${item.title}" foi removido do carrinho!`, {
                    timeout: 3000,
                    position: 'top-right',
                    closeOnClick: true,
                    pauseOnHover: true,
                });
            }
            cartStore.removeFromCart(id);
        });
        selectedItems.value = [];
    }

    function removeItem(id) {
        const item = cartStore.cart.find(i => i.id === id);
        cartStore.removeFromCart(id);

        if (item) {
            toast.success(`"${item.title}" foi removido do carrinho!`, {
                timeout: 3000,
                position: 'top-right',
                closeOnClick: true,
                pauseOnHover: true,
            });
        }
    }

    function increment(id) {
        const item = cartStore.cart.find(item => item.id === id);
        if (item && item.quantity < item.stock) {
            cartStore.updateQuantity(id, item.quantity + 1);
        }
    }

    function decrement(id) {
        const item = cartStore.cart.find(item => item.id === id);
        if (item && item.quantity > 1) {
            cartStore.updateQuantity(id, item.quantity - 1);
        }
    }
    const goToProducts = () => {
        window.location.href = '/produtos/';
    };

    const props = defineProps({
        redirectBack: {
            type: String,
            required: true
        }
    });
</script>



<style>

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
    .box-product__description--text p{
        font-size: 1.125rem;
    }
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
    @media screen and (max-width: 680px) {
        .box-product__description--content__price__price {
            font-weight: 800 !important;
        }
        .box-product__description--text p{
            font-size: 0.938rem;
        }
    }
</style>