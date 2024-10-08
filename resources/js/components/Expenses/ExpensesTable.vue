<script setup>
import { ref } from 'vue';
import CreateExpensesModal from './CreateExpensesModal.vue';
import UpdateExpensesModal from './UpdateExpensesModal.vue';

// Define props to receive message and roles data
const props = defineProps({
    message: String,
    expenses : Array,
    expense_categories : Array,
});

// console.log(props.expense_categories);

// use to show the update modal
const showUpdateModal = ref(false);
const selectedExpense = ref(null);

const handleRowClick = (expense) => {
    showUpdateModal.value = true; // Set modal to visible
    selectedExpense.value = expense;
}

</script>

<template>
    <CreateExpensesModal :expense_categories = "expense_categories" />
    
    <!-- Show success message if it exists -->
    <div v-if = "message" class="bg-green-100 border border-green-400 text-slate-700 px-4 py-3 rounded relative mt-4" role="alert">
        <span class="block sm:inline">{{ message }}</span>
    </div>

    <!-- Table to display roles -->
    <div class="mt-5 grid grid-cols-1 gap-10">
        <div class="table">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-base text-gray-700 uppercase bg-white border-b-2">
                        <tr>
                            <th scope="col" class="px-6 py-3">Expense Category</th>
                            <th scope="col" class="px-6 py-3">Amount</th>
                            <th scope="col" class="px-6 py-3">Created By</th>
                            <th scope="col" class="px-6 py-3">Entry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if = "expenses == ''" class="bg-white border-b">
                            <td class="px-6 py-4 text-center" colspan="4">
                                You have no expenses yet
                            </td>
                        </tr>
                        <!-- Loop through the roles data -->
                        <tr 
                            v-for="expense in expenses" 
                            :key="expense.id" 
                            class="bg-white border-b hover:bg-slate-100 cursor-pointer" 
                            @click="handleRowClick(expense)"
                        >
                            <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ expense.expense_category.category_name }}
                            </th>
                            <td class="px-6 py-4">$ {{ expense.amount }}</td>
                            <td class="px-6 py-4">{{ expense.user.name }}</td>
                            <td class="px-6 py-4">{{ expense.entry_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <UpdateExpensesModal :showUpdateModal="showUpdateModal" :selectedExpense = "selectedExpense" :expense_categories = "expense_categories" @close="showUpdateModal = false" />

</template>
