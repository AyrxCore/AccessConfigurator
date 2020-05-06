import Vue from 'vue'
import Router from 'vue-router'
import HomePage from "../pages/HomePage";
import Login from "../pages/Login";
import ListProjects from "../pages/ListProjects";
import ModelStep from "../pages/ModelStep";
import SizeStep from "../pages/SizeStep";
import OptionsStep from "../pages/OptionsStep";
import SummaryStep from "../pages/SummaryStep";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'HomePage',
            component: HomePage
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/projects',
            name: 'ListProjects',
            component: ListProjects
        },
        {
            path: '/models',
            name: 'ModelStep',
            component: ModelStep
        },
        {
            path: '/sizes',
            name: 'SizeStep',
            component: SizeStep
        },
        {
            path: '/options',
            name: 'OptionsStep',
            component: OptionsStep
        },
        {
            path: '/summary',
            name: 'SummaryStep',
            component: SummaryStep
        }
    ]

})
