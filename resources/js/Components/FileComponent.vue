<template>
    <div class="row">
        <div :class="`col-md-12`">
            <input class="form-input" type="file" @change="handleUpload">
        </div>
        <div class="col-md-12 d-flex align-items-center justify-content-center mt-3" v-if="preview !== null">
            <img :src="preview" style="height: 400px; width: 100%; object-fit: cover;" class="img-responsive" alt="">
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import Swal from 'sweetalert2';

const props = defineProps({
    triggerChange: {
        type: Function,
        required: () => {},
    },
    previewImage: {
        default: null,
    },
    mime: {
        type: Array,
        default: ['image/jpeg', 'image/png'],
    }
});

const preview = ref(null);

// watch previewImage
watch(
    () => props.previewImage,
    (val) => {
        if (val !== null) {
            preview.value = val;
        }
    }
);

onMounted(() => {
    if (props.previewImage !== null) {
        preview.value = props.previewImage;
    }
})

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


// Fungsi ini akan menangani proses upload gambar
const handleUpload = async (event) => {
  // Pastikan file telah dipilih
  if (event.target.files.length > 0) {
    const file = event.target.files[0];
    const allowedMimeTypes = props.mime;
    if (!allowedMimeTypes.includes(file.type)) {
        toast('error', 'File yang diupload harus berupa gambar (JPG/PNG)');
        return;
    }
    props.triggerChange(file);
    // make preview image
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        preview.value = reader.result;
    };
    reader.onerror = (error) => {
        console.log(error);
    };
  } else {
    // Jika tidak ada file yang dipilih, maka set preview menjadi null
    preview.value = null;
  }
}

</script>
