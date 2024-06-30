<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, router, usePage, Link } from '@inertiajs/vue3';

const props = defineProps({
    data: {
        type: Object,
    },
});

const form = useForm({
    name: props.data.name,
    slug: props.data.slug,
});
</script>

<template>

    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Categories</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" readonly
                                autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div>
                            <InputLabel for="slug" value="Slug" />

                            <TextInput id="slug" type="text" class="mt-1 block w-full" v-model="form.slug" readonly
                                autofocus autocomplete="slug" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="flex items-center justify-end mt-4">

                            <Link :href="route('categories.index')"
                                class="text-base bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-gray-600">
                            Back</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
