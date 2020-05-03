<template>

    <div id="sizeStepContainer">
        <h1>Choisissez une surface pour le modèle 'Acacia'</h1>
        <div class="card-container">
            <el-col :span="6" v-for="(size, key) in allSizes" :key="key">
                <div @click="chooseSize">
                    <el-card :body-style="{ padding: '0px' }">
                        <div class="card-img-container">
                            <img :src="size.img1" class="image">
                        </div>
                        <div class="card-text-container">
                            <h3 class="title-model">
                                {{size.value}} m²
                            </h3>
                            <div class="description-model">
                                {{size.description}}
                            </div>
                            <h4 class="price-model">
                                A partir de {{size.lowerPrice}} €
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
        name: "SizeStep",
        data() {
            return {
                allSizes: [
                    {value: '85',
                        img1: '../../img/acacia_85_up.jpg',
                        // img2: '../../img/acacia_85_down.jpg',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam eu augue euismod sagittis sit amet et erat. Nullam sed velit in justo auctor mollis. Etiam vitae odio ac nibh fermentum semper. Ut at turpis sem. Maecenas vitae suscipit nisl, ac egestas velit. Mauris porttitor congue ipsum, et eleifend dui dapibus sit amet.',
                        lowerPrice: '125 000'},
                    {value: '95',
                        img1: '../../img/acacia_95_up.jpg',
                        // img2: '../../img/acacia_95_down.jpg',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at quam eu augue euismod sagittis sit amet et erat. Nullam sed velit in justo auctor mollis. Etiam vitae odio ac nibh fermentum semper. Ut at turpis sem. Maecenas vitae suscipit nisl, ac egestas velit. Mauris porttitor congue ipsum, et eleifend dui dapibus sit amet.',
                        lowerPrice: '150 000'},
                ],
                model: null
            }
        },
        methods: {
            chooseSize() {
                this.$router.push({name: 'OptionsStep', param:{model: 'Acacia', size: '85'}})
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