<style>
    .bg__divider {
        height: 80px;
        background-color: #fff;
        width: 100%;
    }
    .container__maps {
        background-color: #000;
    }
    footer {
        display: none;
    }
</style>
<template>
    <MainLayout>
        <Head :title="props.page_title" />
        <div class="bg__divider"></div>
        <div class="position-re">
            <div class="container-fluid">
                <MapFullScreen :listPosko="props.data_posko" />
                <div id="particles-js"></div>
            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import MapFullScreen from "../Components/MapFullScreen.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { ref, onUnmounted } from "vue";

const props = defineProps({
    page_title: {
        type: String,
        default: "Tentang",
    },
    data_posko: {
        type: Array,
        default: [],
    },
});
onUnmounted(() => {
    // remove display none on footer
    document.querySelector("footer").style.display = "block";
    // remove display none on fixed-search
    document.querySelector(".fixed-search").style.display = "block";
});
</script>
