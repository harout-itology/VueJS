import HistoryComponent from './pages/HistoryPage.vue';
import TreeComponent from './pages/TreePage.vue';
import PageNotFound from './pages/PageNotFound.vue';

export const routes = [
    {
        name: 'Templates Tree',
        path: '/launch/',
        component: TreeComponent,
        meta: {
            title: 'Templates Tree',
        }
    },
    {
        name: 'Log History',
        path: '/log-history/',
        component: HistoryComponent,
        meta: {
            title: 'Log History',
        }
    },
    {
        name: 'Page Not Found',
        path: '*',
        component: PageNotFound,
        meta: {
            title: 'Page Not Found',
        }
    }
];

export default routes ;
