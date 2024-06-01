<style>
    footer {
        background: #e94942;
        background-size: 100%;
    }
    .map_frame {
        width: 100%;
        height: 100%;
        max-height: 300px;
    }
    .horizontal-link {

    }
    .horizontal-link li {
        margin-right: 5px;
    }
    .horizontal-link i {
        color: #fff;
    }
    footer.main-footer .sub-footer{
        border-top: 1px solid #ff5a51 !important;
    }
</style>
<template>
    <!-- ==================== Start Footer ==================== -->

        <footer class="main-footer" data-overlay-dark="0">

            <div class="container pt-80 pb-80">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="clumn">
                            <div class="logo mb-30">
                                <Link href="/">
                                    <img src="/fe/assets/img/logo.svg" alt="">
                                </Link>
                            </div>
                            <div class="text">
                                <p class="text-white">{{ detaildata.tentang_footer.content }}</p>
                            </div>
                            <div class="social circle-bord mt-30">
                                <ul class="rest horizontal-link">
                                    <li>
                                        <a :href="detaildata.facebook.content"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a :href="detaildata.youtube.content"><i class="fab fa-youtube"></i></a>
                                    </li>
                                    <li>
                                        <a :href="detaildata.twitter.content"><i class="fab fa-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="clumn">
                            <h5 class="title fz-20 mb-30">SI-GAP</h5>
                            <ul class="cmp-links">
                                <li class="mb-10">
                                    <Link class="text-white" href="/berita">Berita & Informasi</Link>
                                </li>
                                <li class="mb-10">
                                    <Link class="text-white" href="/gallery">Kegiatan</Link>
                                </li>
                                <li class="mb-10">
                                    <Link class="text-white" href="/tentang">Tentang Kami</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="clumn">
                            <h5 class="title fz-20 mb-30">Kontak Kami</h5>
                            <ul class="address">
                                <li class="adrs mb-15 text-white">{{ detaildata.alamat.content }}</li>
                                <li class="eml underline mb-15">
                                    <a class="text-white" :href="`mailto:${detaildata.email.content}`">{{ detaildata.email.content }}</a>
                                </li>
                                <li class="tel">
                                    <h6 class="text-white">{{ detaildata.no_hp.content }}</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="clumn">
                            <h5 class="title fz-20 mb-30">Lokasi Kami</h5>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.658100098932!2d117.55949571144075!3d0.5134772636891983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x320a4a9767dd3b27%3A0x6f8835822bf8a5bf!2sDinas%20Pemadam%20Kebakaran%20Dan%20Penyelamatan!5e0!3m2!1sid!2sid!4v1691653414865!5m2!1sid!2sid" class="map_frame" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-footer pb-4 pt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="horizontal-link fz-13">
                                <ul class="rest">
                                    <li class="mr-30">
                                        <Link class="text-white" href="/e-maps">E-Maps</Link>
                                    </li>
                                    <li class="mr-30">
                                        <Link class="text-white" href="/e-penanggulangan">E-Penanggulangan</Link>
                                    </li>
                                    <li>
                                        <Link class="text-white" href="/">E-Lapor</Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="copyrights d-flex justify-content-end">
                                <p class="fz-13 text-white">© {{ year }} DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN Kab. Kutai Timur</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- ==================== End Footer ==================== -->
</template>
<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const year = new Date().getFullYear();

const detaildata = ref({
    'tentang_kami': {
        content: '-',
    },
    'alamat': {
        content: '-',
    },
    'no_hp': {
        content: '-',
    },
    'email': {
        content: '-',
    },
    'facebook': {
        content: '-',
    },
    'twitter': {
        content: '-',
    },
    'youtube': {
        content: '-',
    },
    'tentang_footer': {
        content: '-',
    },
});

const getLocalStatikData = () => {
    // check interval in 2 seconds for check in localStorage staticData
    // insert to detaildata
    setInterval(() => {
        const statikData = localStorage.getItem('staticData');
        if (statikData) {
            detaildata.value = JSON.parse(statikData);
        }
    }, 1000);
};

onMounted(() => {
    getLocalStatikData();
});

</script>
