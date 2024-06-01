<template>
    <MainLayout>
        <Head :title="props.page_title" />
        <!-- ==================== Start Slider ==================== -->

        <header class="pg-header-sipm bg-banner ">
            <div class="container mt-60">
                <div class="row justify-content-start">
                    <div class="col-lg-8 col-md-10">
                        <div class="caption">
                            <span class="fz-14 fw-600 mb-0 text-u text-dark">Publikasi</span>
                            <h3 class="fz-40 fw-700 text-white mt-0">Gallery Kegiatan</h3>
                            <span class="fz-14 fw-400 mb-0 text-u text-light">SI-GAP KUTIM</span>

                        </div>
                    </div>
                </div>
            </div>
            <div id="particles-js"></div>
        </header>

        <!-- ==================== End Slider ==================== -->

        <div class="position-re">
            <!-- ==================== Start Blog ==================== -->

            <section class="blog-grid section-padding">
                <div class="container">

                    <div class="row">

                        <div class="col-lg-4" v-for="(galeri, g) in props.data_galeri.data" :key="g">
                            <div class="item clean mb-30">
                                <div class="img radius-5">
                                    <img style="width: 400px; height: 300px; object-fit: cover;" :src="galeri.first_foto" alt="">
                                </div>
                                <div class="cont">
                                    <div class="info">
                                        <div class="date text-brown fw-700">
                                            <span>SI-GAP</span>
                                        </div>
                                    </div>
                                    <div class="title">
                                        <h5 class="text-primary"><Link :href="`/gallery/${galeri.id}/${galeri.slug_nama}`">{{ galeri.nama }}</Link></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-xl-5" v-if="props.data_galeri.data.length > 9">
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <Pagination :links="props.data_galeri.links" />
                        </div>
                    </div>
                </div>
            </section>
            <!-- ==================== End Blog ==================== -->
        </div>
    </MainLayout>
</template>
<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    page_title: {
        type: String,
        default: "Berita dan Informasi",
    },
    data_galeri: {
        type: Object,
    },
});

</script>


<style scoped>
.bg-banner{
    background: url('/images/banner3.png') center center no-repeat;
    background-size: cover;
    min-height: 400px;
    /* background-attachment: fixed; */
}
</style>
