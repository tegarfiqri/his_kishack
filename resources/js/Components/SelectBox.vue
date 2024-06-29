<script setup>
import { ref } from 'vue';
defineProps({
    options: {
        type: Object,
    }
});
const model = defineModel({
    type: Number,
    required: true,
})
const input = ref(null);
</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        ref="input" v-model="model">
        <option v-if="options" v-for="option in options" :value="option.id">{{ option.name }}</option>
        <option v-else value="">No options</option>
    </select>
</template>