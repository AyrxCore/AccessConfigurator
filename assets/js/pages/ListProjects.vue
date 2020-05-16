<template>

    <div id="listProjectsContainer">
        <div class="current-projects">
            <h2>Editer un projet en cours</h2>
            <el-table
                    :data="projects.filter(data => !search || data['client_name'].toLowerCase().includes(search.toLowerCase()))"
                    :default-sort="{prop: 'date', order: 'descending'}"
                    element-loading-background="rgba(255, 255, 255, 1)"
                    height="350px"
                    max-height="350px"
                    v-loading="loading">
                <el-table-column
                        label="Date"
                        prop="date"
                        sortable
                        width="180"
                        :show-overflow-tooltip="true">
                </el-table-column>
                <el-table-column
                        label="Nom"
                        prop="client_name"
                        width="180"
                        :show-overflow-tooltip="true">
                </el-table-column>
                <el-table-column
                        label="Adresse"
                        prop="client_address"
                        width="500"
                        :show-overflow-tooltip="true">
                </el-table-column>
                <el-table-column
                        label="Modèle"
                        prop="model"
                        :show-overflow-tooltip="true">
                </el-table-column>
                <el-table-column
                        label="Surface (m²)"
                        prop="surface"
                        :show-overflow-tooltip="true">
                    <template slot-scope="scope">
                        {{scope.row.surface}}
                    </template>
                </el-table-column>
                <el-table-column
                        align="right"
                        width="200">
                    <template slot="header" slot-scope="scope">
                        <el-input
                                placeholder="Type to search"
                                size="mini"
                                v-model="search"/>
                    </template>
                    <template slot-scope="scope">
                        <el-button
                                @click="handleEdit(scope.row.id)"
                                size="mini">Editer
                        </el-button>
                        <el-button
                                @click="handleDelete(scope.row.id)"
                                size="mini"
                                type="danger">Supprimer
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <el-dialog
                    :visible.sync="dialogVisible"
                    title="Supprimer le projet"
                    width="30%">
                <span>Voulez-vous supprimer ce projet ?</span>
                <span class="dialog-footer" slot="footer">
                    <el-button @click="handleCloseDeleteModal(true)">Annuler</el-button>
                    <el-button @click="handleCloseDeleteModal(false)" type="primary">Confirmer</el-button>
                </span>
            </el-dialog>
        </div>
        <el-divider></el-divider>
        <div class="new-project">
            <h2>Créer un nouveau projet</h2>
            <el-form :model="newProject" ref="form" size="small">
                <el-form-item label="Nom du projet" label-position="top">
                    <el-input v-model="newProject.projectName"></el-input>
                </el-form-item>
                <el-form-item label="Nom du client" label-position="top">
                    <el-input v-model="newProject.clientName"></el-input>
                </el-form-item>
                <el-form-item label="Adresse du client" label-position="left">
                    <el-input v-model="newProject.clientAddress"></el-input>
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
                search: '',
                newProject: {
                    projectName: '',
                    clientName: '',
                    clientAddress: ''
                },
                projects: [],
                dialogVisible: false,
                projectToDelete: '',
                loading: true
            }
        },
        methods: {
            refreshListProjects(userId) {
                this.$apiRequester.getAllProjects(userId).then((response) => {
                    this.projects = response.data;
                    this.loading = false;
                })
            },
            handleCloseDeleteModal(abort) {
                if (!abort) {
                    this.$apiRequester.deleteProject('6aa1e79f-1d95-4624-a839-232702881df9', this.projectToDelete).then((response) => {
                        console.log(response.data)
                    })
                    // this.loading = true;
                    // this.refreshListProjects();
                }
                this.dialogVisible = false;
            },
            handleEdit(projectId) {
                this.$apiRequester.editProject(projectId).then((response) => {
                    this.$router.push({name: response.data, query: {projectId: projectId}});
                })
            },
            handleDelete(projectId) {
                this.dialogVisible = true;
                this.projectToDelete = projectId;
            },
            submitForm() {
                this.$apiRequester.createNewProject( '6aa1e79f-1d95-4624-a839-232702881df9', this.newProject).then((response) => {
                    if (response.status === 200) {
                        const projectId = response.data;
                        this.$router.push({name: 'ModelStep' , query: {projectId: projectId}});
                    }
                })
            },
        },
        created() {
            this.refreshListProjects('6aa1e79f-1d95-4624-a839-232702881df9');
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

    td div {
        word-break: inherit;
    }

</style>