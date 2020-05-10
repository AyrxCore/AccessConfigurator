<template>

    <div id="listProjectsContainer">
        <div class="current-projects">
            <h2>Editer un projet en cours</h2>
            <el-table
                    :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
                    :default-sort="{prop: 'date', order: 'descending'}"
                    height="350px"
                    max-height="350px"
                    style="width: 100%">
                <el-table-column
                        label="Date"
                        prop="date"
                        sortable
                        width="180">
                </el-table-column>
                <el-table-column
                        label="Nom"
                        prop="name"
                        width="180">
                </el-table-column>
                <el-table-column
                        label="Adresse"
                        prop="address"
                        width="500">
                </el-table-column>
                <el-table-column
                        label="Modèle"
                        prop="model">
                </el-table-column>
                <el-table-column
                        label="Surface"
                        prop="size">
                </el-table-column>
                <el-table-column
                        align="right">
                    <template slot="header" slot-scope="scope">
                        <el-input
                                placeholder="Type to search"
                                size="mini"
                                v-model="search"/>
                    </template>
                    <template slot-scope="scope">
                        <el-button
                                @click="handleEdit(scope.$index, scope.row)"
                                size="mini">Editer
                        </el-button>
                        <el-button
                                @click="handleDelete(scope.$index, scope.row)"
                                size="mini"
                                type="danger">Supprimer
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
        <el-divider></el-divider>
        <div class="new-project">
            <h2>Créer un nouveau projet</h2>
            <el-form :model="form" ref="form" size="small">
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
                    <el-button @click="submitForm" size="large" type="primary">Démarrer le projet</el-button>
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
                }, {
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
                firstName: '',
                lastName: '',
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