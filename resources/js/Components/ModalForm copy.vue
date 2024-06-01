<template>
  <div
    class="modal fade"
    :class="{ show: isOpen }"
    :id="idModal ? idModal : 'create'"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex
    aria-labelledby="createLabel"
    aria-hidden="true"
    :style="[isOpen ? { display: 'block' } : { display: 'none' }]"
  >
    <div :class="['modal-dialog', size]">
      <div class="modal-content">
        <form @submit.prevent="mode == 'create' ? store() : update()" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">
              <i :class="[icon]"></i>
              {{ modalTitle }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" @click="closeModal"></button>
          </div>

          <!-- isi modal -->
          <div class="modal-body p-4">
            <slot />
          </div>

           <!-- footer modal -->
          <div class="modal-footer mb-1">
            <!-- button store -->
            <button
              v-if="mode == 'create'"
              :disabled="isLoading"
              type="submit"
              class="btn btn-primary"
            >
              <span v-if="isLoading">
                <i class="fas fa-circle-notch fa-spin"></i> Mohon Tunggu..
              </span>
              <span v-else>
                <div v-if="hasSlot('buttonLabel')">
                  <slot name="buttonLabel"></slot>
                </div>
                <div v-else>
                  <i class="bi bi-save"></i> Simpan
                </div>
              </span>
            </button>

            <!-- button update -->
            <button
              v-if="mode == 'edit'"
              :disabled="isLoading"
              type="submit"
              class="btn"
              :class="[btnColor]"
            >

              <span v-if="isLoading">
                <i class="fas fa-circle-notch fa-spin"></i> Mohon Tunggu..
              </span>
              <span v-else>
                <div v-if="hasSlot('buttonLabel')">
                  <slot name="buttonLabel"></slot>
                </div>
                <div v-else>
                  <i class="bi bi-save"></i> Update

                </div>
              </span>
            </button>

            <div v-if="mode== 'detail'">
              <slot name="customButton"></slot>
            </div>
            <!-- button close -->
            <button
              type="button"
              class="btn btn-outline-secondary"
              data-bs-dismiss="modal"
              @click="closeModal"
            >Batal</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import { computed, reactive, ref, useSlots, watch } from "vue";

const props = defineProps({
  errors: {
    type: Object,
    default: () => ({}),
  },
  dataForm: {
    type: Object,
    default: () => ({}),
  },
  modalTitle: {
    type: String,
    default: "",
  },
  icon: {
    type: String,
    default: "",
  },
  mode: {
    type: String,
    default: "",
  },
  actionForm: {
    type: String,
    default: "",
  },
  size: {
    type: String,
    default: "",
  },
  upload: {
    type: Boolean,
    default: false,
  },
  isOpen: {
    type: Boolean,
    default: false,
  },
  idModal: {
    type: String,
    default: "",
  },
  btnColor: {
    type: String,
    default: "btn-primary",
  },
});

const slots = useSlots();
const hasSlot = (name) => {
  return slots[name] !== undefined;
};

const isLoading = ref(false);
const openModal = ref(false);

const form = reactive({});

const emit = defineEmits(["closeModal", "reset"]);

const dataForm_ = computed(() => props.dataForm);
const isOpen_ = computed(() => props.isOpen);

watch(dataForm_, () => {
  Object.assign(form, props.dataForm);
});

watch(isOpen_, () => {
  if (props.isOpen) {
    $("body").addClass("modal-open");
    $("body").append(
      '<div id="backdrop" class="modal-backdrop fade show"></div>'
    );
  } else {
    $("body").removeClass("modal-open");
    $("#backdrop").remove();
    // console.log("test");
  }
});

const store = () => {
  isLoading.value = true;

  router.post(props.actionForm, form, {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      closeModal();
      // reset();
      emit("reset");

      isLoading.value = false;
      openModal.value = false;
    },
    onError: (errors) => {
      isLoading.value = false;
    },
  });
};

const closeModal = () => {
  // props.isOpen = false;
  emit("closeModal");
  $("body").removeClass("modal-open");
  $("#backdrop").remove();
};

const update = async () => {
  isLoading.value = true;
  if (props.upload == true) {
    // let form = Object.assign(form, { _method: "put" });
    router.post(props.actionForm, Object.assign(form, { _method: "put" }), {
      preserveScroll: true,
      onSuccess: () => {
        closeModal();
        emit("reset");
        isLoading.value = false;
      },
      onError: (errors) => {
        isLoading.value = false;
      },
    });
  } else {
    // let form = Object.assign(form, { _method: "put" });
    router.put(props.actionForm, form, {
      preserveScroll: true,
      onSuccess: () => {
        closeModal();
        emit("reset");
        isLoading.value = false;
      },
      onError: (errors) => {
        isLoading.value = false;
      },
    });
  }
};
</script>
