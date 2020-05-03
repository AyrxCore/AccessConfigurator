<template>

    <div id="loginContainer">
        <h1>Connectez-vous</h1>
        <div class="login-form-container">
            <el-form ref="form" :model="form" size="small">
                <el-form-item label="E-mail" label-position="top">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="Mot de passe" label-position="top">
                    <el-input v-model="form.password"></el-input>
                </el-form-item>
                <el-form-item label="Se souvenir de moi" label-position="left">
                    <el-switch v-model="form.delivery"></el-switch>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="large" @click="submitForm">Connexion</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>

</template>


<script>

    import ListProjects from "./ListProjects";

    export default {
        name: "Login",
        data() {
            return {
                form: {
                    name: '',
                    password: '',
                    delivery: false
                }
            }
        },
        methods: {
            submitForm() {
                this.$router.push({name:'ListProjects'});
            }
        }
    }

</script>

<style scoped>

    .login-form-container form {
        width: 500px;
    }
    .login-form-container form div {
        margin-bottom: 5px;
    }
    .test-css {
        line-height: 2px;
    }

</style>