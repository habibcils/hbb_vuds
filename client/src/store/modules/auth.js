export default {
    namespaced: true,
    state: {
        statusLog : 0,
        token : '',
    },
    getters: {
        getStatus: state => state.statusLog,
        getToken: state => state.token,
    },
    actions: {
        // addUserName({commit}, username){
        //     commit('ADD_USERNAME', username)
        // },
        authLogin({commit,payload}, data ){
            console.log(data.username+' ' +data.password)
            // console.log(payload)
            axios
                .post('http://localhost/api_ujian/api/users/auth',{
                    username: data.username,
                    password: data.password
                })
                .then(data => {
                    console.log(data.data.data)
                    commit('SET_USER', data.data.data[0])
                    commit('LOGIN', data.data.data[0].id)
                    setTimeout( ()=> {
                        router.push('/')
                    },500)
                    // localStorage.setItem('token',token)
                }).catch(err => {
                    console.log(err)
                    // return false;
                })
        },
    },
    mutations: {
        ADD_USERNAME(state, name){
            state.username = name
        },
        LOGIN(state, payload){
            state.stateLogin = payload
        },        
    }
}