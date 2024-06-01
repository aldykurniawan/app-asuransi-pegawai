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
                            <h3 class="fz-40 fw-700 text-white mt-0">Berita dan Informasi</h3>
                            <span class="fz-14 fw-400 mb-0 text-u text-light">SI-GAP KUTIM</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="particles-js"></div>
        </header>

        <!-- ==================== End Slider ==================== -->

        <!-- ==================== Start Blog ==================== -->

        <section class="blog-grid section-padding">
            <div class="container">

                <div class="row mb-3">
                    <div class="col-lg-11 side-bar mb-4 border-orange">
                        <form action="/berita" class="search-box">
                            <input type="text" name="search" placeholder="Pencarian...">
                            <button class="btn icon pe-7s-search" type="button"></button>
                        </form>
                    </div>
                    <div class="col-lg-4" v-for="berita in props.data_berita.data" :key="berita.id">
                        <div class="item box-shadow crv mb-30">
                            <div class="img">
                                <img style="height: 300px; width: 300px; object-fit: cover;" :src="berita.full_path" alt="">

                                <div class="tags">
                                    <Link :href="`berita/${berita.kategori.slug_nama}/${berita.kategori.id}`" class="gat">{{ berita.kategori?.nama || '-' }}</Link>
                                    <Link :href="`berita/${berita.kategori.slug_nama}/${berita.kategori.id}`" class="tag">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="10"
                                            viewBox="0 0 16 10">
                                            <polygon fill-rule="evenodd"
                                                points="104.988 9.2 109.488 9.2 109.488 13.7 107.76 11.972 103.062 16.688 100.074 13.7 95.574 18.2 94.512 17.138 100.074 11.594 103.062 14.582 106.716 10.928"
                                                transform="translate(-94 -9)"></polygon>
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                            <div class="cont">
                                <div class="info">
                                    <div class="author">
                                        <span>SI-GAP</span>
                                    </div>
                                    <div class="date gr-orange-text">
                                        <span>{{ berita.tanggal_rilis }}</span>
                                    </div>
                                </div>
                                <div class="title">
                                    <h5>
                                        <Link class="text-primary" :href="`/detail-berita/${berita.id}/${berita.slug_judul}`">
                                            {{ berita.short_title }}
                                        </Link>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-xl-5" v-if="props.data_berita.data.length > 9">
                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                        <Pagination :links="props.data_berita.links" />
                    </div>
                </div>
            </div>
        </section>
        <!-- ==================== End Blog ==================== -->

    </MainLayout>
</template>
<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { ref, onMounted } from "vue";

const props = defineProps({
    page_title: {
        type: String,
        default: "Berita dan Informasi",
    },
    data_berita: {
        type: Object,
    },
});

const isLoading = ref(true);

</script>

<style scoped>
.bg-banner{
    background: url('/images/banner2.png') top center no-repeat;
    background-size: cover;
    min-height: 400px;
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
