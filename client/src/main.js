import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store'
import './plugins/vue_dialog';
import './plugins/progressbar';
import './plugins/ripple';
import './plugins/toasted';
import './plugins/transition';
import './plugins/vue2_transition';
import './plugins/vue2_page_transition'
Vue.config.productionTip = false

new Vue({
  router,
  store,
  // vuetify,
  render: h => h(App)
}).$mount('#app')
