<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import { Head, useForm, router, usePage } from '@inertiajs/vue3';

const props = defineProps({
    data: {
        type: Object,
    },
    permissionsList: {
        type: Object,
    },
    rolePermissions: {
        type: Object,
    }
});

const form = useForm({
    name: props.data.name,
    permissions: ref([]),
    _method: 'PUT',
});


props.rolePermissions.forEach((permission) => {
    form.permissions.push(permission.permission_id);
})

const submit = () => {
    router.post(route('roles.update', props.data.id), form, {
    });
};
</script>

<template>

    <Head title="Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Roles</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div>
                            <InputLabel for="permissions" value="Permissions" />
                            <div v-for="permission in permissionsList">
                                <input type="checkbox" :id="permission.id" :value="permission.id"
                                    v-model="form.permissions"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 me-2 my-2" />
                                <label :for="permission.id">{{ permission.name }}</label>
                            </div>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="flex items-center justify-end mt-4">

                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Update
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
