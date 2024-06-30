<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import moment from 'moment';
import { Head, useForm, router, usePage } from '@inertiajs/vue3';

const props = defineProps({
    story: {
        type: Object,
    },
});

</script>

<template>

    <Head title="Article" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Article</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="flex flex-col">
                        <img :src="'/' + story.image_path" alt="" class="h-80 object-cover">
                        <div class="flex justify-between mt-2">
                            <h1 class="text-2xl font-bold">{{ story.name }}</h1>
                            <p>{{ moment(story.created_at).format('DD MMM YYYY') }}</p>
                        </div>
                        <p>{{ story.content }}</p>
                        <div class="flex justify-end">
                            <span
                                class="bg-gray-200 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{
                                    story.category.name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
