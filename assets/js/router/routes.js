import HomePage from "../pages/HomePage";
import Login from "../pages/Login";
import ListProjects from "../pages/ListProjects";
import ModelStep from "../pages/ModelStep";
import SizeStep from "../pages/SurfaceStep";
import OptionsStep from "../pages/OptionsStep";
import SummaryStep from "../pages/SummaryStep";

const routes = [
    {
        path: '/',
        name: 'HomePage',
        component: HomePage,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/projects',
        name: 'ListProjects',
        component: ListProjects,
        // meta: {requiresAuth: true}
    },
    {
        path: '/models',
        name: 'ModelStep',
        component: ModelStep,
        // meta: {requiresAuth: true}
    },
    {
        path: '/sizes',
        name: 'SizeStep',
        component: SizeStep,
        // meta: {requiresAuth: true}
    },
    {
        path: '/options',
        name: 'OptionsStep',
        component: OptionsStep,
        // meta: {requiresAuth: true}
    },
    {
        path: '/summary',
        name: 'SummaryStep',
        component: SummaryStep,
        // meta: {requiresAuth: true}
    }
];

export default routes

