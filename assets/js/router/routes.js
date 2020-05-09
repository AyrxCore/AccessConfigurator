import HomePage from "../pages/HomePage";
import Login from "../pages/Login";
import ListProjects from "../pages/ListProjects";
import ModelStep from "../pages/ModelStep";
import SizeStep from "../pages/SizeStep";
import OptionsStep from "../pages/OptionsStep";
import SummaryStep from "../pages/SummaryStep";

const routes = [
    {
        path: '/',
        name: 'HomePage',
        component: HomePage,
        meta: {requiresAuth: true}
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        props: true
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
];

export default routes

