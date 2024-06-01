<template>
    <quill-editor style="min-height: 300px; height: 100%; width: 100%;" :modules="modules" theme="snow" :toolbar="toolBar" placeholder="Write something awesome..." v-model:content="content" content="string" contentType="html"></quill-editor>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import ImageUploader from 'quill-image-uploader';
import Swal from 'sweetalert2';
import imageResize from 'quill-image-resize-module/src/ImageResize';

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
    modelValue: {
        type: String,
        required: '',
    },
    triggerChange : {
        type: Function,
        required: () => {},
    },
    idData: {
        type: Number,
        default: null,
    },
    modelData: {
        type: String,
        default: null,
    },
    folderModel: {
        type: String,
        default: 'EPortal',
    },
});

const content = ref('');

// watch content
watch(
    () => content.value,
    (val) => {
        if (val) {
            props.triggerChange(val);
        }
    }
);
// modelValue
watch(
    () => props.modelValue,
    (val) => {
        content.value = val;
    }
);

onMounted(() => {
    content.value = props.modelValue;
});

const toolBar = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],

  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],

  ['clean'],                                         // remove formatting button
  ['image']
];

const modules = [
    {
        name: 'imageUploader',
        module: ImageUploader,
        options: {
            upload: file => {
                return new Promise((resolve, reject) => {
                // check file if not image
                if (!file.type.match('image.*')) {
                    reject('File is not an image');
                    // toast error
                    toast('error', 'File harus berupa gambar!');
                    return;
                }
                const formData = new FormData();
                formData.append("file", file);
                formData.append("model", props.modelData);
                formData.append("foldermodel", props.folderModel);
                formData.append("idData", props.idData);

                axios.post(route('master.store-image-eportal'), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    console.log(res)
                    resolve(res.data.url);
                })
                .catch(err => {
                    reject("Upload failed");
                    console.error("Error:", err)
                })
            })
            }
        }
    },
    {
        name: 'imageResize',
        module: imageResize,
        options: {
            Resize: true,
            DisplaySize: true,
            Toolbar: true
        }
    }
];
</script>
