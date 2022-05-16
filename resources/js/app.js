require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'material-icons/iconfont/material-icons.css';
import Cart from './components/Cart.vue';
import Notifications from './components/Notifications.vue'

import { createApp } from 'vue';

createApp({
    components:{    
    "Cart": Cart,
    "Notifications": Notifications,
    }
    
}).mount('#app');