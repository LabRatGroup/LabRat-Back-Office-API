
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('collaborators-manager', require('./components/CollaboratorsManager.vue'));
Vue.component('ml-state-form', require('./components/MlStateForm.vue'));
Vue.component('ml-algorithm-form', require('./components/MlAlgorithmForm.vue'));
Vue.component('ml-resampling-form', require('./components/MlReSamplingForm.vue'));
Vue.component('ml-preprocessing-form', require('./components/MlPreprocessingForm.vue'));
Vue.component('ml-metric-form', require('./components/MlMetricForm.vue'));

const app = new Vue({
    el: '#app'
});

