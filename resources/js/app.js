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
Vue.component('read-image-file-component', require('./components/MakeQuestion/ReadImageFileComponent.vue').default);
Vue.component('select-answer-component',   require('./components/MakeQuestion/SelectAnswerComponent.vue').default);


/* 部品アイテム */
Vue.component('submit-button-component',  require('./components/Items/SubmitButtonComponent.vue').default);
// Vue.component('count-up-timer-component', require('./components/Items/CountUpTimerComponent.vue').default);


/* 認証 */
Vue.component('reset-pass-component', require('./components/UserAuth/ResetPassComponent.vue').default);
Vue.component('register-component',   require('./components/UserAuth/RegisterComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
