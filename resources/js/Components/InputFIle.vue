<script setup>
import { ref } from 'vue';

const model = defineModel({
    type: Object,
    required: true,
});

const input = ref(null);

</script>

<template>
    <input type="file" @input="model = $event.target.files[0]" ref="input"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
</template>
