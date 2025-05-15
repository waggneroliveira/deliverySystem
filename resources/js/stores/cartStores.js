import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
    state: () => ({
        cart: [],
    }),
    getters: {
        cartCount: (state) => state.cart.reduce((total, item) => total + item.quantity, 0),
    },
    actions: {
        addToCart(item) {
            const existingItem = this.cart.find(cartItem => cartItem.id === item.id);

            if (existingItem) {
                existingItem.quantity += item.quantity;
            } else {
                this.cart.push({ ...item });
            }

            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        updateQuantity(id, quantity) {
            const item = this.cart.find(item => item.id === id);
            if (item && quantity >= 1 && quantity <= item.stock) {
                item.quantity = quantity;
                localStorage.setItem('cart', JSON.stringify(this.cart)); // Salva no localStorage
            }
        },
        removeFromCart(id) {
            this.cart = this.cart.filter(item => item.id !== id);
            localStorage.setItem('cart', JSON.stringify(this.cart)); // Atualiza no localStorage
        },

        loadCart() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                this.cart = JSON.parse(savedCart);
            }
        }
    }
});
