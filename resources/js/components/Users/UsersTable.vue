<script setup>
import { ref } from 'vue';
import AddNewUserModal from './AddNewUserModal.vue';
import UsersUpdateModal from './UsersUpdateModal.vue';

// Define props to receive message and roles data
const props = defineProps({
    message: String,
    roles: Array,
    users : Array,
});

// use to show the update modal
const showUpdateModal = ref(false);
const selectedUser = ref(null);

const handleRowClick = (user) => {
    if(user.role.role_name !== 'ADMIN') {
        showUpdateModal.value = true; // Set modal to visible
        selectedUser.value = user;
    } else {
        alert('You cannot update or delete this role.');
    }
}

</script>

<template>
    <AddNewUserModal :roles = "roles"/>
    
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
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through the roles data -->
                        <tr 
                            v-for="user in users" 
                            :key="user.id" 
                            class="bg-white border-b hover:bg-slate-100 cursor-pointer" 
                            @click="handleRowClick(user)"
                        >
                            <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ user.name }}
                            </th>
                            <td class="px-6 py-4">{{ user.email }}</td>
                            <td class="px-6 py-4">{{ user.role.role_name }}</td>
                            <td class="px-6 py-4">{{ new Date(user.created_at).toLocaleDateString() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <UsersUpdateModal :showUpdateModal="showUpdateModal" :selectedUser = "selectedUser" :roles = "roles" @close="showUpdateModal = false" />

</template>
