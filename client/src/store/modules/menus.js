import {apiBase} from "@/helpers"

export default {
    namespaced: true,
    state: {
        menuList : [],
    },
    getters: {
        getList : state => {
            return state.menuList 
        },
        getName : state => {
            return state.name 
        },
    },
    actions: {
        async getMenu({commit}, menu){
            return apiBase.get('/menu?id_usergroup=1')
            .then(function (response) {
                let data = response.data.data
                // console.log(data)
                commit('ADD_MENU', response.data.data)
                return response.data
            })
            .catch(function (error) {
                console.log(error);
                return error
            })
        }
    },
    mutations: {
        ADD_MENU(state, menu){
            state.menuList = menu
        }
    }
}