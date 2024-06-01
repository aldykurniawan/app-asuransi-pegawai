<template>
    <MainLayout>
        <Head :title="props.page_title" />
        <div id="particles-js"></div>
        <div class="position-re pt-100">
            <!-- ==================== Start Blog ==================== -->

            <section class="section-padding">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="main-post md-mb50">
                                <div class="item pb-60">
                                    <div class="cont">
                                        <div class="title">
                                            <h3 class="fw-800 text-primary">{{ dataSource.judul }}</h3>
                                        </div>
                                        <div class="info flex mt-15">
                                            <div class="author mr-30 opacity-8 fz-14">
                                                <span>SI-GAP</span>
                                            </div>
                                            <div class="tags mr-30 opacity-8 fz-14">
                                                <Link :href="`berita/${dataSource.kategori.slug_nama}/${dataSource.kategori.id}`" class="gat">
                                                    {{ dataSource.kategori.nama }}
                                                </Link>
                                            </div>
                                            <div class="date fz-14">
                                                <span>{{ dataSource.tanggal_rilis }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-img mt-40 mb-40 radius-5">
                                        <img :src="dataSource.full_path" alt="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" v-html="dataSource.isi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="side-bar">
                                <form action="/berita" class="search-box">
                                    <input type="text" name="search" placeholder="Pencarian...">
                                    <button class="btn icon pe-7s-search" type="button"></button>
                                </form>
                                <div class="widget catogry">
                                    <h6 class="title-widget">Kategori</h6>
                                    <ul class="rest">
                                        <li v-for="(kategori, k) in props.data_kategori">
                                            <span><Link :href="`berita/${kategori.slug_nama}/${kategori.id}`">{{ kategori.nama }}</Link></span>
                                            <span class="ml-auto">{{ kategori.count_berita }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="recent-posts bg-light-gray section-padding mt-100">
                    <div class="blog-grid">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mb-60 text-primary">
                                        <h4>Berita & Informasi Terbaru</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-4" v-for="(b, k) in props.data_berita" :key="k">
                                    <div class="item bg-white crv mb-30">
                                        <div class="img">
                                            <img :src="b.full_path" style="width: 300px; height: 300px; object-fit: cover;" alt="">

                                            <div class="tags">
                                                <Link :href="`berita/${b.kategori.slug_nama}/${b.kategori.id}`" class="gat">{{ b.kategori.nama }}</Link>
                                                <Link :href="`berita/${b.kategori.slug_nama}/${b.kategori.id}`" class="tag">
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
                                                <div class="date">
                                                    <span>{{ b.tanggal_rilis }}</span>
                                                </div>
                                            </div>
                                            <div class="title">
                                                <h5 class="text-primary"><Link :href="`detail-berita/${b.id}/${b.slug_judul}`">{{ b.short_title }}</Link></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- ==================== End Blog ==================== -->
        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const props = defineProps({
    page_title: {
        type: String,
        default: "Berita dan Informasi",
    },
    dataSource: {
        type: Object,
    },
    data_berita: {
        type: Array,
        default: [],
    },
    data_kategori: {
        type: Array,
        default: [],
    },
});

const isLoading = ref(true);
</script>
