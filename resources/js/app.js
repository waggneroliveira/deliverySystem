import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import Toast, { useToast } from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import { useCartStore } from '@/stores/cartStores';// Importando o Pinia e a store

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
const pinia = createPinia();// Criando o Pinia
app.use(pinia);
app.use(Toast);

// Carregando o cart com o Pinia no ciclo de vida do Vue
app.mixin({
  mounted() {
    const cartStore = useCartStore();
    cartStore.loadCart(); // Carrega o carrinho do localStorage ao iniciar
  }
});

// Registro automático de componentes Vue 3 + Vite (com nome em kebab-case e sufixo -component)
function toKebabCase(str) {
  return str
    .replace(/([a-z])([A-Z])/g, '$1-$2')
    .replace(/([A-Z])([A-Z][a-z])/g, '$1-$2')
    .toLowerCase();
}
const modules = import.meta.glob('./components/*.vue', { eager: true });
Object.entries(modules).forEach(([path, module]) => {
  let name = path.split('/').pop().replace('.vue', '');
  name = toKebabCase(name) + '-component';
  app.component(name, module.default);
});

// Montando o aplicativo
app.mount('#app');
