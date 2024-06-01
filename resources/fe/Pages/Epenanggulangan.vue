<template>
    <MainLayout>
        <Head :title="props.page_title" />
        <!-- ==================== Start Slider ==================== -->

        <header class="pg-header-sipm  bg-banner">
            <div class="container mt-1">
                <div class="row justify-content-start">
                    <div class="col-lg-8 col-md-10">
                        <div class="caption mt-70 text-left">
                            <span class="fz-14 mb-10 text-u ls4 text-primary">E - Penanggulangan</span>
                            <h6 class="fz-40 fw-600 text-dark">Edukasi Penanggulangan</h6>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ==================== End Slider ==================== -->
        <main class="position-re">
            <div id="particles-js"></div>
            <!-- ==================== Start Blog ==================== -->

            <section class="blog section-padding">
                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-lg-11 side-bar mb-4 border-orange">
                            <form action="/e-penanggulangan" class="search-box">
                                <input type="text" name="search" placeholder="Pencarian...">
                                <button class="btn icon pe-7s-search" type="button"></button>
                            </form>
                        </div>
                        <div class="col-lg-11">

                            <div class="item side-img box-shadow radius-15 mb-50" v-for="(data, k) in props.dataSource.data" :key="k">
                                <div class="row">
                                    <div class="col-lg-5 rest">
                                        <div class="img bg-img" :data-background="data.first_foto"></div>
                                    </div>
                                    <div class="col-lg-7 valign">
                                        <div class="full-width">
                                            <div class="cont">
                                                <div class="date text-u fz-13 fw-500 opacity-7 mb-10">
                                                    <span class="gr-orange-text">{{ data.tanggal_rilis }}</span>
                                                </div>
                                                <div class="title">
                                                    <h5 class="fw-600 mb-10 text-primary">
                                                        <Link :href="`/penanggulangan/${data.id}/${data.slug_nama}`">
                                                            {{ data.nama }}
                                                        </Link>
                                                    </h5>
                                                    <p>
                                                        {{ data.short_deskripsi }}
                                                    </p>
                                                </div>
                                                <div class="info flex">
                                                    <div>
                                                        <div class="author flex">
                                                            <div class="flex-img">
                                                                <div class="author-img circle-50 mr-15">
                                                                    <img src="/images/default.png" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="flex-cont valign">
                                                                <div>
                                                                    <span class="fz-12 mb-5 opacity-8">SI-GAP</span>
                                                                    <h6 class="fz-16 text-primary">Kutai Timur</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ml-auto valign">
                                                        <Link :href="`/penanggulangan/${data.id}/${data.slug_nama}`">
                                                            <span class="gat text-primary">Lihat Selengkapnya</span>
                                                        </Link>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-xl-5" v-if="props.dataSource.data.length > 9">
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <Pagination :links="props.dataSource.links" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== End Blog ==================== -->

        </main>
    </MainLayout>
</template>
<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { ref, onUnmounted } from "vue";

const props = defineProps({
    page_title: {
        type: String,
        default: "Tentang",
    },
    dataSource: {
        type: Object,
        default: () => {},
    },
});
</script>

<style scoped>
.bg-banner{
    background: url('/images/banner1.png') top center no-repeat;
    background-size: cover;
    min-height: 550px;
    /* background-attachment: fixed; */
}
.border-orange {
    border: 1px solid rgba(255, 102, 0, 0.141);
    border-radius: 8px;
}
.text-orange {
    color: #f60;
}
</style>
