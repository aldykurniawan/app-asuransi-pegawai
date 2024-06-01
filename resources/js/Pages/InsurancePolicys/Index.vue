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
              <thead class="table-light">
                <tr>
                  <th width="1%" class="text-center">No</th>
                  <th width class>Policy Number</th>
                  <th width class>Policy Type</th>
                  <th width class>Start Date - End Date</th>
                  <th width class>Coverage</th>
                  <th width class>Premium</th>
                  <th width class>Status</th>
                  <th width class>Description</th>
                  <th width="10%" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(value, index) in dataSource.data" :key="index">
                  <td
                    class="text-center"
                  >{{ dataSource.current_page * props.perPage - props.perPage + index + 1 }}</td>
                  <td>{{ value.policy_number }}</td>
                  <td>{{ value.policy_type }}</td>
                  <td>{{ value.start_date }} - {{ value.end_date }}</td>
                  <td>{{ value.coverage_amount }}</td>
                  <td>{{ value.premium_amount }}</td>
                  <td>{{ value.status }}</td>
                  <td>{{ value.description }}</td>

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
            <label class="mb-2">Policy Number</label>
            <input
              v-model="form.policy_number"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.policy_number }"
              placeholder="Policy Number"
            />
            <div v-if="errors.policy_number" class="invalid-feedback">{{ errors.policy_number }}</div>
          </div>
        </div>
        
        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Policy Type</label>
            <input
              v-model="form.policy_type"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.policy_type }"
              placeholder="Policy Type"
            />
            <div v-if="errors.policy_type" class="invalid-feedback">{{ errors.policy_type }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Start Date</label>
            <input
              v-model="form.start_date"
              type="date"
              class="form-control"
              :class="{ 'is-invalid': errors.start_date }"
              placeholder="Start Date"
            />
            <div v-if="errors.start_date" class="invalid-feedback">{{ errors.start_date }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">End Date</label>
            <input
              v-model="form.end_date"
              type="date"
              class="form-control"
              :class="{ 'is-invalid': errors.end_date }"
              placeholder="End Date"
            />
            <div v-if="errors.end_date" class="invalid-feedback">{{ errors.end_date }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Coverage Amount</label>
            <input
              v-model="form.coverage_amount"
              type="number"
              class="form-control"
              :class="{ 'is-invalid': errors.coverage_amount }"
              placeholder="Coverage Amount"
            />
            <div v-if="errors.coverage_amount" class="invalid-feedback">{{ errors.coverage_amount }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Premium Amount</label>
            <input
              v-model="form.premium_amount"
              type="number"
              class="form-control"
              :class="{ 'is-invalid': errors.premium_amount }"
              placeholder="Premium Amount"
            />
            <div v-if="errors.premium_amount" class="invalid-feedback">{{ errors.premium_amount }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Status</label>
            <v-select
              v-model="form.status"
              :options="['active', 'inactive']"
              :class="{ 'is-invalid': errors.status, 'capitalize': true }"
              placeholder="Select Status"
            ></v-select>
            <div v-if="errors.status" class="invalid-feedback">{{ errors.status }}</div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3 form-group">
            <label class="mb-2">Description</label>
            <textarea
              v-model="form.description"
              class="form-control"
              :class="{ 'is-invalid': errors.description }"
              rows="3"
              placeholder="Description"
            ></textarea>
            <div v-if="errors.description" class="invalid-feedback">{{ errors.description }}</div>
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
  policy_number: null,
  policy_type: null,
  start_date: null,
  end_date: null,
  coverage_amount: null,
  premium_amount: null,
  status: 'active',
  description: null,
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
      form.policy_number = response.data.policy_number;
      form.policy_type = response.data.policy_type;
      form.start_date = response.data.start_date;
      form.end_date = response.data.end_date;
      form.coverage_amount = response.data.coverage_amount;
      form.premium_amount = response.data.premium_amount;
      form.status = response.data.status;
      form.description = response.data.description;

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
  const a = await getData(id);

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
