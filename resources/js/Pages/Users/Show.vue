<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectBox from '@/Components/SelectBox.vue';
import InputFIle from '@/Components/InputFIle.vue';
import { Head, useForm, router, usePage, Link } from '@inertiajs/vue3';

const props = defineProps({
    data: {
        type: Object,
    },
    roles: {
        type: Object,
    }
});

const form = useForm({
    name: props.data.name,
    email: props.data.email,
    password: '',
    password_confirmation: '',
    role_id: props.data.role_id,
    image: props.data.image_path,
    _method: 'put',
});
</script>

<template>

    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" disabled
                                autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />

                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" disabled
                                autocomplete="username" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="role_id" value="Role" />

                            <SelectBox id="role_id" class="mt-1 block w-full" v-model="form.role_id" :options="roles"
                                disabled>
                            </SelectBox>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="image" value="Image" />

                            <img :src="'/' + form.image" :alt="data.name" class="w-32 h-32 object-cover rounded" />
                        </div>
                        <div class="flex items-center justify-end mt-4">

                            <Link :href="route('users.index')"
                                class="text-base bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-gray-600">
                            Back </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
