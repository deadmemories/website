import Vue from 'vue'
import store from './store/store.js'
import { mapActions } from 'vuex'
import router from './routers.js'
// import validate from './modules/validate.js'

const app = new Vue({
    // mixins: [validate],
    router,
    store,
    // components: {}
    el: '#app',
})