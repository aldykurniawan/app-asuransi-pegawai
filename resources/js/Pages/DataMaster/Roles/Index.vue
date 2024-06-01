<template>
<AuthenticatedLayout>
<loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1"/>

  <div class="col-12 col-lg-8 col-xl-8 d-flex">
    <div class="card radius-10 w-100">
      <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
          <div class="col-12 col-lg-7">
            <button @click="openCreateModal" type="button" class="btn btn-sm btn-primary">
              <i class="bi bi-plus-circle"></i> Tambah
            </button>
          </div>
          <div class="col-12 col-lg-5 text-md-end">
            <form @submit.prevent="search">
              <div class="input-group mb-1">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Pencarian..."
                  aria-label="Pencarian"
                  aria-describedby="pencarian"
                  v-model="keyword"
                />
                <button type="submit" class="btn btn-outline-secondary" id="pencarian">
                  <i class="bx bx-search"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        
        <div class="table-responsive-sm">
          <table class="table table-bordered">
            <thead class="table-active">
              <tr>
                <th width="1%" class="text-center">No</th>
                <th width class>Nama Role</th>
                <th width="10%" class="text-center">#</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(value, index) in dataSource.data" :key="index">
                <td class="text-center">{{ dataSource.current_page * props.perPage - props.perPage + index + 1 }}</td>
                <td class>
                  <b>{{value.name}}</b>
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <a
                      @click="openEditModal(value.id)"
                      class="btn btn-sm btn-outline-dark"
                      data-bs-toggle="tooltip"
                      data-placement="top"
                      title="Edit Data"
                    >
                      <i class="bi bi-pencil"></i>
                    </a>
                    <button
                      @click="destroy(value.id)"
                      class="btn btn-sm btn-outline-danger"
                      data-bs-toggle="tooltip"
                      data-placement="top"
                      title="Hapus Data"
                    >
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <Pagination :links="dataSource.links" />

      </div>
    </div>
  </div>

  <ModalForm
    :modal-title="modalAttr.title"
    :icon="modalAttr.icon"
    :size="modalAttr.size"
    :data-form="form.data()"
    :mode="modalAttr.mode"
    :action-form="modalAttr.actionForm"
    @reset="reset"
    :isOpen="modalOpen"
    @closeModal="closeModal"
  >
    <div class="row">
      <div class="col-md-12">
        <div class="form-group mb-3">
          <label class="mb-2">Nama Role</label>
          <input
            v-model="form.name"
            type="text"
            class="form-control"
            :class="{ 'is-invalid': errors.name }"
            placeholder="....."
          />
          <div v-if="errors.name" class="invalid-feedback">{{ errors.name }}</div>
        </div>
      </div>
    </div>
  </ModalForm>

</AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ModalForm from "@/Components/ModalForm.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { inject, onMounted, reactive, ref } from 'vue';

const isLoading = ref(false);
const swal = inject("$swal");

const props = defineProps({
  dataSource: {
    type: Object,
    default: () => ({}),
  },
  perPage: {
    type: Number,
    default: 1,
  },
  routeName: {
    type: String,
    default: '',
  },
});

onMounted(() => {
  const params = new URLSearchParams(location.search);
  keyword.value = params.get("query");
});

let keyword = ref("");
const search = () => {
  router.get(route(props.routeName+".index", { query: keyword.value }));
};

// Form
const form = useForm({
  redirectRoute: props.routeName+'.index',
  name         : null,
});

// Reset Data
const reset = () => {
  form.reset();
  usePage().props.errors = {};
};

// Modal Data
const closeModal = () => {
  modalOpen.value = false;
};
defineEmits(["closeModal"]);
const modalOpen = ref(false);
const modalAttr = reactive({
  title: "Tambah Data",
  mode: "create",
  icon: "",
  size: "modal-md",
  actionForm: null,
});

// Create Modal
const openCreateModal = () => {
  reset();
  modalAttr.mode = "create";
  modalAttr.icon = "bi bi-plus-circle";
  modalAttr.actionForm = route(props.routeName+".store");
  modalOpen.value = true;
};

// Get Data Edit
const getData = async (id) => {
  isLoading.value = true;
  await axios
    .get(route(props.routeName+".edit", id))
    .then((response) => {
      form.name = response.data.name;
      isLoading.value = false;
    })
    .catch((error) => {
      console.log(error);
      isLoading.value = false;
    });
};

// Edit Modal
const openEditModal = async (id) => {
  reset();
  modalAttr.title = "Edit Data";
  modalAttr.icon = "bi bi-pencil-square";
  modalAttr.actionForm = route(props.routeName+".update", id);
  modalAttr.mode = "edit";
  await getData(id);
  
  modalOpen.value = true;
};

// Delete Alert
const destroy = async (id) => {
  swal({
    title: "Apakah Anda Yakin?",
    text: "Ingin Menghapus Data Ini ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Hapus!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      isLoading.value = true;
      router.delete(route(props.routeName+".destroy", id), {
        onSuccess: (page) => {
          isLoading.value = false;
          swal("Deleted!", "Data Telah Dihapus", "success");
        },
        preserveScroll: true,
      });
    }
  });
};

</script>