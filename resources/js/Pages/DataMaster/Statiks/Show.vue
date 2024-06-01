<style>
    .cap {
        text-transform: capitalize;
    }
</style>
<template>
  <AuthenticatedLayout>
    <loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1" />

    <div class="col-12 col-lg-12 d-flex mx-auto">
      <div class="card radius-10 w-100">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center w-100">
            <h5 class="cap">{{ detailData.title }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form @submit.prevent="submitData" enctype="multipart/form-data">
                        <template v-if="detailData.content">
                            <div class="row" v-for="content in Object.keys(detailData.content)" :key="content">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="mb-2 cap">{{ changeToSpace(content) }}</label>
                                        <text-editor v-if="detailData.content[content].type === 'texteditor'" :modelValue="detailData.content[content].content" :triggerChange="(val) => onChangeState(content, val)" :idData="detailData.id" modelData="statik" folderModel="DataMaster"  />
                                        <textarea v-else class="form-control" :name="content" :id="content" :rows="10" :cols="30" v-model="detailData.content[content].content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div class="d-flex justify-content-end align-items-center">
                            <button
                            :disabled="isLoading"
                            type="submit"
                            class="btn btn-sm btn-success"
                            >
                                <span v-if="isLoading">
                                    <i class="fas fa-circle-notch fa-spin"></i> Mohon Tunggu..
                                </span>
                                <span v-else>
                                    Update
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import axios from "axios";
import Swal from "sweetalert2";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { computed, inject, onMounted, reactive, ref, watch } from "vue";
import TextEditor from '../../../Components/TextEditor.vue';

const isLoading = ref(true);

// change _ / - to space
const changeToSpace = (str) => {
    return str.replace(/_/g, " ").replace(/-/g, " ");
};

const url = window.location.origin;

const detailData = ref({
    title: '-',
    content: null
});

const props = defineProps({
  perPage: {
    type: Number,
    default: 1,
  },
  routeName: {
    type: String,
    default: "",
  },
});

// onChangeState to detailData.content
const onChangeState = (key, value) => {
    detailData.value.content[key].content = value;
};

onMounted(() => {
    getData();
});
// Get Data Edit
const getData = async () => {
  isLoading.value = true;
  await axios
    .get(`${url}/app/data-master/statikegap-data`)
    .then((response) => {
        detailData.value = response.data;
        isLoading.value = false;
    })
    .catch((error) => {
      console.log(error);
      isLoading.value = false;
    });
};
const submitData = async () => {
    try {
        isLoading.value = true;
        await axios
            .post(`${url}/app/data-master/statikapp-store`, {
                content: detailData.value.content
            }, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then(() => {
                Swal.fire({
                    title: "Berhasil!",
                    text: "Data berhasil diupdate!",
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#2E86C1",
                });
                getData();
            })
            .catch((error) => {
                console.log(error);
                isLoading.value = false;
            });
    } catch (error) {
        console.log(error);
    }
};
</script>
