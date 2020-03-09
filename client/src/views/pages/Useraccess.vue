<template>
    <div>

        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>Data Users Access</h5>
                            <span>List all users on this application</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">System</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Users Access</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header"><h3>Data User Access</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex">
                                    <button v-ripple class="btn btn-success mrg-btm-10" @click="showModal('', 'add')"><i class="ik ik-plus"></i> Add User</button>
                                </div>
                            </div>
                        </div>
                        <div class="tableFilters">
                            <div class="col-sm-3" style="padding-right:0">
                            <input class="form-control" type="text" v-model="tableData.search" placeholder="Search Table"
                                @input="getProjects()">
                            </div>
                            <div class="control">
                                <div class="select">
                                    <select class="form-control" v-model="tableData.length" @change="getProjects(),changeRecord()">
                                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>                        
                        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                            <tbody>
                                <tr v-for="project in projects" :key="project.id">
                                    <td>{{project.id}}</td>
                                    <td>{{project.usergroup_name}}</td>
                                    <td> 
                                        <span class="cursor mrg-r-10" @click="showModal(project.id, 'edit')"> <i  class="ik ik-edit f-16 text-green"></i></span>
                                        <span class="cursor" @click="confirmDel(project.id)"> <i  class="ik ik-trash f-16 text-green"></i></span> 
                                    </td>
                                </tr>
                            </tbody>
                        </datatable>
                        <pagination :pagination="pagination"
                                    @prev="prevPage()"
                                    @next="nextPage()">
                        </pagination>                                                
                    </div>
                </div>
            </div>
        </div>
        <Modal :modal="modal" :closeModal="closeModal" :data="dataModal" @save="saveModal" :modeModal="modeModal" :userGroup="userGroup" />
    </div>
</template>

<script>
import Datatable from '@/components/datatable/Datatable.vue'
import Pagination from '@/components/datatable/Pagination.vue'
import Modal from '@/components/usergroup/Modal.vue'
import {FadeTransition} from 'vue2-transitions'
import {apiBase} from "@/helpers"
export default {
    components: { Datatable, Pagination, Modal, FadeTransition },
    created() {
        this.getProjects()
        this.getUserGroup()
    },
    data() {
        let sortOrders = {};

        let columns = [
            {width: '5%', label: 'Id', name: 'id' },
            {width: '80%', label: 'Usergroup Name', name: 'name'},
            {width: '12%', label: 'Action', name: 'action'}
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            prefixApi: '/useraccess',
            dataModal: [],
            userGroup: [],
            modeModal: null,       
            modal : false,
            addModal: false,
            projects: [],
            columns: columns,
            sortKey: 'id',
            sortOrders: sortOrders,
            perPage: [10, 15, 20],
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'desc',
                offset: 0
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
        }
    },
    methods: {
        showModal(key, mode){
            if(mode == 'add'){
                this.dataModal = []
                this.modal = true
                this.modeModal = 'add'
            }else{
                this.modeModal = 'edit'
                apiBase.get(this.prefixApi, {params: {"id":key}  })
                    .then(response => {
                        let data = response.data;
                        this.modal = true
                        this.dataModal = data.data[0]
                    })
                    .catch(errors => {
                        // console.log(errors);
                    });
            }
        },
        async confirmDel(key){
            let conf = await this.$dialog.confirm('Delete Data ?').then(function(dialog) {
                    return true;
                }).catch(function(e) {
                    
                });
            if (conf)
                this.deleteUser(key)
        },
        deleteUser(key){
            apiBase.post(this.prefixApi+'/delete', { 'id': key }   )
                .then(response => {
                    this.$toasted.success('Successfully Deleted').goAway(2000)         
                    this.getProjects()
                })
                .catch(errors => {
                    // console.log(errors);
                });
        },
        saveModal(){
            if(this.modeModal == 'add'){
                apiBase.post(this.prefixApi, { ...this.dataModal })
                .then(response => {
                    this.modal = false
                    this.getProjects()
                    this.$toasted.success('Successfully Added').goAway(2000)         
                })
                .catch(errors => {
                    this.$toasted.info('Please fill form data before save').goAway(2000)
                    // console.log('errror '+errors);
                });
            }else{
                apiBase.put(this.prefixApi, { ...this.dataModal })
                .then(response => {
                    this.modal = false
                    this.getProjects()
                    this.$toasted.success('Successfully Updated').goAway(2000)         
                })
                .catch(errors => {
                    this.$toasted.info('Please edit data before save').goAway(2000)
                    // console.log('errror '+errors);
                });
            }
        },
        closeModal(key){
            this.modal = false
        },        
        changeRecord(){
            this.tableData.offset = 0
        },
        nextPage(){
            if( (this.tableData.offset + this.tableData.length) >= this.pagination.total){

            }else{
                this.tableData.offset = this.tableData.offset + this.tableData.length
                this.getProjects()
            }

        },
        prevPage(){
            if(this.tableData.offset <= 0){
                this.tableData.offset == 0;
            }else{
                this.tableData.offset = (this.tableData.offset - this.tableData.length)
            }
            this.getProjects()
        },
        getUserGroup(){
            apiBase.get(this.prefixApi)
                .then(response => {
                    this.userGroup = response.data.data;
                })
                .catch(errors => {
                    // console.log(errors);
                });
        },    
        getProjects() {
            this.tableData.draw++;
            apiBase.get(this.prefixApi+'/datatable', {params: this.tableData})
                .then(response => {
                    if(this.tableData.length < 0 ){
                        this.tableData.length = 0;
                    }
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.configPagination(data);
                        this.projects = data.data;
                    }
                })
                .catch(errors => {
                    // console.log(errors);
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.count_data;
            this.pagination.to = data.count_data;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getProjects();
            this.tableData.offset = 0
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    }
};
</script>
