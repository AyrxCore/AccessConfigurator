import Vue from 'vue'
import App from './App.vue'
import Api from './api'
import { store } from './vuex/store';
import Vuex from 'vuex';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/fr'
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
Vue.use(ElementUI, {locale});
Vue.use(VueRouter);

Vue.config.productionTip = false;
Vue.prototype.$apiRequester = new Api();

routerApp.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isAuthenticated !== false) {
            next()
        } else {
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
        this.$store.commit('authenticationStatus', this.$el.attributes['data-is-authenticated'].value)
    }
});

