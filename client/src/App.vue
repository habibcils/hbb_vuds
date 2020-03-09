<template>
<div>

    <Login v-if="!loginState" />
    <Index v-if="loginState" />
</div>
</template>

<script>
import Login from './views/Login';
import Index from './views/Index';
export default {
    name: 'App',
    components: {
        Login,
        Index
    },
    data() {
        return {
            loginState: 1,
        }
    },
}
</script>
