<template>
  <div>
    <Head>
      <title>{{ pageInfo.title }}</title>
    </Head>
    <div class="wrapper">
      <!--start top header-->
      <header class="top-header">
        <nav class="navbar navbar-expand">
          <div class="mobile-toggle-icon d-xl-none">
            <i class="bi bi-list"></i>
          </div>
          <div class="top-navbar d-none d-xl-block">
            <ul class="navbar-nav align-items-center">
              <li class="nav-item">
                <Link class="nav-link" :href="route('dashboard')">
                    APP - BELUM ADA NAMA | {{ date }} - {{ time }}
                </Link>
              </li>
            </ul>
          </div>
          <div class="top-navbar d-lg-none ms-3">
            <img :src="'/fe/assets/img/logo_panjang.svg'" width="140" class="mt-2" alt />

            <!-- <i class="bi bi-search"></i> -->
          </div>
          <div class="d-xl-none ms-auto">
            <!-- <i class="bi bi-search"></i> -->
          </div>
          <div class="d-none d-xl-flex ms-auto">
            <div class="text-sm pe-3" style="border-right: 1px dashed #ccc;">
              <!-- <strong class="d-block mb-0">Role</strong> -->
              <div class="d-flex float-end">
                <span
                  v-for="(item, i) in user.roles"
                  :key="i"
                  class="badge rounded-pill capitalize"
                  :class="bgClass[i]"
                >{{ item.name }}</span>
                <span
                  v-if="user.level == 'member'"
                  class="badge rounded-pill bg-orange capitalize"
                >{{ user.type }}</span>
                <span
                  v-else
                  v-for="(item, i) in user.permissions"
                  :key="i"
                  class="badge rounded-pill bg-dark capitalize"
                >{{ item.name }}</span>
              </div>

              <div class="text-end">
                <span class="badge p-0 mt-1 text-dark">APP - BELUM ADA NAMA</span>
              </div>
            </div>
          </div>
          <div class="top-navbar-right ms-3">
            <ul class="navbar-nav align-items-center">
              <li class="nav-item dropdown dropdown-large">
                <a
                  class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                  href="#"
                  data-bs-toggle="dropdown"
                >
                  <div class="user-setting d-flex align-items-center gap-1 px-2">
                    <img
                      class="user-img_ p-1"
                      alt
                      height="35"
                      :src="user.avatar_path ? user.avatar_path : '/fe/assets/img/icons/serv3.png'"
                    />
                    <div class="user-name d-none d-sm-block">{{ user.name }}</div>
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <img
                          :src="user.avatar_path ? user.avatar_path : '/fe/assets/img/icons/serv3.png'"
                          alt
                          class="rounded-circle_"
                          width="50"
                          height="60"
                        />
                        <div class="ms-3">
                          <h6 class="mb-0 dropdown-user-name">{{ user.name }}</h6>

                          <div class="d-flex mt-1" style="font-size:12px;">
                            <span class="badge badge-flat bg-secondary">
                              <i class="bx bx-badge-check p-0"></i> Role
                            </span>
                            <span
                              v-for="(item, i) in user.roles"
                              :key="i"
                              class="badge badge-flat capitalize"
                              :class="bgClass[i]"
                            >{{ item.name }}</span>
                          </div>
                          <div
                            class="d-flex mt-1"
                            style="font-size:12px;"
                          >

                            <span class="badge rounded-pill bg-success">
                              APP - BELUM ADA NAMA
                            </span>

                            <!-- <span
                              v-for="(item, i) in user.permissions"
                              :key="i"
                              class="badge badge-flat bg-dark capitalize"
                            >{{ item.name }}</span> -->
                          </div>
                        </div>
                      </div>
                    </a>

                    <div class="mx-2 mt-3">
                      <div
                        v-if="user.level == 'member'"
                        class="d-flex mb-1"
                        style="font-size:15px;"
                      >
                        <div>
                          <span class="badge badge-flat bg-secondary">Type</span>
                          <span class="badge badge-flat bg-orange">{{ user.type }}</span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li>
                    <Link class="dropdown-item" :href="route('profile.edit')">
                      <div class="d-flex align-items-center">
                        <div class="setting-icon">
                          <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div class="setting-text ms-3">
                          <span>Pengaturan Profil</span>
                        </div>
                      </div>
                    </Link>
                  </li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li>
                    <Link class="dropdown-item" :href="route('logout')" method="post" as="button">
                      <div class="d-flex align-items-center">
                        <div class="setting-icon">
                          <i class="bi bi-power"></i>
                        </div>
                        <div class="setting-text ms-3">
                          <span>Logout</span>
                        </div>
                      </div>
                    </Link>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown dropdown-large">
                <a
                  class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                  href="#"
                  data-bs-toggle="dropdown"
                >
                  <div class="notifications">
                    <span
                      v-if="dataNotif.length"
                      class="notify-badge text-truncate"
                    >{{ dataNotif.length }}</span>
                    <i class="bi bi-bell-fill"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                  <div class="p-2 border-bottom m-2">
                    <h5 class="h5 mb-0">Notifications</h5>
                  </div>
                  <div class="header-notifications-list p-2">
                    <div v-if="dataNotif.length">
                      <div v-for="(itemNotif, indexNotif) in dataNotif" :key="indexNotif">
                        <Link class="dropdown-item" :href="route('notification.mark-as-read', itemNotif.id)">
                        <!-- itemNotif.data?.url -->
                          <div
                            data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            :title="itemNotif.data?.body"
                            class="row"
                          >
                            <div class="col-4 notification-box ms-2">
                              <i class="bx bx-envelope"></i>
                            </div>
                            <div class="col-8 ms-3 flex-grow-1">
                              <h6 class="mb-0 dropdown-msg-user d-flex">
                                <div class="text-truncate" style="width:150px;">
                                  {{ itemNotif.data?.title }}
                                </div>
                                <span
                                  class="msg-time float-end text-secondary"
                                >
                                  <small>{{ moment(itemNotif.created_at).fromNow() }}</small>
                                </span>
                              </h6>
                              <div class="text-truncate" style="width:250px;">
                                <small
                                  class="mb-0 dropdown-msg-text text-secondary align-items-center"
                                >{{ itemNotif.data?.body }}</small>
                              </div>
                            </div>
                          </div>
                        </Link>
                      </div>
                    </div>

                    <div v-else class="text-center pt-5">
                      <img src="/assets/images/no-notif.png" class="img img-fluid" width="250" alt />
                      <h6 class="mt-5 text-secondary">Tidak Ada Notifikasi</h6>
                    </div>
                  </div>
                  <div class="p-2">
                    <div>
                      <hr class="dropdown-divider" />
                    </div>
                    <Link :href="route('notification.index')" class="dropdown-item">
                      <div class="text-center">Lihat Semua Notifikasi</div>
                    </Link>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--end top header-->

      <!--start sidebar -->
      <sidebar-menu />
      <!--start sidebar -->

      <!-- Halaman Profil -->
      <main v-if="hero" class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 radius-8 mx-1">
          <div class="breadcrumb-title pe-3 text-white">{{ pageInfo.title }}</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li v-for="(item, index) in crumbs" :key="item.id" class="breadcrumb-item">
                  <span v-if="index == 'Dashboard'">
                    <Link :href="item" class="text-white">
                      <i class="bx bx-home-alt"></i>
                    </Link>
                  </span>
                  <span v-else>
                    <Link :href="item" v-if="item != ''">{{ index }}</Link>
                    <Link
                      v-else
                      href
                      class="breadcrumb-item text-white active"
                      aria-current="page"
                    >{{ index }}</Link>
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <!--end breadcrumb-->

        <div v-if="hasSlot('cover')">
          <slot name="cover" />
        </div>
        <div v-else class="profile-cover bg-dark" style="margin-top:-70px;"></div>

        <slot />
      </main>

      <!--start content-->
      <main v-else class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 radius-8 mx-1" v-if="!hideCrumb">
          <div class="breadcrumb-title pe-3">{{ pageInfo.title }}</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li v-for="(item, index) in crumbs" :key="item.id" class="breadcrumb-item">
                  <span v-if="index == 'Dashboard'">
                    <Link :href="item">
                      <i class="bx bx-home-alt"></i>
                    </Link>
                  </span>
                  <span v-else>
                    <Link v-if="item != ''" :href="item">{{ index }}</Link>
                    <Link v-else href class="breadcrumb-item active" aria-current="page">{{ index }}</Link>
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
          <slot />
        </div>
      </main>
      <!--end page main-->

      <!--start overlay-->
      <div class="overlay nav-toggle-icon"></div>
      <!--end overlay-->

      <!--Start Back To Top Button-->
      <a href="javaScript:;" class="back-to-top">
        <i class="bx bxs-up-arrow-alt"></i>
      </a>
      <!--End Back To Top Button-->
    </div>
  </div>
</template>

<script setup>
import {
  ref,
  computed,
  onMounted,
  watchEffect,
  watch,
  inject,
  useSlots,
} from "vue";
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import SidebarMenu from "@/Layouts/Menu/SidebarMenu.vue";

import { Head, Link, usePage } from "@inertiajs/vue3";
import moment from 'moment';
// moment indonesia
import 'moment/locale/id';
// import Echo from "laravel-echo";

const time = ref(moment().format('LT'));
const date = ref(moment().format('LL'));

const swal = inject("$swal");

const props = defineProps({
  layout2: {
    type: Boolean,
    default: () => false,
  },
  hero: {
    type: Boolean,
    default: () => false,
  },
  hideCrumb: {
    type: Boolean,
    default: () => false,
  },
});

const slots = useSlots();
const hasSlot = (name) => {
  return slots[name] !== undefined;
};

const showingNavigationDropdown = ref(false);

const user = computed(() => {
  return usePage().props.auth.user;
});

const bgClass = ref([
  "bg-primary",
  "bg-dark",
  "bg-success",
  "bg-orange",
  "bg-warning",
  "bg-danger",
]);

const crumbs = computed(() => {
  return usePage().props.crumbs;
});

const pageInfo = computed(() => {
  return usePage().props.pageInfo;
});

const pageFlashes = computed(() => usePage().props.flash);

const dataNotif = ref([]);
const getNotificationUser = async () => {
  try {
    const urlTarget = route("notification.get-data");
    const response = await axios.get(urlTarget);
    dataNotif.value = response.data;
  } catch (error) {
    throw error;
  }
};

const Toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
})

const message = (icon, title) => {
    Toast.fire({
        icon: icon,
        title: title
    })
}

onMounted(async () => {
  setInterval(() => {
    time.value = moment().format('LT');
  }, 1000);
  $(document).ready(function () {
    $(window).on("scroll", function () {
      $(this).scrollTop() > 300
        ? $(".back-to-top").fadeIn()
        : $(".back-to-top").fadeOut();
    }),
      $(".back-to-top").on("click", function () {
        return (
          $("html, body").animate(
            {
              scrollTop: 0,
            },
            600
          ),
          !1
        );
      });
  });
  await getNotificationUser();
  new PerfectScrollbar(".header-notifications-list");

//   Echo.private("App.Models.User." + user.value.id)
//     .listen('BencanaEvent', (e) => {
//         getNotificationUser();
//         playAudio();
//         message('warning', e.user.body);
//         // console.log(e, 'hasil broadcast');
//     });

//   Echo.private("App.Models.User." + user.value.id).notification(
//     (notification) => {
//       console.log(notification);
//       const incoming = {
//         data: notification,
//       };
//       console.log("incoming", incoming);
//       dataNotif.value.unshift(notification);
//       // Inertia.reload()
//     }
//   );
});

const audio = ref(null);

const playAudio = () => {
    audio.value = new Audio("/audio.mp3");

    setTimeout(() => {
    audio.value.play();
    }, 500);
};

watch(
  pageFlashes,
  (newValue, oldValue) => {
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
  {
    deep: true,
    immediate: true,
  }
);
</script>

