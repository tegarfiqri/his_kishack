<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import CreateButton from '@/Components/CreateButton.vue';
import { Head, router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
defineProps({
    data: {
        type: Object,
    }
});

const search = ref('');

const onSearch = () => {
    router.get('/users', { search: search.value }, { preserveState: true });
    search.value = search.value;
};

</script>

<template>

    <Head title="Users" />
    <AuthenticatedLayout>
        <div>
            <h1>User</h1>
            <div class="flex justify-between">
                <TextInput @input="onSearch" v-model="search" type="text" class="my-2" placeholder="Search..."
                    :value="search"></TextInput>

                <CreateButton :route="route('users.create')" />
            </div>

            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-800 text-white text-left text-sm uppercase font-semibold">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th> * </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 hover:bg-gray-100" v-for="item in data" :key="item.id">
                        <td class="p-4">{{ item.id }}</td>
                        <td class="p-4">{{ item.name }}</td>
                        <td class="p-4">{{ item.email }}</td>
                        <td class="p-4">
                            <Link class="mr-2 bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :href="route('users.edit', item.id)">Edit</Link>
                            <Link class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :href="route('users.destroy', item.id)">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>