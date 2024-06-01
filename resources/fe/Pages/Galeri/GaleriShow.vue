<style>
    .bg__divider {
        height: 80px;
        background-color: #fff;
        width: 100%;
    }
    .image__frame {
        cursor: pointer;
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

            <!-- ==================== Start projdtal ==================== -->

            <section class="projdtal section-padding">
                <div class="container-xxl">
                    <div class="row">
                        <div class="col-md-6 mb-4" v-for="(foto, f) in props.dataSource.file" :key="f">
                            <div class="image__frame" @click="() => previewFile(foto.file_path_url)">
                                <img alt="" :src="foto.file_path_url" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ==================== End projdtal ==================== -->
        </div>
        <ModalPreview :urlFile="urlFile" />
    </MainLayout>
</template>
<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
import ModalPreview from "../../Components/ModalPreview.vue";
import { ref } from "vue";

const props = defineProps({
    page_title: {
        type: String,
        default: "Berita dan Informasi",
    },
    dataSource: {
        type: Object,
    },
});

const url = window.location.origin;

// Modal Preview
const urlFile = ref(null);
const previewFile = (val) => {
  urlFile.value = val;
  $("#modal-preview").modal("show");
};

</script>
