<template>
  <input
    ref="inputRef"
    type="text"
    class="form-control"
    placeholder="0"
  />
</template>

<script>
import { useCurrencyInput } from 'vue-currency-input'
import { watch } from 'vue'


export default {
  name: 'InputMoney',
  props: {
    modelValue: Number, // Vue 2: value
    options: Object
  },
  
  setup(props) {
    const { inputRef, setOptions, setValue } = useCurrencyInput(props.options)

    watch(
      () => props.modelValue, // Vue 2: props.value
      (value) => {
        setValue(value)
      }
    )

    watch(
      () => props.options,
      (options) => {
        setOptions(options)
      }
    )

    return { inputRef }
  }
}
</script>