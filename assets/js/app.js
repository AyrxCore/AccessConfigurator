import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import store from './vuex/store';
import Vuex from 'vuex';
import ElementUI from 'element-ui';
import ElSearchTablePagination from 'el-search-table-pagination';

import 'bootstrap/dist/css/bootstrap.css';
import 'admin-lte/dist/css/adminlte.min.css';
import 'element-ui/lib/theme-chalk/index.css';

import 'vue-awesome/dist/vue-awesome';
import 'vue-awesome/icons';
import Icon from "vue-awesome/components/Icon";

Vue.component("v-icon", Icon);

Vue.use(Vuex);
Vue.use(ElementUI);
Vue.use(ElSearchTablePagination);

Vue.config.productionTip = false;
Vue.prototype.$http = axios;

new Vue({
    el: '#app',
    router,
    store,
    template: '<App/>',
    components: {App},
});

