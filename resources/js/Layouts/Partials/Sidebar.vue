<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div :class="[
        'min-h-screen inset-0 z-30 bg-gray-800 text-white transition-transform transform ',
        isOpen ? 'lg:relative lg:translate-x-0' : '-translate-x-full fixed',
        'w-64 flex-none'
    ]">
        <div class="p-4 text-2xl text-blue-500 font-bold">Kishack</div>
        <div class="py-4">
            <ul>
                <li class="hover:bg-gray-700">
                    <Link class="p-4 block" :href="route('explore.index')">Explore Now</Link>
                </li>
            </ul>
        </div>
        <nav class="flex-1">
            <ul>
                <li class="hover:bg-gray-700">
                    <Link class="p-4 block" :href="route('users.index')">User</Link>
                </li>
                <li class="hover:bg-gray-700">
                    <Link class="p-4 block" :href="route('roles.index')">Role</Link>
                </li>
                <li class="hover:bg-gray-700">
                    <Link class="p-4 block" :href="route('permissions.index')">Permission</Link>
                </li>
            </ul>

            <div class="pt-4">
                <h2 class="font-bold text-xl ms-4">Master Data</h2>
                <ul>
                    <li class="hover:bg-gray-700">
                        <Link class="p-4 block" :href="route('categories.index')">Category</Link>
                    </li>
                    <li class="hover:bg-gray-700">
                        <Link class="p-4 block" :href="route('articles.index')">Article</Link>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'Sidebar',
    props: {
        isOpen: {
            type: Boolean,
            required: true
        }
    }
}
</script>