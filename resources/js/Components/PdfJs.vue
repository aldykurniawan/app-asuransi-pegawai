<template>
  <div>
    <iframe height="100%" width="100%" :src="`${getFilePath}?timestamp=${Date.now()}`"></iframe>
  </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  fileName: {
    type: String,
    default: () => null,
  },
  path: {
    type: String,
    default: () => null,
  },
});

const getFilePath = computed(() => {

  // return '/text.pdf'
  if (props.fileName !== "") {
    return props.path + "?file=" + props.fileName;
  }
  return props.path;
  
});

</script>
<style scoped>
div {
  width: 100%;
  height: 70vh;
}
</style>