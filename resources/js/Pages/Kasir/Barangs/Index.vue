<template>
  <AuthenticatedLayout>
    <loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1" />

    <div class="col-12 col-lg-12 d-flex mx-auto">
      <div class="card radius-10 w-100">
        <div class="card-header bg-transparent">
          <div class="row g-3 align-items-center">
            <div class="col-12 col-lg-7">
              <button @click="() => openCreateModal()" type="button" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah / Scan Barang
              </button>
            </div>
            <div class="col-12 col-lg-5 text-md-end">
              <form @submit.prevent="search">
                <div class="input-group mb-1">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Pencarian..."
                    aria-label="Pencarian"
                    aria-describedby="pencarian"
                    v-model="keyword"
                  />
                  <button type="submit" class="btn btn-outline-secondary" id="pencarian">
                    <i class="bx bx-search"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <div v-for="(value, index) in dataSource.data" :key="index" class="col-12 col-lg-12">
                    <div class="card radius-10 shadow-none border mb-3 best-product-item">
                        <span
                            class="badge badge-flat badge-info bg-danger"
                            @click="destroy(value.id)"
                        >
                            <i class="bi bi-ui-radios"></i> Hapus
                        </span>
                        <div class="card-body" style="padding:0.5rem 1rem 0rem 1rem">
                            <span class="custom-label badge badge-flat bg-secondary cap">
                                Kategori: {{ value.kategori.nama }}
                            </span>
                            <div class="frame__content">
                                <div class="frame__image">
                                    <img
                                        :src="value.full_path"
                                        alt="..."
                                    />
                                </div>
                                <div class="frame__info next_info">
                                    <div class="info--data info--title">
                                        <div class="framer--title" @click="() => detailSwalText(value.nama)">
                                            <i class="bi bi-card-text"></i> {{ value.short_title }}
                                        </div>
                                        <div class="edit-data" @click="openEditModal(value.id)">
                                            <i class="bi bi-pencil"></i> Edit
                                        </div>
                                    </div>
                                    <div class="info--data" @click="() => detailSwalText(value.barcode)">
                                        <i class="bi bi-upc"></i> {{ value.barcode_short }}
                                    </div>
                                    <div class="info--data">
                                        <i class="bi bi-tags"></i> {{ value.merk }}
                                    </div>
                                </div>
                                <div class="frame__info next_payment">
                                    <div class="info--data">
                                        <i class="bi bi-cash"></i> Jual: {{ value.rupiah_hargajual }}
                                    </div>
                                    <div class="info--data">
                                        <i class="bi bi-piggy-bank-fill"></i> Diskon: {{ value.total_diskon.diskon_rupiah }} ({{ value.diskon }}%)
                                    </div>
                                    <div class="info--data">
                                        <i class="bi bi-cash-coin"></i> Setelah Diskon: {{ value.total_diskon.harga_setelah_diskon_rp }}
                                    </div>
                                </div>
                                <div class="frame__info next_stok">
                                    <div class="info--data info--title">
                                        <div class="framer--title">
                                            <i class="bi bi-box-arrow-in-left"></i> Stok Masuk: {{ value.barang_stok_masuk }}
                                        </div>
                                        <a :href="route(props.routeName+'.show', value.id)" class="edit-data bg-danger-data">
                                            <i class="bi bi-door-open-fill"></i>
                                        </a>
                                    </div>
                                    <div class="info--data info--title">
                                        <div class="framer--title">
                                            <i class="bi bi-box-arrow-in-right"></i> Terjual: {{ value.barang_stok_terjual }}
                                        </div>
                                        <!-- <div class="edit-data bg-primary-data" @click="() => openEditModal(value.id, true)">
                                            <i class="bi bi-file-bar-graph-fill"></i>
                                        </div> -->
                                    </div>
                                    <div class="info--data">
                                        <i class="bi bi-bricks"></i> Total Stok: {{ value.barang_stok_sisa }}
                                    </div>
                                </div>
                                <div class="frame__info next_deskripsi">
                                    <div class="info--data" @click="() => detailSwalText(value.deskripsi)">
                                        <i class="bi bi-info-circle-fill"></i> Deskripsi:
                                    </div>
                                    <div class="info--data text-muted text-12" @click="() => detailSwalText(value.deskripsi)">
                                        {{ value.short_deskripsi }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          <Pagination :links="dataSource.links" />
        </div>
      </div>
    </div>

    <!-- Modal FIle -->
    <ModalPreview :urlFile="urlFile" />
    <!-- end Modal File -->

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
        <template v-if="modalAttr.mode !== 'stok'">
            <div class="row">

              <div class="col-md-12">
                <div class="form-group mb-3">
                  <label class="mb-2">Barcode</label>
                  <div class="btn-group w-100">
                      <input
                        v-model="inputModel"
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': errors.barcode }"
                        placeholder="....."
                        :disabled="modalAttr.mode == 'edit'"
                        :readonly="!barcodeStatus"
                      />
                      <button class="btn btn-primary btn-input" type="button" @click="() => barcodeChange(!barcodeStatus)">
                          {{ !barcodeStatus ? 'Input' : 'Scan' }} Barcode
                      </button>
                  </div>
                  <div v-if="errors.barcode" class="text-red text-12 mt-1">{{ errors.barcode }}</div>
                </div>
              </div>
              <template v-if="form.barcode">
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2">Nama <span class="text-red">*</span></label>
                      <input
                        v-model="form.nama"
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': errors.nama }"
                        placeholder="....."
                      />
                      <div v-if="errors.nama" class="invalid-feedback">{{ errors.nama }}</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2">Merk <span class="text-red">*</span></label>
                      <input
                        v-model="form.merk"
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': errors.merk }"
                        placeholder="....."
                      />
                      <div v-if="errors.merk" class="invalid-feedback">{{ errors.merk }}</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2 cap">Harga jual <span class="text-red">*</span></label>
                      <input
                        v-model="form.hargajual"
                        type="number"
                        class="form-control"
                        :class="{ 'is-invalid': errors.hargajual }"
                        placeholder="....."
                      />
                      <div v-if="errors.hargajual" class="invalid-feedback">{{ errors.hargajual }}</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="mb-2">
                          Diskon
                          <span class="text-muted text-12 cap">(dalam persen)</span>
                           <span class="text-red">*</span>
                      </label>
                      <input
                        v-model="form.diskon"
                        type="number"
                        class="form-control"
                        :class="{ 'is-invalid': errors.diskon }"
                        placeholder="....."
                      />
                      <div v-if="errors.diskon" class="invalid-feedback">{{ errors.diskon }}</div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <label class="mb-2">Kategori <span class="text-red">*</span></label>
                      <v-select
                          :options="dataKategori"
                          label="nama"
                          placeholder="Pilih Kategori"
                          v-model="form.kategori_id"
                          :reduce="option => option.id"
                          :class="{ 'is-invalid': errors.kategori_id }"
                      />
                      <div v-if="errors.kategori_id" class="invalid-feedback">{{ errors.kategori_id }}</div>
                    </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group mb-3">
                          <label class="mb-2">Deskripsi <span class="text-red">*</span></label>
                          <div v-if="errors.deskripsi" class="invalid-feedback">{{ errors.deskripsi }}</div>
                          <textarea
                          v-model="form.deskripsi"
                          class="form-control"
                          :class="{ 'is-invalid': errors.deskripsi }"
                          placeholder="....."
                          rows="5"
                          ></textarea>
                      </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <label class="mb-2">Gambar <span class="text-red" v-if="modalAttr.mode == 'create'">*</span></label>
                      <file-component :triggerChange="(val) => onChangeState('gambar', val)" :previewImage="previewImage" :mime="['image/jpeg', 'image/jpg', 'image/png', 'image/PNG', 'image/JPG']" />
                      <div v-if="errors.gambar" class="text-red">{{ errors.gambar }}</div>
                    </div>
                  </div>
              </template>
            </div>
        </template>
        <template v-else>
            tampil bang
        </template>
    </ModalForm>
  </AuthenticatedLayout>
</template>
<style scoped>
    .btn-input {
        font-size: 12px;
        width: 25%;
    }
    .text-12 {
        font-size: 12px !important;
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
        padding: 10px 5px;
    }
        .frame__content .frame__image {
            width: 100px;
            height: 100px;
            overflow: hidden;
            margin-right: 10px;
            border-radius: 5px;
        }
        .frame__content .frame__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .frame__content .frame__info {
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
            width: 20%;
            margin-left: 5px;
            margin-right: 5px;
        }
        .next_payment {
            width: 20%;
            margin-left: 5px;
            margin-right: 5px;
        }
        .next_stok {
            width: 20%;
            margin-left: 5px;
            margin-right: 5px;
        }
        .next_deskripsi {
            flex: 1;
            margin-left: 5px;
            margin-right: 5px;
        }
</style>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ModalPreview from "@/Components/ModalPreview.vue";
import ModalForm from "@/Components/ModalForm.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { computed, inject, onMounted, onBeforeUnmount, reactive, ref, watch } from "vue";
import axios from "axios";
import * as SwalData from 'sweetalert2';
import { toastAlert } from "@/Helpers/AlertPlugins";

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

const isLoading = ref(false);
const swal = inject("$swal");
const reGenerate = ref(Math.random().toString(36).substring(2, 15));
const generateRandomString = () => {
    return Math.random().toString(36).substring(2, 15);
}
const onChangeState = (state, value) => {
    form[state] = value;
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
  dataKategori: {
    type: Array,
    default: [],
  },
});

const barcode = ref(null);
const barcodeStatus = ref(false);
const barcodeInput = ref(null);
const previewImage = ref(null);

const inputModel = computed({
  get() {
    return barcodeStatus.value ? barcodeInput.value : barcode.value;
  },
  set(value) {
    if (barcodeStatus.value) {
      barcodeInput.value = value;
    } else {
      barcode.value = value;
    }
  }
});

const barcodeChange = (status) => {
    barcode.value = null;
    barcodeInput.value = null;
    barcodeStatus.value = status;
    if (!status) {
        window.addEventListener('keydown', handleKeyPress);
    } else {
        window.removeEventListener('keydown', handleKeyPress);
    }
};
// watch barcode with debounce
const debounce = (func, wait) => {
    let timeout;

    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };

        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

// watch barcodeInput
watch(barcodeInput, debounce((value) => {
    barcode.value = value;
}, 500));

watch(() => barcode.value, (value) => {
    if (value) {
        // SwalData loading
        SwalData.fire({
            title: "Loading...",
            text: "Sedang Memeriksa Barcode",
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
        });
        debouncedCheckBarcode();
    } else {
        form.barcode = null;
    }
});

// axios route(barangs.checkBarcode, { barcode: form.barcode })
const checkBarcode = async () => {
    // SwalData close loading
    SwalData.close();
    try {
        const data = await axios.get(route(props.routeName + ".checkBarcode", { barcode: barcode.value }));
        if (data.data.status && modalAttr.mode == "create") {
            toastAlert("info", "Barcode Ditemukan: "+data.data.data.nama);
            modalOpen.value = false;
            keyword.value = data.data.data.barcode;
            search();
        } else {
            form.barcode = barcode.value;
            window.removeEventListener('keydown', handleKeyPress);
        }
    } catch (error) {
        console.log(error, 'error');
    }
};

const debouncedCheckBarcode = debounce(checkBarcode, 500);

const isScanning = ref(false); // State untuk tracking status scanning
const scannedValue = ref('');

onMounted(() => {
  const params = new URLSearchParams(location.search);
  keyword.value = params.get("query");

//   window.addEventListener('keydown', handleKeyPress);
});

onBeforeUnmount(() => {
  window.removeEventListener('keydown', handleKeyPress);
});

const handleKeyPress = (e) => {
  // Periksa apakah kunci yang ditekan adalah karakter yang bisa dicetak
  if (e.key.length === 1 && /[a-zA-Z0-9]/.test(e.key)) {
    // Jika dalam mode scanning, tambahkan karakter ke scannedValue
    if (isScanning.value) {
      scannedValue.value += e.key;
    } else {
      // Jika bukan, mulai mode scanning dan atur karakter pertama
      isScanning.value = true;
      scannedValue.value = e.key;
    }
  }

  // Jika tombol "Enter" ditekan dan ada nilai yang discan
  if (e.key === 'Enter' && scannedValue.value) {
    // Proses nilai yang discan
    processScannedValue(scannedValue.value);
    scannedValue.value = ''; // Reset nilai yang discan
    isScanning.value = false; // Reset status scanning
  }
};

const processScannedValue = (value) => {
    if (modalOpen.value) {
        barcode.value = value;
    } else {
        keyword.value = value;
        search();
    }
};

const keyword = ref("");
const search = () => {
  router.get(route(props.routeName + ".index", { query: keyword.value }));
};


// Form
const form = useForm({
    redirectRoute: props.routeName + ".index",
    barcode: null,
    nama: null,
    merk: null,
    deskripsi: null,
    hargajual: null,
    diskon: null,
    gambar: null,
    kategori_id: null,
});

// Reset Data
const reset = () => {
  form.reset();
  barcode.value = null;
  previewImage.value = null;
  usePage().props.errors = {};
};

// Modal Data
const closeModal = () => {
    modalOpen.value = false;
    reGenerate.value = generateRandomString();
};
defineEmits(["closeModal"]);

const modalOpen = ref(false);
const modalAttr = reactive({
  title: "Tambah Data",
  mode: "create",
  icon: "",
  size: "modal-lg",
  actionForm: null,
});

// Create Modal
const openCreateModal = () => {
    reset();
    modalAttr.title = "Buat / Scan Barang";
    modalAttr.icon = "bi bi-plus-circle";
    modalAttr.actionForm = route(props.routeName + ".store");
    modalAttr.mode = "create";
    modalAttr.size = "modal-lg";
    modalOpen.value = true;
    window.addEventListener('keydown', handleKeyPress);
};

// Get Data Edit
const getData = async (id) => {
  isLoading.value = true;
  await axios
    .get(route(props.routeName + ".edit", id))
    .then((response) => {
        // isi form
        barcode.value = response.data.barcode;
        form.nama = response.data.nama;
        form.merk = response.data.merk;
        form.deskripsi = response.data.deskripsi;
        form.hargajual = response.data.hargajual;
        form.diskon = response.data.diskon;
        previewImage.value = response.data.full_path;
        form.kategori_id = response.data.kategori_id;

      isLoading.value = false;
    })
    .catch((error) => {
      console.log(error);
      isLoading.value = false;
    });
};

// Edit Modal
const openEditModal = async (id, stok = false) => {
  reset();
  modalAttr.title = stok ? "Laporan Penjualan" : "Edit Data";
  modalAttr.icon = stok ? "bi bi-bag-plus-fill" : "bi bi-pencil-square";
  modalAttr.actionForm = !stok ? route(props.routeName + ".update", id) : null;
  modalAttr.mode = !stok ? "edit" : "stok";
  modalAttr.size = !stok ? "modal-lg" : "modal-fullscreen";
  window.removeEventListener('keydown', handleKeyPress);
  await getData(id);
  localStorage.removeItem("cart");
  localStorage.removeItem("totalBayar");
  modalOpen.value = true;
};

// Modal Preview
const urlFile = ref(null);
const previewFile = () => {
  urlFile.value = "/text.pdf";
  $("#modal-preview").modal("show");
};

// Delete Alert
const destroy = async (id) => {
  swal({
    title: "Apakah Anda Yakin?",
    text: "Ingin Menghapus Data Ini ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Hapus!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      isLoading.value = true;
      router.delete(route(props.routeName + ".destroy", id), {
        onSuccess: (page) => {
          isLoading.value = false;
          swal("Deleted!", "Data Telah Dihapus", "success");
        },
        preserveScroll: true,
      });
    }
  });
};


</script>
