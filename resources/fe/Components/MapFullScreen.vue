<style >
.btn-orange {
  background: #f60;
  color: #fff;
}
.leaflet-control-layers {
  margin-top: 50px !important;
}
.frame__leaflet {
  min-height: 91vh;
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
}
.frame__loading {
  min-height: 91vh;
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: absolute;
  background-color: #fff;
  top: 0;
  left: 0;
  right: 0;
}
.leaflet-container {
  z-index: 2;
}
.button__group {
  position: absolute;
  top: 0;
  right: 0;
  margin-top: 20px;
  margin-right: 20px;
  z-index: 3;
  /* background-color: #fff; */
  /* display: flex; */
}
.input-group {
  position: absolute;
  display: flex;
}
.button__find-me {
  position: absolute;
  bottom: 50px;
  right: 0;
  margin-bottom: 20px;
  margin-right: 10px;
  z-index: 1000;
  background-color: #fff;
  display: flex;
}
.flat .vs__dropdown-toggle {
  border-radius: 0 !important;
  background: #fff;
}
.button__group .v-select {
  min-width: 280px;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
.detail__data {
  display: flex;
  flex-direction: column;
}
.detail__data b {
  font-size: 1.2rem;
  font-weight: bold;
  width: 100%;
  padding-bottom: 10px;
  margin-bottom: 10px;
  border-bottom: 1px solid #ccc;
}
.group__detail {
  display: flex;
  flex-direction: column;
  gap: 5px;
}
.group__detail span {
  font-size: 0.8rem;
}
.option__posko {
  display: flex;
  flex-direction: column;
  gap: 5px;
}
.option__posko h3 {
  font-size: 1rem;
  font-weight: bold;
  margin: 0;
}
.option__posko em {
  font-size: 0.8rem;
}

.remove__border-radius-left {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
.remove__border-radius-right {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
@media (max-width: 768px) {
  .button__group .v-select {
    min-width: 150px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }
  .input-group {
    position: absolute;
    display: flex;
  }
  .button__find-me {
    margin-bottom: 40px;
    margin-left: 20px;
  }
}
</style>
<template>
  <div class="frame__leaflet" v-if="show">
    <div class="button__find-me">
      <button class="btn btn-sm btn-dark" type="button" @click="() => myLocation()">
        <i class="bx bx-map"></i> Lokasi Saya
      </button>
    </div>
    <div class="button__group input-group justify-content-center justify-content-md-end">
      <v-select
        v-model="selectedPosko"
        :options="listDataPosko"
        label="nama"
        class="flat"
        :filterBy="pencarianPosko"
      >
        <template #option="props">
          <div class="option__posko">
            <h3>{{ props.nama }}</h3>
            <em>Kec. {{ props.kecamatan.nama }}, Kel. {{ props.kelurahan.nama }}</em>
          </div>
        </template>
      </v-select>
      <button
        class="btn btn-orange btn-sm remove__border-radius-left"
        type="button"
        @click="() => searchLocation()"
      >Pencarian</button>
    </div>
    <l-map
      ref="map"
      v-model:zoom="zoom"
      :center="[lang, long]"
      :use-global-leaflet="false"
      :options="{zoomControl: false}"
    >
      <!-- <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        layer-type="base"
        name="OpenStreetMap"
      ></l-tile-layer>-->
      <l-control-layers position="topleft"></l-control-layers>
      <l-control-zoom position="topleft"></l-control-zoom>
      <l-control-scale position="bottomright" :imperial="true" :metric="true"></l-control-scale>

      <l-tile-layer
        v-for="tileProvider in tileProviders"
        :key="tileProvider.name"
        :name="tileProvider.name"
        :visible="tileProvider.visible"
        :url="tileProvider.url"
        :attribution="tileProvider.attribution"
        layer-type="base"
      />

      <l-geo-json :geojson="geojson" :options-style="styleGeo"></l-geo-json>

      <l-layer-group>
        <l-marker :lat-lng="coordinates">
          <LIcon icon-url="/images/output.gif" :icon-size="[48, 48]" />
          <LTooltip>Posisimu Disini!</LTooltip>
        </l-marker>
        <!-- <l-circle :lat-lng="[this.lang, this.long]" :radius="1000" color="red" /> -->
        <l-marker
          v-for="(marker, index) in listDataPosko"
          :key="marker.id"
          :lat-lng="[marker.lat, marker.long]"
          @click="onPress"
        >
          <LIcon icon-url="/images/posko.gif" :icon-size="[48, 48]" />
          <l-popup>
            <div class="detail__data">
              <b>{{ marker.nama }}</b>
              <!-- list  -->
              <div class="group__detail">
                <span>Kecamatan: {{ marker.kecamatan.nama }}</span>
                <span>Kelurahan: {{ marker.kelurahan.nama }}</span>
                <span>
                  No Kontak:
                  <a :href="`tel:${marker.no_hp}`" target="_blank">{{ marker.no_hp }}</a>
                </span>
              </div>
            </div>
          </l-popup>
          <LTooltip
            :options="{permanent: marker.show ? true : false, direction: 'top'}"
          >{{ marker.nama }}</LTooltip>
        </l-marker>
        <!-- <l-marker :lat-lng="[this.lang, this.long + 0.02]">
                    <LIcon icon-url="/images/api.svg" :icon-size="[32, 48]" />
                    <LTooltip> Titik laporan </LTooltip>
        </l-marker>-->
      </l-layer-group>
    </l-map>
  </div>
  <div class="frame__loading" v-else>
    <img src="/images/way.gif" style="width: 100px; height: 100px;" alt />
    <h5 class="mt-2">LOADING MAPS ...</h5>
  </div>
</template>
<script>
import "leaflet/dist/leaflet.css";
import "leaflet/dist/images/marker-shadow.png";
import "leaflet/dist/images/marker-icon.png";
import {
  LMap,
  LTileLayer,
  LLayerGroup,
  LMarker,
  LPopup,
  LTooltip,
  LIcon,
  LCircle,
  LControlLayers,
  LControlZoom,
  LControlScale,
  LGeoJson

} from "@vue-leaflet/vue-leaflet";

// import L from 'leaflet';

// delete L.Icon.Default.prototype._getIconUrl;

// L.Icon.Default.mergeOptions({
//     iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
//     iconUrl: require('leaflet/dist/images/marker-icon.png'),
//     shadowUrl: require('leaflet/dist/images/marker-shadow.png')
// });

export default {
  props: {
    triggerChange: {
      type: Function,
      default: () => {},
    },
    valueData: {
      type: Object,
      default: null,
    },
    listPosko: {
      type: Array,
      default: () => [],
    },
    listBencana: {
      type: Array,
      default: () => [],
    },
  },
  components: {
    LMap,
    LTileLayer,
    LLayerGroup,
    LMarker,
    LPopup,
    LTooltip,
    LIcon,
    LCircle,
    LControlLayers,
    LControlZoom,
    LControlScale,
    LGeoJson
  },
  data() {
    return {
      show: false,
      zoom: 10,
      lang: 47.41322,
      long: -1.219482,
      coordinates: null,
      listDataPosko: [],
      selectedPosko: null,
      tileProviders: [
        {
          name: "Sreet Map",
          visible: true,
          attribution:
            '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
          url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        },
        {
          name: "Satelit Map",
          visible: false,
          url: "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
          attribution:
            'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
        },
      ],
      geojson: null
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
    if (this.listPosko) {
      this.listDataPosko = this.listPosko;
    }
    if (this.valueData !== null) {
      this.coordinates = this.valueData;
    } else {
      this.getLocation();
    }
  },
  methods: {
    pencarianPosko(option, label, search) {
      return (
      (option.nama || "")
        .toLocaleLowerCase()
        .indexOf(search.toLocaleLowerCase()) > -1 ||
      (option.kecamatan.nama || "")
        .toLocaleLowerCase()
        .indexOf(search.toLocaleLowerCase()) > -1 ||
      (option.kelurahan.nama || "")
        .toLocaleLowerCase()
        .indexOf(search.toLocaleLowerCase()) > -1
    );
    },
    searchLocation() {
      this.show = false;
      const targetLocation = this.selectedPosko;
      this.lang = 0;
      this.long = 0;
      if (targetLocation) {
        this.lang = targetLocation.lat;
        this.long = targetLocation.long;
        this.zoom = 20;
        // add show in object listDataPosko
        this.listDataPosko = this.listDataPosko.map((item) => {
          if (item.id === targetLocation.id) {
            item.show = true;
          } else {
            item.show = false;
          }
          return item;
        });
      }
      this.selectedPosko = null;
      setTimeout(() => {
        this.show = true;
      }, 500);
    },
    myLocation() {
      this.show = false;
      // set long and lat null
      this.lang = 0;
      this.long = 0;
      // geoLocation
      this.getLocation();
    },
    onPress(val) {
      // change this.lang and this.long using val
      this.lang = val.latlng.lat;
      this.long = val.latlng.lng;
    },
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
          console.warn("ERROR(" + error.code + "): " + error.message);
          this.lang = 0.5632429184185753;
          this.long = 117.56551688827986;
          this.zoom = 12;
          this.coordinates = {
            lat: 0.5632429184185753,
            lng: 117.56551688827986,
          };
        },
        {
          // Opsi tambahan untuk getCurrentPosition (jika diperlukan)
          timeout: 5000,
        }
      );
    },
  },
  async created () {
    const response = await fetch('/geojson/batas-administrasi-kutai-timur.geojson');
    this.geojson = await response.json();
  },
  computed: {
    styleGeo: function (){
      const fillColor = "#F0B86E"; 
      return () => {
        return {
          weight: 1,
          color: "#900C3F",
          opacity: 0.7,
          fillColor: 'none',
          fillOpacity: 0.5,
          zIndex: 1,
        };
      };
    },
  }
};
</script>
