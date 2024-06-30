<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import SelectBox from '@/Components/SelectBox.vue';
import InputFIle from '@/Components/InputFIle.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    categories: {
        type: Object,
    },
});

const form = useForm({
    name: '',
    category_id: '',
    content: '',
    image: '',
});
const submit = () => {
    form.post(route('articles.store'), form, { forceFormData: true, }, {

    });
};
</script>

<template>

    <Head title="Articles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Articles</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Title" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div>
                            <InputLabel for="content" value="Content" />

                            <Textarea id="content" class="mt-1 block w-full" v-model="form.content" required />

                            <InputError class="mt-2" :message="form.errors.content" />
                        </div>
                        <div>
                            <InputLabel for="category_id" value="Category" />

                            <SelectBox v-model="form.category_id" :options="categories" name="category_id" />

                            <InputError class="mt-2" :message="form.errors.category" />
                        </div>

                        <div>
                            <InputLabel for="image" value="Image" />
                            <InputFIle v-model="form.image" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Save
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
