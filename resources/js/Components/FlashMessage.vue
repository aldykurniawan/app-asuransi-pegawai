<script setup>
import { computed, onMounted, watch } from "vue";
// import { usePage } from "@inertiajs/vue3";

const props = defineProps({
   flash: {
      type: [Object, String],
      default: () => ({}),
    },
})
const pageFlashes = props.flash
onMounted(() => {
  console.log(pageFlashes.success);
});
watch(
  pageFlashes,
  () => {
    console.log(pageFlashes);
    if (pageFlashes.message) {
      Lobibox.notify("default", {
        pauseDelayOnHover: true,
        size: "mini",
        rounded: true,
        continueDelayOnInactiveTab: false,
        position: "top right",
        icon: "bx bx-info-circle",
        msg: pageFlashes.value.message,
      });
    }
    if (pageFlashes) {
      console.log('success')
      alert("dd");
      Lobibox.notify("success", {
        pauseDelayOnHover: true,
        title: "Sukses",
        size: "mini",
        rounded: true,
        continueDelayOnInactiveTab: false,
        position: "top right",
        icon: "bx bx-check-circle",
        msg: pageFlashes.value.success,
      });
    }
    if (pageFlashes.value.info) {
      Lobibox.notify("info", {
        pauseDelayOnHover: true,
        title: "Info",
        size: "mini",
        rounded: true,
        continueDelayOnInactiveTab: false,
        position: "top right",
        icon: "bx bx-info-circle",
        msg: pageFlashes.value.info,
      });
    }
    if (pageFlashes.value.warning) {
      Lobibox.notify("warning", {
        pauseDelayOnHover: true,
        title: "Warning",
        size: "mini",
        rounded: true,
        continueDelayOnInactiveTab: false,
        position: "top right",
        icon: "bx bx-error",
        msg: pageFlashes.value.warning,
      });
    }
    if (pageFlashes.value.error) {
      Lobibox.notify("error", {
        pauseDelayOnHover: true,
        title: "Error",
        size: "mini",
        rounded: true,
        continueDelayOnInactiveTab: false,
        position: "top right",
        icon: "bx bx-x-circle",
        msg: pageFlashes.value.error,
      });
    }
    if (pageFlashes.value.sweet_success) {
      swal({
        icon: "success",
        title: "Sukses",
        text: pageFlashes.sweet_success,
        showConfirmButton: false,
        timer: 2500,
      });
    }
    if (pageFlashes.value.sweet_error) {
      swal({
        icon: "error",
        title: "Gagal",
        text: pageFlashes.sweet_error,
        showConfirmButton: false,
        timer: 2500,
      });
    }
  },
  { deep: true }
);
</script>

<template></template>