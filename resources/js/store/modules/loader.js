const state = {
  isLoading: false
}

const actions = {
  loading({ commit }, estado) {
    commit('changeState', estado)
  }
}

const mutations = {
  changeState(state, estado) {
    state.isLoading = estado
  }
}

const getters = {
  getLoading: state => {
    return state.isLoading
  }
}

export const loader = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
}