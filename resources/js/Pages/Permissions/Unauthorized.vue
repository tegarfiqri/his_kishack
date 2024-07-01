<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

</script>

<template>

    <Head title="Permissions" />
    <AuthenticatedLayout>
        <div class="py-12 flex justify-center">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-center">
                            <FontAwesomeIcon class="text-8xl text-red-500" :icon="['fas', 'exclamation-triangle']" />
                        </div>
                        <div class="text-center">
                            <h1 class="text-4xl font-bold">You are not authorized to access this page</h1>
                            <Link :href="route('explore.index')" class="text-gray-500 hover:text-gray-700">Back
                            Home
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>