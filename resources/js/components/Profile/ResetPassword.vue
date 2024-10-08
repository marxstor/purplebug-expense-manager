<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    user : Object,
});

const error = ref(null);

const form = useForm({
    id : props.user.id,
    password : null,
    confirm_password : null,
});

const submit = () => {
    error.value = null;
    if(form.password !== form.confirm_password) {
        error.value = "Password do not match"
        return;
    }

    form.put(route('profile.reset_password', form.id), {
        onSuccess : () => {
            form.password = null;
            form.confirm_password = null;
        }
    });
}

// console.log(props.user);

</script>

<template> 
    <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow mt-5 ">
        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Reset Password</h5>
        <form class="space-y-6 mt-5" @submit.prevent = "submit">
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="••••••••" required v-model="form.password"/>
            </div>
            <div>
                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="••••••••" required v-model="form.confirm_password" />
                <div v-if="error !== null" class="text-red-500 mt-2">{{ error }}</div>
            </div>
            <button type="submit" :class="form.processing ? 'text-white bg-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center opacity-50' : 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center'" :disabled="form.processing">Reset Password</button>

            
        </form>
    </div>

</template>