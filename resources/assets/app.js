import Vue from 'vue'
import store from './store/store.js'
import axios from 'axios'
import { mapActions } from 'vuex'
import router from './routers.js'
import validate from './modules/validate.js'

const app = new Vue({
    mixins: [validate],
    router,
    store,
    // components: {}
    el: '#app',
    created() {
        let validate = {
            login: ['data', 'required|min:25'],
        }

        this.validate(validate)
    },
})