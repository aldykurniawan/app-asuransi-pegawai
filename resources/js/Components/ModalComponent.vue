<style scoped>
    .modal__frame {
        height: 100vh;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
    }

    @media screen and (max-width: 768px) {
        .modal__frame {
            height: 100vh;
            width: 100%;
        }
    }

    .modal__container {
        background-color: #fff;
        border-radius: 8px;
    }

    @media screen and (max-width: 768px) {
        .modal__container {
            width: 100% !important;
            height: 100% !important;
        }
    }

    .modal-md {
        width: 50%;
        height: 70%;
    }

    .modal-sm {
        width: 35%;
        height: 65%;
    }

    .modal-lg {
        width: 70%;
        height: 80%;
    }

    .modal-full {
        width: 100%;
        height: 100%;
    }

    .modal__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    .modal__title {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .modal__close {
        background-color: transparent;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 1.5rem;
        color: #333;
    }

    .modal__body {
        padding: 20px;
        height: 85%;
        overflow-y: auto;
    }

    .modal__body::-webkit-scrollbar {
        width: 5px;
    }

    .modal__body::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .modal__body::-webkit-scrollbar-thumb {
        background: #888;
    }

    .modal__body::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<template>
  <div class="modal__frame" v-show="modal">
    <div :class="`modal__container modal-${modalType}`">
      <div class="modal__header">
        <h3 class="modal__title">
          <slot name="title"></slot>
        </h3>
        <button class="modal__close" @click="closeModalComponent">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal__body">
        <slot name="body"></slot>
      </div>
    </div>
  </div>
</template>
<script setup>
import { watch, onMounted, onUnmounted, defineProps } from "vue";

// props
const props = defineProps({
  // modal
  modal: {
    type: Boolean,
    default: false,
  },
  actionClose: {
    type: Function,
    default: () => {},
  },
  // modal type md,sm,lg,full
  modalType: {
    type: String,
    default: "md",
  },
});

// watch when props.modal change
watch(
  () => props.modal,
  (val) => {
    if (val) {
      // remove scroll on body
      document.body.style.overflow = "hidden";
    } else {
      // add scroll on body
      document.body.style.overflow = "auto";
    }
  }
);

const closeModalComponent = () => {
  props.actionClose();
  // add scroll on body
  document.body.style.overflow = "auto";
};
onMounted(() => {
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      closeModalComponent();
    }
  });
  if (props.modal) {
    // remove scroll on body
    document.body.style.overflow = "hidden";
  }
});

// on unmounted
onUnmounted(() => {
  // add scroll on body
  document.body.style.overflow = "auto";
});

// defineExpose
defineExpose({
  closeModalComponent,
});
</script>
