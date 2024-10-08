<script setup>
import { defineEmits, defineProps, ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    showUpdateModal: Boolean,
    selectedUser: Object, 
    roles : Array,
});

// Emit event to close the modal
const emit = defineEmits(['close']);

const form = useForm({
    id : '',
    name : '',
    email : '',
    user_role : '',
})

// Watch for changes in the selectedRole prop and update the form fields
watch(() => props.selectedUser, (newUser) => {
    if (newUser) {
        form.id = newUser.id;
        form.name = newUser.name;
        form.email = newUser.email;
        form.user_role = newUser.role.id;
    }
}, { immediate: true });  // immediate ensures the watch is triggered on mount

// Function to close the modal
const closeModal = () => {
    emit('close'); // Emit 'close' event to the parent
};

// for updating the values of user
const submit = () => {
    form.put(route('users.update', form.id), {
        onSuccess: () => closeModal(), // close the update modal after success
    });
}

// for deleting the user
const deleteUser = () => {
    if(confirm('Are you sure you want to delete this user?')) {
        form.delete(route('users.destroy', form.id), {
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
                        Update user information
                    </h3>
                </div>

                <!-- Modal body -->
                <form class="p-4 md:p-5" @submit.prevent = "submit">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter name of the user" required v-model="form.name">
                            <span v-if="form.errors.role_name">{{ form.errors.role_name }}</span>
                        </div>
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="abc@example.com" required v-model="form.email">
                            <span v-if="form.errors.email">{{ form.errors.email }}</span>
                        </div>
                        
                        <div class="col-span-2 w-full">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">User Role</label>
                            <select id="category" name = "user_role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" v-model="form.user_role" >
                                <option disabled value = "" selected>Select role</option>
                                <!-- loop available roles -->
                                <option v-for="role in props.roles" :key="role.id" :value="role.id">
                                    {{ role.role_name }}
                                </option>
                            </select>
                        </div>
                        
                    </div>

                    <div class="flex justify-between gap-2">
                        <button type="button" @click = "deleteUser" :class="form.processing ? 'text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 opacity-50' : 'text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5'">
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
