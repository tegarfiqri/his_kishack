<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import CreateButton from '@/Components/CreateButton.vue';
import StoryCard from './Components/StoryCard.vue';
import SelectBox from '@/Components/SelectBox.vue';
import moment from 'moment';
import { Head, router, Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
const props = defineProps({
    data: {
        type: Object,
    },
    categories: {
        type: Object,
    },
    sharedFunction: {
        type: String
    }
});

const search = ref('');
const onlyCategory = ref('');

const checkPermission = (permission) => {
    return usePage().props.permissions.includes(permission);
}
const onSearch = () => {
    search.value = search.value;
    repopulateData();
};
const onCategory = () => {
    repopulateData();
};

const repopulateData = () => {
    router.get('/explore', { search: search.value, onlyCategory: onlyCategory.value }, { preserveState: true });
}
// const permissions = computed(() => usePage().props.permissions)
</script>

<template>

    <Head title="Categories" />
    <AuthenticatedLayout>
        <div>
            <h1>Exlore Articles </h1>
            <div class="flex justify-between">
                <div class="flex gap-4">
                    <TextInput @input="onSearch" v-model="search" type="text" class="my-2" placeholder="Search..."
                        :value="search"></TextInput>
                    <select v-model="onlyCategory" v-on:change="onCategory"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full my-2">
                        <option value="">All Categories</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <CreateButton :route="route('articles.index')" v-if="checkPermission('Create Master Article')">Create
                    Article</CreateButton>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 w-full">
                <div v-for="article in data" :key="article.id" :article="article">
                    <Link :href="checkPermission('Read Master Article') ? route('explore.show', article.id) : '#'">
                    <StoryCard>
                        <div class="flex flex-col flex-1 p-4 h-96">
                            <img :src="'/' + article.image_path" alt="" class="w-full h-40 object-cover">
                            <div class="p-4 flex justify-between">
                                <h2 class="text-xl font-bold">{{ article.name }}</h2>
                                <p>{{ moment(article.created_at).format('DD MMM YYYY') }}</p>
                            </div>
                            <p>{{ article.content.length > 200 ? article.content.substring(0, 200) + '...' :
                                article.content
                                }}</p>
                            <div class="mt-auto">
                                <div class="flex justify-end">
                                    <span
                                        class="bg-gray-200 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{
                                            article.category.name }}</span>
                                </div>
                            </div>
                        </div>
                    </StoryCard>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>