<template>
    <div>
        <Aside></Aside>
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
        props: ['csrf_token'],
        components: {
            Aside, Nav
        }
    }
</script>

<style lang="scss">

    #contentContainer {
        margin-left: 250px;
        padding: 10px 20px;
    }

</style>
