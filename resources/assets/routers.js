import Vue from 'vue'
import VueRouter from 'vue-router'
import Index from '../../resources/ts/components/main.component.ts'

Vue.use(VueRouter)

const routes = [
    { path: '/', component: Index },
]

const routers = new VueRouter({
    routes
})


export default routers;