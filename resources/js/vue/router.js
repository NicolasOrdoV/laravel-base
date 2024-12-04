import { createRouter, createWebHistory } from "vue-router";

import List from './componets/ListComponent.vue'
import Save from './componets/SaveComponent.vue'
import Login from './componets/auth/LoginComponent.vue'

const routes = [
    {
        name: 'login',
        path: '/vue/login',
        component: Login
    },
    {
        name: 'list',
        path: '/vue',
        component: List
    },
    {
        name: 'save',
        path: '/vue/save/:slug?',
        component: Save
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router
