<template>
  <div
    class="modal fade paling-depan"
    :id="id ? id : 'modal-preview'"
    tabindex="1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="bi bi-file-earmark-text"></i> Preview File
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div v-if="urlFile" class="modal-body">
          
          <div class="row">
            <div v-if="selectedFile" class="col-md-4">
              <slot />
              <hr />

              <div
                class="alert border-0 border-secondary border-start border-4 bg-light-dark alert-dismissible fade show"
              >
                <div class="text-dark">
                  <h6>
                    <i class="bx bx-info-circle"></i> Keterangan Dokumen
                  </h6>
                  <p class="mb-3">{{ selectedFile.keterangan }}</p>
                </div>
              </div>

              <div
                class="alert border-0 border-secondary border-start border-4 bg-light alert-dismissible fade show"
              >
                <div class="text-dark">
                  <h6>
                    <i class="bx bx-building"></i> Instansi Yang Mengesahkan
                  </h6>
                  <p class="mb-3">{{ selectedFile.instansi_terkait }}</p>
                </div>
                <div class="">
                  <h6>
                    <i class="bx bx-calendar"></i> Tanggal Pengesahan
                  </h6>
                  <p>{{ moment(selectedFile.tanggal_dokumen).format("DD MMMM YYYY") }}</p>
                </div>
              </div>
            </div>
            <div class="mx-auto" :class="{'col-md-12' : !selectedFile, 'col-md-8': selectedFile}">
              <slot v-if="!selectedFile" />
              
              <div v-if="urlFile.includes('.pdf')">
                <pdf-js :fileName="urlFile" :path="fileTemplate" />
              </div>
              <div v-else-if="urlFile.includes('.png') || urlFile.includes('.jpg') || urlFile.includes('.jpeg')">
                <img :src="urlFile" style="width:100%;" alt />
              </div>
              <div v-else class="text-center mt-4">
                <h1>
                  <i class="bx bxs-file-archive bx-lg"></i>
                </h1>
                <h6>File Tidak Dapat Dipreview</h6>
                <p>Silahkan Download File</p>
                <a :href="urlFile" class="btn btn-s, btn-primary">
                  <i class="bx bx-download"></i> Download
                </a>
              </div>
              
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PdfJs from "@/Components/PdfJs.vue";
export default {
  name: "ModalPreview",
  components: {
    PdfJs,
  },
  props: {
    urlFile: String,
    id: String,
    selectedFile: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      fileTemplate: "/plugins/pdfjs-3.3.122-dist/web/viewer.html", //path of the PDF.js viewer.html
    };
  },
  mounted() {
    // console.log(this.urlFile)
  },
};
</script>
<style>
.paling-depan {
  z-index: 1000000;
}
</style>