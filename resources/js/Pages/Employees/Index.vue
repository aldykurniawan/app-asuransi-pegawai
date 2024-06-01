<template>
  <AuthenticatedLayout>
    <loading-overlay :active="isLoading" :is-full-page="true" loader="bars" color="#2E86C1" />

    <div class="mx-auto col-12 col-lg-12 d-flex">
      <div class="card radius-10 w-100">
        <div class="bg-transparent card-header">
          <div class="row g-3 align-items-center">
            <div class="col-12 col-lg-7">
              <button @click="() => openCreateModal()" type="button" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah
              </button>
            </div>
            <div class="col-12 col-lg-5 text-md-end">
              <form @submit.prevent="search">
                <div class="mb-1 input-group">
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
                  <th width class>Name</th>
                  <th width class>Email</th>
                  <th width class>Phone</th>
                  <th width class>Address</th>
                  <th width="10%" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(value, index) in dataSource.data" :key="index">
                  <td
                    class="text-center"
                  >{{ dataSource.current_page * props.perPage - props.perPage + index + 1 }}</td>
                  <td>{{ value.name }}</td>
                  <td>{{ value.email }}</td>
                  <td>{{ value.phone }}</td>
                  <td>{{ value.address }}</td>
                  
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
      :key="reGenerate"
    >
      <div class="row">

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Name</label>
            <input
              v-model="form.name"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.name }"
              placeholder="Name"
            />
            <div v-if="errors.name" class="invalid-feedback">{{ errors.name }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Email</label>
            <input
              v-model="form.email"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.email }"
              placeholder="Email"
            />
            <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Phone</label>
            <input
              v-model="form.phone"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.phone }"
              placeholder="Phone"
            />
            <div v-if="errors.phone" class="invalid-feedback">{{ errors.phone }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Address</label>
            <textarea
              v-model="form.address"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.address }"
              placeholder="Address"
            ></textarea>
            <div v-if="errors.address" class="invalid-feedback">{{ errors.address }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Insurance Policy</label>
            <v-select
              v-model="form.insurance_policies_id"
              :options="props.dataInsurance"
              :reduce="(item) => item.id"
              label="policy_number"
              :class="{ 'is-invalid': errors.insurance_policies_id, 'capitalize': true }"
              placeholder="Select Insurance Policy"
            ></v-select>
            <div v-if="errors.status" class="invalid-feedback">{{ errors.status }}</div>
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
const reGenerate = ref(Math.random().toString(36).substring(2, 15));
const generateRandomString = () => {
    return Math.random().toString(36).substring(2, 15);
}

const props = defineProps({
  dataSource: {
    type: Object,
    default: () => ({}),
  },
  dataInsurance: {
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
  name: null,
  email: null,
  phone: null,
  address: null,
  insurance_policies_id: null,
});

// Reset Data
const reset = () => {
  form.reset();
  usePage().props.errors = {};
};

// Modal Data
const closeModal = () => {
    modalOpen.value = false;
    reGenerate.value = generateRandomString();
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
    modalAttr.title = "Buat Data";
    modalAttr.icon = "bi bi-plus-circle";
    modalAttr.actionForm = route(props.routeName + ".store");
    modalAttr.mode = "create";
    modalOpen.value = true;
};

// Get Data Edit
const getData = async (id) => {
  isLoading.value = true;
  await axios
    .get(route(props.routeName + ".edit", id))
    .then((response) => {
      // isi form
      form.name = response.data.name;
      form.email = response.data.email;
      form.phone = response.data.phone;
      form.address = response.data.address;
      form.insurance_policies_id = response.data.insurance_policies_id;

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
