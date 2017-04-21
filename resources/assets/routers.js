import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routers = new VueRouter({
    mode: 'history',
    routers: [
        {path: '/', component: ''},
    ],
})

export default routers;