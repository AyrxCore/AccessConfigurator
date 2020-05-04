<template>

    <div id="optionsStepContainer">
        <h1>Choisissez les options de personnalisation</h1>
        <el-collapse accordion>
            <el-collapse-item name="1">
                <template slot="title">
                    <h4>Revêtement</h4>
                </template>
                <div style="display: flex; align-items: center;">
                    <h6 style="margin-bottom: 0.5rem">Enduit</h6>
                    <el-form ref="form" label-width="120px" :inline="true" style="display: flex; align-items: center;">
                        <el-form-item label="Type" style="margin-bottom: 0; display: flex; align-items: center;">
                            <el-select placeholder="Sélectionnez le type" v-model="type">
                                <el-option
                                        v-for="(item, key) in itemsType"
                                        :key="key"
                                        :label="item.label+' (+ '+item.value+' €)'"
                                        :value="item.value">
                                    <span style="float: left">{{ item.label }}</span>
                                    <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ item.value }} €</span>
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Couleur" style="margin-bottom: 0; display: flex; align-items: center;">
                            <el-select placeholder="Sélectionnez la couleur" v-model="couleur">
                                <el-option
                                        v-for="(item, key) in itemsCouleur"
                                        :key="key"
                                        :label="item.label+' (+ '+item.value+' €)'"
                                        :value="item.value">
                                    <span style="float: left">{{ item.label }}</span>
                                    <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ item.value }} €</span>
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Matière" style="margin-bottom: 0; display: flex; align-items: center;">
                            <el-select placeholder="Sélectionnez la matière" v-model="matiere">
                                <el-option
                                        v-for="(item, key) in itemsMatiere"
                                        :key="key"
                                        :label="item.label+' (+ '+item.value+' €)'"
                                        :value="item.value">
                                    <span style="float: left">{{ item.label }}</span>
                                    <span style="float: right; color: #8492a6; font-size: 13px;">+ {{ item.value }} €</span>
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-card style="width: 200px;margin: 0 100px;">
                            <div class="text item" style="text-align: center">
                                <p style="font-size: 15px">Total de la section</p>
                                <p style="font-size: 30px; margin-bottom: 0">500 €</p>
                            </div>
                        </el-card>
                        <el-form-item style="margin-bottom: 0">
                            <el-button type="primary" @click="choiceOption">Valider votre choix</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </el-collapse-item>
            <el-collapse-item name="2">
                <template slot="title">
                    <h4>Toiture</h4>
                </template>
                <div>Retour d'expèrience: permets aux utilisateurs de percevoir clairement leur opérations par le biais d'animations et d'effets interactifs.</div>
                <div>Retour visuel: reflète l'état actuel de la page via le réarrangement ou la mise à jour des éléments.</div>
            </el-collapse-item>
            <el-collapse-item name="3">
                <template slot="title">
                    <h4>Salle de bain</h4>
                </template>
                <div>Simplifier le processus: garde chaque opération simple et intuitive.;</div>
                <div>Clair et défini: énonce clairement ses intentions afin que l'utilisateur puisse comprendre et prendre une décision rapidement;</div>
                <div>Facile à identifier: l'interface devrait être simple et facile d'accès, afin que les utilisateurs n'ai pas d'efforts de mémorisation à faire.</div>
            </el-collapse-item>
        </el-collapse>
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
            }
        },
        methods : {
            choiceOption() {
                console.log('choiceOption')
            }
        }
    }

</script>

<style scoped>

    label {
        margin-bottom: 0;
    }

</style>