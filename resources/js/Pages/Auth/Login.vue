<script setup>
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { watch } from "@vue/runtime-core";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  username: "",
  password: "",
  remember: false,
});

const submit = () => {
    localStorage.removeItem("cart");
    localStorage.removeItem("totalBayar");
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
const emit = () => def;
</script>

<template>
  <Head>
    <title>Login</title>
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
                  <div class="m-4">
                    <img src="/images/logo3.png" class="img-fluid" alt />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                    <div class="text-left">
                      <img src="/fe/assets/img/logo4.png" width="400" alt="logo icon" />
                    </div>

                    <div class="login-separater text-center mb-4">
                      <span>Silahkan Masukkan Username & Password Anda</span>
                      <hr />
                    </div>

                    <BreezeValidationErrors class="mb-4" />

                    <div
                      v-if="status"
                      class="alert border-0 bg-light-success alert-dismissible fade show py-2"
                    >
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
                      <div class="row g-3">
                        <div class="col-12">
                          <label for class="form-label">&nbsp; Username</label>
                          <div class="ms-auto position-relative">
                            <div
                              class="position-absolute top-50 translate-middle-y search-icon px-3"
                            >
                              <i class="bi bi-person-circle"></i>
                            </div>
                            <input
                              v-model="form.username"
                              type="text"
                              placeholder="Username here..."
                              class="form-control radius-30 ps-5"
                              name="username"
                              required
                              autocomplete="off"
                              autofocus
                            />
                          </div>
                        </div>
                        <div class="col-12">
                          <label for="inputChoosePassword" class="form-label">&nbsp; Password</label>
                          <div class="ms-auto position-relative">
                            <div
                              class="position-absolute top-50 translate-middle-y search-icon px-3"
                            >
                              <i class="bi bi-lock-fill"></i>
                            </div>
                            <input
                              v-model="form.password"
                              type="password"
                              placeholder="Password here.."
                              class="form-control radius-30 ps-5"
                              autocomplete="password"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-check form-switch">
                            <BreezeCheckbox
                              id="simpanlogin"
                              name="remember"
                              v-model:checked="form.remember"
                            />
                            <label class="form-check-label" for="simpanlogin">Simpan Login</label>
                          </div>
                        </div>

                        <div class="col-6 text-end">
                          <!-- <a :href="route('password.request')">Lupa Password ?</a> -->
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
                              <i class="bi bi-key"></i> Login
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
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
