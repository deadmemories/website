const state = {
    user: false,
}

const mutations = {
    changeUser(state, value) {
        state.user = value
    },
}

const actions = {
    changeInfo({commit}, value) {
        commit('commit', value);
    }
}

export default {
    state, mutations, actions
}