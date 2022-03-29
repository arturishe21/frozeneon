require('./bootstrap');

import Vue from 'vue/dist/vue.esm.js';
window.Vue = require('vue');
import Vuex from 'vuex'

import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'

import App from './components/App.vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import store from "./store";
import Comment from './components/partials/Comment'

Vue.component('comment', Comment);
Vue.use(VModal)

Vue.use(VueAxios, axios);
Vue.use(Vuex);

const app = new Vue({
    el: '#app',
    store : new Vuex.Store(store),
    render: h => h(App),
});