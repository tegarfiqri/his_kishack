<script setup>
import { ref } from 'vue';
import Header from './Partials/Header.vue';
import Sidebar from './Partials/Sidebar.vue';

</script>

<script>
export default {
    name: 'AuthLayout',
    components: {
        Sidebar,
        Header
    },
    data() {
        return {
            isSidebarOpen: false
        }
    },
    methods: {
        toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen
        }
    }
}
</script>
<template>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />

        <!-- Header and Main Content -->
        <div class="flex-1 flex-shrink flex-col">
            <!-- Header -->
            <Header @toggle-sidebar="toggleSidebar" />
            <header class="bg-white dark:bg-gray-100 shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
            <!-- Main Content -->
            <main class="flex-1 p-4">
                <slot />
                <!-- Add your main content here -->
            </main>
        </div>
    </div>
</template>
