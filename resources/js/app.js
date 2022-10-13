/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/* 問題を解く */
Vue.component('play-question-component',  require('./components/PlayQuestion/PlayQuestionComponent.vue').default);
Vue.component('count-down-timer-component', require('./components/PlayQuestion/CountDownTimerComponent.vue').default);
Vue.component('count-up-timer-component', require('./components/PlayQuestion/CountUpTimerComponent.vue').default);

/* 問題作成 */
Vue.component('make-question-group-form-component', require('./components/MakeQuestion/MakeQuestionGroupFormComponent.vue').default);
Vue.component('make-question-form-component', require('./components/MakeQuestion/MakeQuestionFormComponent.vue').default);

Vue.component('commentary-input-component', require('./components/MakeQuestion/CommentaryInputComponent.vue').default);
Vue.component('read-image-file-component', require('./components/MakeQuestion/ReadImageFileComponent.vue').default);
Vue.component('select-answer-component',   require('./components/MakeQuestion/SelectAnswerComponent.vue').default);


/* 部品アイテム */
Vue.component('seach-box-component',      require('./components/Items/SeachBoxComponent.vue').default);
Vue.component('see-more-btn-component',   require('./components/Items/SeeMoreBtnComponebt.vue').default);
Vue.component('submit-button-component',  require('./components/Items/SubmitButtonComponent.vue').default);
// Vue.component('count-up-timer-component', require('./components/Items/CountUpTimerComponent.vue').default);
Vue.component('url-copy-component',       require('./components/Items/UrlCopyComponent.vue').default);

/* 認証 */
Vue.component('reset-pass-component', require('./components/UserAuth/ResetPassComponent.vue').default);
Vue.component('register-component',   require('./components/UserAuth/RegisterComponent.vue').default);

/* その他のサービス */
Vue.component('please-login-modal-component',  require('./components/Service/PleaseLoginModalComponebt.vue').default);
Vue.component('keep-question-group-component', require('./components/Service/KeepQuestionGroupComponent.vue').default);
Vue.component('keep-creator-user-component',   require('./components/Service/KeepCreatorUserComponent.vue').default);
Vue.component('comment-component',             require('./components/Service/CommentComponent.vue').default);

Vue.component('violation-report-component',    require('./components/Service/ViolationReportComponent.vue').default);
Vue.component('violation-report-list-component',    require('./components/Service/ViolationReportListComponent.vue').default);
Vue.component('contact-form-component',             require('./components/Service/ContactFormComponent.vue').default);
Vue.component('contact-list-component',             require('./components/Service/ContactListComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
