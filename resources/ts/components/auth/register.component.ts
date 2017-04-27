import Vue from 'vue'
import Component from 'vue-class-component'

@Component({
    template: `
        <div>
            <input type="text" v-model="name"> 
            {{ name }}
        </div> 
    `
})

export default class MainComponent extends Vue {
    name: string = 'DeadMoras'
}
