<template lang="pug">
    div#mainAuth
        div#auth-modal.modal.modal-auth
            div.modal-content.modal-content_auth
                div.header
                    h5 Авторизация
                    span
                        i.fa.fa-times.modal-close
                div.inputs
                    div.row
                        div.input-field.col.s12
                            input(type='text', name='login', id='auth-login_modal', v-model='email')
                            label(for='auth-login_modal') Имеил
                    div.row
                        div.input-field.col.s12
                            input(type='password', name='password', id='auth-password_modal', v-model='password')
                            label(for='auth-password_modal') Пароль
                    div.row.button
                        div.input-field.col.s12
                            a(href='#', class='button-auth waves-effect waves-light btn col s12', @click='register()') Авторизоваться
</template>

<script>
    import axios from 'axios';
    import Token from '../../modules/token'
    import Validate from '../../modules/validate'
    import config from '../../config'

    export default {
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            register() {
                let token = new Token
                if (token.check()) {
                    alertify.notify('You are already logged', 'error', 3);
                    return false;
                }

                let validate = new Validate
                const rules = {
                    email: [this.email, 'required|min:5|max:30'],
                    password: [this.password, 'required|min:4|max:25']
                }
                validate.validate(rules)

                if (validate.isError()) {
                    console.log(validate.getErrors())
                } else {
                    axios.post(config.url + 'register', {
                        email: this.email,
                        password: this.password
                    }).then(response => {
                        token.set(response.data.response);
                        alertify.notify('You are successfully loggin', 'success', 2);
                    }).catch(error => console.log(error));
                }
            }
        }
    }
</script>