<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="button" class="btn btn-primary fa-pull-right" @click="sendNow()" :disabled="SendNowDisabled">
				        Send Now <i v-if="showloading" class="fas fa-spinner fa-pulse"></i>
				    </button>
                                    <h5><i class="fas fa-project-diagram"></i> Templates Tree</h5>
                                    <v-jstree :data="data" :async="loadData" size="large" ref="tree" show-checkbox multiple allow-batch whole-row @item-click="itemClick"></v-jstree>
                                    <hr>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="mb-3"><i class="fas fa-chalkboard-teacher"></i> Request Parameters</h5>                            
                                        <div class="row">                                          
                                            <div class="col-md-5">Recipient Num :</div>
                                            <div class="col-md-7"><input class="form-control" v-model="form.recipientNumber" placeholder="Must be 11 Digits"></div>                                          
                                            <div class="col-md-5">Username :</div>
                                            <div class="col-md-7"><input class="form-control" v-model="form.username" placeholder="Username"></div>
                                        </div>                                   
                                    <hr>
                                    <h5 class="mb-3"><i class="fas fa-database"></i> SMS Data</h5>
                                    <ol>
                                        <li v-for="item in SMSText" > {{item}} </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myErrorModal" ref="myErrorModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div :class="errorMessageHeaderColor">
                        <h3 class="modal-title">{{errorMessageHeader}}</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>{{errorMessage}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VJstree from 'vue-jstree';     /* https://reposhub.com/vuejs/tree/zdy1988-vue-jstree.html */
    import { sendNowJs } from './../functions/TreePageFunction.js'
    export default {
        components: {
            VJstree
        },
        props: [
            'username'
        ],
        data() {
            return {
                showloading : false,
                SendNowDisabled: false,
                errorMessageHeaderColor: 'modal-header',
                errorMessageHeader: 'Error Message',
                errorMessage: '',
                data: [],
                SMSData: [],
                SMSText: [],
                form: {}
            }
        },
        created() {
            axios.get('/api/templates')
                .then(function (response) {
                    this.data = response.data;                    
                }.bind(this))
                .catch(error => {
                    console.log('Error fetching data ' + error)
            });
        },
        methods: {
            loadData: function () {},
            itemClick (node) {
                let index = this.SMSData.indexOf(node.model.id);
                if( index === -1 ){
                    this.SMSData.push(node.model.id);
                    this.SMSText.push(node.model.text);
                }
                else{
                    this.SMSData.splice(index, 1);
                    this.SMSText.splice(index, 1);
                }
            },
            sendNow(){
                sendNowJs(this);
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss">
    .tree-disabled{
        .tree-icon.tree-checkbox{
            display: none;
        }
    }
</style>
