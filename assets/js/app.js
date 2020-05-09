import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import { store } from './vuex/store';
import Vuex from 'vuex';
import ElementUI from 'element-ui';
import VueRouter from "vue-router";
import routerApp from './router'

import 'bootstrap/dist/css/bootstrap.css';
import 'admin-lte/dist/css/adminlte.min.css';
import 'element-ui/lib/theme-chalk/index.css';

import 'vue-awesome/dist/vue-awesome';
import 'vue-awesome/icons';
import Icon from "vue-awesome/components/Icon";
import routes from "./router/routes";

Vue.component("v-icon", Icon);

Vue.use(Vuex);
Vue.use(ElementUI);
Vue.use(VueRouter);

Vue.config.productionTip = false;
Vue.prototype.$http = axios;

new Vue({
    el: '#app',
    router: routerApp,
    store,
    template: '<App/>',
    components: {App},
});

