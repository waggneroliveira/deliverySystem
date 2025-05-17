<template>
    <h1 v-if="isCategoryPage" class="text-[#CF1E0C] text-[1.125rem] sm:text-[1.875rem] uppercase noto-sans-devanagari-extrabold">
        {{ category }}
    </h1>
    <h1 v-else-if="isProductsPage" class="text-[#CF1E0C] text-[1.125rem] sm:text-[1.875rem] uppercase noto-sans-devanagari-extrabold">
        Todos os produtos
    </h1>

    <div v-if="isCategoryPage || isProductsPage" class="filter">
        <product-filter-component v-model="searchTerm"></product-filter-component>
    </div>

    <div class="box-products grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 m-auto w-full max-w[79.188rem]">
        <div
            v-for="(item) in filteredItems"
            :key="item.id"
            class="box-product__content rounded-tl-[0rem] rounded-tr-[0rem] rounded-br-[1.25rem] rounded-bl-[1.25rem] w-100 !max-w-full sm:max-w-[320px] relative pt-[0.5rem] p-[0.75rem] sm:pr-[1.5625rem] pb-[1.296rem] pl-[0.75rem] sm:pl-[1.5625rem] border border-[#CF1E0C] border-solid"
        >
            <div class="box-product__image relative flex items-center justify-center w-full max-w-[362.89px] m-auto h-[10.625rem] sm:h-[215.68px] overflow-hidden">
                <div v-if="item.promotion" class="tag z-10 absolute top-[1.125rem] h-[1.563rem] sm:h-[2.125rem] left-0 bg-[#CF1E0C] text-[#FFF] w-[3.600rem] sm:w-[5.063rem] flex justify-center items-center">
                    <i class="w-full h-100 flex items-center justify-center text-[0.75rem] sm:text-[0.938rem] mt-[0.188rem] noto-sans-devanagari-regular">{{ item.tag }}</i>
                </div>
                <img :src="item.image" alt="Product Image" class="w-full h-full object-cover transition-transform duration-700 ease-in-out transform hover:scale-110" />
            </div>

            <div class="box-product__description flex flex-wrap text-left items-center gap-[0.063rem] sm:gap-[1.514rem] max-w-[362.89px] m-auto">
                <div class="box-product__description--content w-full flex flex-wrap justify-between mt-[0.625rem] sm:mt-[1.363rem]">
                    <h4 class="box-product__description--title uppercase text-[0.75rem] sm:text-[1.25rem] text-[#4C3A36] w-100 noto-sans-devanagari-semibold">
                    {{ item.title }}
                    </h4>
                    <div class="box-product__description--content__price flex gap-2">
                        <div v-if="item.oldPrice > 0" class="box-product__description--content__price__old-price text-[#4C3A36] text-[0.75rem] sm:text-[0.938rem] line-through noto-sans-devanagari-light">
                            {{ formatPrice(item.oldPrice) }}
                        </div>
                        <div v-if="item.price > 0" class="box-product__description--content__price__price text-[#CF1E0C] text-[0.938rem] sm:text-[1.25rem] noto-sans-devanagari-semibold">
                            {{ formatPrice(item.price) }}
                        </div>
                    </div>
                </div>
                <div class="box-product__description--text w-100">
                    <div class="text-[#4C3A36] text-[0.938rem] sm:text-[1.25rem] noto-sans-devanagari-regular" v-html="truncate(stripTags(item.text), 120)"></div>
                </div>
            </div>

            <div class="actions flex items-center justify-between mt-[0.625rem] sm:mt-[2.5rem] max-w-[362.89px] m-auto">
                <div v-if="item.stock === 0" class="flex items-center rounded justify-center bg-red-500 text-white w-full text-[0.813rem] sm:text-[1.25rem] text-center h-[35px] py-2 px-4 font-bold">
                    Produto Esgotado
                </div>

                <div v-else-if="item.price == 0" class="bg-red-500 rounded text-white w-full text-[0.813rem] sm:text-[1.25rem] text-center h-[35px] py-2 px-4 font-bold">
                    Indisponível
                </div>

                <div v-else class="count-item flex items-center">
                    <button
                    @click="decrement(item.id)"
                    class="px-2 py-[0.20rem] sm:px-3 sm:py-1 bg-[#987F2D] text-sm sm:text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none"
                    :disabled="item.quantity <= 1"
                    >
                    -
                    </button>
                    <span class="mx-3 text-sm sm:text-xl noto-sans-devanagari-semibold">{{ item.quantity }}</span>
                    <button
                    @click="increment(item.id)"
                    class="px-2 py-[0.20rem] sm:px-3 sm:py-1 bg-[#987F2D] text-sm sm:text-lg rounded hover:bg-[#b8982c] text-[#FFF] focus:outline-none"
                    :disabled="item.quantity >= item.stock"
                    >
                    +
                    </button>
                </div>
                <button-component
                    v-if="item.stock > 0 && item.price > 0"
                    class="none"
                    :icon="'/build/client/images/heart.png'"
                    :label="'Quero!'"
                    @click="addToCart(item)"
                ></button-component>
            </div>
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import { ref, computed, onMounted } from 'vue';
    import { useCartStore } from '@/stores/cartStores';
    import { useToast } from 'vue-toastification';

    const cartStore = useCartStore();
    const toast = useToast();

    const items = ref([]);
    const category = ref(null);
    const isCategoryPage = ref(false);
    const isProductsPage = ref(false);
    const searchTerm = ref('');
    
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

    // Função para carregar produtos da API
    async function fetchProducts() {
        const pathname = window.location.pathname;
        const categorySlug = pathname.split('/').pop();

        isProductsPage.value = pathname === '/produtos/';
        isCategoryPage.value = !!categorySlug && pathname !== '/produtos/';

        category.value = isCategoryPage.value ? decodeURIComponent(categorySlug.replace(/-/g, ' ')) : null;

        const url = isCategoryPage.value ? `/api/produtos/${categorySlug}` : '/api/produtos-destaques';
        
        try {
            const response = await axios.get(url);
            items.value = response.data.map(item => ({
                ...item,
                quantity: 1,
                stock: item.stock,
                outOfStock: item.stock <= 0,
            }));
        } catch (error) {
            console.error('Erro ao buscar os produtos:', error);
        }
    }


    const filteredItems = computed(() => {
        if (!searchTerm.value) {
            return items.value;
        }
        const term = searchTerm.value.toLowerCase();
        return items.value.filter(item => item.title.toLowerCase().includes(term) || item.text.toLowerCase().includes(term));
    });

    function increment(id) {
        const item = items.value.find(item => item.id === id);
        if (item && item.quantity < item.stock) {
            item.quantity++;
        }
    }

    function decrement(id) {
        const item = items.value.find(item => item.id === id);
        if (item && item.quantity > 1) {
            item.quantity--;
        }
    }

    function addToCart(item) {
        if (!cartStore || !cartStore.cart) {
            console.error('cartStore não está inicializado corretamente');
            return;
        }

        cartStore.addToCart({ ...item, quantity: item.quantity });

        toast.success(`"${item.title}" foi adicionado ao carrinho!`, {
            timeout: 3000,
            position: 'top-right',
            closeOnClick: true,
            pauseOnHover: true,
        });

        item.quantity = 1;
    }

    onMounted(() => {
        fetchProducts();
    });

</script>

<style>    
    .box-product__description--text p{
        font-size: 1.125rem;
    }
    .count-item button,
    .btn__buy {
        transition: background-color 0.3s;
    }
    .count-item button:disabled {
        background-color: #987f2d;
        cursor: not-allowed;
    }
    .tag i {
        font-style: normal;
    }
    @media screen and (min-width: 1441px) {
        .box-products {
            grid-template-columns: repeat(4, 1fr);
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
        @media screen and (max-width: 416px) {
        .box-products {
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style>
