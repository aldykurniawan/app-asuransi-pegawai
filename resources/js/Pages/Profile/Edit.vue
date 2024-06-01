<template>
  <AuthenticatedLayout :hero="true">
    <loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1" />

    <div class="row">
      <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="mb-0">Data Akun</h5>
            <hr />
            <div class="card shadow-none border">
              <div class="card-header">
                <h6 class="mb-0">USER INFORMATION</h6>
              </div>

              <form @submit.prevent="updateProfil">
                <div class="card-body row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.name"
                      :class="{ 'is-invalid': errors.name }"
                      placeholder="Nama"
                    />
                    <div v-if="errors.name" class="invalid-feedback">{{ errors.name }}</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.username"
                      :class="{ 'is-invalid': errors.username }"
                      placeholder="Username"
                    />
                    <div v-if="errors.username" class="invalid-feedback">{{ errors.username }}</div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-1">
                      <label class="mb-1">Email</label>
                      <input
                        v-model="form.email"
                        type="email"
                        class="form-control"
                        :class="{ 'is-invalid': errors.email }"
                        placeholder="Email"
                      />
                      <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-1">
                      <label class="mb-2">No. Handphone</label>
                      <input
                        v-model="form.hp"
                        type="hp"
                        class="form-control"
                        :class="{ 'is-invalid': errors.hp }"
                        placeholder="No. Handphone"
                      />
                      <div v-if="errors.hp" class="invalid-feedback">{{ errors.hp }}</div>
                    </div>
                  </div>
                  <!-- <div class="col-12">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                v-model="form.email"
                                :class="{ 'is-invalid': errors.email }"
                            >
                            <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
                  </div>-->

                  <div class="col-md-6">
                    <label class="form-label">Password Baru</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.password"
                      :class="{ 'is-invalid': errors.password }"
                      placeholder="Password Baru"
                    />
                    <div v-if="errors.password" class="invalid-feedback">{{ errors.password }}</div>
                    <small class="fst-italic text-muted">Abaikan Jika Tidak Ada Perubahan.</small>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.password_confirmation"
                      :class="{ 'is-invalid': errors.password }"
                      placeholder="Konfirmasi Password Baru"
                    />
                    <div v-if="errors.password" class="invalid-feedback">{{ errors.password }}</div>
                    <small class="fst-italic text-muted">Abaikan Jika Tidak Ada Perubahan.</small>
                  </div>

                  <div class="text-end">
                    <button :disabled="form.processing" type="submit" class="btn btn-primary">
                      <span v-if="form.processing">
                        <span
                          class="spinner-border spinner-border-sm"
                          role="status"
                          aria-hidden="true"
                        ></span>
                        Mohon Tunggu..
                      </span>
                      <span v-else>
                        <i class="lni lni-save"></i> Update Data
                      </span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0 overflow-hidden">
          <div class="card-body">
            <div class="profile-avatar text-center">
              <img :src="'/images/logo3.png'" class width="100" height="120" alt />
            </div>
            <div class="text-center mt-4">
              <h4 class="mb-1">{{ user.name }}</h4>
              <p class="mb-0 text-secondary">
                <span v-for="(role, r) in user.roles" :key="r" class="capitalize">
                  {{ role.name }}
                  <span v-if="r != user.roles.length-1">,</span>
                </span>
              </p>
              <div class="mt-4"></div>
              <p class="mb-0 text-secondary">
                APP - BELUM ADA NAMA
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
</style>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head, router, useForm, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const user = computed(() => {
  return usePage().props.auth.user;
})

const form = useForm({
  name: user.value.name,
  username: user.value.username,
  email: user.value.email,
  hp: user.value.hp,
  password: null,
  password_confirmation: null,
});

const updateProfil = () => {
  router.patch(route("profile.update"), form, {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      // form.reset()
    }
  });
};

const isLoading = ref(false);
</script>
