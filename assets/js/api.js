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
    getUserInformations() {
        return this.axios.get(`/authenticated-user`)
    }
    logout() {
        return this.axios.get(`/logout`)
    }
}
