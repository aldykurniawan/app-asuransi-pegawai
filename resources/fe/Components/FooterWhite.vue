<style>
    .map_frame {
        width: 100%;
        height: 100%;
        max-height: 300px;
    }
</style>
<template>
    <!-- ==================== Start Footer ==================== -->

    <footer class="purple-light-bg position-re pb-40 pt-60">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="clumn">
              <Link href="/" class="logo mb-30">
                <img src="/fe/assets/img/logo.svg" />
              </Link>
              <p>
                {{ detaildata.tentang_footer.content }}
              </p>
              <div class="social circle-bord mt-30">
                <ul class="rest horizontal-link">
                  <li>
                    <a :href="detaildata.facebook">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a :href="detaildata.twitter">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a :href="detaildata.youtube">
                      <i class="fab fa-youtube"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-3 offset-lg-1">
            <div class="clumn">
              <h6 class="title fw-600 mb-30">Kontak kami</h6>
              <ul class="address rest">
                <li class="adrs mb-15">
                    {{ detaildata.alamat.content }}
                </li>
                <li class="eml underline mb-15">
                  <a href="#0">
                    {{ detaildata.email.content }}
                  </a>
                </li>
                <li class="tel">
                  <h6 class="gr-blue2-text">{{ detaildata.no_hp.content }}</h6>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 offset-lg-1 map">
            <h6 class="title fw-600 mb-10">
                Lokasi Kami
            </h6>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.658100098932!2d117.55949571144075!3d0.5134772636891983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x320a4a9767dd3b27%3A0x6f8835822bf8a5bf!2sDinas%20Pemadam%20Kebakaran%20Dan%20Penyelamatan!5e0!3m2!1sid!2sid!4v1691653414865!5m2!1sid!2sid" class="map_frame" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>

      <div class="sub-footer pt-50">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="horizontal-link fz-13">
                <ul class="rest">
                  <li class="mr-30">
                    <Link href="/">SI-GAP KUTIM</Link>
                  </li>
                  <li class="mr-30">
                    <Link href="/e-penanggulangan">E-Penanggulangan</Link>
                  </li>
                  <li class="mr-30">
                    <Link href="/">E-Pelaporan</Link>
                  </li>
                  <li>
                    <Link href="/e-maps">E-Maps</Link>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="copyrights d-flex justify-content-end">
                <p class="fz-13">
                  © {{ year }} Ravo is Proudly Powered by
                  <span class="underline">
                    <a
                      href="#"
                      target="_blank"
                      class="gr-blue2-text"
                    >Ui-ThemeZ</a>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </footer>

    <!-- ==================== End Footer ==================== -->
</template>
<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const year = new Date().getFullYear();

const detaildata = ref({
    'tentang_kami': {
        content: '-',
    },
    'alamat': {
        content: '-',
    },
    'no_hp': {
        content: '-',
    },
    'email': {
        content: '-',
    },
    'facebook': {
        content: '-',
    },
    'twitter': {
        content: '-',
    },
    'youtube': {
        content: '-',
    },
    'tentang_footer': {
        content: '-',
    },
});

const getLocalStatikData = () => {
    // check interval in 2 seconds for check in localStorage staticData
    // insert to detaildata
    setInterval(() => {
        const statikData = localStorage.getItem('staticData');
        if (statikData) {
            detaildata.value = JSON.parse(statikData);
        }
    }, 1000);
};

onMounted(() => {
    getLocalStatikData();
});

</script>
