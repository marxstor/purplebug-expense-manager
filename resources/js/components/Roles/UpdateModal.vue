<script setup>
import { defineEmits, defineProps, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    showUpdateModal: Boolean,
    selectedRole: Object, 
});

// Emit event to close the modal
const emit = defineEmits(['close']);

// for form values
const form = useForm({
    id : '',
    role_name : '',
    description : '',
})

// Watch for changes in the selectedRole prop and update the form fields
watch(() => props.selectedRole, (newRole) => {
    if (newRole) {
        form.id = newRole.id;
        form.role_name = newRole.role_name;
        form.description = newRole.description;
    }
}, { immediate: true });  // immediate ensures the watch is triggered on mount

// Function to close the modal
const closeModal = () => {
    emit('close'); // Emit 'close' event to the parent
};

// for updating the user role
const submit = () => {
    if(form.role_name !== 'ADMIN') {
        form.put(route('roles.update', form.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        alert('You cannot delete or update the admin role');
    }
    
}

// for deleting the role
const deleteRole = () => {
    if(confirm('All the users that has this role will be deleted? Are you sure you want to delete this role?')) {
        if(form.role_name !== 'ADMIN') {
            form.delete(route('roles.destroy', form.id), {
                onSuccess : () => closeModal(),
            });
        } else {
            alert('You cannot delete or update the this role');
        }
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
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="role_name" class="block mb-2 text-sm font-medium text-gray-900">Role Name</label>
                            <input v-model="form.role_name" type="text" name = "role_name" id="role_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type role name"
                            >
                            <span v-if="form.errors.role_name" class = "text-red-600 text-sm">{{ form.errors.role_name }}</span>

                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Role Description</label>
                            <textarea v-model="form.description" id="description" name = "description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Write role description"
                            ></textarea>
                            <span v-if="form.errors.description" class = "text-red-600 text-sm">{{ form.errors.description }}</span>

                        </div>
                    </div>

                    <div class="flex justify-between gap-2">
                        <button type="button" @click = "deleteRole" :class="form.processing ? 'text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 opacity-50' : 'text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5'">
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
