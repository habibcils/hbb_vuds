<template>
    <div>

        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>Data  Menu Order</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Data Menu Order </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header"><h3>Data  Menu Order</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">

                            </div>
                        </div>                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {apiBase} from "@/helpers"
export default {
    // components: { Datatable, Pagination, Modal, FadeTransition },
    mounted() {
        // this.getProjects()
        // this.getUserGroup()
    },
    data() {
        return {
            prefixApi: '/useraccess',
            dataModal: [],
            userGroup: [],
            modeModal: null,       
            modal : false,
        }
    },
    methods: {
    }
};
</script>
