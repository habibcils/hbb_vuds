import Vue from 'vue';
import VueProgressBar from 'vue-progressbar'

const options = {
    color: 'rgb(143, 255, 199)',
    failedColor: '#874b4b',
    height: '2px',
    thickness: '5px',
    transition: {
        speed: '0.5s',
        opacity: '0.8s',
        termination: 300
    },
    autoRevert: true,
    autoFinish:true
}
Vue.use(VueProgressBar, options)