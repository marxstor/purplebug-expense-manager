<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '../shared/components/partials/Sidebar.vue';
import Header from '../shared/components/partials/Header.vue';
import ProfileInfo from '../components/Profile/ProfileInfo.vue';
import ResetPassword from '../components/Profile/ResetPassword.vue';

const props = defineProps({
    user : Object,
    message : String,
});

// console.log(props.user);



</script>

<template>
    <Head title = "- Profile" />
    <Sidebar />
    <Header />

    <div class="md:ml-64">
        <main class="px-2 m-5">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold">Settings</h2>
            </div>

            <div v-if = "message" class="bg-green-100 border border-green-400 text-slate-700 px-4 py-3 rounded relative mt-4" role="alert">
                <span class="block sm:inline">{{ message }}</span>
            </div>

            <ProfileInfo :user = "user" />
            <ResetPassword :user = "user"/>
        </main>
    </div>

</template> 
