import './bootstrap';
import App from './components/App.vue';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Header from './components/Header.vue';
import Slide from './components/SlideCarousel.vue';
import ProductCategory from './components/ProductCategories.vue';
import Products from './components/ProductBox.vue';
import Newslleter from './components/Newslleter.vue';
import Button from './components/Button.vue';
import Footer from './components/Footer.vue';
import BannerInner from './components/BannerInner.vue';

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
app.component('slide-carousel-component', Slide);
app.component('product-category-component', ProductCategory);
app.component('products-component', Products);
app.component('newslleter-component', Newslleter);
app.component('button-component', Button);
app.component('footer-component', Footer);
app.component('banner-inner-component', BannerInner);

app.mount('#app');