<template>
  <MainLayout>
    <Head :title="props.page_title" />
    <!-- ==================== Start Slider ==================== -->

    <header class="full-height rshp valign bg-white-2">
      <div class="front bg-img" data-background="/images/hero.png"></div>
      <div class="container ontop content__header">
        <div class="row">
          <div class="col-lg-6 valign">
            <div class="cont">
              <div class="sub-head radius mb-10 bg-cream d-none d-md-inline">
                <span>SI-GAP KUTIM</span>
              </div>
              <h1 class="fw-800 fz-45 text-primary">Dinas Pemadam Kebakaran Dan Penyelamatan Kab. Kutai Timur</h1>
              <p>
                <span class="text-red">SI-GAP</span> adalah Sistem layanan cepat tanggap untuk memudahkan
                masyarakat dalam melaporkan kejadian kebakaran.
              </p>
              <div class="mt-40 flex">
                <div>
                  <a href="#aplikasi" class="butn butn-md bg-primary-gradient text-light radius-30">
                    <span class="text slide-up">
                      <i class="fa fa-mouse-pointer fa-fw"></i> Lihat Layanan
                    </span>
                    <span class="text slide-down">
                      <i class="fa fa-hand-pointer fa-fw"></i> Lihat Layanan
                    </span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="particles-js"></div>
    </header>

    <!-- ==================== End Slider ==================== -->

    <!-- ==================== Start clients ==================== -->

    <section class="clients-carsouel shad up reset-style bg-transparent">
      <div class="container">
        <div
          class="call-action-banner pt-60 pb-50 position-re bg-white border-1 border-cream radius-30"
          data-overlay-dark="0"
        >
          <div class="row position-re ontop">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-4 valign">
                  <div class="item d-flex align-items-center">
                    <div class="icon-flex mr-10">
                      <a href="https://kutaitimurkab.go.id" target="_blank" class="img">
                        <div class="front">
                          <img
                            style="max-width:100%; width:100%; margin:0;"
                            src="/images/kutim_panjang.svg"
                            alt
                          />
                        </div>
                        <div class="back">
                          <img
                            style="max-width:100%; width:100%; margin:0;"
                            src="/images/kutim_panjang.svg"
                            alt
                          />
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-4 valign">
                  <div class="item d-flex align-items-center">
                    <div class="icon-flex mr-10">
                      <a href="https://damkar.kutaitimurkab.go.id/" target="_blank" class="img">
                        <div class="front">
                          <img
                            style="max-width:100%; width:100%; margin:0;"
                            src="/images/damkar.svg"
                            alt
                          />
                        </div>
                        <div class="back">
                          <img
                            style="max-width:100%; width:100%; margin:0;"
                            src="/images/damkar.svg"
                            alt
                          />
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-4 valign">
                  <div class="item d-flex align-items-center">
                    <a href="#" target="_blank" class="img">
                      <div class="front">
                        <img
                          style="max-width:100%; width:100%; margin:0;"
                          src="/images/bpbd.svg"
                          alt
                        />
                      </div>
                      <div class="back">
                        <img
                          style="max-width:100%; width:100%; margin:0;"
                          src="/images/bpbd.svg"
                          alt
                        />
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 md-hide valign">
              <div class="call-button full-width d-flex justify-content-end">
                <a href="#aplikasi" class="butn butn-md bg-light radius-30">
                  <span class="text gr-red-text slide-up">Dinas Terkait</span>
                  <span class="text gr-sunrise-text slide-down">SI-GAP</span>
                </a>
              </div>
            </div>
          </div>

          <div
            class="full-over bg-img opacity-3 radius-30"
            data-background="/fe/assets/img/patterns/call-action.png"
          ></div>
        </div>
      </div>
    </section>

    <!-- ==================== End clients ==================== -->

    <!-- ==================== Start Process ==================== -->

    <section id="aplikasi" class="collection-box  section-padding position-re pt-4 pb-150">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 mb-3">
            <div class="main-text">
              <h6 class="sub-title text-brown mb-0">Aplikasi SI-GAP</h6>
              <h4 class="fw-700 mt-0 text-primary">Layanan Aplikasi Kami</h4>
            </div>
          </div>
          <div class="col-md-12">
            <div class="metadata-frame">
              <div
                class="metadata-content wow fadeInUp"
                data-wow-delay="0.4s"
                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;"
              >
                <div class="metadata">
                  <div class="metadata-imgframe">
                    <img
                      src="/images/maskot/mascot4.png"
                      alt
                      class="metadata-img"
                    />
                  </div>
                  <Link
                    :href="'/'"
                    class="metadata-title text-truncate text-capitalize"
                  >E-Lapor</Link>
                  <Link
                    :href="''"
                    class="metadata-button"
                  >
                    Akses
                    <i class="icofont-long-arrow-right"></i>
                  </Link>
                </div>
              </div>

              <div
                class="metadata-content wow fadeInUp"
                data-wow-delay="0.2s"
                style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;"
              >
                <div class="metadata">
                  <div class="metadata-imgframe">
                    <img
                      src="/images/maskot/mascot2.png"
                      alt
                      class="metadata-img"
                    />
                  </div>
                  <Link
                    :href="route('fe.e-maps')"
                    class="metadata-title text-truncate text-capitalize"
                  >E-Maps</Link>
                  <Link
                    :href="route('fe.e-maps')"
                    class="metadata-button"
                  >
                    Akses
                    <i class="icofont-long-arrow-right"></i>
                  </Link>
                </div>
              </div>

              <div
                class="metadata-content wow fadeInUp"
                data-wow-delay="0.1s"
                style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;"
              >
                <div class="metadata">
                  <div class="metadata-imgframe">
                    <img
                      src="/images/maskot/mascot1.png"
                      alt
                      class="metadata-img"
                    />
                  </div>
                  <Link
                    :href="route('fe.e-penanggulangan')"
                    class="metadata-title text-truncate text-capitalize"
                  >E-Penanggulangan</Link>
                  <Link
                    :href="route('fe.e-penanggulangan')"
                    class="metadata-button"
                  >
                    Akses
                    <i class="icofont-long-arrow-right"></i>
                  </Link>
                </div>
              </div>

              <div
                class="metadata-content wow fadeInUp"
                data-wow-delay="0.3s"
                style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;"
              >
                <div class="metadata">
                  <div class="metadata-imgframe">
                    <img
                      src="/images/maskot/mascot3.png"
                      alt
                      class="metadata-img"
                    />
                  </div>
                  <a
                    href="javascript:;"
                    class="metadata-title text-truncate text-capitalize"
                  >E-Sapras</a>
                  <a
                    href="javascript:;"
                    class="metadata-button"
                  >
                    Comming Soon
                    <i class="icofont-long-arrow-right"></i>
                  </a>
                </div>
              </div>

              <div
                class="metadata-content wow fadeInUp"
                data-wow-delay="0.5s"
                style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;"
              >
                <div class="metadata">
                  <div class="metadata-imgframe">
                    <img
                      src="/images/maskot/mascot5.png"
                      alt
                      class="metadata-img"
                    />
                  </div>
                  <a
                    href="javascript:;"
                    class="metadata-title text-truncate text-capitalize"
                  >E-Personil</a>
                  <a
                    href="javascript:;"
                    class="metadata-button"
                  >
                    Comming Soon
                    <i class="icofont-long-arrow-right"></i>
                  </a>
                </div>
              </div>
              <div
                class="metadata-content wow fadeInUp"
                data-wow-delay="0.6s"
                style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;"
              >
                <div class="metadata">
                  <div class="metadata-imgframe">
                    <img
                      src="/images/maskot/mascot6.png"
                      alt
                      class="metadata-img"
                    />
                  </div>
                  <a
                    href="javascript:;"
                    class="metadata-title text-truncate text-capitalize"
                  >E-APD</a>
                  <a
                    href="javascript:;"
                    class="metadata-button"
                  >
                    Comming Soon
                    <i class="icofont-long-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>

    <!-- ==================== End Process ==================== -->

    <!-- ==================== Start Hero ==================== -->

    <section class="hero section-padding position-re pt-150 bg-fire">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="main-text">
              <h6 class="sub-title text-white">Kilas APP</h6>
              <h4 class="fw-700 text-light">
                APP belum ada nama, tapi sudah ada fitur.
              </h4>
            </div>
          </div>
          <div class="col-lg-6 offset-lg-1 valign">
            <div class="hero-cont">
              <p class="fw-500 fz-18 mb-10 text-white">
                <span class="fz-25">APP</span> ini adalah aplikasi yang akan memudahkan masyarakat dalam ..........
              </p>
            </div>
          </div>
        </div>
        <div class="row mt-80">
          <div class="col-lg-8 img-quote bg-img-custom" style="border-radius:10px; background: url('/images/kadis-new.png') center center; background-size:cover;" ></div>
          <div class="col-lg-4 valign">
            <div class="quote full-width">
              <blockquote>
                <h5
                  class="fz-20 fw-200 line-height-50 mb-50"
                >Kami akan terus berusaha memberikan kualitas layanan yang prima untuk masyarakat kutai timur.</h5>
              </blockquote>
              <div class="author mb-10">
                <span
                  class="fw-700 fz-13 text-u ls3 gr-sunrise-text"
                >Mr. X Amd Intel NVIDIA</span>
              </div>
              <div class="position">
                <span>
                    Direktur Utama
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="circle-pattern bottom left"></div>
    </section>

    <!-- ==================== End Hero ==================== -->

    <!-- ==================== Start portfolio ==================== -->

    <section class="portfolio section-padding pb-90">
      <div class="container">
        <div class="row mb-40">
          <div class="col-lg-12">
            <div class="round-head">
              <h6 class="ls2 text-u fz-13 fw-600 text-brown rest">Jurnal</h6>
              <h3 class="fw-700 text-primary">Kegiatan SI-GAP</h3>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- gallery -->
          <div class="gallery col-12 rest">
            <div class="row">
              <!-- gallery item -->
              <div
                v-for="(gal, i) in props.data_galeri"
                :key="i"
                class="col-lg-4 col-md-6 items sm-marg web wow fadeInUp"
                data-wow-delay=".4s"
              >
                <div class="item">
                  <div class="item-img" style="border-radius:10px;">
                    <img
                      style="width: 400px; height: 300px; object-fit: cover;"
                      :src="gal.first_foto"
                      alt="image"
                    />
                  </div>
                  <Link :href="`/gallery/${gal.id}/${gal.slug_nama}`" class="cont">
                    <span class="mb-5">
                      <a href="#0">SI-GAP</a>
                    </span>
                    <h6>{{ gal.nama }}</h6>
                  </Link>
                </div>
              </div>
            </div>
          </div>

          <div class="text-center mt-50">
            <Link href="/gallery" class="more-butn bg-red radius-30">
              <span>Lihat Semua Kegiatan</span>
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- ==================== End portfolio ==================== -->

    <!-- ==================== Start Blog ==================== -->

    <section class="blog-grid section-padding">
      <div class="container">
        <div class="row mb-100">
          <div class="col-md-7">
            <div class="simple-head">
              <h6 class="sub-head radius  bg-cream">
                <span class="fz-12 ls2 text-u text-primary">Berita</span>
              </h6>
              <h2 class="fz-40 fw-700 text-primary">Informasi Terkini</h2>
            </div>
          </div>
          <div class="col-md-5 justify-content-end valign">
            <div class="s-title valign ml-auto">
              <h6>
                <Link href="/berita" class="text-primary">Lihat selengkapnya</Link>
                <i class="icon fz-20 pe-7s-angle-right"></i>
              </h6>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4" v-for="(berita, b) in props.data_berita" :key="b">
            <div class="item box-shadow crv">
              <div class="img">
                <img
                  :src="berita.full_path"
                  style="height: 250px; width: 300px; object-fit: cover;"
                  alt
                />

                <div class="tags">
                  <Link
                    class="text-dark"
                    :href="`berita/${berita.kategori.slug_nama}/${berita.kategori.id}`"
                  >{{ berita.kategori.nama }}</Link>
                </div>
              </div>
              <div class="cont">
                <div class="info">
                  <div class="author">
                    <span>SI-GAP</span>
                  </div>
                  <div class="date">
                    <span class="gr-orange-text">{{ berita.tanggal_rilis }}</span>
                  </div>
                </div>
                <div class="title">
                  <h5 class="fw-700 fz-18 ">
                    <Link
                      class="text-primary"
                      :href="`/detail-berita/${berita.id}/${berita.slug_judul}`"
                    >{{ berita.short_title }}</Link>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==================== End Blog ==================== -->

    <!-- ==================== Start Footer ==================== -->
  </MainLayout>

  <!-- ==================== End Footer ==================== -->
</template>


<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";
import MainLayout from "../Layouts/MainLayout.vue";

const props = defineProps({
  data_galeri: {
    type: Array,
    default: [],
  },
  data_berita: {
    type: Array,
    default: [],
  },
  page_title: {
    type: String,
    default: "",
  },
});

const pluginPartikel = () => {
  particlesJS("particles-js",{
  "particles": {
    "number": {
      "value": 1,
      "density": {
        "enable": true,
        "value_area": 400.8530152163807
      }
    },
    "color": {
      "value": "#f5e5c9"
    },
    "shape": {
      "type": "polygon",
      "stroke": {
        "width": 0,
        "color": "#000"
      },
      "polygon": {
        "nb_sides": 3
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 160,
      "random": false,
      "anim": {
        "enable": true,
        "speed": 10,
        "size_min": 40,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 200,
      "color": "#ffffff",
      "opacity": 1,
      "width": 0.4810236182596568
    },
    "move": {
      "enable": true,
      "speed": 8,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "bubble"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
};

onMounted(() => {
  pluginPartikel();
})
</script>

<style scoped>
.title-app {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.content__header .sub-head span {
  font-weight: bold;
  font-size: 1.2em;
  letter-spacing: 3px;
  /* font gradient */
  color: #d52320;
}
.text-red {
  color: #d52320 !important;
}
/* .row.display-flex {
  display: flex !important;
  flex-wrap: wrap !important;
}
.row.display-flex > [class*='col-'] {
  display: flex !important;
  flex-direction: column !important;
} */

header.rshp .front {
  position: absolute;
  top: 0;
  right: 0;
  height: 95vh;
  z-index: 3;
}

header.rshp .front img {
  background-size: cover;
}

.butn .text_ {
  position: relative;
  z-index: 3;
}
.bg-gray2 {
  background: rgb(244, 247, 248);
}
.bg-primary-gradient {
  background: #d52320;
  background: linear-gradient(90deg, #32B3A6 0%, #d52320 100%);
}

.clients-carsouel.shad.reset-style .container {
  background: transparent;
  padding: 0 !important;
  /* -webkit-box-shadow: 0px 0px 60px  #878787; */
  /* box-shadow: 10px 0px 5px  #f5e5c9; */
  box-shadow: none;
  border-radius: 30px;
  box-sizing: border-box;
}

@media screen and (max-width: 991px) {
  .front {
    display: block !important;
  }
  header.rshp .front {
    position: absolute;
    top: 0;
    right: 0;
    width: 60vh;
    height: 50vh;
    z-index: 3;
  }
  header.full-height {
    min-height: 60vh;
  }
}

@media screen and (max-width: 480px) {
  .clients-carsouel.shad.reset-style {
    padding: 0 20px;
  }

  .clients-carsouel.shad.reset-style .container .call-action-banner {
    padding-top: 30px !important;
    padding-bottom: 30px !important;
    padding-left: 20px;
    padding-right: 20px;
  }

  .circle-pattern {
    width: 100%;
    height: 300px;
  }

  .front {
    display: block !important;
  }
  header.rshp .front {
    position: absolute;
    top: 0;
    right: 0;
    width: 60vh;
    height: 50vh;
    z-index: 3;
    opacity: 0.2;
  }

  header.full-height {
    min-height: 60vh;
  }

  /* .row.display-flex > [class*='col-'] {
    display: block !important;
    flex-direction: column !important;
  } */
}

.collection-box .coll-item .cont .se-img {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  position: relative;
  margin: -35px auto 0;
  background: #fff;
  background-size: con;
  padding: 10px;
}
.collection-box .coll-item .cont .se-img .icon {
  position: absolute;
  bottom: 0px;
  right: 0px;
  width: 20px;
  height: 20px;
  line-height: 20px;
  text-align: center;
  border-radius: 50%;
  /* background: #7e2dec; */
  font-size: 10px;
  z-index: 2;
}

.bg-fire{
  background: #e94942 url('/images/bg-fire.png') bottom no-repeat ;
  background-size: 100%;
  /* background-attachment: fixed; */
}
</style>
