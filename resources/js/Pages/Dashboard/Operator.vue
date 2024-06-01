<template>
  <AuthenticatedLayout :hero="true">
    <loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1" />
    <template #cover>
      <div class="profile-cover bg-dark custom-cover" style="margin-top:-70px;"></div>
    </template>
    <welcome style="position:relative; top:170px; margin-bottom:200px;" />


  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { ref } from "vue";
import welcome from "./Partials/Welcome.vue";

const props = defineProps({
  mainData: {
    type: Object,
    default: () => ({}),
  },
});

const isLoading = ref(false);

</script>