import Vue from 'vue'
import store from './store/store.js'
import axios from 'axios'
import { mapActions } from 'vuex'
import router from './routers.js'
import validate from '../../resources/ts/modules/validate.ts'

const app = new Vue({
    mixins: [validate],
    router,
    store,
    // components: {}
    el: '#app',
})