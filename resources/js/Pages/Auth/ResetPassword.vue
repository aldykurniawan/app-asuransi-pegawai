<script setup>
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { watch } from "@vue/runtime-core";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
  <Head>
    <title>New Password</title>
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
              <div class="col-lg-6 d-flex align-items-center justify-content-center" style="background-color:#fcfcfc;">
                <div class="m-4">
                  <img src="/images/reset-password.png" class="img-fluid" alt />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                  <h5>Password Baru</h5>
                  <p>
                    Kami menerima permintaan reset kata sandi Anda. Silakan masukkan kata sandi baru Anda.
                  </p>

                  <div class="login-separater text-center mb-4">
                    <span>Password Baru</span>
                    <hr />
                  </div>

                  <BreezeValidationErrors class="mb-4" />

                  <form @submit.prevent="submit">
                    <div class="row g-3">
                      <div class="col-12">
                        <label for class="form-label">&nbsp; Email</label>
                        <div class="ms-auto position-relative">
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                            <i class="bi bi-envelope"></i>
                          </div>
                          <input
                            v-model="form.email"
                            type="email"
                            placeholder="email here..."
                            class="form-control radius-30 ps-5"
                            name="email"
                            required
                            autocomplete="off"
                            autofocus
                            readonly
                          />
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="inputChoosePassword" class="form-label">&nbsp; Password Baru</label>
                        <div class="ms-auto position-relative">
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                            <i class="bi bi-lock-fill"></i>
                          </div>
                          <input
                            v-model="form.password"
                            type="password"
                            placeholder="Password Baru.."
                            class="form-control radius-30 ps-5"
                            required
                            autocomplete="new-password"
                          />
                        </div>
                      </div>
                       <div class="col-12">
                        <label for="inputChoosePassword" class="form-label">&nbsp; Konfirmasi Password</label>
                        <div class="ms-auto position-relative">
                          <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                            <i class="bi bi-lock-fill"></i>
                          </div>
                          <input
                            v-model="form.password_confirmation"
                            type="password"
                            placeholder="Konfirmasi Password.."
                            class="form-control radius-30 ps-5"
                            required
                            autocomplete="new-password"
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
                            <i class="bx bx-lock-open"></i> Ganti Password
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row totop">
            <div class="col-lg-12 mx-auto text-center" >
              <div class="d-flex gap-2 align-items-center justify-content-center">
                <img src="/fe/assets/img/logo.svg" width="60" class="img mt-3" alt="Diskominfo" />
                <img src="/fe/assets/img/logo_panjang.svg" width="40" class="mt-lg-3" alt="Kutai Timur" />
                <img src="/images/berakhlak.png" width="150" class="img mt-3" alt="Berakhlak" />
              </div>
            </div>
          </div>
          </div>

        </div>

      </div>
    </main>

    <!--end page main-->
  </div>
</template>

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
.totop{
  z-index: 9999;
  position: relative;
}
</style>
