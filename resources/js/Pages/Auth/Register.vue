<script setup>
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { computed, onMounted, ref, watch } from "@vue/runtime-core";

defineProps({
  canResetPassword: Boolean,
  status: String,
});


const form = useForm({
  name: "",
  username: "",
  email: "",
  hp: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => {
      form.reset()
      showForm.value = false
    },
  });
};
// const emit = () => def;

const pageFlashes = computed(() => usePage().props.flash);
watch(pageFlashes, () => {
  if (pageFlashes.value.message) {
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
  if (pageFlashes.value.success) {
    Lobibox.notify("success", {
      pauseDelayOnHover: true,
      title: "Sukses",
      size: "mini",
      rounded: true,
      continueDelayOnInactiveTab: false,
      position: "top center",
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
});

const showForm = ref(true)
onMounted(() => {
  const params = new URLSearchParams(location.search);
  if(params.get("registred")){
    showForm.value = false
  };
});
</script>

<template>
  <Head>
    <title>Register</title>
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
                  class="col-lg-4 d-flex align-items-center justify-content-center"
                  style="background-color:#fcfcfc;"
                >
                  <div class="m-4">
                    <img src="/images/register.png" class="img-fluid" alt />
                  </div>
                </div>
                <div class="col-lg-8">
                  <div v-if="showForm" class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Register</h5>
                    <p class="card-text mb-2">Isi Data Diri Anda Untuk Mendapatkan Akun.</p>
                    <div class="login-separater text-center mb-4">
                      <span>Silahkan Lengkapi Form Yang Telah Disediakan</span>
                      <hr />
                    </div>

                    <BreezeValidationErrors class="mb-4" />

                    <form @submit.prevent="submit">
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label for class="form-label">&nbsp; Nama Lengkap</label>
                          <div class="ms-auto position-relative">
                            <div
                              class="position-absolute top-50 translate-middle-y search-icon px-3"
                            >
                              <i class="bx bxs-user-detail"></i>
                            </div>
                            <input
                              v-model="form.name"
                              type="text"
                              placeholder="Nama Lengkap..."
                              class="form-control radius-30 ps-5"
                              name="username"
                              required
                              autocomplete="off"
                              autofocus
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
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
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for class="form-label">&nbsp; Email</label>
                          <div class="ms-auto position-relative">
                            <div
                              class="position-absolute top-50 translate-middle-y search-icon px-3"
                            >
                              <i class="bx bx-envelope"></i>
                            </div>
                            <input
                              v-model="form.email"
                              type="email"
                              placeholder="email..."
                              class="form-control radius-30 ps-5"
                              name="email"
                              required
                              autocomplete="off"
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for class="form-label">&nbsp; Nomor Handphone</label>
                          <div class="ms-auto position-relative">
                            <div
                              class="position-absolute top-50 translate-middle-y search-icon px-3"
                            >
                              <i class="bx bx-mobile"></i>
                            </div>
                            <input
                              v-model="form.hp"
                              type="text"
                              placeholder="Hanphone..."
                              class="form-control radius-30 ps-5"
                              name="hp"
                              required
                              autocomplete="off"
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
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
                              placeholder="Password..."
                              class="form-control radius-30 ps-5"
                              required
                              autocomplete="off"
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label
                            for="inputChoosePassword"
                            class="form-label"
                          >&nbsp; Konfirmasi Password</label>
                          <div class="ms-auto position-relative">
                            <div
                              class="position-absolute top-50 translate-middle-y search-icon px-3"
                            >
                              <i class="bi bi-lock-fill"></i>
                            </div>
                            <input
                              v-model="form.password_confirmation"
                              type="password"
                              placeholder="Konfirmasi Password..."
                              class="form-control radius-30 ps-5"
                              required
                              autocomplete="off"
                            />
                          </div>
                        </div>

                        <div class="col-md-8">
                          <div class="form-check form-switch mt-2">
                            <BreezeCheckbox
                              id="acc"
                              name="remember"
                              required
                              v-model:checked="form.remember"
                            />
                            <label
                              class="form-check-label"
                              for="acc"
                            >Data Yang Saya Masukkan Telah Benar</label>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-grid">
                            <button
                              type="submit"
                              class="btn btn-md text-white themeColor radius-30 mb-2 mt-4"
                              :class="{ 'opacity-25': form.processing }"
                              :disabled="form.processing"
                              name="submit"
                            >
                              <i class="bx bx-edit"></i> Daftar
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>

                    <div class="mt-4 text-center border-0">
                      Sudah Punya Akun ? <Link :href="route('login')" class>Login</Link>
                    </div>
                  </div>

                  <div v-else>
                    <div class="alert alert-info mt-5 mx-5">
                      <h6>Berhasil.</h6>
                      <p>Data anda telah berhasil dikirim. Kami akan segera melakukan verifikasi terhadap data yang anda daftarkan.</p>

                      <i>Aktivasi akun akan kami kirim melalui email yang anda daftarkan.</i>
                    </div>

                    <Link
                      :href="route('fe.index')"
                      class="btn btn-outline-primary btn-sm mx-5 mb-5"
                    >
                      <i class="bx bx-left-arrow-circle"></i> Halaman Utama
                    </Link>
                  </div>
                </div>
              </div>
            </div>
            <div class="row totop">
              <div class="col-lg-12 mx-auto text-center">
                <div class="d-flex gap-2 align-items-center justify-content-center">
                  <img src="/fe/assets/img/logo_panjang.svg" width="100" class="img mt-3" alt="Diskominfo" />
                  <img src="/images/logo.png" width="50" alt="Kutai Kartanegara" />
                  <img src="/images/berakhlak.png" width="110" class="img mt-3" alt="Berakhlak" />
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
  background-color: #063155;
}
.themeColor:hover {
  background-color: #145993;
}

.skewed {
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #063155;
  z-index: 0;
  transform: skewY(-25deg);
  transform-origin: top left;
}
.totop {
  z-index: 9999;
  position: relative;
}
</style>
