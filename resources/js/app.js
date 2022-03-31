require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'material-icons/iconfont/material-icons.css';
import Cart from './components/Cart.vue';

import { createApp } from 'vue';

createApp({
    components:{    
    "Cart": Cart,
    }
    
}).mount('#app');