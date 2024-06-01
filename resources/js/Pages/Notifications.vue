<template>
  <AuthenticatedLayout>

    <div class="col-12 col-lg-10 col-xl-10 mx-auto">
      <div class="card radius-10 w-100 mt-3">
        <div class="card-header bg-transparent">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">
                <i class="bi bi-bell-fill"></i> Notifications
              </h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="d-lg-flex gap-2">
            <div class="list-group result-notif" style="width:100%;">
              <div v-for="(itemNotif, indexNotif) in notifications" :key="indexNotif">
                <Link class="dropdown-item mb-2" :href="itemNotif.data?.url">
                  <div
                    data-bs-toggle="tooltip"
                    data-bs-placement="left"
                    :title="itemNotif.data?.data?.body"
                    class="d-flex align-items-center"
                  >
                    <div class="notification-box">
                      <i v-if="!itemNotif.read_at" class="bx bx-envelope bx-sm"></i>
                      <i v-else class="bx bx-envelope-open bx-sm text-secondary"></i>
                    </div>
                    <div class="ms-3 flex-grow-1">
                      <h6 class="mb-0 dropdown-msg-user">
                        {{ itemNotif.data?.title }}
                        <span
                          class="msg-time float-end text-secondary"
                        >
                          <small>{{ moment(itemNotif.created_at).fromNow() }}</small>
                        </span>
                      </h6>
                      <div class="text-truncate" style="width:90%;">
                        <small
                          class="mb-0 dropdown-msg-text text-secondary align-items-center"
                        >{{ itemNotif.data?.body }}</small>
                      </div>
                    </div>
                  </div>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const props = defineProps({
  notifications: {
    type: Object,
    default: () => ({}),
  },
});

onMounted(async () => {
  new PerfectScrollbar(".result-notif");
});
</script>


<style scoped>
.result-notif {
  position: relative;
  max-height: 60vh !important;
}
</style>