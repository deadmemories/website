const template: string = `
<div>
    <div class="col s12 m12 l12 index-with_anime--background">
        <div class="row col s12 m12 l12 register-container">
            <div v-if="justWait">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-cliper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="email"
                           name="email"
                           id="register-email"
                           v-model="user.email">
                    <label for="register-email">Ваш имеил</label>
                </div>
                <div class="input-field col s12">
                    <input type="text"
                           name="login"
                           id="register-login"
                           v-model="user.login">
                    <label for="register-login">Ваш логин</label>
                </div>
                <div class="input-field col s12">
                    <input type="password"
                           name="password"
                           id="register-password"
                           v-model="user.password">
                    <label for="register-password">Ваш пароль</label>
                </div>
                <div class="input-field col s12">
                    <input type="password"
                           name="repeat-password"
                           id="register-repeat-password"
                           v-model="user.repeatPassword"
                           @input="checkPasswords">
                    <label for="register-repeat-password">Повтор пароля</label>
                </div>
                <div class="input-field col s12">
                    <input type="checkbox"
                           id="register-sex"
                           v-model="user.sex">
                    <label for="register-sex">Мужчина/Женщина</label>
                </div>
                <div class="file-field input-field col s12"
                     id="register-image">
                    <div v-if="0 == image.length"
                         class="btn">
                        <span> Аватарка </span>
                        <input type="file"
                               @change="uploadImage">
                    </div>
                    <div v-if="0 == image.length"
                         class="file-path-wrapper">
                        <input type="text"
                               class="file-path">
                    </div>
                    <div v-else-if="0 < image.length" class="imageUploaded">
                        <img v-for="item in image"
                             :src="item.name">
                        <div class="panel-image">
                            <a @click="removeImage()"
                               class="waves-effect waves-light btn col s12">Удалить</a>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12 social-icons">
                    <div @click="socialInput('registerVk')"
                         class="div-social_icon">
                        <social-icon class="fa fa-vk"></social-icon>
                    </div>
                    <div @click="socialInput('registerSkype')"
                         class="div-social_icon">
                        <social-icon class="fa fa-skype"></social-icon>
                    </div>
                    <div @click="socialInput('registerTwitter')"
                         class="div-social_icon">
                        <social-icon class="fa fa-twitter"></social-icon>
                    </div>
                    <div @click="socialInput('registerFacebook')"
                         class="div-social_icon">
                        <social-icon class="fa fa-facebook"></social-icon>
                    </div>
                </div>
                <div v-if="socialIconsFor('registerVk')"
                     class="social_icon-css">
                    <div class="input-field col s12"
                         id="register-input_div--register-vk">
                        <input type="text"
                               id="register-input_vk"
                               v-model="user.registerVk">
                        <label for="register-input_vk">Ваш вк</label>
                    </div>
                </div>
                <div v-if="socialIconsFor('registerFacebook')"
                     class="social_icon-css">
                    <div class="input-field col s12"
                         id="register-input_div--register-facebook">
                        <input type="text"
                               id="register-input_facebook"
                               v-model="user.registerFacebook">
                        <label for="register-input_facebook">Ваш facebook</label>
                    </div>
                </div>
                <div v-if="socialIconsFor('registerTwitter')"
                     class="social_icon-css">
                    <div class="input-field col s12"
                         id="register-input_div--register-twitter">
                        <input type="text"
                               id="register-input_twitter"
                               v-model="user.registerTwitter">
                        <label for="register-input_twitter">Ваш twitter</label>
                    </div>
                </div>
                <div v-if="socialIconsFor('registerSkype')"
                     class="social_icon-css">
                    <div class="input-field col s12"
                         id="register-input_div--register-skype">
                        <input type="text"
                               id="register-input_skype"
                               v-model="user.registerSkype">
                        <label for="register-input_skype">Ваш skype</label>
                    </div>
                </div>
            </div>
            <div v-if="disabledButton"
                 class="row col s12 ul-errors">
                <ul>
                    <li v-for="item in error">
                        {{ item }}
                    </li>
                </ul>
            </div>
            <a :class="errorButton" @click.prevent="justRegister()">Зарегистрироваться</a>
        </div>
    </div>
</div>
`

export default template;