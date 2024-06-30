<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import CreateButton from '@/Components/CreateButton.vue';
import PaginationButton from '@/Components/PaginationButton.vue';
import { Head, router, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
const props = defineProps({
    data: {
        type: Object,
    },
    page: {
        type: Number
    }
});

const search = ref('');
const sortBy = ref('');
const sortDesc = ref(true);
const pageNumber = ref(1);

const onSortChange = () => {
    sortDesc.value = !sortDesc.value;
    if (sortBy.value) {
        // router.get('/users', { sortBy: sortBy.value, sortDesc: sortDesc.value }, { preserveState: true });
        repopulateData();
    }
};

const checkPermission = (permission) => {
    return usePage().props.permissions.includes(permission);
}

const onPageChange = (number) => {
    if (number < 1 || number > props.page) return;
    pageNumber.value = number;
    console.log(props.page);
    repopulateData();
}

const onSearch = () => {
    // router.get('/users', { search: search.value }, { preserveState: true });
    search.value = search.value;
    repopulateData();
};

const repopulateData = () => {
    router.get('/users', { sortBy: sortBy.value, sortDesc: sortDesc.value, search: search.value, page: pageNumber.value }, { preserveState: true });
}

const onDelete = (item) => {
    if (confirm('Are you sure you want to delete this user?')) {
        router.delete(route('users.destroy', item.id), { preserveScroll: true, onFinish: () => repopulateData() });
    }
}


</script>

<template>

    <Head title="Users" />
    <AuthenticatedLayout>
        <div>
            <h1>User</h1>
            <div class="flex justify-between">
                <TextInput @input="onSearch" v-model="search" type="text" class="my-2" placeholder="Search..."
                    :value="search"></TextInput>

                <CreateButton v-if="checkPermission('Create Users')" :route="route('users.create')">Add User
                </CreateButton>
            </div>

            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-800 text-white text-left text-sm uppercase font-semibold">
                        <th v-on:click=" sortBy = 'id'; onSortChange();" class="p-4"> <font-awesome-icon
                                :icon="['fas', 'arrows-up-down']" :class="sortBy === 'id' ? 'text-blue-500' : ''" />ID
                        </th>
                        <th v-on:click=" sortBy = 'name'; onSortChange();" class="p-4"> <font-awesome-icon
                                :icon="['fas', 'arrows-up-down']"
                                :class="sortBy === 'name' ? 'text-blue-500' : ''" />Name</th>
                        <th v-on:click=" sortBy = 'email'; onSortChange();" class="p-4"> <font-awesome-icon
                                :icon="['fas', 'arrows-up-down']"
                                :class="sortBy === 'email' ? 'text-blue-500' : ''" />Email</th>
                        <th> * </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 hover:bg-gray-100" v-for="item in data" :key="item.id">
                        <td class="p-4">{{ item.id }}</td>
                        <td class="p-4">{{ item.name }}</td>
                        <td class="p-4">{{ item.email }}</td>
                        <td class="p-4">
                            <Link v-if="checkPermission('Read Users')"
                                class="mr-2 bg-purple-400 hover:bg-purple-400 text-white font-bold py-2 px-4 rounded"
                                :href="route('users.show', item.id)">View</Link>
                            <button v-else disabled
                                class="mr-2 bg-yellow-100 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <Link v-if="checkPermission('Update Users')"
                                class="mr-2 bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :href="route('users.edit', item.id)">Edit</Link>
                            <button v-else disabled
                                class="mr-2 bg-yellow-100 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button v-if="checkPermission('Delete Users')" @click="onDelete(item)"
                                class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Delete
                            </button>
                            <button v-else disabled
                                class="mr-2 bg-red-100 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                </tbody>
                <div class="flex justify-start">
                    <PaginationButton class="m-1" v-on:click="onPageChange(pageNumber - 1)">
                        <FontAwesomeIcon icon="fa-solid fa-angle-left">
                        </FontAwesomeIcon>
                    </PaginationButton>
                    <PaginationButton v-for="n in page" v-on:click="onPageChange(n)" class="m-1 ">{{ n
                        }}
                    </PaginationButton>
                    <PaginationButton class="m-1" v-on:click="onPageChange(pageNumber + 1)">
                        <FontAwesomeIcon icon="fa-solid fa-angle-right text-blue-500"></FontAwesomeIcon>
                    </PaginationButton>
                </div>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>