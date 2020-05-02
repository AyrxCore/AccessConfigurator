<template>

    <div id="loginContainer">
        <h1>Connectez-vous</h1>
        <el-form ref="form" :model="form" label-width="120px">
            <el-form-item label="E-mail">
                <el-input v-model="form.name"></el-input>
            </el-form-item>
            <el-form-item label="Mot de passe">
                <el-input v-model="form.password"></el-input>
            </el-form-item>
            <el-form-item label="Se souvenir de moi">
                <el-switch v-model="form.delivery"></el-switch>
            </el-form-item>
        </el-form>
    </div>
</template>


<script>

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
            onSubmit() {
                console.log('submit!');
            }
        }
    }

</script>

<style scoped>

</style>