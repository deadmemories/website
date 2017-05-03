import Vue from 'vue'
import store from './store/store.js'
import { mapActions } from 'vuex'
import router from './routers.js'
import headerComponent from './components/patterns/header.vue'
import footerComponent from './components/patterns/footer.vue'

const app = new Vue({
    router,
    store,
    components: {
        headerComponent, footerComponent,
    },
    el: '#app'
})