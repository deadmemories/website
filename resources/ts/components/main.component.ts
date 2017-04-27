import Vue from 'vue'
import Component from 'vue-class-component'
// import template from './main.html.ts'
import template from './main.html'

@Component({
    template: template
})

export default class MainComponent extends Vue {
    name: string = 'DeadMoras'
}