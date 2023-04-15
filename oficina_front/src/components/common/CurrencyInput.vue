<template>
    <input class="w-full p-2 mt-2 border border-gray-300 rounded outline-none focus:bg-gray-50"
            ref="inputRef"
           type="text"
    />
</template>

<script setup>
import  {useCurrencyInput} from 'vue-currency-input';
const props = defineProps(['modelValue', 'options']);
// const inputRef = ref(null);
const  {inputRef } = useCurrencyInput(props.options)

</script>
