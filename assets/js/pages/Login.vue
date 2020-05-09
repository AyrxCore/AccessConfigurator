<template>

    <div id="loginContainer">
        <h1>Connectez-vous</h1>
        <div class="login-form-container">
            <el-form ref="form" size="small">
                <el-form-item label="E-mail" label-position="top">
                    <el-input v-model="email"></el-input>
                </el-form-item>
                <el-form-item label="Mot de passe" label-position="top">
                    <el-input v-model="password"></el-input>
                </el-form-item>
<!--                <el-form-item label="Se souvenir de moi" label-position="left">-->
<!--                    <el-switch v-model="form.remember"></el-switch>-->
<!--                </el-form-item>-->
                <el-form-item>
                    <el-input type="hidden" name="_csrf_token" v-model="csrf_token"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="large" @click="sendLogin">Connexion</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>

</template>


<script>

    import ListProjects from "./ListProjects";

    export default {
        name: "Login",
        props: ['csrf_token', 'last_email'],
        data() {
            return {
                email: '',
                password: '',
                isError: false,
                errorMessage: ''
            }
        },
        created () {
            if (this.$props.last_email !== 'undefined'){
                this.email = this.$props.last_email;
            }
            console.log('Login component:' + this.$store.getters.isAuthenticated );
            if (this.$store.getters.isAuthenticated === true) {
                this.$router.push('/projects')
            }
        },
        methods: {
            sendLogin () {
                console.log('send login form');
                fetch('/login', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        'email': this.email,
                        'password': this.password,
                        '_csrf_token': this.$props.csrf_token
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data)
                        if (data === 'authenticated') {
                            this.$store.commit('change', true);
                            console.log('user authenticated successfully ' + this.$store.getters.isAuthenticated);
                            this.$router.push('/projects');
                        } else {
                            this.isError = true;
                            this.errorMessage = data
                        }
                    })
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