<template>
    <div>
        <Aside :user="user"></Aside>
        <Nav></Nav>
        <div id="contentContainer">
            <router-view v-bind:csrf_token="csrf_token"/>
        </div>
    </div>
</template>

<script>

    import Nav from './components/main/Nav';
    import Aside from './components/main/Aside';

    export default {
        name: 'App',
        components: {
            Aside, Nav
        },
        data() {
            return {
                csrf_token: "",
                last_email: "",
                user: []
            }
        },
        created() {
            this.csrf_token = this.$parent.csrf_token;
            this.last_email = this.$parent.last_email
            fetch('/authenticated-user')
                .then(response => response.json())
                .then(user => {
                    this.user = user
                })
        },
    }
</script>

<style lang="scss">

    #contentContainer {
        margin-left: 250px;
        padding: 10px 20px;
    }

</style>
