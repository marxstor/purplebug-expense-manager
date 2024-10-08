<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '../shared/components/partials/Sidebar.vue';
import Header from '../shared/components/partials/Header.vue';
import RolesTable from '../components/Roles/RolesTable.vue';

const props = defineProps({
    message : String,
    roles : Array,
})

</script>

<template>
    <Head title = "- Roles" />
    <Sidebar />
    <Header />

    <div class="md:ml-64">
        <main class="px-2 m-5">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold">Roles</h2>
                <h2 class="text-lg font-bold">User Management > Roles</h2>    
            </div>

            <RolesTable :roles = "roles" :message = "message"/>

        </main>
    </div>
</template>
