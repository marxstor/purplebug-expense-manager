<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    showUpdateModal: Boolean,
    selectedExpense: Object, 
    expense_categories: Object, 
});

// for debugging purposes
// console.log(props.selectedExpense);

// Emit event to close the modal
const emit = defineEmits(['close']);

const form = useForm({
    expense_id : '',
    amount : '',
    entry_date : '',
    expense_category_id : '',
})

// Watch for changes in the selectedRole prop and update the form fields
watch(() => props.selectedExpense, (newExpense) => {
    if (newExpense) {
        form.expense_id = newExpense.id;
        form.expense_category_id = newExpense.expense_category.id;
        form.amount = newExpense.amount;
        form.entry_date = newExpense.entry_date;
    }
}, { immediate: true });  // immediate ensures the watch is triggered on mount

// Function to close the modal
const closeModal = () => {
    emit('close'); // Emit 'close' event to the parent
};

const submit = () => {
    form.put(route('expenses.update', form.expense_id), {
        onSuccess: () => closeModal(),
    });
    // console.log(form);
}

const deleteExpense = () => {
    if(confirm('Are you sure you want to delete this role?')) {
        form.delete(route('expenses.destroy', form.expense_id), {
            onSuccess : () => closeModal(),
        })
    }
}

</script>

<template>
    <!-- Modal visibility controlled by 'showUpdateModal' prop -->
    <div v-if="showUpdateModal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Update Role
                    </h3>
                </div>

                <!-- Modal body -->
                <form class="p-4 md:p-5" @submit.prevent = "submit">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 w-full">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Expense Type</label>
                            <select id="category" name = "expense_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" v-model="form.expense_category_id">
                                <option disabled value = "">Select type</option>
                                <option v-for="expense in expense_categories" :key="expense.id" :value="expense.id">{{ expense.category_name}}</option>
                                
                            </select>
                            <span v-if="form.errors.expense_id" class = "text-red-600 text-sm">{{ form.errors.expense_id }}</span>
                        </div>

                        <div class="col-span-2">
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Amount</label>
                            <input type="text" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter the expense amount" required v-model="form.amount">
                            <span v-if="form.errors.amount" class = "text-red-600 text-sm">{{ form.errors.amount }}</span>
                        </div>
                        
                        <div class="col-span-2">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Entry Date</label>
                            <input type="date" name="entry_date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required v-model="form.entry_date">
                            <span v-if="form.errors.entry_date" class = "text-red-600 text-sm">{{ form.errors.entry_date }}</span>
                        </div>

                    </div>

                    <div class="flex justify-between gap-2">
                        <button type="button" @click = "deleteExpense" :class="form.processing ? 'text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 opacity-50' : 'text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5'">
                            Delete
                        </button>
                        <div class="group">
                            <button type="button" :class="form.processing ? 'text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 opacity-50 mr-2' : 'border-solid border border-blue-400 hover:bg-blue-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2'" @click="closeModal">
                                Cancel
                            </button>
                            <button type="submit" :class="form.processing ? 'text-white bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 opacity-50': 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5'" @click="updateRole">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
