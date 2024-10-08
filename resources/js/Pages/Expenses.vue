<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '../shared/components/partials/Sidebar.vue';
import Header from '../shared/components/partials/Header.vue';
import ExpensesTable from '../components/Expenses/ExpensesTable.vue';

const props = defineProps({
    expenses: Array,
    message: String,
    expense_categories: Array,
});


</script>

<template>
    <Head title = "- Expenses" />
    <Sidebar />
    <Header />

    <div class="md:ml-64">
        <main class="px-2 m-5">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold">Expenses</h2>
                <h2 class="text-lg font-bold">Expense Management > Expenses</h2>    
            </div>

            <ExpensesTable :expense_categories="expense_categories" :expenses = "expenses" :message = "message" />
        </main>
    </div>
</template>
