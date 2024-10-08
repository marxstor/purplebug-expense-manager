<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import CreateCategoryModal from './CreateCategoryModal.vue';
import UpdateCategoryModal from './UpdateCategoryModal.vue';

// Define props to receive message and roles data
const props = defineProps({
    message: String,
    categories : Array,
});

// for accessing the authenticated user
const page = usePage();
const user = computed( () => page.props.auth.user);


// use to show the update modal
const showUpdateModal = ref(false);
const selectedCategory = ref(null);

const handleRowClick = (category) => {
    showUpdateModal.value = true; // for modal visibility
    selectedCategory.value = category;
}

</script>

<template>
    <div v-if="user.role == 'ADMIN'">
        <CreateCategoryModal />
    </div>
    
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
                            <th scope="col" class="px-6 py-3">Category Name</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if = "categories == ''" class="bg-white border-b">
                            <td class="px-6 py-4 text-center" colspan="3">
                                No available categories yet
                            </td>
                        </tr>
                        <!-- Loop through the roles data -->
                        <tr 
                            v-for="category in categories" 
                            :key="category.id" 
                            class="bg-white border-b hover:bg-slate-100 cursor-pointer" 
                            @click="handleRowClick(category)"
                        >
                            <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ category.category_name }}
                            </th>
                            <td class="px-6 py-4">{{ category.description }}</td>
                            <td class="px-6 py-4">{{ new Date(category.created_at).toLocaleDateString() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div v-if="user.role == 'ADMIN'">
        <UpdateCategoryModal :showUpdateModal="showUpdateModal" :selectedCategory = "selectedCategory" @close="showUpdateModal = false" />
    </div>

</template>
