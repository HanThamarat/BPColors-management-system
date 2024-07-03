import { createMemoryHistory, createRouter } from 'vue-router';

import LockScreen from '../component/contents/content-lockScreen.vue';

const routes = [
    {
        path: '/',
        component: LockScreen,
    },
    {
        path: '/loscreen',
        component: LockScreen,
    },
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});

export default router;