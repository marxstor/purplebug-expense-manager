<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    roles : Array,
});

// Reactive state for modal visibility
const showModal = ref(false);
function toggleModal() {
    showModal.value = !showModal.value;
}

const form = useForm({
    name : null,
    email : null,
    user_role : '',
    password : null,
});

const submit = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            toggleModal(); // close the modal after successfull submission of form
            form.reset(); // reset the form fields
        }
    });
}

</script>

<template>
    <button @click="toggleModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Add new user
    </button>

    <!-- Main modal -->
    <div v-if="showModal" id="crud-modal" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create new user
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
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter name of the user" required v-model="form.name">
                            <span v-if="form.errors.role_name" class = "text-red-600 text-sm">{{ form.errors.role_name }}</span>
                        </div>
                        
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="abc@example.com" required v-model="form.email">
                            <span v-if="form.errors.email" class = "text-red-600 text-sm">{{ form.errors.email }}</span>
                        </div>
                        
                        <div class="col-span-2 w-full">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">User Role</label>
                            <select id="category" name = "user_role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" v-model="form.user_role">
                                <option disabled value = "">Select role</option>
                                <option v-for="role in props.roles" :key="role.id" :value="role.id">{{ role.role_name }}</option>

                                <!-- <option value="ADMIN">Administrator</option>
                                <option value="USER">User</option> -->
                            </select>
                            <span v-if="form.errors.user_role" class = "text-red-600 text-sm">{{ form.errors.user_role }}</span>

                        </div>

                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="••••••••" required v-model="form.password">
                            <span v-if="form.errors.role_name">{{ form.errors.password }}</span>
                        </div>
                        
                    </div>
                    <button type="submit" :class="form.processing ? 'flex text-white bg-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center opacity-50' : ' flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center'" :disabled="form.processing">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add new user
                    </button>
                </form>
            </div>
        </div>
    </div>

</template>
