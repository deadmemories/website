<template lang="pug">
    div.col.s12.m12.l12.index-with_anime--background
        div.row.col.s12.m12.l12.register-container
            div.register-content.col.s11.m11.l4
                div(v-if="justWait")
                    div.preloader-wrapper.big.active
                        div.spinner-layer.spinner-blue-only
                            div.circle-clipper.left
                                div.circle
                            div.gap-patch
                                div.circle
                            div.circle-clipper.right
                                div.circle
                div.row
                    div.input-field.col.s12
                        input(type='email' name='email' id='register-email' v-model='user.email')
                        label(for='register-login') Ваш имеил
                    div.input-field.col.s12
                        input(type='text' name='login' id='register-login' v-model='user.login')
                        label(for='register-login') Ваш логин
                    div.input-field.col.s12
                        input(type='password' name='password' id='register-password' v-model='user.password')
                        label(for='register-login') Ваш пароль
                    div.input-field.col.s12
                        input(type="password" name="repeat-password" id="repeat-password",
                                        v-model="user.passwordConfirmation" @input="checkRePassword")
                        label(for='repeat-password') Подтверждение пароля
                    div.row.input-field.col.s12
                        input(type='checkbox' id='register-sex' v-model='user.sex')
                        label(for='register-sex') Мужчина/женщина
                    div.file-field.input-field.col.s12#register-image
                        div(v-if='!image.name' class='btn')
                            span Аватарка
                                input(type='file', @change='uploadImage')
                        div(v-if='!image.name' class='file-path-wrapper')
                            input(type='text', class='file-path')
                        div(v-else-if='image.name' class='imageUploaded')
                            img(:src='image.name')
                            div.panel-image
                                a(class='waves-effect waves-light btn col s12', @click='removeImage()') Удалить
                    div.input-field.col.s12.social-icons
                        div(class='div-social_icon', @click="socialInput('registerVk')")
                            social-icon.fa.fa-vk
                        div(class='div-social_icon', @click="socialInput('registerSkype')")
                            social-icon.fa.fa-skype
                        div(class='div-social_icon', @click="socialInput('registerTwitter')")
                            social-icon.fa.fa-twitter
                        div(class='div-social_icon', @click="socialInput('registerFacebook')")
                            social-icon.fa.fa-facebook
                    div(v-if="socialIconsFor('registerVk')", class='social_icon-css')
                        div.input-field.col.s12#register-input_div--register-vk
                            input(type='text', id='register-input_vk', v-model='user.registerVk')
                            label(for='register-input_vk') Ваш вк
                    div(v-if="socialIconsFor('registerFacebook')", class='social_icon-css')
                        div.input-field.col.s12#register-input_div--register-facebook
                            input(type='text', id='register-input_facebook', v-model='user.registerFacebook')
                            label(for='register-input_facebook') Ваш фб
                    div(v-if="socialIconsFor('registerTwitter')", class='social_icon-css')
                        div.input-field.col.s12#register-input_div--register-twitter
                            input(type='text', id='register-input_twitter', v-model='user.registerTwitter')
                            label(for='register-input_twitter') Ваш твитер
                    div(v-if="socialIconsFor('registerSkype')", class='social_icon-css')
                        div.input-field.col.s12#register-input_div--register-skype
                            input(type='text', id='register-input_skype', v-model='user.registerSkype')
                            label(for='register-input_skype') Ваш скайп
                div(v-if='0 != error.length', class='row col s12 ul-errors')
                    ul
                        li(v-for='item in error') {{ item }}
                a(href='#' @click.prevent='justRegister()').col.s12.btn Зарегистрироваться
</template>

<script>
    import Vue from 'vue';
    import Validate from '../../modules/validate'
    import Image from '../../modules/image'
    import axios from 'axios';

    Vue.component('social-icon', {
        template: `
            <i aria-hidden="true"></i>
        `,
        data() {
            return {}
        }
    });
    export default {
        data() {
            return {
                image: [],
                user: {
                    login: '',
                    email: '',
                    password: '',
                    passwordConfirmation: '',
                    sex: false,
                    registerVk: '',
                    registerFacebook: '',
                    registerTwitter: '',
                    registerSkype: '',
                },
                errorPasswordRepeat: false,
                justWait: false,
                error: [],
                socialIcons: {
                    registerVk: false,
                    registerSkype: false,
                    registerTwitter: false,
                    registerFacebook: false,
                }
            }
        },
        methods: {
            checkRePassword() {
                if (this.user.password && this.user.password !== this.user.passwordConfirmation) {
                    this.errorPasswordRepeat = true;
                } else {
                    this.errorPasswordRepeat = false;
                }
            },
            justRegister() {
                let validate = new Validate
                const rules = {
                    login: [this.user.login, 'required|min:5|max:15'],
                    password: [this.user.password, 'required|min:4|max:25'],
                    email: [this.user.email, 'required|min:5|max:30'],
                }
                validate.validate(rules)

                if ( validate.isError() ) {
                    this.error = validate.getErrors()
                    alertify.notify('Validation error', 'error', 3)
                    return false;
                } else {
                    axios.post('/api/v1/register', {
                        user: this.user,
                        image: this.image
                    }).then(res => console.log(res))
                      .catch(err => console.log(err))
                }
            },
            uploadImage(e) {
                let image = new Image
                image.upload(e.target.files, 'user')
                setTimeout(() => {
                    this.image = image.getResponse()[0]
                }, 2000)
            },
            removeImage() {
                this.image = []
            },
            socialInput(iconName) {
                if (!this.socialIcons.iconName) {
                    if (this.socialIcons[iconName] == false) {
                        this.socialIcons[iconName] = true;
                    } else {
                        this.socialIcons[iconName] = false;
                    }
                }
            },
            socialIconsFor(iconName) {
                if (this.socialIcons[iconName] == true) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
</script>