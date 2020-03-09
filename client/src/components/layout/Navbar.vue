<template>
<vueCustomScrollbar class="sidebar-content">
    <div class="nav-container">
        <nav id="main-menu-navigation" class="navigation-main">
            
            <span v-for="(list,key) in this.menuList " :key="key">
                <div v-if="list.id_parent == 0" class="nav-lavel" >{{list.name}} </div>
                
                <!-- <div v-ripple class="nav-item" :class="linkActiveClass"  v-for="(listed,key) in list.submenu " :key="key">
                    <router-link :to="{path:listed.target}"  exact><i :class="'ik '+listed.icon"></i><span>{{listed.name}} </span></router-link>
                </div> -->

                <router-link :to="{path:listed.target}" v-slot="{ href, route, navigate, isActive, isExactActive }" v-for="(listed,key) in list.submenu " :key="key">
                    <div v-ripple class="nav-item"  :class="[isActive && 'is-active', isExactActive && 'active']" >
                        <a :href="href" @click="navigate"><i :class="'ik '+listed.icon"></i><span>{{listed.name}} </span></a>
                    </div>
                </router-link>                
            </span>

        </nav>
    </div>
</vueCustomScrollbar>
</template>

<script>
import vueCustomScrollbar from 'vue-custom-scrollbar'
// import { mapMutations, mapActions, mapState, mapGetters } from "vuex";
import { createNamespacedHelpers, mapState, mapGetters } from 'vuex'
// const { mapGetters } = createNamespacedHelpers('menus')
export default {
    data() {
        return {
            activeClass: 'active',
            // activeUrl: linkActiveClass
        };
    },
    components: {
        vueCustomScrollbar
    },
    computed: {
        linkActiveClass(){
            // selec

                return ''
        },
        ...mapState('menus', {
            menuList : 'menuList'
            }),
        // ...mapState('auth', {
        //     statusLog : 'statusLog'
        //     }),
        // ...mapGetters('menus', {
        //     name : 'getName',
        //     // getName : 'menu/getName'
        //     }),  
        currentPage() {
            return this.$route.path
        }
    },
    mounted(){
        this.$store.dispatch('menus/getMenu').then( (res) => {
            // console.log(res)
        })

        let el = document.querySelector(".nav-item a.active")
            console.log(el)
        if(el){
            // return 'active'
        }else{
            // return 'no'

        }        

    }
};
</script>

<style scoped>

.nav-item:has(a:active) {
    background-color: rgba(25, 181, 254, 0.21);
}
.nav-item.active {
    background-color: rgba(25, 181, 254, 0.21);
}

.nav-item {
    transition: all ease 0.5s;
}

.nav-item:hover {
    background-color: rgba(25, 181, 254, 0.21);
}
</style>
