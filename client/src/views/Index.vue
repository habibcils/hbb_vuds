<template>
<div>
	<Layout>
        <vue-page-transition name="fade-in-up">
            <!-- <keep-alive> -->
                <router-view />
            <!-- </keep-alive> -->
        </vue-page-transition>
        <vue-progress-bar></vue-progress-bar>
    </Layout>
</div>
</template>

<script>
require('@/assets/plugins/bootstrap/dist/css/bootstrap.min.css')
require('@/assets/plugins/icon-kit/dist/css/iconkit.min.css')
require('@/assets/plugins/ionicons/dist/css/ionicons.min.css')
require('@/assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css')
require('@/assets/plugins/weather-icons/css/weather-icons.min.css')
require('@/assets/plugins/c3/c3.min.css')
require('@/assets/theme/css/theme.min.css')
require('@/assets/css/my_style.css')
import 'vuejs-dialog/dist/vuejs-dialog.min.css';
import Layout from '@/components/layout/Layout';
export default {
    names: 'Index',
    components: {
        // Login
        Layout
    },
    data() {
        return {
            loginStat: 0,
        }
    },
    methods: {
        start() {
            this.$Progress.start()
        },
        set(num) {
            this.$Progress.set(num)
        },
        increase(num) {
            this.$Progress.increase(num)
        },
        decrease(num) {
            this.$Progress.decrease(num)
        },
        finish() {
            this.$Progress.finish()
        },
        fail() {
            this.$Progress.fail()
        },
    },
    beforeUpdate() {
        this.start()
    },
    updated() {
        this.finish()
    }    
}
</script>