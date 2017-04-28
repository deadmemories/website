import Vue from 'vue'
import Component from 'vue-class-component'
import Validate from '../../modules/validate'
import Image from '../../modules/image'
import template from './register.html.ts'

@Component({
    template: template
})

export default class RegisterComponent extends Vue {
    protected image: any[]
    protected service: string = 'image'
    protected user: any = {
        email: '',
        password: '',
        login: '',
        repeatPassword: '',
        sex: false,
        registerVk: '',
        registerFacebook: '',
        registerTwitter: '',
        registerSkype: '',
    }
    protected justWait: boolean = false
    protected socialIcons: {
        registerVk: false,
        registerSkype: false,
        registerTwitter: false,
        registerFacebook: false,
    }
    protected rePasswordError: boolean = false
    protected errors: any[] = []

    justRegister(): any {
        let valid: Validate = new Validate;
        let rules = {
            login: [this.user.login, 'required|min:4|max:20'],
            password: [this.user.password, 'required|min:4|max:16'],
            email: [this.user.email, 'required|min:5|max:25'],
        }
        valid.validate(rules);

        if (valid.isError()) {
            this.errors = valid.getErrors()
            return false;
        } else {
            fetch('/api/v1/auth/register', {
                method: 'post',
                body: this.user
            })
                .then(response => console.log(response))
                .catch(error => console.log(error))
        }
    }

    uploadImage(e: any): void {
        let image: Image = new Image;
        image.upload(e.target.files, 'user')
        this.image = image.getResponse()
    }

    removeImage(): void {
        this.image = []
    }

    checkPasswords(): void {
        if (this.user.password && this.user.password != this.user.repeatPassword) {
            this.rePasswordError = true
        } else {
            this.rePasswordError = false
        }
    }

    socialInput(iconName: string): void {
        if (!this.socialIcons.hasOwnProperty('iconName')) {
            if (this.socialIcons[iconName] == false) {
                this.socialIcons[iconName] = true;
            } else {
                this.socialIcons[iconName] = false;
            }
        }
    }

    socialIconsFor(iconName: string): boolean {
        if (this.socialIcons[iconName] == true) {
            return true;
        } else {
            return false;
        }
    }
}