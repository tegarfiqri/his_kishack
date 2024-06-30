<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import SelectBox from '@/Components/SelectBox.vue';
import InputFIle from '@/Components/InputFIle.vue';
import { Head, useForm, router, usePage, Link } from '@inertiajs/vue3';

const props = defineProps({
    data: {
        type: Object,
    },
    categories: {
        type: Object,
    },
});

const form = useForm({
    name: props.data.name,
    category_id: props.data.category_id,
    content: props.data.content,
    image: props.data.image_path,
    _method: 'PUT',
});

</script>

<template>

    <Head title="Articles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Show Articles</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Title" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" disabled
                                autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div>
                            <InputLabel for="content" value="Content" />

                            <Textarea id="content" class="mt-1 block w-full" v-model="form.content" disabled />

                            <InputError class="mt-2" :message="form.errors.content" />
                        </div>
                        <div>
                            <InputLabel for="category_id" value="Category" />

                            <SelectBox v-model="form.category_id" :options="categories" name="category_id" disabled />

                            <InputError class="mt-2" :message="form.errors.category" />
                        </div>

                        <div>
                            <img class="w-60 h-60" :src="'/' + form.image" alt="image">
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <Link :href="route('articles.index')"
                                class="text-base bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-gray-600">
                            Back </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
