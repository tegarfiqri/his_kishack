<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    route: String
});
</script>

<template>
    <Link :href="route" class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add User
    </Link>
</template>