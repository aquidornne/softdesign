import Vue from "vue"
import Vuex from "vuex"
import { loader } from "./modules/loader"
import { msgError } from "./modules/msgError"
import { msgSuccess } from "./modules/msgSuccess"

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    loader,
    msgError,
    msgSuccess
  }
})

export default store