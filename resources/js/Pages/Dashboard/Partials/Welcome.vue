<template>
  <div class="col-12 col-md-12">
    <div class="card radius-10 w-100">
      <div class="card-body">
        <div class="row mt-4">
          <div class="col-md-8">
            <h5 class="text">Portal Admin APP - BELUM ADA NAMA</h5>
            <strong class="text-secondary">Sistem APP - BELUM ADA NAMA</strong>
            <p class="mt-3">
              Selamat datang, <strong class="text-orange">{{ user.name }}</strong> <br>

            </p>

            <p class="text-secondary">
              <small>--AITI--</small>
            </p>
          </div>
          <div class="col-md-4">
            <div class="text-center">
              <img src="/images/maskot/icon1.png" class="img-fluid" width="140" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// const props = defineProps({
//   dataSource: {
//     type: Object,
//     default: () => ({}),
//   },
// });

import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const user = computed(() => {
  return usePage().props.auth.user;
});
</script>
