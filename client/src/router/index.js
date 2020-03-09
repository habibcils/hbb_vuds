import Vue from 'vue'
import VueRouter from 'vue-router'
// import Home from '@/views/pages/Home.vue'
import Users from '@/views/pages/Users.vue'
// import Gis from '@/views/pages/Gis.vue'
// import Login from '../views/Login.vue'

const Null404 = r => require.ensure([], () => r(require('@/components/_code//404.vue')), 'big-pages')
const Null503 = r => require.ensure([], () => r(require('@/components/_code//503.vue')), 'big-pages')
const Login = r => require.ensure([], () => r(require('../views/Login.vue')), 'big-pages')
const Gis = r => require.ensure([], () => r(require('../views/pages/Gis.vue')), 'big-pages')
const Home = r => require.ensure([], () => r(require('../views/pages/Home.vue')), 'big-pages')
const Usergroup = r => require.ensure([], () => r(require('../views/pages/Usergroup.vue')), 'big-pages')
const Shield = r => require.ensure([], () => r(require('../views/pages/Shield.vue')), 'big-pages')
const Useraccess = r => require.ensure([], () => r(require('../views/pages/Useraccess.vue')), 'big-pages')
const Menusort = r => require.ensure([], () => r(require('../views/pages/Menu_sort.vue')), 'big-pages')
const Menu = r => require.ensure([], () => r(require('../views/pages/Menu.vue')), 'big-pages')
Vue.use(VueRouter)

const routes = [{
        path: '/dashboard',
        name: 'Home',
        component: Home,
        meta: {
            auth: true,
            permission: 'read_dashboard',
        },
    },
    {
        path: '/gis',
        name: 'Gis',
        component: Gis
    },
    {
        path: '/404',
        name: '404',
        component: Null404,
    },
    {
        path: '/503',
        name: '503',
        component: Null503,
    },
    {
        path: '/AddLoc',
        name: 'AddLoc',
        component: Null404,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/users',
        name: 'Users',
        component: Users,
        meta: {
            auth: true,
            permission: 'read_users',
        },
    },
    // {
    //   path: '/shield',
    //   name: 'shield',
    //   component: Shield
    // },
    {
        path: '/usergroup',
        name: 'Usergroup',
        component: Usergroup
    },
    {
        path: '/useraccess',
        name: 'Useraccess',
        component: Useraccess
    },
    {
        path: '/menu',
        name: 'Menu',
        component: Menu
    },
    {
        path: '/Menu_order',
        name: 'Menu Order',
        component: Menusort
    }

]

const router = new VueRouter({
    routes,
    mode: 'history',
    // linkActiveClass: "active", for non exact
    linkExactActiveClass: "is-active"
})

router.beforeEach((to, from, next) => {
    // mengecek ada tidak meta auth di dalam meta
    if (to.matched.some(record => record.meta.auth)) {
        // cek di localstorage auth, jika false maka diarahkan ke halaman login
        if (!localStorage.getItem('auth')) {
            next('/login');
        } else {
            const permission = localStorage.getItem('permission');
            if (to.matched.some(record => record.meta.permission)) {
                if (permission == to.meta.permission) {
                    next();
                } else {
                    next('/503');
                }
            } else {
                next();
            }
        }
    } else {
        next();
    }
});

function addroute() {
    router.addRoutes(
        [
            { path: '/shield', name: 'Shield', component: Shield }
        ]
    )
}
addroute()


export default router