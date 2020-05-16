import axios from 'axios'
// la classe Api regroupe les appels ajax envoyés à l'api
export default class Api {
    // // on créé une variable qui contient la base de l'url du serveur
    constructor (){
       // this.baseUrl = baseUrl;
       // this.cojeauthToken = cojeauthToken;
       // this.axios = axios.create({
       //     baseURL: this.baseUrl,
       //     headers: {'X-Auth-Token': this.cojeauthToken}
       // });
       this.axios = axios.create();
    }

    // ------ USER ------ //
    getUserInformations() {
        return this.axios.get(`/authenticated-user`);
    }
    logout() {
        return this.axios.get(`/logout`);
    }
    // ------ #### ------ //

    // ------ PROJECTS ------ //
    getAllProjects(userId) {
        return this.axios.get(`/internal/${userId}/projects`);
    }
    createNewProject(userId, data) {
        return this.axios.post(`/internal/${userId}/new_project`, data);
    }
    editProject(projectId) {
        return this.axios.get(`/internal/${projectId}/edit_project`);
    }
    deleteProject(userId, projectId) {
        return this.axios.get(`/internal/${userId}/${projectId}/delete_project`);
    }
    // ------ ######## ------ //

    // ------ MODELS ------ //
    getAllModels() {
        return this.axios.get(`/internal/models`);
    }
    saveChosenModel(projectId, chosenModel) {
        return this.axios.get(`/internal/${projectId}/save_model`, chosenModel);
    }
    // ------ ###### ------ //

}
