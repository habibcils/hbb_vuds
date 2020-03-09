<template>
    <div>
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>GIS</h5>
                            <span>Jakarta coordinate</span>
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
                                <a href="#">Applications</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">GIS</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header"><h3>GIS </h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <GmapMap ref="mapRef"
                                :center="{lat:10, lng:10}"
                                :zoom="7"
                                map-type-id="terrain"
                                style="width: 500px; height: 300px"
                                >
                                <GmapMarker
                                    :key="index"
                                    v-for="(m, index) in markers"
                                    :position="m.position"
                                    :clickable="true"
                                    :draggable="true"
                                    @click="center=m.position"
                                />
                                </GmapMap>
                            </div>
                        </div>                                            
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
// import Layout from '@/components/admin/Layout.vue'
import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'
console.log('from GIS')


Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyAgz3dX2HpGWQVG9-Zm03ULTlO8F7_SyHI',
    }}
);

export default {
    name: 'Gis',
	components:{
		// Layout
    },
    mounted(){
        this.$refs.mapRef.$mapPromise.then((map) => {
        map.panTo({lat: -6.200000, lng: 106.816666})
    })
    },
	// name: "Index",
	data() {
		return {
			msg: "Welcome to Your Vue.js App"
		};
	}
};
</script>