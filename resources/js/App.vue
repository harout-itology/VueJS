<template>
    <div class="">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="javascript:">
                    <i class="fas fa-sms fa-2x text-danger"></i> {{name}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <router-link :to="treeUrl" class="nav-item nav-link">Templates Tree</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="historyUrl" class="nav-item nav-link">Log History</router-link>
                        </li>
                        <li class="nav-item dropdown"> 
                            <a id="navbarDropdown" class="nav-link" href="javascript:" >
                                {{username}} <i class="fas fa-user"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">  
                <div class="col-md-12">
                    <main class="py-5">
                        <transition>
                            <keep-alive>
                                <router-view :username="username" ></router-view>
                            </keep-alive>
                        </transition>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: process.env.MIX_APP_NAME,
                username: 'guest user',
                treeUrl: '/launch',
                historyUrl: '/log-history'
            }
        },
        methods:{
            getData(){
                this.axios.get('/api/remoteUser').then(response => {
                    if(!response.data.error){
                        this.username = response.data.name;
                    }
                });
            }          
        },
        created() {
            this.getData();
        },
        watch: {
            '$route':{
                handler: (route) => {
                    document.title = route.meta.title;
                },
                immediate: true
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss">
    #navbarSupportedContent{
        #navbarDropdown {
            text-transform: capitalize;
        }
    }
</style>

