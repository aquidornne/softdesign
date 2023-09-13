const state = {
  showErrorMsg: false,
  txtErrorMsg: '',
}

const actions = {
  showErrorMsg({ commit }, msg) {
    commit("setErrorMsg", msg && msg !== undefined ? msg : "Erro interno na aplicação")
    commit("changeState", true)
  },
  destroy({ commit }) {
    commit("changeState", false)
  }
}

const getters = {
  getErrorMsg: state => {
    return state.showErrorMsg
  },
  getTxtErrorMsg: state => {
    return state.txtErrorMsg
  }
}

const mutations = {
  changeState(state, estado) {
    state.showErrorMsg = estado
  },
  setErrorMsg(state, msg) {
    state.txtErrorMsg = msg
  }
}

export const msgError = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
}
