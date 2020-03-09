import vue from 'vue'
import vuex from 'vuex'
// import axios from 'axios'
import modules from '@/store/modules'; 
// import menus from '@/store/modules/menus'; 

vue.use(vuex)

export default new vuex.Store({
    strict: true,
    modules
})