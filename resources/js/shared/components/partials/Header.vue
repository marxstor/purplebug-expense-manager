<script setup>
import { router } from '@inertiajs/vue3';
const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <!-- header -->
    <div class="bg-white px-4 py-2 shadow lg:block md:block sm:hidden 2sm:hidden">
        <div class="flex justify-end align-center gap-10">
            <p>Welcome to Expense Manager</p>
            <button @click = "logout" class="text-blue-600 hover:underline">Log out</button>
        </div>
    </div>
</template>