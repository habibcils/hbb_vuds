export default {
    namespaced: true,
    state: {
        username : '',
        userData: [],
    },
    getters: {
        username : state => state.username
    },
    actions: {
        addUserName({commit}, username){
            commit('ADD_USERNAME', username)
        }
    },
    mutations: {
        // ADD_USERNAME(state, name){
        //     state.username = name
        // },
        SET_USER(state, payload){
            state.userData = payload
        } 
    }
}