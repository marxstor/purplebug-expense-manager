<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// Reactive state for modal visibility
const showModal = ref(false);

function toggleModal() {
    showModal.value = !showModal.value;
}

const form = useForm({
    role_name : null,
    description : null,
});

const submit = () => {
    form.post(route('roles.store'), {
        onSuccess: () => {
            toggleModal(); // close the modal after successfull submission of form
            form.reset(); // reset the form fields
        }
    });
}

</script>

<template>
    <button @click="toggleModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Add new role
    </button>

    <!-- Main modal -->
    <div v-if="showModal" id="crud-modal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create New Role
                    </h3>
                    <button type="button" @click="toggleModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" @submit.prevent="submit">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Role Name</label>
                            <input type="text" name="role_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type role name" required v-model="form.role_name">
                            <span v-if="form.errors.role_name" class = "text-red-600 text-sm">{{ form.errors.role_name }}</span>
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Role Description</label>
                            <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write role description" v-model = "form.description"></textarea>        
                            <span v-if="form.errors.role_name" class = "text-red-600 text-sm">{{ form.errors.description }}</span>            
                        </div>
                    </div>
                    <button type="submit" :class="form.processing ? 'flex text-white bg-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center opacity-50' : ' flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center'" :disabled="form.processing">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add new role
                    </button>
                </form>
            </div>
        </div>
    </div>

</template>
