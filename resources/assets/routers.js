import Vue from 'vue'
import VueRouter from 'vue-router'
import Index from './components/index.vue'
import Register from './components/auth/register.vue'

Vue.use(VueRouter)

const routers = new VueRouter(
    {
        mode: 'history',
        routes: [
            {path: '/', component: Index},
            {path: '/register', component: Register},
        ],
    },
)

export default routers