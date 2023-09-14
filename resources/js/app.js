require('./bootstrap');

import Vue from "vue";
import store from "@/store/index";
import App from "@/page";
import router from "@/router/index";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

// bootstrap
import { BootstrapVue, IconsPlugin } from "bootstrap-vue"
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import "bootstrap/dist/css/bootstrap.css"
import "bootstrap-vue/dist/bootstrap-vue.css"

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css'

import VueMask from 'v-mask'
Vue.use(VueMask)

const app = new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app")