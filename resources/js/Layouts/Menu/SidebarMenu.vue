<template>
  <aside class="sidebar-wrapper">
    <div class="iconmenu">
      <div class="nav-toggle-box">
        <div class="nav-toggle-icon">
          <i class="bi bi-list"></i>
        </div>
      </div>
      <ul class="nav nav-pills flex-column">
        <li
          v-if="user.is_active == '1'"
          class="nav-item"
          data-bs-toggle="tooltip"
          data-bs-placement="right"
          title="Dashboards"
        >
          <button
            class="nav-link"
            data-bs-toggle="pill"
            data-bs-target="#pills-dashboards"
            type="button"
          >
            <i class="bi bi-house-door-fill"></i>
          </button>
        </li>

        <li
          v-if="hasAnyRole(['superadmin','admin']) && user.is_active == '1'"
          class="nav-item"
          data-bs-toggle="tooltip"
          data-bs-placement="right"
          title="Data Master"
        >
          <button
            class="nav-link"
            data-bs-toggle="pill"
            data-bs-target="#pills-master"
            type="button"
          >
            <i class="bx bx-book-content font-22"></i>
          </button>
        </li>

        <li
          v-if="user.is_active == '1'"
          class="nav-item"
          data-bs-toggle="tooltip"
          data-bs-placement="right"
          title="Menu Utama"
        >
          <button
            class="nav-link"
            data-bs-toggle="pill"
            data-bs-target="#pills-sigap"
            type="button"
          >
            <i class="bx bxs-layer font-22"></i>
          </button>
        </li>

        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Profil">
          <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-akun" type="button">
            <i class="bi bi-person-fill-gear font-22"></i>
          </button>
        </li>
      </ul>
    </div>

    <!-- Detail Menu -->
    <div class="textmenu">
      <div class="brand-logo" style="filter: none !important;">
        <img :src="'/fe/assets/img/logo-panjang.png'" width="180" height alt />
      </div>
      <div class="tab-content">
        <div v-if="user.is_active == '1'" class="tab-pane fade" id="pills-dashboards">
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-0">Dashboard</h5>
              </div>
              <small class="mb-0">Halaman Utama Aplikasi</small>
            </div>
            <Link :href="route('dashboard')" class="list-group-item">
              <i class="bi bi-house"></i> Dashboard
            </Link>
          </div>
        </div>

        <div
          class="tab-pane fade"
          id="pills-master"
          v-if="hasAnyRole(['superadmin','admin']) && user.is_active == '1'"
        >
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-0">Master</h5>
              </div>
              <small class="mb-0">Data Master (General)</small>
            </div>

            <Link :href="route('master.users.index')" class="list-group-item">
              <i class="bi bi-person-vcard"></i> Users
            </Link>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="pills-sigap"
        >
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-0">Menu Utama</h5>
              </div>
              <small class="mb-0">Navigasi Pilihan Utama</small>
            </div>

            <Link :href="route('asuransis.index')" class="list-group-item">
                <i class="bi bi-envelope-paper"></i> Asuransi
            </Link>

            <Link :href="route('pegawais.index')" class="list-group-item">
                <i class="bi bi-people"></i> Pegawai
            </Link>

            <!-- <Link :href="route('kasir.barangs.index')" class="list-group-item">
                <i class="bi bi-bag-plus-fill"></i> Stok Masuk
            </Link> -->
            <!-- <Link :href="route('master.users.index')" class="list-group-item">
                <i class="bi bi-person-vcard"></i> Barang
            </Link> -->
            <!-- <ul class="metismenu metis" id="menu_sigap" v-if="hasAnyRole(['superadmin','admin']) && user.is_active == '1'">
              <li>
                <a href="javascript:;" class="has-arrow">
                  <div class="parent-icon">
                    <i class="bx bxs-institution"></i>
                  </div>
                  <div class="menu-title">Kasir</div>
                </a>
                <ul>
                  <li>
                    <Link :href="route('master.statikegap.show')" class="list-group-item">
                      <i class="bi bi-arrow-right-short"></i> Statik Data
                    </Link>
                  </li>
                </ul>
              </li>
            </ul> -->

          </div>
        </div>

        <div class="tab-pane fade" id="pills-akun">
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-0">Profil</h5>
              </div>
              <small class="mb-0">Profil Login Anda</small>
            </div>
            <Link
              v-if="user.is_active == '1'"
              :href="route('profile.edit')"
              class="list-group-item"
            >
              <i class="lni lni-cog"></i> Pengaturan
            </Link>
            <Link
              :href="route('logout')"
              method="post"
              type="button"
              as="button"
              class="list-group-item"
              style="text-align:left;"
            >
              <i class="bi bi-power"></i> Logout
            </Link>
          </div>
        </div>
      </div>
    </div>
  </aside>
</template>

<style scoped>
html.semi-dark .brand-logo img {
  filter: none;
  /* margin: 0 auto;   */
}
html.semi-dark .sidebar-wrapper .iconmenu .nav-pills .nav-link.line-success {
  border: 1px solid rgb(0, 177, 30);
  color: solid rgb(0, 177, 30);
}
html.semi-dark
  .sidebar-wrapper
  .iconmenu
  .nav-pills
  .nav-link.line-success.active {
  border-color: transparent;
}
html.semi-dark .sidebar-wrapper .iconmenu .nav-pills .nav-link.line-primary {
  border: 1px solid rgb(0, 88, 177);
  color: solid rgb(0, 88, 177);
}
html.semi-dark
  .sidebar-wrapper
  .iconmenu
  .nav-pills
  .nav-link.line-primary.active {
  border-color: transparent;
}
.custom-notif {
  max-width: 30px;
}

.tooltip-inner {
  background-color: #2f4fff;
  box-shadow: 0px 0px 4px black;
  opacity: 1 !important;
}
.tooltip.bs-tooltip-right .tooltip-arrow::before {
  border-right-color: #2f4fff !important;
}
.tooltip.bs-tooltip-left .tooltip-arrow::before {
  border-left-color: #2f4fff !important;
}
.tooltip.bs-tooltip-bottom .tooltip-arrow::before {
  border-bottom-color: #2f4fff !important;
}
.tooltip.bs-tooltip-top .tooltip-arrow::before {
  border-top-color: #2f4fff !important;
}
</style>

<script setup>
import { ref, computed, onMounted } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
// import BadgeNotif from "@/Components/BadgeNotif.vue";

const user = computed(() => {
  return usePage().props.auth.user;
});

onMounted(() => {
  $(function () {
    "use strict";

    $(function () {
      $('[data-bs-toggle="tooltip"]').tooltip();
      $('[data-bs-toggle="popover"]').popover({
        html: true,
      });
    });

    $(".nav-toggle-icon").on("click", function () {
      $(".wrapper").toggleClass("toggled");
    });

    $(".mobile-toggle-icon").on("click", function () {
      $(".wrapper").addClass("toggled");
    });

    $(function () {
      for (
        var e = window.location,
          o = $(".sidebar-wrapper .tab-content a")
            .filter(function () {
              const cek = e.href.search(this.href);
              return cek > -1;
              // return (this.href == e.origin+e.pathname) ||
              //        (this.href+'/create' == e.origin+e.pathname) ||
              //        (this.href+'/edit' == e.origin+e.pathname) ||
              //        (this.href+'/show' == e.origin+e.pathname)
              //       ;
            })
            .addClass("active");
        o.is("a");

      )
        o = o.parent("").parent("").addClass("active show");

      let metis = o.parent("").parent("");
      if (metis[0].className == "metismenu metis") {
        let x = $(".metismenu li a").filter(function () {
          let li_ = $(this);
          // console.log("ini", li_);

          let cek = li_.attr("href").search(window.location.href.split('?')[0]);
          // console.log("cnt", window.location.href.split('?')[0]);
          if (cek > -1) {
            // console.log("prnt", li_.parent("").parent("").parent(""));
            li_.parent("").parent("").parent("").addClass("mm-active");
            // li_.parent("").parent("").addClass("mm-show");
          } else {
            // li_.parent("").parent("").parent("").addClass("mm-active");
            li_.parent("").parent("").removeClass("mm-show");
          }
        });
        // .addClass("mm-active")
        // .parent()
        // .addClass("");
        x.is("li");

        // x = x.children("").addClass('mm-active')
        // metis.children().addClass('mm-active')
        // metis.children("").addClass("mm-show").parent("").addClass("mm-active")
        let metisTab = metis.parent("").parent("");
        let tab2 = "#" + metisTab[0].id.toString();

        $("[data-bs-target='" + tab2 + "']").addClass("active");
        $(tab2).addClass("active show");
        // console.log(metisTab.parent(""))
        // metisTab.parent("").addClass("active show");
      }

      // console.log(o[0].id.toString());
      if (o[0]) {
        var tab = "#" + o[0].id.toString();
        $("[data-bs-target='" + tab + "']").addClass("active");
      }

      $(".sidebar-wrapper .tab-content a").on("click", function () {
        // console.log('klk')
        $(this).addClass("active");
      });
    });

    // $(function() {
    //   for (var e = window.location,
    //   o = $(".sidebar-wrapper .tab-content .metismenu li a")
    //   .filter(function() {

    //      const cek = e.href.search(this.href);
    //           console.log(cek)
    //           return cek > -1;
    //     })
    //     .addClass("active")
    //     .parent()
    //     .addClass("active"); o.is("li");)
    //     o = o.parent("")
    //     .addClass("mm-show")
    //     .parent("")
    //     .addClass("active")
    // })

    $(".toggle-icon").click(function () {
      $(".wrapper").hasClass("toggled")
        ? ($(".wrapper").removeClass("toggled"),
          $(".sidebar-wrapper").unbind("hover"))
        : ($(".wrapper").addClass("toggled"),
          $(".sidebar-wrapper").hover(
            function () {
              $(".wrapper").addClass("sidebar-hovered");
            },
            function () {
              $(".wrapper").removeClass("sidebar-hovered");
            }
          ));
    });

    $(".iconmenu .nav-link").on("click", function () {
      let w = $(window).width();
      //   console.log(w);
      if (w >= 1199) {
        $(".wrapper").removeClass("toggled");
      }
    });

    $(".nav-link").click(function () {
      //   $(".wrapper").hasClass("toggled") && $(".wrapper").removeClass("toggled");
      $('[data-bs-toggle="tooltip"]').tooltip("hide");
      $(this).addClass("active");
    });

    $(".list-group-item").click(function () {
      $(".nav-link").removeClass("active");
    });
    $(".mn").click(function () {
      $(".nav-link").removeClass("active");
    });

    $("a").click(function () {
      $('[data-bs-toggle="tooltip"]').tooltip("hide");
    });
    $("button").click(function () {
      $('[data-bs-toggle="tooltip"]').tooltip("hide");
    });

    // new PerfectScrollbar(".iconmenu", {
    //   wheelPropagation: true,
    //   minScrollbarLength: 20,
    //   passive: true  // Add passive option here
    // });
    // new PerfectScrollbar(".textmenu", {
    //   wheelPropagation: true,
    //   minScrollbarLength: 20,
    //   passive: true  // Add passive option here
    // })

    $(function () {
      $(".metis").metisMenu({
        preventDefault: false,
        toggle: true,
      });
    });
  });
});
</script>
