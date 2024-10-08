<script setup>
import { ref } from 'vue';
import RolesModal from './RolesModal.vue';
import UpdateModal from './UpdateModal.vue';

// Define props to receive message and roles data
const props = defineProps({
    message: String,
    roles: Array,
});

// use to show the update modal
const showUpdateModal = ref(false);
const selectedRole = ref(null);

const handleRowClick = (role) => {
    
    if(role.role_name !== 'ADMIN') {
        showUpdateModal.value = true; // Set modal to visible
        selectedRole.value = role;
    } else {
        alert('You cannot update or delete this role.');
    }
}
</script>

<template>
    <RolesModal />
    
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
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through the roles data -->
                        <tr 
                            v-for="role in roles" 
                            :key="role.id" 
                            class="bg-white border-b hover:bg-slate-100 cursor-pointer" 
                            @click="handleRowClick(role)"
                        >
                            <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ role.role_name }}
                            </th>
                            <td class="px-6 py-4">{{ role.description }}</td>
                            <td class="px-6 py-4">{{ new Date(role.created_at).toLocaleDateString() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <UpdateModal :showUpdateModal="showUpdateModal" :selectedRole = "selectedRole" @close="showUpdateModal = false" />

</template>
