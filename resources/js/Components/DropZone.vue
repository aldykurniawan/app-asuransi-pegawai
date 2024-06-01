<template>
  <div class="row mb-4">
    <div class="col-md-12 frame__dropzone" v-bind="getRootProps()">
      <input v-bind="getInputProps()" />
      <p v-if="isDragActive">Drop File Disini ...</p>
      <p v-else>
        <template v-if="!loading">
            Drag 'n' drop file disini, atau klik untuk upload file.
            <br />
            <br />
            <span class="d-flex flex-column" v-if="!isDragActive">
              <span v-if="!props.maxFiles">
                <span>Maks Upload Size: {{ props.maxSize / 1000000 }} MB</span>
              </span>
              <span class="d-flex flex-column" v-else>
                <span>Maks Upload: {{ props.maxFiles }} file</span>
                <span>Maks Upload Size: {{ props.maxSize / 1000000 }} MB</span>
              </span>
            </span>
        </template>
        <template v-else>
            <div class="d-flex align-items-center justify-content-center flex-column">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="text-primary mt-3">Progress Upload: {{ listFileUpload }} File - Loading...</div>
            </div>
        </template>
      </p>
    </div>
  </div>
</template>

<style>
    .frame__dropzone {
        min-height: 150px;
        width: 100%;
        border-radius: 8px;
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
</style>

<script setup>
import { ref } from 'vue';
import { useDropzone, isDragActive } from "vue3-dropzone";
import axios from "axios";
import Swal from 'sweetalert2';

const loading = ref(false);

const listFileUpload = ref(0);

const toast = (type, message) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: type,
        title: message
    })
};

const props = defineProps({
  accept: {
    type: String,
    default: "image/*",
  },
  maxFiles: {
    type: Number,
    default: 1,
  },
  maxSize: {
    type: Number,
    // default: 1024
    default: 10000000, // 10mb
  },
  urlEndpoint: {
    type: String,
    default: "",
  },
  payloadEndpoint: {
    type: Object,
    default: () => {},
  },
  triggerRefresh: {
    type: Function,
    default: () => {},
  }
});


const onDrop = async (acceptFiles, rejectReasons) => {
    loading.value = true;
    listFileUpload.value = acceptFiles.length;
    let uploadStatuses = [];
    for (let file of acceptFiles) {
        const status = await saveFiles(file);
        uploadStatuses.push(status);
        listFileUpload.value = listFileUpload.value - 1;
    }
    if (uploadStatuses.length >= acceptFiles.length) {
        console.log('All files uploaded successfully');
        props.triggerRefresh();
    }
    // console.log(rejectReasons);
    for(let reject of rejectReasons) {
        for(let error of reject.errors) {
            toast('error', error.message);
        }
    }
    loading.value = false;
};

const { getRootProps, getInputProps, ...rest } = useDropzone({
    onDrop,
    maxFiles: props.maxFiles,
    accept: props.accept,
    maxSize: props.maxSize,
});

const saveFiles = async (files) => {
    const formData = new FormData();
    formData.append("file[]", files);
    if (Object.keys(props.payloadEndpoint).length > 0) {
        for (const [key, value] of Object.entries(props.payloadEndpoint)) {
            formData.append(key, value);
        }
    }

    await axios
    .post(props.urlEndpoint, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then((response) => {
      console.info(response.data);
      return true;
    })
    .catch((err) => {
      console.error(err);
      return false;
    });
};
</script>
