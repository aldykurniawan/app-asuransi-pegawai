<template>
  <AuthenticatedLayout>
    <loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1" />

    <div class="col-12 col-lg-12 d-flex mx-auto" v-if="detaildata">
      <div class="card radius-10 w-100">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center w-100">
            <h5 class="title__page">
                <!-- back button  -->
                <a :href="route(props.routeName+'.index')" class="btn btn-sm btn-outline-primary ms-2">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                {{ detaildata.nama }}
            </h5>
            <div class="d-flex">
                <div class="kategori">
                    <span class="title__categori">Dibuat Pada :</span>
                    <span>{{ detaildata.tanggal_dibuat }}</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card radius-10 shadow-none border mb-3 best-product-item">
                        <div class="card-body" style="padding:0.5rem 1rem 0rem 1rem">
                            <span class="custom-label badge badge-flat bg-secondary cap">
                                Kategori: {{ detaildata.kategori.nama }}
                            </span>
                            <div class="frame__content">
                                <div class="frame__image">
                                    <img
                                        :src="detaildata.full_path"
                                        alt="..."
                                    />
                                </div>
                                <div class="frame__info next_info">
                                    <div class="info--data info--title" @click="() => detailSwalText(detaildata.nama)">
                                        <div class="framer--title">
                                            <i class="bi bi-card-text"></i> {{ detaildata.nama }}
                                        </div>
                                    </div>
                                    <div class="info--data" @click="() => detailSwalText(detaildata.barcode)">
                                        <i class="bi bi-upc"></i> {{ detaildata.barcode }}
                                    </div>
                                    <div class="info--data">
                                        <i class="bi bi-tags"></i> {{ detaildata.merk }}
                                    </div>
                                </div>
                                <div class="frame__info next_payment">
                                    <div class="info--data">
                                        <i class="bi bi-cash"></i> Jual: {{ detaildata.rupiah_hargajual }}
                                    </div>
                                    <div class="info--data">
                                        <i class="bi bi-piggy-bank-fill"></i> Diskon: {{ detaildata.total_diskon.diskon_rupiah }} ({{ detaildata.diskon }}%)
                                    </div>
                                    <div class="info--data">
                                        <i class="bi bi-cash-coin"></i> Setelah Diskon: {{ detaildata.total_diskon.harga_setelah_diskon_rp }}
                                    </div>
                                </div>
                            </div>

                            <b>Deskripsi:</b>
                            <p>
                                {{ detaildata.deskripsi }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 content--stok">
                    <div class="frame__content frame--big">
                        <div class="frame__info next_stok">
                            <div class="info--data form-group btn-group">
                                <input type="date" v-model="keyword" class="form-control">
                                <button class="btn btn-md btn-primary" style="font-size: 14px;" type="button" @click="() => search()">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                            <div class="info--data btn-group">
                                <button class="btn btn-primary d-flex justify-content-start align-items-center text-12" type="button" @click="() => openCreateModal()">
                                    <i class="bi bi-cart-plus-fill" style="margin-right: 5px;"></i> <span>Tambah Stok</span>
                                </button>
                            </div>
                            <div class="info--data btn-group" v-if="props.riwayatStok.total > 0">
                                <button class="btn btn-warning d-flex justify-content-start align-items-center text-12" type="button" @click="() => openKoreksiModal()">
                                    <i class="bi bi-recycle" style="margin-right: 5px;"></i> <span>Koreksi Stok</span>
                                </button>
                            </div>
                            <div class="info--data info--title">
                                <div class="framer--title">
                                    <span>Stok Masuk</span>
                                    <b>
                                        {{ detaildata.barang_stok_masuk }}
                                    </b>
                                </div>
                            </div>
                            <div class="info--data info--title">
                                <div class="framer--title">
                                    <span>Terjual</span>
                                    <b>
                                        {{ detaildata.barang_stok_terjual }}
                                    </b>
                                </div>
                            </div>
                            <div class="info--data info--title">
                                <div class="framer--title">
                                    <span>Total Stok</span>
                                    <b>
                                         {{ detaildata.barang_stok_sisa }}
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="frame__content frame--small">
                        <div class="frame__info next_stok">
                            <template v-if="props.riwayatStok.total > 0">
                                <div class="info--data info--title" v-for="(rw, i) in props.riwayatStok.data" :key="i">
                                    <div class="framer--title">
                                        <i class="bi bi-cart-plus-fill" style="margin-right: 5px;"></i>
                                        <span>
                                            {{ rw.qty }} <span :class="`text-${rw.riwayat_status.class}`">{{ rw.riwayat_status.label }}</span> <span class="text-muted text-10">({{ rw.tanggal_dibuat }}) Dibuat oleh {{ rw.created_by_user }}</span>
                                        </span>
                                    </div>
                                </div>
                            </template>
                            <div class="info--data info--title" v-else>
                                <div class="framer--title">
                                    Tidak Ada Riwayat Stok
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center" v-if="props.riwayatStok.total > 10">
                                <Pagination :links="props.riwayatStok.links" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-12 d-flex align-items-center justify-content-center mx-auto" style="min-height: 50vh;" v-else>
      <!-- loading  -->
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <ModalForm
      :modal-title="modalAttr.title"
      :icon="modalAttr.icon"
      :size="modalAttr.size"
      :data-form="form.data()"
      :mode="modalAttr.mode"
      :action-form="modalAttr.actionForm"
      @reset="reset"
      :isOpen="modalOpen"
      @closeModal="closeModal"
      :upload="true"
      :key="reGenerate"
    >
      <div class="row">
        <template v-if="modalAttr.type == 'tambah'">
            <div class="col-md-8">
              <div class="form-group mb-3">
                <label class="mb-2 cap">Harga modal</label>
                <input
                  v-model="form.hargamodal"
                  type="number"
                  class="form-control"
                  :class="{ 'is-invalid': errors.hargamodal }"
                  placeholder="....."
                />
                <div v-if="errors.hargamodal" class="invalid-feedback">{{ errors.hargamodal }}</div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group mb-3">
                <label class="mb-2 cap">Stok Masuk</label>
                <input
                  v-model="form.qty"
                  type="number"
                  class="form-control"
                  :class="{ 'is-invalid': errors.qty }"
                  placeholder="....."
                />
                <div v-if="errors.qty" class="invalid-feedback">{{ errors.qty }}</div>
              </div>
            </div>
        </template>
        <template v-else>
            <div class="col-md-8">
              <div class="form-group mb-3">
                <label class="mb-2 cap">Status</label>
                <v-select
                    v-model="form.status"
                    :options="props.statusPilih"
                    :class="{ 'is-invalid': errors.status }"
                    label="label"
                    :reduce="option => option.id"
                    placeholder="Pilih Status"
                />
                <div v-if="errors.status" class="invalid-feedback">{{ errors.status }}</div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group mb-3">
                <label class="mb-2 cap">Jumlah</label>
                <input
                  v-model="form.qty"
                  type="number"
                  class="form-control"
                  :class="{ 'is-invalid': errors.qty }"
                  placeholder="....."
                  :max="form.status === '3' ? detaildata.barang_stok_sisa : null"
                />
                <div v-if="errors.qty" class="invalid-feedback">{{ errors.qty }}</div>
              </div>
            </div>
        </template>

      </div>
    </ModalForm>
  </AuthenticatedLayout>
</template>

<style scoped>
    .title__page {
        margin: 0;
        padding: 0;
    }
    .kategori {
        display: flex;
        margin-top: 10px;
    }
    .kategori span {
        background-color: #2E86C1;
        color: #fff;
        padding: 5px 10px;
        border-radius: 12px;
    }
    .kategori .title__categori {
        margin-right: 10px;
        background-color: transparent;
        color: #000;
        font-weight: bold;
    }
    .title__berita {
        padding-bottom: 10px;
        border-bottom: 1px solid #000;
        margin-bottom: 10px;
    }
    .title__berita span {
        background-color: #8b8c8c;
        color: #fff;
        padding: 5px 10px;
        border-radius: 12px;
    }
    .btn-input {
        font-size: 12px;
        width: 25%;
    }
    .text-12 {
        font-size: 12px !important;
    }
    .text-10 {
        font-size: 10px !important;
    }
    .text-red{
        color: red;
    }
    .cap {
        text-transform: capitalize;
    }
    .frame__content {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding: 10px 5px;
        gap: 5px;
    }
        .frame__content .frame__image {
            width: 100%;
            height: 250px;
            overflow: hidden;
            border-radius: 5px;
        }
        .frame__content .frame__image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .frame__content .frame__info {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .frame__content .frame__info .info--data {
            cursor: pointer;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 5px;
            text-transform: capitalize;
            background-color: #fff;
            border: 1px solid #ccc;
            width: 100%;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
        }
        .info--title {
            justify-content: space-between;
            padding: 0px !important;
        }
        .info--title .framer--title {
            /* bg warning */
            padding: 5px 10px;
        }
        .info--title .edit-data {
            /* bg warning */
            background-color: #ffc107;
            padding: 5px 10px;
            cursor: pointer;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            text-decoration: none;
        }
        .bg-primary-data {
            background-color: #007bff !important;
            color: #fff;
        }
        .bg-danger-data {
            background-color: #dc3545 !important;
            color: #fff;
        }
        .next_info {
            width: 1000%;
        }
        .next_payment {
            width: 100%;
        }
    .content--stok {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .frame--big {
        width: 30%;
        height: 100%;
    }
        .frame--big .framer--title {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 5px;
            gap: 10px;
        }
        .frame--big .framer--title span {
            font-size: 15px;
            text-transform: uppercase;
            font-size: bold;
        }
        .frame--big .framer--title b {
            width: 100%;
            font-size: 35px;
            text-wrap: wrap;
            text-align: center;
        }
    .frame--small {
        width: 70%;
        height: 100%;
        gap: 5px;
    }
        .frame--small .info--data {
            width: 100% !important;
            padding: 10px !important;
        }
        .framer--action {
            display: flex;
            gap: 7px;
        }
        .framer--action span {
            font-size: 12px;
            cursor: pointer;
            color: #007bff;
        }
        .framer--action span:hover {
            color: #080808;
        }
</style>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { computed, inject, onMounted, reactive, ref, watch } from "vue";
import axios from "axios";
import * as SwalData from 'sweetalert2';
import { toastAlert } from "@/Helpers/AlertPlugins";
import ModalForm from "@/Components/ModalForm.vue";
import Pagination from "@/Components/Pagination.vue";

const isLoading = ref(true);
const reGenerate = ref(Math.random().toString(36).substring(2, 15));

// detailSwalText
const detailSwalText = (text) => {
    SwalData.fire({
        title: "<h5>Detail</h5>",
        html: `<p style="text-align: left; font-size: 12px;">${text}</p>`,
        showCloseButton: true,
        showConfirmButton: false,
        showCancelButton: false,
    });
};

const props = defineProps({
  dataSource: {
    type: Object,
    default: () => ({}),
  },
  perPage: {
    type: Number,
    default: 1,
  },
  routeName: {
    type: String,
    default: "",
  },
  riwayatStok: {
    type: Object,
  },
  statusStok: {
    type: Array,
    default: [],
  },
  statusPilih: {
    type: Array,
    default: [],
  },
});

const detaildata = ref(null);

onMounted(() => {
  detaildata.value = props.dataSource;
  isLoading.value = false;
  const params = new URLSearchParams(location.search);
  keyword.value = params.get("tanggal");
});

const keyword = ref("");
const search = () => {
  router.get(`${route(props.routeName + ".show", detaildata.value.id)}?tanggal=${keyword.value}`);
};


// Get Data Edit
const getData = async (id) => {
  isLoading.value = true;
  await axios
    .get(route(props.routeName + ".edit", id))
    .then((response) => {
        detaildata.value = response.data;

      isLoading.value = false;
    })
    .catch((error) => {
      console.log(error);
      isLoading.value = false;
    });
};

// Form
const form = useForm({
    redirectRoute: props.routeName + ".index",
    qty: null,
    hargamodal: null,
    hargajual: null,
    barang_id: null,
    status: null,
});

// Reset Data
const reset = () => {
  form.reset();
  usePage().props.errors = {};
};

// Modal Data
const closeModal = () => {
    modalOpen.value = false;
    reGenerate.value = generateRandomString();
    getData(detaildata.value.id);
};
const generateRandomString = () => {
    return Math.random().toString(36).substring(2, 15);
};
defineEmits(["closeModal"]);

const modalOpen = ref(false);
const modalAttr = reactive({
  title: "Tambah Stok",
  mode: "create",
  icon: "",
  size: "modal-lg",
  type: "tambah",
  actionForm: null,
});

// Create Modal
const openCreateModal = () => {
    reset();
    form.hargajual = detaildata.value.hargajual;
    form.barang_id = detaildata.value.id;
    modalAttr.title = "Tambah Stok";
    modalAttr.icon = "bi bi-plus-circle";
    modalAttr.actionForm = route(props.routeName + ".storeStok");
    modalAttr.mode = "create";
    modalAttr.type = "tambah";
    modalOpen.value = true;
    localStorage.removeItem("cart");
    localStorage.removeItem("totalBayar");
};
// Create Modal
const openKoreksiModal = () => {
    reset();
    if (props.riwayatStok.total === 0) {
        toastAlert("warning", "Tidak ada stok yang tersedia");
        return;
    }
    form.hargamodal = props.riwayatStok.data[0].hargamodal;
    form.hargajual = detaildata.value.hargajual;
    form.barang_id = detaildata.value.id;
    modalAttr.title = "Koreksi Stok";
    modalAttr.icon = "bi bi-plus-circle";
    modalAttr.actionForm = route(props.routeName + ".storeStokKoreksi");
    modalAttr.mode = "create";
    modalAttr.type = "koreksi";
    modalOpen.value = true;
    localStorage.removeItem("cart");
    localStorage.removeItem("totalBayar");
};

</script>
