<script setup>

const props = defineProps({
    expenses : Array,
});

</script>
<template>
        <div class="table">
            <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-base text-gray-700 uppercase bg-white border-b-2">
                <tr>
                    <th scope="col" class="px-6 py-3">
                    Expense Categories
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Total
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-if = "expenses == ''" class="bg-white border-b">
                    <td class="px-6 py-4 text-center" colspan="2">
                        No available expenses yet
                    </td>
                </tr>
                <tr v-else class="bg-white border-b" v-for = "expense in expenses">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                    {{ expense.category_name }}
                    </th>
                    <td class="px-6 py-4">
                        ${{ expense.total }}
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
</template> 