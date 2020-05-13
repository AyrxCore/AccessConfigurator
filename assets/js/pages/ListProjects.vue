<template>

    <div id="listProjectsContainer">
        <div class="current-projects">
            <h2>Editer un projet en cours</h2>
            <el-table
                    :data="projects.filter(data => !search || data['client_name'].toLowerCase().includes(search.toLowerCase()))"
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
                        prop="client_name"
                        width="180">
                </el-table-column>
                <el-table-column
                        label="Adresse"
                        prop="client_address"
                        width="500">
                </el-table-column>
                <el-table-column
                        label="Modèle"
                        prop="model">
                </el-table-column>
                <el-table-column
                        label="Surface"
                        prop="surface">
                    <template slot-scope="scope">
                        {{scope.row.surface}} m²
                    </template>
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
            <el-form :model="newProject" ref="form" size="small">
                <el-form-item label="Nom" label-position="top">
                    <el-input v-model="newProject.lastname"></el-input>
                </el-form-item>
                <el-form-item label="Prénom" label-position="top">
                    <el-input v-model="newProject.firstname"></el-input>
                </el-form-item>
                <el-form-item label="Adresse" label-position="left">
                    <el-input v-model="newProject.address"></el-input>
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
                search: '',
                newProject: {
                    lastname: '',
                    firstname: '',
                    address: ''
                },
                firstName: '',
                lastName: '',
                email: '',
                roles: '',
                projects: []
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
                this.$apiRequester.createNewProject('6aa1e79f-1d95-4624-a839-232702881df9', this.newProject)
                this.$router.push({name: 'ModelStep'});
            },
        },
        created() {
            this.$apiRequester.getAllProjects('6aa1e79f-1d95-4624-a839-232702881df9').then((response) => {
                this.projects = response.data
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