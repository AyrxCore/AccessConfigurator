<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <v-icon name="bars"></v-icon>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <router-link to="/projects" class="nav-link">Projects</router-link>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <router-link to="/summary" class="nav-link">Summary</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "Nav"
    }
</script>

<style scoped>

</style>