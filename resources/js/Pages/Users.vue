<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '../shared/components/partials/Sidebar.vue';
import Header from '../shared/components/partials/Header.vue';
import UsersTable from '../components/Users/UsersTable.vue';

const props = defineProps({
    roles: Array,
    users: Array,
    message: String,
});


</script>

<template>
    <Head title = "- Roles" />
    <Sidebar />
    <Header />

    <div class="md:ml-64">
        <main class="px-2 m-5">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold">Users</h2>
                <h2 class="text-lg font-bold">User Management > Users</h2>    
            </div>

            <UsersTable :roles = "roles" :users = "users" :message = "message"/>

        </main>
    </div>
</template>
