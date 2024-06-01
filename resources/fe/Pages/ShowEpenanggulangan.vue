<style>
    .bg__divider {
        height: 80px;
        background-color: #fff;
        width: 100%;
    }
</style>
<template>
    <MainLayout>
        <Head :title="props.page_title" />

        <div class="wrapper">
            <div class="bg__divider"></div>
             <!-- ==================== Start Header ==================== -->

            <section class="works-header bg-img parallaxie d-flex align-items-end" :data-background="props.dataSource.first_foto"
                data-overlay-dark="4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-9">
                            <div class="cont mb-40">
                                <h6>SI-GAP</h6>
                                <h2>{{ props.dataSource.nama }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="particles-js"></div>
            </section>

            <!-- ==================== Start Header ==================== -->

            <!-- ==================== Start Intro ==================== -->

            <section class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="htit">
                                <h4>Penjelasan</h4>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-1 col-md-8">
                            <div class="text js-scroll__content">
                                <p class="fz-18 fw-300" v-html="props.dataSource.deskripsi_nl2br"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="accordion bord mt-50">

                                <div
                                    v-for="(item, index) in props.dataSource.steppenanggulanganopen"
                                    :key="index"
                                    :class="`item ${index === 0 ? 'active' : ''}`"
                                >
                                    <div class="title">
                                        <h6 class="fz-15">{{ index + 1 }}. {{ item.nama }}</h6>
                                        <span class="ico"></span>
                                    </div>
                                    <div :class="`accordion-info ${index === 0 ? 'active' : ''}`">
                                        <p v-html="item.deskripsi"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== End Intro ==================== -->

            <div class="recent-posts bg-light-gray section-padding mt-100">
                <div class="blog-grid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-60 text-primary">
                                    <h4>Penanggulangan Lainnya</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-4" v-for="(b, k) in props.data_penanggulangan" :key="k">
                                <div class="item bg-white crv mb-30">
                                    <div class="img">
                                        <img :src="b.first_foto" style="width: 300px; height: 300px; object-fit: cover;" alt="">

                                        <div class="tags">
                                            <a class="gat">E-Penanggulangan</a>
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
                                            <h5 class="text-primary"><Link :href="`/penanggulangan/${b.id}/${b.slug_nama}`">{{ b.nama }}</Link></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
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
    data_penanggulangan: {
        type: Array,
        default: [],
    }
});
</script>
