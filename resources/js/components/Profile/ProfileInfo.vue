<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    user : Object,
});

const form = useForm({
    id : props.user.id,
    name : props.user.name,
    email : props.user.email,
    role : props.user.role.role_name,
});

const submit = () => {
    form.put(route('profile.update', form.id));
}

// console.log(props.user);

</script>

<template> 
    <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow mt-5 ">
        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Profile Information</h5>
        <form class="space-y-6 mt-5" @submit.prevent = "submit">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter your full name" required v-model="form.name"/>
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter your email" required v-model="form.email" />
            </div>
            <div>
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                <input type="text" name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter your full name" readonly v-model="form.role" />
            </div>
            <button type="submit" :class="form.processing ? 'text-white bg-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center opacity-50' : 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center'" :disabled="form.processing">Update Information</button>
        </form>
    </div>

</template>