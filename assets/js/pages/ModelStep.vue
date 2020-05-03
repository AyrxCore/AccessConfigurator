<template>

    <div id="modelStepContainer">
        <h1>Choisissez un modèle de la gamme Access</h1>
        <div class="card-container">
            <el-col :span="6" v-for="(model, key) in allModels" :key="key">
                <div @click="chooseModel">
                    <el-card :body-style="{ padding: '0px' }">
                        <div class="card-img-container">
                            <img :src="model.img" class="image">
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
        </div>
    </div>

</template>

<script>

    export default {
        name: "ModelStep",
        data() {
            return {
                allModels: [
                    {name: 'Acacia',
                    img: '../../img/acacia.jpg',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam eu augue euismod sagittis sit amet et erat. Nullam sed velit in justo auctor mollis. Etiam vitae odio ac nibh fermentum semper. Ut at turpis sem. Maecenas vitae suscipit nisl, ac egestas velit. Mauris porttitor congue ipsum, et eleifend dui dapibus sit amet.',
                    lowerPrice: '125 000'},
                    {name: 'Lotus',
                        img: '../../img/lotus.jpg',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam eu augue euismod sagittis sit amet et erat. Nullam sed velit in justo auctor mollis. Etiam vitae odio ac nibh fermentum semper. Ut at turpis sem. Maecenas vitae suscipit nisl, ac egestas velit. Mauris porttitor congue ipsum, et eleifend dui dapibus sit amet.',
                        lowerPrice: '150 000'},
                    {name: 'Magnolia',
                        img: '../../img/magnolia.jpg',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam eu augue euismod sagittis sit amet et erat. Nullam sed velit in justo auctor mollis. Etiam vitae odio ac nibh fermentum semper. Ut at turpis sem. Maecenas vitae suscipit nisl, ac egestas velit. Mauris porttitor congue ipsum, et eleifend dui dapibus sit amet.',
                        lowerPrice: '110 000'},
                    ]
            }
        },
        methods: {
            chooseModel() {
                this.$router.push({name: 'SizeStep', param:{model: 'Acacia'}})
            }
        }
    }

</script>

<style scoped>

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-top: 30px;
    }
    .card-img-container {
        width: 500px;
        height: 350px;
    }
    .card-img-container img {
        width: 100%;
        height: 100%;
    }
    .card-container > div {
        width: 500px;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .card-container > div:hover {
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

</style>