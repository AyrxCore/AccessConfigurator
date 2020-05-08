<template>

    <div id="homeContainer">
        <h1>Bienvenue sur<br/><span class="brand-style">Access Configurator</span></h1>
        <div class="tool-presentation">
            <h2>Un outil Demeure Rhône-Alpes</h2>
            <img src="/img/dra_logo.png" alt="Logo Demeure Rhône-Alpes">
        </div>
        <h3>Pour démarrer une nouvelle simulation, veuillez vous <router-link to="/login">connecter</router-link></h3>
    </div>

</template>

<script>

    export default {
        name: "HomePage",
        data() {
            return {
                isWorking: false,
            }
        },
    }

</script>

<style scoped>

    #homeContainer {
        text-align: center;
    }
    .brand-style {
        font-size: 60px;
        display: inline-block;
        margin: 40px 0;
    }
    .tool-presentation {
        margin: 40px 0;
    }

</style>
