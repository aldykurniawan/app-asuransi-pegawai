<style scoped>
    .content--kategori {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
        gap: 5px;
    }
        .item--kategori {
            flex: 0 0 calc(20% - 4px); /* Mengurangi bagian gap dari lebar */
            max-width: calc(20% - 4px); /* Pastikan item tidak lebih besar dari hasil kalkulasi */
            padding: 10px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
</style>
<template>
  <AuthenticatedLayout :hideCrumb="true" :hero="false">
    <loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1" />
    <div class="framer--page">
        <div class="page-item left--place">
            <div class="title--section">
                <div class="header--title">
                    <h4>SIMATA Mart</h4>
                    <p>
                        Cari data barang atau scan barcode untuk menambahkan barang ke keranjang.
                    </p>
                </div>
                <div class="pencarian--title">
                    <div class="input-group mb-3">
                        <input type="text" v-model="keyword" class="form-control" placeholder="Cari data barang..." aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary text-white" type="button" id="button-addon2" @click="() => search()">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <hr class="hr--site">
            
            <div class="content--kategori">
                <div @click="() => selectedKategory = ''" :class="`item--kategori btn btn-sm btn-outline-primary ${selectedKategory === '' ? 'active' : ''}`" type="button">
                    Lihat Semua
                </div>
                <template v-for="(k, i) in kategori" :key="i">
                    <div @click="() => selectedKategory = k.id" :class="`item--kategori btn btn-sm btn-outline-primary ${selectedKategory === k.id ? 'active' : ''}`" type="button">
                        {{ k.nama }}
                    </div>
                </template>
            </div>

            <hr class="hr--site">
            <div class="frame--barang">
                <div class="content--barang" v-if="barangs.length > 0">
                    <div class="item--barang" v-for="(b, k) in barangs" :key="k">
                        <div class="framer--image">
                            <img :src="b.full_path" alt="">
                        </div>
                        <div class="framer--title">
                            <div class="title--content">
                                <h5>{{ b.nama }}</h5>
                                <b>
                                    {{ b.rupiah_hargajual }}
                                </b>
                            </div>
                            <div class="button--action input-group">
                                <button class="btn btn-sm btn-plus btn-success" v-if="b.barang_stok_sisa > 0" type="button" @click="() => actionAddCart(b)">
                                    <i class="bi bi-plus"></i> <span>Tambah</span>
                                </button>
                                <button class="btn btn-sm btn-plus btn-secondary" v-else disabled type="button">
                                    <i class="bi bi-plus"></i> <span>Kosong</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center w-100 mt-2" v-if="totalBarang > 12 && totalPage > page">
                         <button class="btn btn-sm btn-primary p-2 " type="button" @click="() => getBarangs(keyword, page + 1)">
                            <i class="bi bi-arrow-repeat"></i> <span>Muat Lebih Banyak</span>
                        </button>
                    </div>
                </div>
                <div class="content--barang" v-else>
                    <div class="text-center">
                        <template v-if="keyword == ''">
                            Tidak Ada Barang
                        </template>
                        <template v-else>
                            Barang dengan keyword <b>{{ keyword }}</b> tidak ditemukan.
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-item right--place">
            <div class="card radius-10 w-100">
                <div class="card-body min-height">
                    <div class="btn-group w-100 mb-3">
                        <button class="btn btn-sm btn-outline-danger btn-block p-2 d-flex align-items-center justify-content-center" type="button" @click="() => openTransaksiModal()">
                            <i class="bi bi-clock"></i>
                            <span style="margin-left: 5px;">Riwayat Transaksi</span>
                        </button>
                    </div>
                    <div class="title--transaction">
                        <div class="left--title">
                            <span>Kasir bertanggung jawab: <b>{{ user.name }}</b></span>
                            <h4>
                                Keranjang Belanja
                            </h4>
                        </div>
                        <div class="right--title">
                            <div class="btn-group" v-if="cart.length > 0">
                                <button class="btn" type="button" @click="() => clearCart()">
                                    <i class="bi bi-trash"></i> <span>Bersihkan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="hr--transaction">
                    <template v-if="cart.length > 0">
                        <div class="list--transaction">
                            <div class="item--transaction_cart" v-for="(c, kn) in cart" :key="kn">
                                <div class="title--item_transaction">
                                    <b>
                                        {{ c.nama }}
                                        <div class="diskon" v-if="c.diskon > 0">
                                            <i class="badge bg-success text-white">Diskon: {{ c.diskon }}%</i>
                                        </div>
                                    </b>
                                    <span class="harga--transaction">
                                        <span>Harga:</span>
                                        <template v-if="c.diskon > 0">
                                            <i>{{ rupiah(c.total_diskon.harga_setelah_diskon) }}</i> <b>{{ rupiah(c.hargajual) }}</b>
                                        </template>
                                        <template v-else>
                                            <i>{{ rupiah(c.hargajual) }}</i>
                                        </template>
                                    </span>
                                </div>
                                <div class="button--action input-group">
                                    <button
                                        class="btn btn-sm btn-danger btn-minus"
                                        type="button"
                                        @click="() => actionAddCart(c, false)"
                                    >
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Qty"
                                        aria-label="Qty"
                                        aria-describedby="button-addon2"
                                        :value="c.qty"
                                        readonly
                                    />
                                    <button
                                        class="btn btn-sm btn-success btn-plus"
                                        type="button"
                                        @click="() => actionAddCart(c)"
                                    >
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="result--transaction">
                            <div class="item--transaction_result">
                                <span>Total Pembelian</span>
                                <b>
                                    {{ rupiah(totalBayar) }}
                                </b>
                            </div>
                            <div class="item--transaction_result" v-if="pajakBayar !== 0">
                                <span>Pajak</span>
                                <b>{{ pajakBayar }}%</b>
                            </div>
                            <hr class="hr--transaction">
                            <div class="item--transaction_result btn-group">
                                <button :class="`btn btn-sm btn-outline-danger ${metodePembayran === 'tunai' ? 'active' : ''}`" @click="() => changeMetodePembayaran('tunai')" type="button">
                                    <i class="bi bi-cash"></i> <span>Tunai</span>
                                </button>
                                <button :class="`btn btn-sm btn-outline-danger ${metodePembayran === 'non tunai' ? 'active' : ''}`" @click="() => changeMetodePembayaran('non tunai')" type="button">
                                    <i class="bi bi-credit-card"></i> <span>Non Tunai</span>
                                </button>
                                <button :class="`btn btn-sm btn-outline-danger ${metodePembayran === 'QRIS' ? 'active' : ''}`" @click="() => changeMetodePembayaran('QRIS')" type="button">
                                    <i class="bi bi-credit-card"></i> <span>QRIS</span>
                                </button>
                            </div>
                            <div class="item--transaction_result big--title">
                                <span>Total</span>
                                <b>
                                    {{ rupiah(totalBayar + (totalBayar * pajakBayar / 100)) }}
                                </b>
                            </div>
                            <div class="item--transaction_result btn--title">
                                <button class="btn btn-success w-100" type="button" @click="() => askBayarTransaksi()">
                                    <i class="bi bi-cash"></i> <span>Bayar</span>
                                </button>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="text-center d-flex align-items-center justify-content-center">
                            Keranjang Masih Kosong
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <ModalForm
      :modal-title="modalAttr.title"
      :icon="modalAttr.icon"
      :size="modalAttr.size"
      :data-form="{}"
      :mode="modalAttr.mode"
      :action-form="modalAttr.actionForm"
      @reset="() => console.log('reset')"
      :isOpen="modalOpen"
      @closeModal="closeModal"
      :upload="true"
    >
       <div class="frame--riwayat">
            <div class="list--transaksi">
                <div class="item--transaksi input-group">
                    <input type="date" v-model="tanggalTransaksi" class="form-control" placeholder="Cari data transaksi..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-primary text-white" @click="() => callRiwayat()" type="button" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <div class="item--transaksi item--transaksi_data" v-if="riwayats.length > 0" v-for="(tr, k) in riwayats" :key="k">
                    <div class="item--fix_top_left-with-radius">
                        {{ tr.tanggal_transaksi }}
                    </div>
                    <div class="item--fix_top_right-with-radius">
                        Kasir: {{ tr.nama_kasir }}
                    </div>
                    <div class="title--item_transaksi">
                        <b>{{ k + 1 }}. Kode Transansaksi: {{ tr.nomor_referensi }}</b>
                        <span class="metode_pembayaran">
                            <span>Metode Pembayaran:</span> <b>{{ tr.metode_pembayaran }}</b>
                        </span>
                        <span class="metode_pembayaran">
                            <span>Total Transaksi:</span> <b>{{ rupiah(tr.total) }}</b>
                        </span>
                        <span class="metode_pembayaran">
                            <span>Pembayaran Customer:</span> <b>{{ rupiah(tr.bayar) }}</b>
                        </span>
                        <span class="metode_pembayaran">
                            <span>Kembalian:</span> <b>{{ rupiah(tr.kembalian) }}</b>
                        </span>
                        <span class="metode_pembayaran" v-if="tr.ref_transaksi">
                            <span>Nomor Referensi:</span> <b>{{ tr.ref_transaksi }}</b>
                        </span>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-primary" type="button" @click="() => detaiLtransaksi = tr">
                            <i class="bi bi-eye"></i> <span>Lihat Detail</span>
                        </button>
                        <!-- print  -->
                        <button class="btn btn-sm btn-outline-success" type="button" @click="() => cetakPdfFrame(tr)">
                            <i class="bi bi-printer"></i> <span>Cetak</span>
                        </button>
                    </div>
                </div>
                <div class="item--transaksi" v-else>
                    Tidak Ada Transaksi Pada Tanggal Ini.
                </div>
            </div>
            <div class="detail--transaksi">
                <template v-if="detaiLtransaksi">
                    <div class="detail--item_transaksi">
                        <iframe id="pdfFrame" :src="route('printStruk', detaiLtransaksi.id)" width="100%" height="600px"></iframe>
                    </div>
                </template>
            </div>
       </div>
    </ModalForm>

  </AuthenticatedLayout>
</template>
<!-- style detail transaksi  -->
<style scoped>
    .framer--page {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
        .left--place {
            width: 60%;
        }
        .right--place {
            width: 38%;
        }
    @media screen and (max-width: 1228px) {
        .framer--page {
            flex-wrap: wrap;
            flex-direction: column-reverse;
        }
            .left--place {
                width: 100%;
            }
            .right--place {
                width: 100%;
            }
    }
    .frame--riwayat {
        display: flex;
        position: relative;
    }
        .detail--transaksi {
            padding: 10px 20px;
            width: 35%;
        }
        .list--transaksi {
            width: 65%;
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            overflow-y: auto; /* Memastikan scroll hanya vertikal */
            overflow-x: hidden; /* Menghilangkan horizontal scroll */

            /* Gaya untuk scrollbar */
            scrollbar-width: thin; /* Untuk Firefox */
            scrollbar-color: rgba(0, 0, 0, 0.5) transparent; /* Untuk Firefox */
        }
            .list--transaksi .item--transaksi {
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-radius: 5px;
                padding: 10px;
                background-color: #f8f8f8;
                border: 1px solid #d5d6d7;
                position: relative;
            }
            .item--transaksi_data {
                height: 22vh;
                padding: 20px !important;
            }
            .item--fix_top_left-with-radius {
                position: absolute;
                top: 0;
                left: 0;
                padding: 5px 10px;
                border-radius: 5px 0 0 0;
                background-color: #36fd04;
                color: #000;
            }
            .item--fix_top_right-with-radius {
                position: absolute;
                top: 0;
                right: 0;
                padding: 5px 10px;
                border-radius: 0 5rgb(255, 2, 2);
                background-color: #f50505;
                color: #fff;
            }
            .title--item_transaksi {
                display: flex;
                flex-direction: column;
                width: 80%;
                gap: 5px;
            }
                .title--item_transaksi b {
                    font-size: 16px;
                    display: flex;
                    align-items: center;
                    gap: 5px;
                    width: 100%;
                }
                .title--item_transaksi .metode_pembayaran {
                    font-size: 14px;
                    display: flex;
                    align-items: center;
                    width: 100%;
                    gap: 5px;
                }
                    .metode_pembayaran b {
                        font-size: 12px;
                        width: 30%;
                        text-transform: capitalize;
                    }
    @media screen and (max-width: 1228px) {
        .mt-transaksi{
            margin-top: 20px;
        }
    }
</style>
<!-- style item box  -->
<style scoped>
    .min-height {
        min-height: 90vh;
    }
    .hr--site {
        border: 1px solid #d5d6d7;
        margin: 0;
        padding: 0;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .title--section {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
        .title--section .header--title {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .title--section .header--title h4 {
            margin: 0;
            padding: 0;
        }
        .title--section .header--title p {
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        .title--section .pencarian--title {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    .frame--barang {
        width: 100%;
        height: 100%;

        overflow-y: auto; /* Memastikan scroll hanya vertikal */
        overflow-x: hidden; /* Menghilangkan horizontal scroll */

        /* Gaya untuk scrollbar */
        scrollbar-width: thin; /* Untuk Firefox */
        scrollbar-color: rgba(0, 0, 0, 0.5) transparent; /* Untuk Firefox */
    }
    .content--barang {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
        height: 55vh;
        gap: 10px;
    }
    @media screen and (max-width: 1228px) {
        .frame--barang {
            margin-bottom: 20%;
        }
            .content--barang {
                height: 40vh;
            }
    }
        .item--barang {
            display: flex;
            flex-direction: column;
            width: calc((100% - 30px) / 4);
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
            padding: 1rem 1rem;
            background-color: #fff;
        }
            .item--barang .framer--image {
                width: 100%;
                height: 160px;
                margin-bottom: 10px;
                border-radius: 5px;
            }
                .item--barang .framer--image img {
                    width: 100%;
                    object-fit: cover;
                    height: 100%;
                    border-radius: 5px;
                }
            .item--barang .framer--title {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
                .framer--title .title--content {
                    width: 50%;
                }
                    .framer--title .title--content h5 {
                        margin: 0;
                        padding: 0;
                        font-size: 14px;
                    }
                    .framer--title .title--content b {
                        margin: 0;
                        padding: 0;
                        font-size: 12px;
                    }
                .framer--title .button--action {
                    width: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                }
                    .framer--title .button--action .btn-plus {
                        font-size: 12px;
                        font-weight: bold;
                    }
    @media screen and (max-width: 1228px) {
        .title--section {
            flex-wrap: wrap;
        }
            .header--title {
                width: 100% !important;
            }
            .pencarian--title {
                margin-top: 20px;
                width: 100% !important;
            }
        .item--barang {
           width: calc((100% - 10px) / 2);
        }
    }
</style>
<!-- style transaction box -->
<style scoped>
    .hr--transaction {
        border: 1px solid #d5d6d7;
        margin: 0;
        padding: 0;
        margin-top: 20px;
        margin-bottom: 20px;
        width: 100%;
    }
    .title--transaction {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
        .title--transaction .left--title {
            width: 70%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
            .title--transaction .left--title span {
                margin: 0;
                padding: 0;
                font-size: 10px;
                color: #6c757d;
            }
                .title--transaction .left--title span b {
                    text-transform: uppercase;
                    text-decoration: underline;
                }
            .title--transaction .left--title h4 {
                margin: 0;
                padding: 0;
                font-size: 28px;
                margin-top: 3px;
            }
        .title--transaction .right--title {
            width: 30%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
            .title--transaction .right--title .btn-group {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: flex-end;
            }
                .title--transaction .right--title .btn-group .btn {
                    font-size: 18px;
                    font-weight: bold;
                    border: 1px solid #c12e2e;
                    border-radius: 5px;
                    color: #c1702e;
                }
</style>
<!-- style item transaction  -->
<style scoped>
    .list--transaction {
        height: 45vh;
        display: flex;
        flex-direction: column;
        gap: 10px;
        overflow-y: auto; /* Memastikan scroll hanya vertikal */
        overflow-x: hidden; /* Menghilangkan horizontal scroll */

        /* Gaya untuk scrollbar */
        scrollbar-width: thin; /* Untuk Firefox */
        scrollbar-color: rgba(0, 0, 0, 0.5) transparent; /* Untuk Firefox */
    }
    /* Untuk Chrome, Safari, dan Edge */
    .list--transaction::-webkit-scrollbar {
        width: 8px; /* Lebar scrollbar */
    }

    .list--transaction::-webkit-scrollbar-track {
        background: transparent; /* Warna background track scrollbar */
    }

    .list--transaction::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.5); /* Warna scrollbar */
        border-radius: 4px; /* Membuat tepi scrollbar menjadi bulat */
    }

    .list--transaction::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.7); /* Warna scrollbar saat di-hover */
    }
        .item--transaction_cart {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 5px;
            padding: 10px;
            background-color: #f8f8f8;
            border: 1px solid #d5d6d7;
        }
            .item--transaction_cart .title--item_transaction {
                display: flex;
                flex-direction: column;
                width: 79%;
                gap: 5px;
            }
                .item--transaction_cart .title--item_transaction b {
                    font-size: 16px;
                    display: flex;
                    align-items: center;
                    gap: 5px;
                    width: 100%;
                }
                .item--transaction_cart .title--item_transaction .harga--transaction {
                    display: flex;
                    gap: 5px;
                    width: 100%;
                }
                    .item--transaction_cart .title--item_transaction .harga--transaction span {
                        font-size: 14px;
                    }
                    .item--transaction_cart .title--item_transaction .harga--transaction i {
                        text-align: left;
                        font-size: 14px;
                        font-weight: bold !important;
                    }
                    .item--transaction_cart .title--item_transaction .harga--transaction b {
                        text-decoration: line-through;
                        font-size: 14px;
                        text-align: left;
                        font-size: 10px;
                        font-weight: 100;
                        width: 25%;
                    }
            .item--transaction_cart .button--action {
                width: 23%;
            }
                .item--transaction_cart .button--action .btn-minus {
                    font-size: 12px;
                    font-weight: bold;
                    border: 1px solid #c12e2e;
                    border-radius: 5px;
                    color: #fff;
                }
                .item--transaction_cart .button--action .btn-plus {
                    font-size: 12px;
                    font-weight: bold;
                    border: 1px solid #28a745;
                    border-radius: 5px;
                    color: #fff;
                }
                .item--transaction_cart .button--action input {
                    text-align: center;
                    font-size: 12px;
                    font-weight: bold;
                    border: 1px solid #d5d6d7;
                    border-radius: 5px;
                    color: #000;
                }
</style>
<!-- style result transaction  -->
<style scoped>
    .result--transaction {
        height: 22vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        flex-direction: column;
        padding: 0.2rem 1.2rem;
        gap: 10px;
        background-color: #f8f8f8;
        margin-top: 10px;
    }
        .result--transaction .item--transaction_result {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
</style>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { onMounted, ref, computed, reactive, onBeforeUnmount, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import * as SwalData from 'sweetalert2';
import { toastAlert } from "@/Helpers/AlertPlugins";
import axios from "axios";
import ModalForm from "@/Components/ModalForm.vue";
import moment from "moment";

// category
const selectedKategory = ref('');

// watch selectedKategory
watch(selectedKategory, () => {
    search();
});

// Modal Data
const closeModal = () => {
    modalOpen.value = false;
};
defineEmits(["closeModal"]);

// cetak pdfFrame
const cetakPdfFrame = (detail = null) => {
    if (detail !== null) {
        detaiLtransaksi.value = detail;
    }
    setTimeout(() => {
        let pdfFrame = document.getElementById("pdfFrame");
        pdfFrame.focus();
        pdfFrame.contentWindow.print();
    }, 500);
};

const modalOpen = ref(false);

const modalAttr = reactive({
  title: "Tambah Data",
  mode: "create",
  icon: "",
  size: "modal-lg",
  actionForm: null,
});

const riwayats = ref([]);
const detaiLtransaksi = ref(null);
const tanggalTransaksi = ref(null);

// resetRiwayat
const resetRiwayat = () => {
    riwayats.value = [];
    detaiLtransaksi.value = null;
    tanggalTransaksi.value = null;
};

// call riwayat
const callRiwayat = async () => {
    isLoading.value = true;
    const { data } = await axios.get(route("riwayatTransaksi"), {
        params: {
            tanggal: tanggalTransaksi.value,
        },
    });
    riwayats.value = data;
    // detaiLtransaksi check if data.length > 0
    if (data.length > 0) {
        detaiLtransaksi.value = data[0];
    }
    isLoading.value = false;
};

// Open Modal Transaksi
const openTransaksiModal = () => {
  resetRiwayat();
  tanggalTransaksi.value = moment().format("YYYY-MM-DD");
  modalAttr.title = "Riwayat Transaksi";
  modalAttr.icon = "bi bi-file-bar-graph-fill";
  modalAttr.actionForm = null;
  modalAttr.mode = "riwayat";
  modalAttr.size =  "modal-fullscreen";
  modalOpen.value = true;
  callRiwayat();
};

const metodePembayran = ref("tunai");
const noTransaksi = ref(null);

const changeMetodePembayaran = (metode) => {
    metodePembayran.value = metode;
};

const askBayarTransaksi = async () => {
    let ref_transaksi = null;

    // Cek metode pembayaran
    if (metodePembayran.value === 'non tunai' || metodePembayran.value === 'QRIS') {
        const { value: refInput } = await SwalData.default.fire({
            title: 'Nomor Transaksi',
            input: 'text',
            inputLabel: 'Masukan Nomor Transaksi',
            inputPlaceholder: 'Nomor Transaksi ...',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Nomor transaksi tidak boleh kosong!';
                }
            },
        });

        // Jika tidak ada input untuk ref_transaksi, keluar dari fungsi
        if (!refInput) return;
        ref_transaksi = refInput;
        noTransaksi.value = refInput;
    }
    // SwalData form total_bayar
    const { value: total_dibayar } = await SwalData.default.fire({
        title: "Total Bayar",
        input: "number",
        inputLabel: "Masukan Nominal Uang Customer",
        inputPlaceholder: "Total Pembayaran ...",
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return "Total bayar tidak boleh kosong!";
            }
        },
    });
    // check if total_dibayar
    if (total_dibayar) {
        // check if total_dibayar < totalBayar
        if (total_dibayar < totalBayar.value) {
            toastAlert("error", "Total bayar tidak boleh kurang dari total belanja.");
            return;
        }
        // SwalData ask Apakah anda yakin sudah memasukan nominal yang sesuai
        const { value: accept } = await SwalData.default.fire({
            title: "Silahkan Cek Kembali !",
            html: `
                <div style="text-align: left;">
                    <p>Nominal Uang : <b>${rupiah(total_dibayar)}</b></p>
                    <p>Total Pembelian : <b>${rupiah(totalBayar.value)}</b></p>
                    <p>Kembalian : <b>${rupiah(total_dibayar - totalBayar.value)}</b></p>
                </div>
            `,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, bayar!",
            cancelButtonText: "Tidak, batalkan!",
            reverseButtons: true,
        });
        // check if accept
        if (accept) {
            // check if metodePembayran === tunai
            if (metodePembayran.value === "tunai") {
                bayarTransaksi(total_dibayar);
            } else {
                bayarTransaksi(total_dibayar);
            }
        }
    }
}

const bayarTransaksi = async (total_dibayar) => {
    try {
        let payload = {
            total: totalBayar.value,
            total_dibayar,
            metode_pembayaran: metodePembayran.value,
            json_transaksi: JSON.stringify(cart.value),
        };
        if (metodePembayran.value === 'non tunai' || metodePembayran.value === 'QRIS') {
            payload.ref_transaksi = noTransaksi.value;
        }
        await axios.post(route("storePembelian"), payload);
        // bersihkan
        cart.value = [];
        totalBayar.value = 0;
        localStorage.removeItem("cart");
        localStorage.removeItem("totalBayar");
        // toast
        toastAlert("success", "Transaksi berhasil dilakukan.");
        // SwalData loading memuat transaksi
        getBarangs();
        SwalData.default.fire({
            title: "Memuat transaksi...",
            allowOutsideClick: false,
            didOpen: () => {
                SwalData.default.showLoading();
            },
        });
        openTransaksiModal();
        setTimeout(() => {
            SwalData.default.close();
            cetakPdfFrame();
        }, 1500);
    } catch (error) {
        console.log(error);
        // get message
        console.log(error.response.data.message);
        // toast
        toastAlert("error", error.response.data.message);
    }
}

const barangs = ref([]);
const totalBarang = ref(0);
const page = ref(1);
const totalPage = ref(1);

const cart = ref([]);
const totalBayar = ref(0);
const pajakBayar = ref(0);

const keyword = ref("");
const search = () => {
  getBarangs(keyword.value);
};

// rupiah
const rupiah = (angka) => {
    var number_string = angka.toString(),
        sisa = number_string.length % 3,
        rupiah = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        var separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    return `Rp. ${rupiah}`;
};

const user = computed(() => {
  return usePage().props.auth.user;
});

const actionAddCart = (barang, plus = true) => {
    // check if barang id is exist
    let isExist = cart.value.find((c) => c.id === barang.id);
    if (isExist) {
        // update barang
        let index = cart.value.findIndex((c) => c.id === barang.id);
        // check if barang qty is more than barang_stok_sisa
        if (plus) {
            if (cart.value[index].qty + 1 > barang.barang_stok_sisa) {
                toastAlert("error", "Stok barang tidak mencukupi. Sisa stok: " + barang.barang_stok_sisa);
                return;
            }
            cart.value[index].qty += 1;
        } else {
            if (cart.value[index].qty - 1 <= 0) {
                cart.value.splice(index, 1);
                toastAlert("success", "Barang berhasil dihapus dari keranjang.");
            } else {
                cart.value[index].qty -= 1;
            }
        }
    } else {
        // add barang
        cart.value.push({
            ...barang,
            qty: 1,
        });
    }
    updateTotalBayar();
};

const updateTotalBayar = () => {
    let total = 0;
    cart.value.forEach((c) => {
        total += c.qty * c.total_diskon.harga_setelah_diskon;
    });
    totalBayar.value = total;
    localStorage.setItem("cart", JSON.stringify(cart.value));
    localStorage.setItem("totalBayar", totalBayar.value);
};

// clearCart
const clearCart = async () => {
    // SwalData ask
    const { value: accept } = await SwalData.default.fire({
        title: "Anda yakin?",
        text: "Anda akan menghapus semua barang di keranjang.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus semua!",
        cancelButtonText: "Tidak, batalkan!",
        reverseButtons: true,
    });
    // check if accept
    if (accept) {
        cart.value = [];
        totalBayar.value = 0;
        localStorage.removeItem("cart");
        localStorage.removeItem("totalBayar");
        toastAlert("success", "Keranjang berhasil dibersihkan.");
    }
};

const props = defineProps({
  mainData: {
    type: Object,
    default: () => ({}),
  },
  barangs: {
    type: Object,
    default: () => ({}),
  },
  kategori: {
    type: Array,
    default: () => [],
  }
});

const isLoading = ref(false);

const getBarangs = (search = '', pageData = 1, findBarcode = false) => {
  isLoading.value = true;
  const parameter = {
        query: search,
        page: pageData,
    };
    if (selectedKategory.value !== '' && !findBarcode) {
        parameter.kategori = selectedKategory.value;
    }
    axios.get(route("barangs"), {
        params: parameter,
    })
    .then((res) => {
        // page
        // if page > 1
        if (findBarcode) {
            // check if res.data.data.length > 0
            // add to chart
            if (res.data.data.length > 0) {
                actionAddCart(res.data.data[0]);
            } else {
                toastAlert("error", "Barang tidak ditemukan.");
            }
        } else {
            if (pageData > 1) {
                barangs.value = [...barangs.value, ...res.data.data];
            } else {
                barangs.value = res.data.data;
            }
            page.value = pageData;
            totalPage.value = res.data.last_page;
            totalBarang.value = res.data.total;
        }
        isLoading.value = false;
    })
    .catch((err) => {
        console.log(err);
        isLoading.value = false;
    });
};

onMounted(() => {
    // action click .nav-toggle-box
    let w = $(window).width();
    //   console.log(w);
    if (w >= 1199) {
      $(".wrapper").addClass("toggled");
    }

    // check localStorage
    if (localStorage.getItem("cart")) {
        cart.value = JSON.parse(localStorage.getItem("cart"));
        updateTotalBayar();
    }
    getBarangs(keyword.value, page.value);
    window.addEventListener('keydown', handleKeyPress);
});

onBeforeUnmount(() => {
  window.removeEventListener('keydown', handleKeyPress);
});

const isScanning = ref(false); // State untuk tracking status scanning
const scannedValue = ref('');

const handleKeyPress = (e) => {
  console.log('mencet');
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
    getBarangs(value, 1, true)
};

</script>
