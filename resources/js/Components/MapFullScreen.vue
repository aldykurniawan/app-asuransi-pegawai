<style>
.btn-orange {
  background: #f60;
  color: #fff;
}
.leaflet-control-layers {
  margin-top: 50px !important;
}
.frame__leaflet {
  min-height: 86vh;
  height: 100%;
  width: 100%;
  position: relative;
}
.frame__loading {
  min-height: 80vh;
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.leaflet-container {
  z-index: 1;
}
.button__group {
  position: absolute;
  top: 0;
  right: 0;
  margin-top: 20px;
  margin-right: 20px;
  z-index: 2;
  /* background-color: #fff; */
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
.option__posko span {
  font-size: 0.7rem;
  padding-top: 5px;
  padding-bottom: 5px;
}

.remove__border-radius-left {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
.remove__border-radius-right {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
.sos__button {
  position: absolute;
  bottom: 0;
  margin-bottom: 10px;
  margin-left: 10px;
  z-index: 2;
  display: flex;
  align-items: center;
}
.sos__button .v-select {
  background-color: #fff;
  min-width: 280px;
  height: 100%;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
.sos__button .btn {
  border-radius: 50%;
  height: 50px;
  width: 50px;
  -webkit-animation: breathing 5s ease-out infinite normal;
  animation: breathing 5s ease-out infinite normal;
  margin-right: 10px;
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

@-webkit-keyframes breathing {
  0% {
    -webkit-transform: scale(0.8);
    transform: scale(0.8);
  }

  25% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  60% {
    -webkit-transform: scale(0.8);
    transform: scale(0.8);
  }

  100% {
    -webkit-transform: scale(0.8);
    transform: scale(0.8);
  }
}

@keyframes breathing {
  0% {
    -webkit-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }

  25% {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  60% {
    -webkit-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }

  100% {
    -webkit-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
  }
}
.detail__bencana {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 999;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background-color: #0000004b;
}
.center__detail {
  width: 70%;
  border: 1px solid #f60;
  background-color: #fff;
  height: 60vh;
  overflow-x: hidden;
  overflow-y: auto;
  border-radius: 8px;
  padding: 10px;
}
.header__moda {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid #f60;
  padding-top: 10px;
  padding-bottom: 10px;
}
.h-100 {
  height: 100%;
}
.cap {
  text-transform: capitalize;
}
.list__bencana {
  position: absolute;
  top: 0;
  left: 0;
  background-color: #fff;
  height: 100px;
  width: 25%;
  z-index: 200;
  margin-top: 100px;
}

.section-action {
  position: absolute;
  top: 0;
  left: 7%;
  z-index: 200;
  width: 30%;
  padding-top: 20px;
  padding-bottom: 20px;
}

.sound {
  position: absolute;
  right: 0;
  top: 0;
}

.bell {
  animation: pulsate 1.5s ease-in-out infinite;
}

@keyframes pulsate {
  0%,
  100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
}
.c-pointer {
  cursor: pointer;
}
</style>
<template>
  <div class="frame__leaflet" v-if="show" style="border-radius: 30px">
    <div class="section-action" v-if="laporanTerkini !== null">
      <div class="card shadow-sm border-0 overflow-hidden radius-30">
        <div class="d-flex justify-content-between align-items-center sound p-3 w-100">
          <button class="btn" type="button" @click="stopAudio">
            <i class="bx bx-bell-off bell text-secondary" v-if="!audioPlay"></i>
            <i class="bx bx-bell bell text-danger" v-else></i>
          </button>
          <button class="btn" type="button" @click="closeLaporanTerkini">
            <i class="bx bx-x text-secondary"></i>
          </button>
        </div>
        <div class="card-body">
          <div class="profile-avatar text-center mt-3">
            <img src="/images/api.gif" class="rounded-circle shadow" width="120" height="120" alt />
          </div>
          <div class="text-center mt-4">
            <h4 class="mb-1">{{ laporanTerkini.warga.nama }}</h4>
            <p class="mb-0 text-secondary">NIK. {{ laporanTerkini.warga.nik }}</p>
          </div>

          <div class="d-flex align-items-center justify-content-around mt-3 gap-2">
            <div class="text-center">
              <h4 class="mb-0">
                <i class="bx bx-phone"></i>
              </h4>
              <p class="mb-0 text-secondary">{{ laporanTerkini.warga.no_hp }}</p>
            </div>
            <div
              class="text-center text-orange c-pointer"
              @click="
                                () =>
                                    centerLatLang(
                                        laporanTerkini.lat,
                                        laporanTerkini.long
                                    )
                            "
            >
              <h4 class="mb-0">
                <i class="bx bxs-direction-right"></i>
              </h4>
              <p class="mb-0">Lihat Titik Laporan</p>
            </div>
          </div>

          <div class="text-center mt-4">
            <h6 class="mb-1">Kelurahan {{ laporanTerkini.kampung }}</h6>
            <p class="mb-0 text-secondary">Alamat {{ laporanTerkini.alamat }}</p>
            <a
              class="mb-0 text-primary c-pointer"
              :href="laporanTerkini.url_google_maps"
              target="_blank"
            >
              {{ laporanTerkini.lat }},
              {{ laporanTerkini.long }}
            </a>
          </div>
        </div>
      </div>

      <div class="card radius-30">
        <div class="card-body">
          <div class="d-flex align-items-center" v-if="laporanTerkini.status !== 'close'">
            <div class>
              <p class="mb-1">Kerahkan Personel</p>
              <h6 class="mb-0 text-primary">Hubungi Posko Bantuan</h6>
            </div>
            <div class="ms-auto fs-2 text-primary">
              <i class="bx bx-broadcast"></i>
            </div>
          </div>
          <hr v-if="laporanTerkini.status !== 'close'" class="my-2" />
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <template v-if="laporanTerkini.status !== 'close'">
                <button
                  class="btn btn-sm btn-primary"
                  type="button"
                  @click="() => detailLokasi(laporanTerkini)"
                >
                  <i class="bx bxs-truck"></i> Hubungi
                </button>
                <button
                  class="btn btn-sm btn-danger"
                  type="button"
                  @click="
                                        () => tolakStatus(laporanTerkini.id)
                                    "
                >
                  <i class="bx bx-x"></i> Tutup
                </button>
              </template>
              <button
                class="btn btn-sm btn-dark text-white"
                v-if="laporanTerkini.status === 'progress'"
                type="button"
                @click="() => detailLokasi(laporanTerkini)"
              >
                <!-- see detail  -->
                <i class="bx bxs-detail"></i> Detail
              </button>
              <button
                class="btn btn-sm btn-dark text-white"
                v-if="laporanTerkini.status === 'close'"
                type="button"
                @click="() => detailLokasi(laporanTerkini)"
              >
                <!-- see detail  -->
                <i class="bx bxs-detail"></i> Detail
              </button>
            </div>

            <div>
              <small class="text-secondary">
                Status:
                {{
                laporanTerkini.status !== "close"
                ? "Perlu Penanganan"
                : "Penanganan Selesai"
                }}
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="list__bencana">
      <div class="header__bencana">
        <h4>List Bencana</h4>
      </div>
      <div class="content__bencana">ini list becanana</div>
    </div>-->
    <div class="detail__bencana" v-if="selectedBencana !== null">
      <div class="center__detail">
        <div class="header__moda">
          <h5 class="text-orange">Detail Bencana</h5>
          <button class="btn btn-orange btn-sm" @click="() => closeDetail()">
            <i class="bi bi-x"></i>
          </button>
        </div>
        <div class="row mt-3">
          <div class="col-md-12 col-sm-12">
            <template v-if="loadingPoskoTerdekat">
              <!-- loading -->
              <div class="d-flex flex-column align-items-center justify-content-center h-100">
                <img src="/images/way.gif" style="width: 100px; height: 100px;" alt />
                <span class="mt-2">Mencari Posko Terdekat ...</span>
              </div>
            </template>
            <template v-else>
              <table class="table table-bordered w-100">
                <thead class="bg-orange text-white">
                  <tr>
                    <th>#</th>
                    <th>Nama Posko</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Jarak</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody v-if="loadingPosko">
                  <tr>
                    <td colspan="6">
                      <!-- loading  -->
                      <div
                        class="d-flex flex-column align-items-center justify-content-center h-100"
                      >
                        <img src="/images/way.gif" style="width: 100px; height: 100px;" alt />
                        <span class="mt-2">Loading ...</span>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr
                    v-for="(
                                            item, index
                                        ) in listPoskoTerdekat"
                    :key="index"
                  >
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.nama }} {{ item.posko_pembantu == 1 ? '(Posko Utama)' : '' }} </td>
                    <td>{{ item.kecamatan?.nama }}</td>
                    <td>{{ item.kelurahan?.nama }}</td>
                    <td>{{ item.distance }} Km</td>
                    <td class="text-center">
                      <button
                        v-if="
                                                    selectedBencana.status !== 'close' &&
                                                    item.laporanposko === null
                                                "
                        class="btn btn-sm btn-orange"
                        type="button"
                        @click="
                                                    () => kerahkanPosko(item)
                                                "
                      >
                        <i class="bx bxs-truck"></i>
                        Kerahkan Posko
                      </button>
                      <button
                        type="button"
                        class="btn btn-sm btn-secondary"
                        v-if="
                                                    item.laporanposko !== null
                                                "
                      >
                        <i class="bx bx-check"></i>
                        Posko Sudah Dikerahkan
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </template>
          </div>
        </div>
      </div>
    </div>
    <div class="button__find-me">
      <button class="btn btn-light btn-sm" type="button" @click="() => myLocation()">
        <i class="bx bx-map"></i> Lokasi Saya
      </button>
    </div>
    <div class="button__group input-group justify-content-center justify-content-md-end">
      <v-select
        v-model="selectedPosko"
        :options="listDataPosko"
        label="nama"
        placeholder="Pilih Posko"
        class="flat"
        :filterBy="pencarianPosko"
      >
        <template #option="props">
          <div class="option__posko">
            <h3>{{ props.nama }}</h3>
            <em>
              Kec. {{ props.kecamatan.nama }}, Kel.
              {{ props.kelurahan.nama }}
            </em>
          </div>
        </template>
      </v-select>
      <button
        class="btn btn-orange btn-sm remove__border-radius-left"
        type="button"
        @click="() => searchLocation()"
      >
        <i class="bi bi-search"></i>
      </button>
    </div>
    <div class="sos__button" v-if="listDataLokasi.length > 0">
      <button
        class="btn btn-danger btn-sm"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight"
      >SOS</button>
    </div>
    <l-map
      ref="map"
      v-model:zoom="zoom"
      :center="[lang, long]"
      :use-global-leaflet="false"
      :options="{ zoomControl: false }"
    >
      <l-control-layers position="topleft"></l-control-layers>
      <l-control-zoom position="topleft"></l-control-zoom>
      <l-control-scale position="bottomright" :imperial="true" :metric="true"></l-control-scale>

      <l-geo-json :geojson="geojson" :options-style="styleGeo"></l-geo-json>

      <l-tile-layer
        v-for="tileProvider in tileProviders"
        :key="tileProvider.name"
        :name="tileProvider.name"
        :visible="tileProvider.visible"
        :url="tileProvider.url"
        :attribution="tileProvider.attribution"
        layer-type="base"
      />
      <l-layer-group>
        <l-marker v-if="coordinates !== null" :lat-lng="coordinates">
          <LIcon icon-url="/images/output.gif" :icon-size="[48, 48]" />
          <LTooltip>
            <strong>Posisimu Disini!</strong>
          </LTooltip>
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
                <span>
                  Kecamatan:
                  {{ marker.kecamatan.nama }}
                </span>
                <span>
                  Kelurahan:
                  {{ marker.kelurahan.nama }}
                </span>
                <span>
                  No Kontak:
                  <a :href="`tel:${marker.no_hp}`" target="_blank">{{ marker.no_hp }}</a>
                </span>
              </div>
            </div>
          </l-popup>
          <LTooltip
            :options="{
                            permanent: marker.show ? true : false,
                            direction: 'top',
                        }"
          >
            <strong>{{ marker.nama }}</strong>
          </LTooltip>
        </l-marker>
        <l-marker
          v-for="bencana in listDataLokasi"
          :key="bencana.id"
          :lat-lng="[bencana.lat, bencana.long]"
          @click="() => detailLokasi(bencana)"
        >
          <LIcon icon-url="/images/flag.gif" :icon-size="[48, 48]" />
          <LTooltip :options="{ permanent: true, direction: 'top' }">
            <span class="badge bg-danger">Titik laporan</span>
          </LTooltip>
        </l-marker>

        <l-circle
          v-for="bencana in listDataLokasi"
          :key="bencana.id"
          :lat-lng="[bencana.lat, bencana.long]"
          :radius="50"
          color="red"
          :bubblingMouseEvents="true"
        />
      </l-layer-group>
    </l-map>
  </div>
  <div class="frame__loading" v-else>
    <img src="/images/way.gif" style="width: 100px; height: 100px;" alt />
    <h5 class="mt-2">LOADING MAPS ...</h5>
  </div>
  <div
    class="offcanvas offcanvas-end"
    data-bs-backdrop="false"
    tabindex="-1"
    id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel"
  >
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">List</h5>
      <button
        type="button"
        class="btn-close text-reset"
        id="tutupCanvas"
        data-bs-dismiss="offcanvas"
        aria-label="Close"
      ></button>
    </div>
    <div class="offcanvas-body">
      <div
        class="card radius-10 border border-orange"
        v-for="bencana in listDataLokasi"
        :key="bencana.id"
      >
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class>
              <p class="mb-2">{{ bencana.nama_warga }}</p>
              <h6 class="mb-0 text-orange">{{ bencana.kampung }}</h6>
              <small class="mb-0 text-secondary">{{ bencana.alamat }}</small>
            </div>
            <div class="ms-auto fs-2 text-orange">
              <i class="bx bxs-hot"></i>
            </div>
          </div>
          <div class="my-2 border-top border-orange" />
          <div class="btn-group float-end mt-1">
            <Link
              :href="`${route('elapor.petapelapor', {
                                lat: bencana.lat,
                                lng: bencana.long,
                                laporan_id: bencana.id
                            })}`"
              class="btn btn-sm btn-orange"
            >
              <i class="bx bxs-truck"></i> Detail
            </Link>
            <button
              class="btn btn-sm btn-dark"
              type="button"
              @click="
                                () => tolakStatus(bencana.id, true)
                            "
            >
              <i class="bx bx-x"></i> Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Link, usePage } from "@inertiajs/vue3";
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
import axios from "axios";
import Swal from "sweetalert2";

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
  computed: {
    user() {
      return usePage().props.auth.user;
    },
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
    Link,
    LControlScale,
    LGeoJson
  },
  data() {
    return {
      loadingPosko: true,
      loadingLaporan: true,
      laporanTerkini: null,
      audioPlay: false,
      audio: null,
      sos: false,
      show: false,
      zoom: 20,
      lang: 0.5632429184185753,
      long: 117.56551688827986,
      coordinates: null,
      listDataPosko: [],
      listDataLokasi: [],
      selectedPosko: null,
      selectedLokasi: null,
      selectedBencana: null,
      loadingPoskoTerdekat: true,
      listPoskoTerdekat: [],
      tileProviders: [
        {
          name: "OpenStreetMap",
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
      circle: null,
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
    // watch selectedLokasi
    selectedLokasi: {
      handler: function (val) {
        if (val) {
          this.lang = val.lat;
          this.long = val.long;
          this.zoom = 15;
        }
      },
      deep: true,
    },
  },
  mounted() {
    if (this.listPosko) {
      this.listDataPosko = this.listPosko;
    }
    if (this.listBencana) {
      this.getAdreessBencana();
    }
    if (this.valueData !== null) {
      this.show = false;
      this.defaultValuedata();
    } else {
      this.centerKutim();
    }

    let w = $(window).width();
    //   console.log(w);
    if (w >= 1199) {
      $(".wrapper").addClass("toggled");
    }
    Echo.private("App.Models.User." + this.user.id).listen(
      "BencanaEvent",
      (e) => {
        // console.log(e, "hasil broadcast");
        // router push with inertia to route('elapor.petapelapor', { laporan_id: e.user.laporan_id, lat: e.user.lokasi.lat, lng: e.user.lokasi.lng })
        this.updateListPelapor();
        if (this.laporanTerkini === null || this.laporanTerkini.status === 'close') {
            this.$inertia.visit(
              route("elapor.petapelapor", {
                laporan_id: e.user.laporan_id,
                lat: e.user.lokasi.lat,
                lng: e.user.lokasi.lng,
              }),
              {
                preserveState: true,
                preserveScroll: true,
              }
            );
            setTimeout(() => {
              this.show = false;
              this.defaultValuedata(e.user.lokasi.lat, e.user.lokasi.lng);
            }, 1000);
        }
      }
    );
  },
  async created () {
    const response = await fetch('/geojson/batas-administrasi-kutai-timur.geojson');
    this.geojson = await response.json();
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
    async updateListPelapor() {
      const response = await axios.get(route("elapor.laporan-api"));

      const arrayLokasi = await Promise.all(
        response.data.map(async (item) => {
          const address = await this.getAddress(item.lat, item.long);
          return {
            ...item,
            kampung: address.kampung,
            alamat: address.alamat,
          };
        })
      );

      this.listDataLokasi = arrayLokasi;
    },
    getAdreessBencana() {
      this.listBencana.forEach(async (item) => {
        const address = await this.getAddress(item.lat, item.long);
        this.listDataLokasi.push({
          ...item,
          kampung: address.kampung,
          alamat: address.alamat,
        });
      });
    },
    async getPosisitionByUrlParams() {
      const urlParams = new URLSearchParams(window.location.search);
      const laporan = urlParams.get("laporan_id");
      if (laporan) {
        await this.getLaporanTerkini(laporan);
      }
    },
    async getAddress(lat, lng) {
      try {
        const response = await axios.get(
          `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`
        );
        return {
          kampung: response.data.address.village,
          alamat: response.data.address.road,
        };
      } catch (error) {
        console.error("Terjadi kesalahan:", error);
        return {
          kampung: "-",
          alamat: "-",
        };
      }
    },
    async getLaporanTerkini(id) {
      // axios /get-laporan/{id}
      const { data } = await axios.get(`${route("elapor.get-laporan", id)}`);
      this.laporanTerkini = data.content;

      const getAddress = await this.getAddress(
        data.content.lat,
        data.content.long
      );
      if (getAddress) {
        this.laporanTerkini.kampung = getAddress.kampung;
        this.laporanTerkini.alamat = getAddress.alamat;
      }
      this.lat = data.content.lat;
      this.long = data.content.long;
      this.coordinates = {
        lat: data.content.lat,
        lng: data.content.long,
      };
      this.loadingLaporan = false;
    },
    centerLatLang(lat, lng) {
      this.show = false;
      this.lat = 0;
      this.long = 0;
      setTimeout(() => {
        this.lang = lat;
        this.long = lng;
        this.show = true;
      }, 1000);
    },
    playAudio() {
      this.audioPlay = true;
      if (!this.audio) {
        this.audio = new Audio("/music.wav");
        this.audio.loop = true;
      }

      setTimeout(() => {
        this.audio.play();
      }, 2000);
    },
    stopAudio() {
      if (this.audio) {
        if (this.audio.paused) {
          this.audioPlay = true;
          // Jika audio sedang dipause, mainkan audio
          this.audio.play();
        } else {
          this.audioPlay = false;
          // Jika audio sedang dimainkan, pause audio
          this.audio.pause();
          this.audio.currentTime = 0; // mengembalikan waktu audio ke awal
        }
      }
    },
    kerahkanPosko(posko) {
      // route('elapor.kerahkan-posko', { idPosko: id, idLaporan: this.selectedBencana.id })
      Swal.fire({
        title: "Kerahkan Posko",
        text: "Apakah anda yakin ingin mengkerahkan posko ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, kerahkan!",
        cancelButtonText: "Tidak, batalkan!",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          this.loadingPosko = true;
          axios
            .post(
              `${route("elapor.kerahkan-posko", {
                idPosko: posko.id,
                idLaporan: this.selectedBencana.id,
              })}`,
              {
                jarak: posko.distance,
              }
            )
            .then((res) => {
              if (res.data.success) {
                Swal.fire("Berhasil!", res.data.message, "success");
                this.poskoTerdekat(this.selectedBencana.id);
              } else {
                Swal.fire("Gagal!", res.data.message, "error");
              }
            })
            .catch((err) => {
              Swal.fire("Gagal!", err.message, "error");
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire("Dibatalkan", "Posko tidak jadi dikirim", "error");
        }
      });
    },
    tolakStatus(id, tutupCanvas = false) {
      if (tutupCanvas) {
        // click element with id tutupCanvas
        document.getElementById("tutupCanvas").click();
      }
      Swal.fire({
        title: "Alasan Kasus ditutup",
        input: "textarea",
        inputAttributes: {
          autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Kirim",
        showLoaderOnConfirm: true,
        // add required
        inputValidator: (value) => {
          if (!value) {
            return "Alasan kasus ditutup tidak boleh kosong!";
          }
        },
        preConfirm: (keterangan) => {
          this.changeStatus(id, "close", keterangan);
        },
        allowOutsideClick: () => !Swal.isLoading(),
      });
    },
    closeLaporanTerkini() {
      this.laporanTerkini = null;
    },
    async changeStatus(id, status, keterangan = null) {
      this.loadingPoskoTerdekat = true;
      const { data } = await axios.post(
        `${route("elapor.change-status-laporan", id)}`,
        {
          status: status,
          keterangan: keterangan,
        }
      );
      if (!data.success) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: data.message,
        });
      } else {
        this.laporanTerkini = null;
        let detailbencana = {
          ...this.selectedBencana,
          status: status,
        };
        if (status === "close") {
          detailbencana["keterangan"] = keterangan;
        }
        this.selectedBencana = detailbencana;
        Swal.fire({
          icon: "success",
          title: "Berhasil",
          text: data.message,
        });
        setTimeout(() => {
          // reload location
          window.location.reload();
        }, 500);
      }
      this.loadingPoskoTerdekat = false;
    },
    async defaultValuedata(latSet = null, lngSet = null) {

      this.show = false;
      this.coordinates = {
        lat: latSet ? latSet : this.valueData.lat,
        lng: lngSet ? lngSet : this.valueData.lng,
      };
      this.zoom = 20;
      await this.getPosisitionByUrlParams();
      if(this.laporanTerkini && this.laporanTerkini.status != 'close'){
          this.playAudio();
      }
      setTimeout(() => {
        this.show = true;
      }, 1500);

    },
    async poskoTerdekat(id) {
      // axios '/posko-terdekat/{id}'
      this.loadingPoskoTerdekat = true;
      const { data } = await axios.get(`${route("elapor.posko-terdekat", id)}`);
      this.listPoskoTerdekat = data;
      this.loadingPoskoTerdekat = false;
      this.loadingPosko = false;
    },
    closeDetail() {
      this.selectedBencana = null;
      this.listPoskoTerdekat = [];
    },
    detailLokasi(data) {
      this.selectedBencana = data;
      this.poskoTerdekat(data.id);
    },
    showSOS() {
      this.sos = !this.sos;
    },
    centerKutim() {
      this.show = false;
      this.lang = 0.5632429184185753;
      this.long = 117.56551688827986;
      this.coordinates = null;
      this.zoom = 10;
      setTimeout(() => {
        this.show = true;
      }, 500);
    },
    searchLocation() {
      this.show = false;
      const targetLocation = this.selectedPosko;
      this.lang = 0;
      this.long = 0;
      if (targetLocation) {
        this.lang = targetLocation.lat;
        this.long = targetLocation.long;
        this.zoom = 10;
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
      this.zoom = 20;
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

};
</script>
