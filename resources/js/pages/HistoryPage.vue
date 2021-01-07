<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <data-table
                            @loading="isLoading = true"
                            @finished-loading = "isLoading = false"                    
                            :filters = "filters"
                            :url = "url"
                            :per-page = "length"
                            :order-by = "column"
                            :order-dir = "dir"
                            :columns = "columns"
                            :classes = "classes"
                            ref="myTable">
                            <div slot="filters" slot-scope="{ tableFilters, perPage }">
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <select class="form-control" v-model="tableFilters.length">
                                            <option :key="page" v-for="page in perPage">{{ page }}</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-2">
                                        <input name="Username" title="Username" class="form-control" v-model="form.username" placeholder="Username" >
                                    </div>
                                    <div class="col-md-2">
                                        <input name="recipientNumber" title="Recipient Number" class="form-control" v-model="form.recipientNumber" placeholder="Recipient Number">
                                    </div>
                                    <div class="col-md-3">
                                        <date-range-picker ref="picker" name="dateRange" v-model="form.dateRange" :locale-data="locale" :autoApply="autoApply" >
                                            <template v-slot:input="picker">
                                                {{ form.dateRange.startDate | date }}
                                                {{ form.dateRange.startDate ? '-' : 'Search Daterange'}}
                                                {{ form.dateRange.endDate | date }}
                                            </template>
                                        </date-range-picker>
                                    </div>                                
                                    <div class="col-md-1">
                                        <button type="button" @click="submitFilters" class="btn btn-primary">Submit</button>
                                    </div>
                                     <div class="col-md-1">
                                        <button type="button" @click="resetFilters" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </data-table>
                        <loading :is-full-page="false" :active.sync="isLoading"></loading>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TailablePagination from 'tailable-pagination';       
    import ResultCodeComponent from './../components/ResultCodeComponent.vue';
    import DateRangePicker from 'vue2-daterange-picker'                                                          /* https://innologica.github.io/vue2-daterange-picker */
    import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'
    import Loading from 'vue-loading-overlay';                                                                   /* https://ankurk91.github.io/vue-loading-overlay */
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        filters:{
            date(value){
                if(value)
                    return moment.tz(value, 'Asia/Yerevan').format('YYYY MMM DD');
                return '';
            }
        },
        components: {
            ResultCodeComponent,
            DateRangePicker,
            Loading,
        },
        props: [
            'username'
        ],
        data() {
            return {
                form:{
                    dateRange: {},
                    username: '',
                    recipientNumber: ''
                },
                filters:{
                    dateRange: {},
                    username: '',
                    recipientNumber: ''
                },
                locale: {
                    firstDay: 1,
                },
                isLoading: false,
                url: '/api/templateslog',
                length: ['10', '25', '50'],
                column: 'id',
                dir: 'desc',
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        orderable: true
                    },
                    {
                        label: 'Username',
                        name: 'username',
                        orderable: true
                    },
                    {
                        label: 'Date',
                        name: 'created_at',
                        orderable: true,
                        width: 12,
                        transform: ({data, name}) => moment.tz(data[name], 'Asia/Yerevan').format('YYYY MMM DD h:mm a')
                    },
                    {
                        label: 'Recipient Number',
                        name: 'recipient_number',
                        orderable: true
                    },
                    {
                        label: 'SMS Text',
                        name: 'message',
                        width: 42,
                        orderable: true
                    },                
                    {
                        label: 'Result Code',
                        name: 'result_code',
                        orderable: true,
                        component: ResultCodeComponent,
                    }
                ],
                classes: {
                    "table-container": {
                        'justify-center': true,
                        'w-full': true,
                        'flex': true,
                        'rounded': true,
                        'mb-6': true,
                        'shadow-md': true,
                    },
                    "table": {
                        'text-left': true,
                        'w-full': true,
                        'border-collapse': true,
                    },
                    "t-head": {
                        'text-grey-dark': true,
                        'bg-black': true,
                        'border-grey-light': true,
                        'py-4': true,
                        'px-6': true,
                    },
                    "t-body": {
                        'bg-grey-darkest': true,
                        'text-center': true,
                    }
                },
                autoApply: true
            }
        },
        methods:{
            resetFilters(){    
                this.filters.dateRange = {} ; 
                this.filters.username = '';
                this.filters.recipientNumber = '';
            },
            submitFilters(){          
                this.filters.dateRange = {
                    startDate: moment.tz(this.form.dateRange.startDate, 'Asia/Yerevan').format('YYYY-MM-DD'), 
                    endDate: moment.tz(this.form.dateRange.endDate, 'Asia/Yerevan').format('YYYY-MM-DD')            
                };
                this.filters.username = this.form.username;
                this.filters.recipientNumber = this.form.recipientNumber;        
            }    
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss">
    select.form-control{
        width: auto;
    }
    span.badge{
        padding: 7px;
    }
    .vue-daterange-picker{
        min-width: 240px !important;
    }
</style>
