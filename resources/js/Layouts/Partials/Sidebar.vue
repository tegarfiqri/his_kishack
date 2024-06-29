<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div :class="[
        'min-h-screen fixed inset-0 z-30 bg-gray-800 text-white transition-transform transform md:relative md:translate-x-0',
        isOpen ? 'translate-x-0 relative' : '-translate-x-full fixed',
        'w-64 flex-none'
    ]">
        <div class="p-4 text-2xl font-bold">CMS Menu</div>
        <nav class="flex-1">
            <ul>
                <li class="hover:bg-gray-700">
                    <Link class="p-4 block" :href="route('users.index')">User</Link>
                </li>
                <li class="hover:bg-gray-700">
                    <Link class="p-4 block" :href="route('roles.index')">Role</Link>
                </li>
            </ul>
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