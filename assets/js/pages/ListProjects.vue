<template>

    <div id="listProjectsContainer">
        <div class="current-projects">
            <h2>Editer un projet en cours</h2>
            <el-table
                    :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
                    :default-sort = "{prop: 'date', order: 'descending'}"
                    height="350px"
                    max-height="350px"
                    style="width: 100%">
                <el-table-column
                        sortable
                        prop="date"
                        label="Date"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="Nom"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="address"
                        label="Adresse"
                        width="500">
                </el-table-column>
                <el-table-column
                        prop="model"
                        label="Modèle">
                </el-table-column>
                <el-table-column
                        prop="size"
                        label="Surface">
                </el-table-column>
                <el-table-column
                        align="right">
                    <template slot="header" slot-scope="scope">
                        <el-input
                                v-model="search"
                                size="mini"
                                placeholder="Type to search"/>
                    </template>
                    <template slot-scope="scope">
                        <el-button
                                size="mini"
                                @click="handleEdit(scope.$index, scope.row)">Editer</el-button>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.$index, scope.row)">Supprimer</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
        <el-divider></el-divider>
        <div class="new-project">
            <h2>Créer un nouveau projet</h2>
            <el-form ref="form" :model="form" size="small">
                <el-form-item label="Nom" label-position="top">
                    <el-input v-model="form.lastname"></el-input>
                </el-form-item>
                <el-form-item label="Prénom" label-position="top">
                    <el-input v-model="form.firstname"></el-input>
                </el-form-item>
                <el-form-item label="Adresse" label-position="left">
                    <el-input v-model="form.address"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="large" @click="submitForm">Démarrer le projet</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>

</template>

<script>

    export default {
        name: "ListProjects",
        data() {
            return {
                pageSize: 5,
                tableData: [{
                    date: '2020-05-01',
                    name: 'CHAPIRON Anthony',
                    address: '14 rue Franklin Roosevelt 74190 Passy',
                    model: 'Acacia',
                    size: '85m²'
                }, {
                    date: '2020-04-03',
                    name: 'ROUX Anthony',
                    address: '65 avenue Albert Einstein 69100 Villeurbanne',
                    model: 'Lotus',
                    size: '105m²'
                }, {
                    date: '2019-05-10',
                    name: 'GELIN Lucie',
                    address: '13 avenue du Mont-Blanc 69140 Rillieux-la-Pape',
                    model: 'Magenta',
                    size: '85m²'
                }, {
                    date: '2020-05-20',
                    name: 'ROUX Stécie',
                    address: '11 bis Impasse du Puits 01360 Loyettes',
                    model: 'Acacia',
                    size: '95m²'
                },{
                    date: '2020-05-01',
                    name: 'CHAPIRON Anthony',
                    address: '14 rue Franklin Roosevelt 74190 Passy',
                    model: 'Acacia',
                    size: '85m²'
                }, {
                    date: '2020-04-03',
                    name: 'ROUX Anthony',
                    address: '65 avenue Albert Einstein 69100 Villeurbanne',
                    model: 'Lotus',
                    size: '105m²'
                }, {
                    date: '2019-05-10',
                    name: 'GELIN Lucie',
                    address: '13 avenue du Mont-Blanc 69140 Rillieux-la-Pape',
                    model: 'Magenta',
                    size: '85m²'
                }, {
                    date: '2020-05-20',
                    name: 'ROUX Stécie',
                    address: '11 bis Impasse du Puits 01360 Loyettes',
                    model: 'Acacia',
                    size: '95m²'
                }],
                search: '',
                form: {
                    lastname: '',
                    firstname: '',
                    address: ''
                },
                email: '',
                roles: '',
            }
        },
        methods: {
            handleEdit(index, row) {
                console.log(index, row);
            },
            handleDelete(index, row) {
                console.log(index, row);
            },
            submitForm() {
                this.$router.push({name: 'ModelStep'});
            },
        },
        created() {
            fetch('/authenticated-user')
                .then(response => response.json())
                .then(user => {
                    console.log("user: " + user);
                    this.firstName = user.firstName
                    this.lastName = user.lastName
                    this.email = user.email
                    this.roles = user.roles
                })
        }
    }

</script>

<style scoped>

    .new-project {
        width: 600px;
    }
    .el-divider {
        height: 10px;
        background-color: brown;
    }

</style>