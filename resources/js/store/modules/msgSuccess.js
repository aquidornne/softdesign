const state = {
  showSuccessMsg: false,
  txtSuccessMsg: '',
};

const actions = {
  showSuccessMsg({ commit }, msg) {
    commit("setSuccessMsg", msg && msg !== undefined ? msg : "Operação realizada com sucesso!")
    commit("changeState", true)
  },
  destroy({ commit }) {
    commit("changeState", false)
  }
}

const getters = {
  getSuccessMsg: state => {
    return state.showSuccessMsg
  },
  getTxtSuccessMsg: state => {
    return state.txtSuccessMsg
  }
}

const mutations = {
  changeState(state, estado) {
    state.showSuccessMsg = estado
  },
  setSuccessMsg(state, msg) {
    state.txtSuccessMsg = msg
  }
}

export const msgSuccess = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
}