<template>

    <div id="surfaceStepContainer">
        <h1>Choisissez une surface pour le modèle 'Acacia'</h1>
        <el-container class="cards" v-loading="loading" element-loading-background="rgba(255, 255, 255, 1)">
            <el-col :class="chosenSurface.id === surface.id ? 'card-container selected' : 'card-container not-selected'" :span="6" v-for="(surface, key) in allSurfaces" :key="key">
                <div @click="handleSurface(surface)">
                    <el-card :body-style="{ padding: '0px' }">
                        <div class="card-img-container">
                            <img :src="'../../img/'+surface.imgRdc" class="image">
                        </div>
                        <div class="card-text-container">
                            <h3 class="title-surface">
                                {{surface.surface}} m²
                            </h3>
                            <div class="description-surface">
                                {{surface.description}}
                            </div>
                            <h4 class="price-surface">
                                A partir de {{surface.lowerPrice}} €
                            </h4>
                        </div>
                    </el-card>
                </div>
            </el-col>
        </el-container>
        <el-row type="flex" justify="center" class="surface-validation">
            <el-button type="success" round :disabled="disabled" @click="chooseSurface">Passer au choix des options</el-button>
        </el-row>
    </div>

</template>

<script>

    export default {
        name: "SurfaceStep",
        data() {
            return {
                allSurfaces: [],
                disabled: true,
                loading: true,
                chosenSurface: {},
                cardSelected: false,
                projectId: ''
            }
        },
        methods: {
            chooseSurface() {
                this.$apiRequester.saveChosenSurface(this.projectId, this.chosenSurface).then((response) => {
                    this.$router.push({name: 'OptionsStep', query: {projectId: this.projectId}});
                })
            },
            handleSurface(surface) {
                if(this.chosenSurface === {} || this.chosenSurface !== surface) {
                    this.chosenSurface = surface;
                    this.disabled = false;
                } else {
                    this.chosenSurface = {};
                    this.disabled = true;
                }
            }
        },
        created() {
            this.projectId = this.$route.query.projectId;
            this.$apiRequester.getAllSurfaces(this.projectId).then((response) => {
                this.allSurfaces = response.data
                this.loading = false;
            })
        },
    }

</script>

<style scoped>

    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-top: 50px;
    }
    .card-img-container {
        width: 450px;
        height: 300px;
    }
    .card-img-container img {
        width: 100%;
        height: 100%;
    }
    .cards .card-container {
        width: 450px;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .cards .card-container.not-selected:hover {
        transform: scale(1.03);
        -webkit-box-shadow: 0 0 14px 3px rgba(87,53,51,1);
        -moz-box-shadow: 0 0 14px 3px rgba(87,53,51,1);
        box-shadow: 0 0 14px 3px rgba(87,53,51,1);
    }
    .card-text-container {
        padding: 10px;
    }
    .price-surface {
        margin-top: 10px;
    }
    .surface-validation {
        margin-top: 80px;
    }
    .surface-validation button:hover[disabled=false] {
        background: #67C23A;
        border-color: #67C23A;
        color: #FFF;
    }
    .selected {
        transform: scale(1.03);
        -webkit-box-shadow: 0 0 18px 20px rgba(87,53,51,1);
        -moz-box-shadow: 0 0 18px 20px rgba(87,53,51,1);
        box-shadow: 0 0 18px 20px rgba(87,53,51,1);
    }

</style>