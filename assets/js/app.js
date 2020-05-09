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

Vue.component("v-icon", Icon);

Vue.use(Vuex);
Vue.use(ElementUI);
Vue.use(VueRouter);

Vue.config.productionTip = false;
Vue.prototype.$http = axios;

routerApp.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        console.log('route need authentication')
        if (store.getters.isAuthenticated !== false) {
            console.log('user is authenticated: ' + store.getters.isAuthenticated)
            next()
        } else {
            console.log('page should be redirect')
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        }
    } else {
        next()
    }
});

new Vue({
    el: '#app',
    router: routerApp,
    store,
    template: '<App/>',
    components: {App},
    beforeMount () {
        this.csrf_token = this.$el.attributes['data-token'].value
        this.last_email = this.$el.attributes['data-last-email'].value
        this.$store.commit('change', this.$el.attributes['data-is-authenticated'].value)
    }
});

