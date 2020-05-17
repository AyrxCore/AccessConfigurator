<template>

    <div id="optionsStepContainer">
        <h1>Choisissez les options de personnalisation</h1>
        <el-form v-loading="loading" element-loading-background="rgba(255, 255, 255, 1)">
            <el-collapse accordion>
                <el-collapse-item :key="key" v-for="(option, key) in allOptions">
                <template slot="title">
                        <h4>{{option.category.name}}</h4>
                    </template>
                    <div v-for="(product, key) in option.products" :key="key" :style="validate ? styleSectionSelected : ''" class="section-container">
                        <h6 style="margin-bottom: 0.5rem">{{product.name}}</h6>
                        <el-form :inline="true" label-width="120px" ref="form"
                                 style="display: flex; align-items: center;">
                            <el-form-item label="Type" v-for="(specs, key) in option.specs" :key="key">
                                <el-select @change="modifyTotalSection(type, 'type')" placeholder="Sélectionnez le type"
                                           v-model="type">
                                    <el-option
                                            :label="specs.type+' (+ '+specs.price+' €)'"
                                            :value="specs.price"
                                            >
                                        <span style="float: left">{{ specs.type }}</span>
                                        <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ specs.price }} €</span>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item v-if="specs.color" label="Couleur">
                                <el-select @change="modifyTotalSection(couleur, 'color')" placeholder="Sélectionnez la couleur"
                                           v-model="couleur">
                                    <el-option
                                            :key="key"
                                            :label="item.label+' (+ '+item.value+' €)'"
                                            :value="item.value"
                                            v-for="(item, key) in itemsCouleur">
                                        <span style="float: left">{{ item.label }}</span>
                                        <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ item.value }} €</span>
                                    </el-option>
                                </el-select>
                            </el-form-item>
<!--                            <el-form-item label="Matière">-->
<!--                                <el-select @change="modifyTotalSection(matiere, 'matter')" placeholder="Sélectionnez la matière"-->
<!--                                           v-model="matiere">-->
<!--                                    <el-option-->
<!--                                            :key="key"-->
<!--                                            :label="item.label+' (+ '+item.value+' €)'"-->
<!--                                            :value="item.value"-->
<!--                                            v-for="(item, key) in itemsMatiere">-->
<!--                                        <span style="float: left">{{ item.label }}</span>-->
<!--                                        <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ item.value }} €</span>-->
<!--                                    </el-option>-->
<!--                                </el-select>-->
<!--                            </el-form-item>-->
                            <el-card style="width: 200px;margin: 0 100px;">
                                <div class="text item" style="text-align: center">
                                    <p style="font-size: 15px">Total de la section</p>
                                    <p style="font-size: 30px; margin-bottom: 0">{{totalSection.total}} €</p>
                                </div>
                            </el-card>
                            <el-form-item style="margin-bottom: 0">
                                <el-button @click="choiceOption" type="primary" v-if="!validate">Valider votre choix
                                </el-button>
                                <el-button @click="choiceOption" type="success" v-else>Choix sauvegardé</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </el-collapse-item>
            </el-collapse>
            <el-form-item class="btn-submit-configuration">
                <el-button type="primary" @click="onSubmit">Valider la configuration</el-button>
            </el-form-item>
        </el-form>
    </div>

</template>

<script>

    export default {
        name: "OptionsStep",
        data() {
            return {
                itemsType: [
                    {
                        label: 'Gratté',
                        value: '5'
                    },
                    {
                        label: 'Lissé',
                        value: '10'
                    }
                ],
                itemsCouleur: [
                    {
                        label: 'Noir',
                        value: '45'
                    },
                    {
                        label: 'Blanc',
                        value: '20'
                    }
                ],
                itemsMatiere: [
                    {
                        label: 'Béton',
                        value: '80'
                    },
                    {
                        label: 'Acier',
                        value: '6'
                    }
                ],
                type: '',
                couleur: '',
                matiere: '',
                totalSection: {
                    total: 0,
                    couleur: 0,
                    matiere: 0,
                    type: 0
                },
                validate: false,
                styleSectionSelected: 'background: linear-gradient(327deg, rgba(254,254,254,1) 0%, rgba(132,242,94,0.5018382352941176) 100%);',
                allOptions: [],
                loading: true
            }
        },
        methods: {
            onSubmit() {
                this.$router.push({name: 'SummaryStep'});
            },
            choiceOption() {
                this.validate = !this.validate;
            },
            modifyTotalSection(data, word) {
                switch (word) {
                    case 'color':
                        this.totalSection.couleur = data;
                        break;
                    case 'matter':
                        this.totalSection.matiere = data;
                        break;
                    case 'type':
                        this.totalSection.type = data;
                        break;
                }
                this.calculateTotalPrice();
            },
            calculateTotalPrice() {
                this.totalSection.total = parseInt(this.totalSection.couleur) + parseInt(this.totalSection.matiere) + parseInt(this.totalSection.type);
            }
        },
        created() {
            this.projectId = this.$route.query.projectId;
            this.$apiRequester.getAllOptions(this.projectId).then((response) => {
                console.log(response.data)
                this.allOptions = response.data
                this.loading = false;
            })
        },
    }

</script>

<style scoped>

    label {
        margin-bottom: 0;
    }
    .section-container {
        display: flex;
        align-items: center;
    }
    .el-form-item {
        margin-bottom: 0;
    }
    .btn-submit-configuration {
        text-align: center;
        margin-top: 30px;
    }

</style>