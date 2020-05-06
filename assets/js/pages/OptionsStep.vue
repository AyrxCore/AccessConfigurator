<template>

    <div id="optionsStepContainer">
        <h1>Choisissez les options de personnalisation</h1>
        <el-form>
            <el-collapse accordion>
                <el-collapse-item name="1">
                    <template slot="title">
                        <h4>Revêtement</h4>
                    </template>
                    <div :style="validate ? styleSectionSelected : ''" class="section-container">
                        <h6 style="margin-bottom: 0.5rem">Enduit</h6>
                        <el-form :inline="true" label-width="120px" ref="form"
                                 style="display: flex; align-items: center;">
                            <el-form-item label="Type">
                                <el-select @change="modifyTotalSection(type, 'type')" placeholder="Sélectionnez le type"
                                           v-model="type">
                                    <el-option
                                            :key="key"
                                            :label="item.label+' (+ '+item.value+' €)'"
                                            :value="item.value"
                                            v-for="(item, key) in itemsType">
                                        <span style="float: left">{{ item.label }}</span>
                                        <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ item.value }} €</span>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="Couleur">
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
                            <el-form-item label="Matière">
                                <el-select @change="modifyTotalSection(matiere, 'matter')" placeholder="Sélectionnez la matière"
                                           v-model="matiere">
                                    <el-option
                                            :key="key"
                                            :label="item.label+' (+ '+item.value+' €)'"
                                            :value="item.value"
                                            v-for="(item, key) in itemsMatiere">
                                        <span style="float: left">{{ item.label }}</span>
                                        <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ item.value }} €</span>
                                    </el-option>
                                </el-select>
                            </el-form-item>
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
                <el-collapse-item name="2">
                    <template slot="title">
                        <h4>Toiture</h4>
                    </template>
                    <div>Retour d'expèrience: permets aux utilisateurs de percevoir clairement leur opérations par le
                        biais d'animations et d'effets interactifs.
                    </div>
                    <div>Retour visuel: reflète l'état actuel de la page via le réarrangement ou la mise à jour des
                        éléments.
                    </div>
                </el-collapse-item>
                <el-collapse-item name="3">
                    <template slot="title">
                        <h4>Salle de bain</h4>
                    </template>
                    <div>Simplifier le processus: garde chaque opération simple et intuitive.;</div>
                    <div>Clair et défini: énonce clairement ses intentions afin que l'utilisateur puisse comprendre et
                        prendre une décision rapidement;
                    </div>
                    <div>Facile à identifier: l'interface devrait être simple et facile d'accès, afin que les
                        utilisateurs n'ai pas d'efforts de mémorisation à faire.
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
    }
    .el-form-item {
        margin-bottom: 0;
    }
    .btn-submit-configuration {
        text-align: center;
        margin-top: 30px;
    }

</style>