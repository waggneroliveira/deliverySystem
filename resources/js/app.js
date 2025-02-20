import './bootstrap';
import App from './components/App.vue';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import VueSplide from '@splidejs/vue-splide';
import Header from './components/Header.vue';
import Splide from './components/SplideCarousel.vue';
import ProductCategory from './components/ProductCategories.vue';
import Products from './components/ProductBox.vue';

if (typeof createInertiaApp !== 'undefined') {
  createInertiaApp({
    resolve: name => {
      const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
      return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
      createApp({ render: () => h(App, props) })
        .use(plugin)
        .mount(el)
    },
  })
}

const app = createApp();
app.component('app', App);
app.component('header-component', Header);
app.component('splide-carousel', Splide);
app.component('product-category', ProductCategory);
app.component('products', Products);
app.use( VueSplide );

app.mount('#app');