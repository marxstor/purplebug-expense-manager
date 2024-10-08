<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '../shared/components/partials/Sidebar.vue';
import Header from '../shared/components/partials/Header.vue';
import CategoryTable from '../components/ExpenseCategory/CategoryTable.vue';

const props = defineProps({
    categories: Array,
    message: String,
});


</script>

<template>
    <Head title = "- Expense Category" />
    <Sidebar />
    <Header />

    <div class="md:ml-64">
        <main class="px-2 m-5">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold">Expense Category</h2>
                <h2 class="text-lg font-bold">Expense Management > Expense Category</h2>    
            </div>

            <CategoryTable :categories = "categories" :message = "message" />
        </main>
    </div>
</template>
