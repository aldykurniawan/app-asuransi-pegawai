<template>
  <AuthenticatedLayout>
    <loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1" />

    <div class="col-12 col-lg-12 d-flex mx-auto">
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
                  <th width class>Nama</th>
                  <th width class="text-center">Username</th>
                  <th width="16%" class="text-center">Role</th>
                  <th width="10%" class="text-center">#</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(value, index) in dataSource.data" :key="index">
                  <td
                    class="text-center"
                  >{{ dataSource.current_page * props.perPage - props.perPage + index + 1 }}</td>
                  <td style="vertical-align:middle">
                    <b>{{ value.name }}</b>
                    <p class="text-muted mb-0">{{ value.email }}</p>
                    <p class="text-muted mb-0">
                      <i class="bx bx-phone"></i> {{ value.hp }}
                    </p>
                  </td>
                  <td class="text-center" style="vertical-align:middle">
                    <b>{{ value.username }}</b>
                  </td>
                  <td style="vertical-align:middle" class="text-center">
                    <div class="d-flex flex-wrap gap-1 justify-content-center" style="max-width:200px;">
                      <span v-for="(item, i) in value.roles" :key="i" class="badge badge-flat bg-dark">
                        <i class="bx bx-flag"></i> {{ item.name }}
                      </span>
                    </div>
                  </td>

                  <td style="vertical-align:middle" class="text-center">
                    <div class="btn-group">

                      <button
                        @click="openEditModal(value.id)"
                        class="btn btn-sm btn-warning"
                        data-bs-toggle="tooltip"
                        data-placement="top"
                        title="Edit Data"
                      >
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button
                        @click="destroy(value.id)"
                        class="btn btn-sm btn-danger"
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

    <!-- Modal FIle -->
    <ModalPreview :urlFile="urlFile" />
    <!-- end Modal File -->

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
      :upload="true"
    >
      <div class="row">
        <div class="form-group mb-2">
          <label class="mb-1">Role User</label>
          <v-select
            v-model="form.role"
            multiple
            :options="dataRole"
            :reduce="(item) => item.id"
            label="name"
            :class="{ 'is-invalid rounded-3 border border-danger': errors.role }"
            placeholder="Pilih"
            :closeOnSelect="false"
          />
          <div v-if="errors.role" class="invalid-feedback">{{ errors.role }}</div>
        </div>



        <div class="col-md-12">
          <div class="form-group mb-3">
            <label class="mb-2">Nama</label>
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

        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="mb-2">Email</label>
            <input
              v-model="form.email"
              type="email"
              class="form-control"
              :class="{ 'is-invalid': errors.email }"
              placeholder="....."
            />
            <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="mb-2">No Handphone</label>
            <input
              v-model="form.hp"
              type="hp"
              class="form-control"
              :class="{ 'is-invalid': errors.hp }"
              placeholder="Nomor Handphone..."
            />
            <div v-if="errors.hp" class="invalid-feedback">{{ errors.hp }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group mb-3">
            <label class="mb-2">Username</label>
            <input
              v-model="form.username"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.username }"
              placeholder="....."
            />
            <div v-if="errors.username" class="invalid-feedback">{{ errors.username }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group mb-3">
            <label class="mb-2">Password</label>
            <input
              v-model="form.password"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.password }"
              placeholder="....."
            />
            <div v-if="errors.password" class="invalid-feedback">{{ errors.password }}</div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group mb-3">
            <label class="mb-2">Konfirmasi Password</label>
            <input
              v-model="form.password_confirmation"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.password }"
              placeholder="....."
            />
            <div v-if="errors.password" class="invalid-feedback">{{ errors.password }}</div>
          </div>
        </div>
      </div>
    </ModalForm>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ModalPreview from "@/Components/ModalPreview.vue";
import ModalForm from "@/Components/ModalForm.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { computed, inject, onMounted, reactive, ref, watch } from "vue";

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
    default: "",
  },
  dataRole: {
    type: Object,
    default: () => ({}),
  },

});

onMounted(() => {
  const params = new URLSearchParams(location.search);
  keyword.value = params.get("query");
});

let keyword = ref("");
const search = () => {
  router.get(route(props.routeName + ".index", { query: keyword.value }));
};

// Form
const form = useForm({
  redirectRoute: props.routeName + ".index",
  role: [],
  permission: [],
  name: null,
  email: null,
  hp: null,
  username: null,
  password: null,
  password_confirmation: null,
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
  modalAttr.actionForm = route(props.routeName + ".store");
  modalOpen.value = true;
};

// Get Data Edit
const getData = async (id) => {
  isLoading.value = true;
  await axios
    .get(route(props.routeName + ".edit", id))
    .then((response) => {
      // isi form
      form.role = response.data.roles.map((item) => item.id);
      form.permission = response.data.permissions.map((item) => item.id);
      form.name = response.data.name;
      form.username = response.data.username;
      form.email = response.data.email;
      form.hp = response.data.hp;

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
  modalAttr.actionForm = route(props.routeName + ".update", id);
  modalAttr.mode = "edit";
  await getData(id);

  modalOpen.value = true;
};

// Modal Preview
const urlFile = ref(null);
const previewFile = () => {
  urlFile.value = "/text.pdf";
  $("#modal-preview").modal("show");
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
      router.delete(route(props.routeName + ".destroy", id), {
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
