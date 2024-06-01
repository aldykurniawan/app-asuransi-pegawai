<template>
    <MainLayout>
        <Head :title="props.page_title" />
        <!-- ==================== Start Slider ==================== -->

        <header class="pg-header-sipm to-up valign">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="caption text-center">
                            <h1 class="fz-60 color-red">Tentang Kami.</h1>
                            <div id="particles-js"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ==================== End Slider ==================== -->
        <div class="position-re">

            <!-- ==================== Start Services ==================== -->

            <!-- <section class="services to-up md-no-pad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="item text-center box-shadw pt-50 pb-50">
                                <div class="icon fz-50 mb-20 rest d-flex justify-content-center align-items-center">
                                    <img style="width: 54px; height: 54px;" src="/images/penanggulangan.svg" alt />
                                </div>
                                <h6 class="mb-20 fw-600 text-center">E-Penanggulangan</h6>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="item text-center box-shadw pt-50 pb-50">
                                <div class="icon fz-50 mb-20 rest d-flex justify-content-center align-items-center">
                                    <img style="width: 54px; height: 54px;" src="/images/senter.svg" alt />
                                </div>
                                <h6 class="mb-20 fw-600 text-center">E-lapor</h6>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="item text-center box-shadw pt-50 pb-50 md-no-mrg">
                                <div class="icon fz-50 mb-20 rest d-flex justify-content-center align-items-center">
                                    <img style="width: 54px; height: 54px;" src="/images/maps.svg" alt />
                                </div>
                                <h6 class="mb-20 fw-600 text-center">E-Maps</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

            <!-- ==================== End Services ==================== -->

            <!-- ==================== Start Sec-half ==================== -->

            <section class="sec-half position-re bg-white">
                <div class="bg-img" data-background="/images/pp.svg" data-overlay-dark="2"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-7">
                            <div class="content" v-html="detaildata.tentang_kami.content"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== End Sec-half ==================== -->

        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

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

const props = defineProps({
    page_title: {
        type: String,
        default: "Tentang",
    },
});
</script>
