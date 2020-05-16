<template>

    <div id="modelStepContainer">
        <h1>Choisissez un modèle de la gamme Access</h1>
        <el-container class="cards" v-loading="loading" element-loading-background="rgba(255, 255, 255, 1)">
            <el-col :class="chosenModel.id === model.id ? 'card-container selected' : 'card-container not-selected'" :span="6" v-for="(model, key) in allModels"
                    :key="key">
                <div @click="handleModel(model)" class="test">
                    <el-card
                            :body-style="{ padding: '0px' }">
                        <div class="card-img-container">
                            <img :src="'../../img/'+model.img" class="image">
                        </div>
                        <div class="card-text-container">
                            <h3 class="title-model">
                                {{model.name}}
                            </h3>
                            <div class="description-model">
                                {{model.description}}
                            </div>
                            <h4 class="price-model">
                                A partir de {{model.lowerPrice}} €
                            </h4>
                        </div>
                    </el-card>
                </div>
            </el-col>
        </el-container>
        <el-row type="flex" justify="center" class="model-validation">
            <el-button type="success" round :disabled="disabled" @click="chooseModel">Passer au choix de la surface</el-button>
        </el-row>
    </div>

</template>

<script>

    export default {
        name: "ModelStep",
        data() {
            return {
                allModels: [],
                disabled: true,
                loading: true,
                chosenModel: {},
                cardSelected: false,
                projectId: ''
            }
        },
        methods: {
            chooseModel() {
                this.$apiRequester.saveChosenModel(this.projectId, this.chosenModel).then((response) => {
                    console.log(response.data)
                })
            },
            handleModel(model) {
                if(this.chosenModel === {} || this.chosenModel !== model) {
                    this.chosenModel = model;
                    this.disabled = false;
                } else {
                    this.chosenModel = {};
                    this.disabled = true;
                }
            }
        },
        created() {
            this.projectId = this.$route.query.projectId;
            this.$apiRequester.getAllModels().then((response) => {
                this.allModels = response.data
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
    .price-model {
        margin-top: 10px;
    }
    .model-validation {
        margin-top: 80px;
    }
    .model-validation button:hover[disabled=false] {
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