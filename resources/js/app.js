import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import Toast, { useToast } from 'vue-toastification';
import 'vue-toastification/dist/index.css';

// Importando os componentes
import Header from './components/Header.vue';
import Slide from './components/SlideCarousel.vue';
import ProductCategory from './components/ProductCategories.vue';
import Products from './components/ProductBox.vue';
import ProductFilter from './components/ProdutctFilter.vue';
import OrderSummary from './components/OrderSummary.vue';
import Cart from './components/Cart.vue';
import Newslleter from './components/Newslleter.vue';
import Button from './components/Button.vue';
import Footer from './components/Footer.vue';
import BannerInner from './components/BannerInner.vue';
import FinalizeOrder from './components/FinalizeOrder.vue';

// Importando o Pinia e a store
import { useCartStore } from '@/stores/cartStores';

// Verificando se o Inertia App existe
if (typeof createInertiaApp !== 'undefined') {
  createInertiaApp({
    resolve: name => {
      const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
      return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
      createApp({ render: () => h(App, props) })
        .use(plugin)
        .mount(el);
    },
  });
}

const app = createApp();

// Criando o Pinia
const pinia = createPinia();
app.use(pinia);
app.use(Toast);

// Carregando o cart com o Pinia no ciclo de vida do Vue
app.mixin({
  mounted() {
    const cartStore = useCartStore();
    cartStore.loadCart(); // Carrega o carrinho do localStorage ao iniciar
  }
});

// Registrando componentes globais
app.component('header-component', Header);
app.component('slide-carousel-component', Slide);
app.component('product-category-component', ProductCategory);
app.component('products-component', Products);
app.component('newslleter-component', Newslleter);
app.component('button-component', Button);
app.component('footer-component', Footer);
app.component('banner-inner-component', BannerInner);
app.component('product-filter-component', ProductFilter);
app.component('cart-component', Cart);
app.component('order-summary-component', OrderSummary);
app.component('finalize-order-component', FinalizeOrder);

// Montando o aplicativo
app.mount('#app');
