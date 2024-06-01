<template>
  <Head>
    <title>Lupa Password</title>
  </Head>
  <div class="wrapper">
    <!--start content-->
    <div class="skewed"></div>
    <main class="authentication-content">
      <div class="container">
        <div class="authentication-card">
          <div>
            <div class="card shadow rounded-30 overflow-hidden">
              <div class="row g-0">
                <div
                  class="col-lg-6 d-flex align-items-center justify-content-center"
                  style="background-color:#fcfcfc;"
                >
                  <img src="/images/forgot-password.png" width="400" class="img-fluid" alt />
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Lupa Password</h5>
                    <p class="card-text mb-2">Masukkan email anda untuk melakukan reset password.</p>

                    <BreezeValidationErrors class="mb-4" />

                    <div v-if="status" class="alert border-0 bg-light-success alert-dismissible fade show py-2">
                      <div class="d-flex align-items-center">
                        <div class="fs-3 text-success">
                          <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="ms-3">
                          <div class="text-success">{{ status }}</div>
                        </div>
                      </div>

                    </div>
                    <form @submit.prevent="submit">
                      <div class="row g-3 mt-4">
                        <div class="col-12">
                          <label for class="form-label">&nbsp; Email</label>
                          <div class="ms-auto position-relative">
                            <div
                              class="position-absolute top-50 translate-middle-y search-icon px-3"
                            >
                              <i class="bi bi-envelope"></i>
                            </div>
                            <input
                              v-model="form.email"
                              type="email"
                              placeholder="email..."
                              class="form-control radius-30 ps-5"
                              name="email"
                              required
                              autocomplete="off"
                              autofocus
                            />
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-grid">
                            <button
                              type="submit"
                              class="btn btn-md text-white themeColor radius-30 mb-2"
                              :class="{ 'opacity-25': form.processing }"
                              :disabled="form.processing"
                              name="submit"
                            >
                              <i class="bx bx-lock-open-alt"></i> Kirim
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <a
                      :href="route('login')"
                      class="btn btn-light btn-secondary radius-30 btn-md w-100"
                    >Kembali Ke Login</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row totop">
              <div class="col-lg-12 mx-auto text-center">
                <div class="d-flex gap-2 align-items-center justify-content-center">
                  <img src="/fe/assets/img/logo.svg" width="60" class="img mt-3" alt="Diskominfo" />
                  <img src="/fe/assets/img/logo_panjang.svg" width="40" class="mt-lg-3" alt="Kutai Timur" />
                  <img src="/images/berakhlak.png" width="150" class="img mt-3" alt="Berakhlak" />
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </main>

    <!--end page main-->
  </div>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<style scoped>
.rounded-30 {
  border-radius: 30px !important;
}
.img-thumbnail {
  border-radius: 50%;
}
.bg-login {
  background-color: #9a0637 !important;
}
.themeColor {
  background-color: #32B3A6;
}
.themeColor:hover {
  background-color: #32B3A6;
}

.skewed {
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #32B3A6;
  z-index: 0;
  transform: skewY(-25deg);
  transform-origin: top left;
}
.totop {
  z-index: 9999;
  position: relative;
}
</style>
