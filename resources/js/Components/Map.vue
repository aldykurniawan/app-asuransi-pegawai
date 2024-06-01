<style>
    .frame__leaflet {
        min-height: 300px;
        height: 100%;
        width: 100%;
    }
    .frame__loading {
        min-height: 300px;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
<template>
    <div class="frame__leaflet" v-if="show">
        <l-map ref="map" v-model:zoom="zoom" :center="[lang, long]" :use-global-leaflet="false">
            <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                layer-type="base"
                name="OpenStreetMap"
            ></l-tile-layer>
            <l-layer-group>
                <l-marker :lat-lng="coordinates" draggable @moveend="onDragLocation">
                    <l-popup> Hi! You can drag me around! </l-popup>
                </l-marker>
            </l-layer-group>
        </l-map>
    </div>
    <div class="frame__loading" v-else>
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="mt-2">LOADING MAPS ...</h5>
    </div>
</template>
<script>
import "leaflet/dist/leaflet.css";
import 'leaflet/dist/images/marker-shadow.png';
import 'leaflet/dist/images/marker-icon.png';
import { LMap, LTileLayer, LLayerGroup, LMarker, LPopup } from "@vue-leaflet/vue-leaflet";

// import L from 'leaflet';

// delete L.Icon.Default.prototype._getIconUrl;

// L.Icon.Default.mergeOptions({
//     iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
//     iconUrl: require('leaflet/dist/images/marker-icon.png'),
//     shadowUrl: require('leaflet/dist/images/marker-shadow.png')
// });

export default {
    props:{
        triggerChange: {
            type: Function,
            default: () => {}
        },
        valueData: {
            type: Object,
            default: null
        }
    },
    components: {
        LMap,
        LTileLayer,
        LLayerGroup,
        LMarker,
        LPopup
    },
    data() {
        return {
            show: false,
            zoom: 24,
            lang: 47.41322,
            long: -1.219482,
            coordinates: null,
        };
    },
    watch: {
        // watch coordinates
        coordinates: {
            handler: function (val) {
                this.triggerChange(val);
                setTimeout(() => {
                    this.lang = val.lat;
                    this.long = val.lng;
                    this.show = true;
                }, 1000);
            },
            deep: true,
        },
    },
    mounted() {
        if (this.valueData !== null) {
            this.coordinates = this.valueData;
        } else {
            this.getLocation();
        }
    },
    methods: {
        onDragLocation(val) {
            if (val) {
                if (val.target && val.target?._latlng) {
                    const { lat, lng } = val.target?._latlng;
                    this.coordinates = { lat, lng };
                    this.lang = lat;
                    this.long = lng;
                }
            }
        },
        async getLocation() {
            // use navigator geoLocation for get lang and long
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // Jika mendapatkan lokasi dengan sukses
                    this.lang = position.coords.latitude;
                    this.long = position.coords.longitude;
                    this.coordinates = { lat: this.lang, lng: this.long };
                    // add marker to leaflet using vue-leaflet
                },
                (error) => {
                    // Jika gagal mendapatkan lokasi atau tidak diberikan izin
                    console.warn('ERROR(' + error.code + '): ' + error.message);
                    this.lang = 0.5632429184185753;
                    this.long = 117.56551688827986;
                    this.zoom = 12;
                    this.coordinates = {
                        lat: 0.5632429184185753,
                        lng: 117.56551688827986
                    };
                },
                {
                    // Opsi tambahan untuk getCurrentPosition (jika diperlukan)
                    timeout: 5000
                }
            );

        }
    },
};
</script>
