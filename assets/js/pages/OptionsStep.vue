<template>

    <div id="optionsStepContainer">
        <h1>Choisissez les options de personnalisation</h1>
        <el-form element-loading-background="rgba(255, 255, 255, 1)" v-loading="loading">
            <el-collapse accordion>
                <el-collapse-item :key="optionId" v-for="(option, optionId) in allOptions">
                    <template slot="title">
                        <h4>{{option.name}} <v-icon v-if="categoryCompletelyValidate[optionId]" style="color: #85ce61;" name="check-circle"></v-icon></h4>
                    </template>
                    <div :key="productId"
                         :style="section[productId].validate ? styleSectionSelected : ''"
                         class="section-container"
                         v-for="(product, productId) in option.products">
                        <h6 style="margin-bottom: 0.5rem; width: 6rem">{{product.name}}</h6>
                        <el-form :inline="true" ref="form">
                            <div class="products-container">
                                <el-form-item class="product-form-item" label="Type" label-width="4rem" v-if="product.types">
                                    <el-select @change="calculateTotalPrice(optionId, productId, 'types')"
                                               placeholder="Sélectionnez le type"
                                               v-model="typeSelected[productId]">
                                        <el-option
                                                :key="typeId"
                                                :label="type.name+' (+ '+type.price+' €)'"
                                                :value="typeId"
                                                v-for="(type, typeId) in product.types"
                                        >
                                            <span style="float: left">{{ type.name }}</span>
                                            <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ type.price }} €</span>
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                                <el-form-item class="product-form-item" label="Couleur" v-if="product.colors">
                                    <el-select @change="calculateTotalPrice(optionId, productId, 'colors')"
                                               placeholder="Sélectionnez la couleur"
                                               v-model="colorSelected[productId]">
                                        <el-option
                                                :key="colorId"
                                                :label="color.name+' (+ '+color.price+' €)'"
                                                :value="colorId"
                                                v-for="(color, colorId) in product.colors"
                                        >
                                            <span style="float: left">{{ color.name }}</span>
                                            <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ color.price }} €</span>
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                                <el-form-item class="product-form-item" label="Matière" v-if="product.matters">
                                    <el-select @change="calculateTotalPrice(optionId, productId, 'matters')"
                                               placeholder="Sélectionnez la matière"
                                               v-model="matterSelected[productId]">
                                        <el-option
                                                :key="matterId"
                                                :label="matter.name+' (+ '+matter.price+' €)'"
                                                :value="matterId"
                                                v-for="(matter, matterId) in product.matters"
                                        >
                                            <span style="float: left">{{ matter.name }}</span>
                                            <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ matter.price }} €</span>
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="price-button-container">
                                <el-card style="width: 200px;margin: 0 100px;">
                                    <div class="text item" style="text-align: center">
                                        <p style="font-size: 15px">Total de la section</p>
                                        <p style="font-size: 30px; margin-bottom: 0">{{section[productId].price}} €</p>
                                    </div>
                                </el-card>
                                <el-form-item style="margin-bottom: 0" v-if="!section[productId].validate">
                                    <el-button :key="productId"
                                               @click="choiceOption(optionId, productId, true)"
                                               type="primary"
                                    >Valider votre choix
                                    </el-button>
                                </el-form-item>
                                <el-form-item v-else>
                                    <el-button :key="productId" @click="choiceOption(optionId, productId, false)" type="success">Choix
                                        sauvegardé
                                    </el-button>
                                </el-form-item>
                            </div>
                        </el-form>
                    </div>
                </el-collapse-item>
            </el-collapse>
            <div>
                <h3>Prix total des options</h3>
                <p>{{getOptionsTotalPrice}} €</p>
                <h3>Prix total maison + options</h3>
                <p>{{getTotalPrice}} €</p>
            </div>
            <el-form-item class="btn-submit-configuration">
                <el-button @click="onSubmit" type="primary">Valider la configuration</el-button>
            </el-form-item>
        </el-form>
    </div>

</template>

<script>

    import _filter from 'lodash/filter';
    import _foreach from 'lodash/forEach';

    export default {
        name: "OptionsStep",
        data() {
            return {
                typePrices: {},
                colorPrices: {},
                matterPrices: {},
                section: {},
                styleSectionSelected: 'background: linear-gradient(327deg, rgba(254,254,254,1) 0%, rgba(132,242,94,0.5018382352941176) 100%);',
                allOptions: [],
                allProducts: [],
                loading: true,
                typeSelected: {},
                colorSelected: {},
                matterSelected: {},
                productSelected: '',
                categoryCompletelyValidate: {},
                housePrice: ''
            }
        },
        computed: {
            getOptionsTotalPrice() {
                let totalPrice = 0;
                _foreach(this.section, (product) => {
                    totalPrice += product.price;
                });
                return totalPrice;
            },
            getTotalPrice() {
                return parseInt(this.housePrice) + parseInt(this.getOptionsTotalPrice);
            }
        },
        methods: {
            onSubmit() {
                this.$router.push({name: 'SummaryStep'});
            },
            choiceOption(optionId, productId, bool) {
                this.section[productId].validate = bool;
                let data = [];
                let i = 1;
                _foreach(this.allOptions[optionId].products, (product, productId) => {
                    if(!this.section[productId].validate) {
                        data.push(i);
                        i++;
                    }
                });
                this.categoryCompletelyValidate[optionId] = data.length === 0;
            },
            calculateTotalPrice(optionId, productId, cate) {
                let vm = this;
                let productSelected = _filter(this.allProducts, function (x, key) {
                    if (key === productId)
                        vm.productSelected = key;
                    return key === productId;
                })
                if (cate === 'types') {
                    this.typePrices[productId] = parseInt(productSelected[0]['types'][this.typeSelected[productId]]['price']);
                }
                if (cate === "colors") {
                    this.colorPrices[productId] = parseInt(productSelected[0]['colors'][this.colorSelected[productId]]['price']);
                }
                if (cate === "matters") {
                    this.matterPrices[productId] = parseInt(productSelected[0]['matters'][this.matterSelected[productId]]['price']);
                }
                this.section[productId].validate = false;
                this.categoryCompletelyValidate[optionId] = false;
                this.section[productId].price = this.getSectionTotalPrice(productId);
            },
            getSectionTotalPrice(productId) {
                this.typePrices[productId] = this.typePrices[productId] === undefined ? 0 : this.typePrices[productId];
                this.colorPrices[productId] = this.colorPrices[productId] === undefined ? 0 : this.colorPrices[productId];
                this.matterPrices[productId] = this.matterPrices[productId] === undefined ? 0 : this.matterPrices[productId];
                return this.typePrices[productId] + this.colorPrices[productId] + this.matterPrices[productId];
            }
        },
        created() {
            this.projectId = this.$route.query.projectId;
            this.$apiRequester.getAllOptions(this.projectId).then((response) => {
                this.allOptions = response.data.allOptions;
                this.allProducts = response.data.allProducts;
                this.loading = false;
                _foreach(this.allOptions, (option, optionId) => {
                    this.$set(this.categoryCompletelyValidate, optionId, false);
                });
                _foreach(this.allProducts, (product, productId) => {
                    this.$set(this.section, productId, {'validate': false, 'price': 0});
                });
            });
            this.$apiRequester.getProject(this.projectId).then((response) => {
                this.housePrice = response.data.lowerPrice;
            });
        }
    }

</script>

<style scoped>

    label {
        margin-bottom: 0;
    }
    .section-container {
        display: flex;
        align-items: center;
        padding: 0 1rem;
        margin-bottom: 1rem;
    }
    .el-form-item {
        margin-bottom: 0;
    }
    .btn-submit-configuration {
        text-align: center;
        margin-top: 30px;
    }
    #optionsStepContainer .section-container form {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .price-button-container {
        display: flex;
        align-items: center;
    }
    .price-button-container button {
        width: 10rem;
    }
    .product-form-item {
        margin-left: 1rem;
    }

</style>