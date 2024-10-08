<script setup>
import { defineEmits, defineProps, ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    showUpdateModal: Boolean,
    selectedCategory: Object, 
});

// Emit event to close the modal
const emit = defineEmits(['close']);

const form = useForm({
    id : '',
    category_name : '',
    description : '',
})

// Watch for changes in the selectedRole prop and update the form fields
watch(() => props.selectedCategory, (newCategory) => {
    if (newCategory) {
        form.id = newCategory.id;
        form.category_name = newCategory.category_name;
        form.description = newCategory.description;
    }
}, { immediate: true });  // immediate ensures the watch is triggered on mount

// Function to close the modal
const closeModal = () => {
    emit('close'); // Emit 'close' event to the parent
};

const submit = () => {
    form.put(route('expense_categories.update', form.id), {
        onSuccess: () => closeModal(),
    });
}

const deleteCategory = () => {
    if(confirm('Are you sure you want to delete this role?')) {
        form.delete(route('expense_categories.destroy', form.id), {
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
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Category Name</label>
                            <input type="text" name="category_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type role name" required v-model="form.category_name">
                            <span v-if="form.errors.category_name" class = "text-red-600 text-sm">{{ form.errors.category_name }}</span>
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write category description" v-model = "form.description"></textarea>        
                            <span v-if="form.errors.description" class = "text-red-600 text-sm">{{ form.errors.description }}</span>            
                        </div>
                    </div>

                    <div class="flex justify-between gap-2">
                        <button type="button" @click = "deleteCategory" :class="form.processing ? 'text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 opacity-50' : 'text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5'">
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
