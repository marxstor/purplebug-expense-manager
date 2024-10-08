<script setup>
import { useForm, Head } from '@inertiajs/vue3';

const props = defineProps({
    errors: Object,
});

const form = useForm({
    email: null,
    password: null,
});

const submit = () => {
    form.post(route('auth.login'));
}
</script>

<template>
    <Head title = "- Login" />
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="mb-6 text-2xl font-semibold text-gray-900">
                <!-- <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo"> -->
                <h1 class="font-bold">Expense Management</h1>    
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="name@company.com" required="" v-model = "form.email">
                        </div>

                        <div>
                            <label for="password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="" v-model="form.password">
                            <div v-if="props.errors.password" class="text-red-500 text-sm mt-1">{{ props.errors.password }}</div>
                            <div v-if="props.errors.email" class="text-red-500 text-sm mt-2 mb-2">{{ props.errors.email }}</div>

                        </div>

                        <button type="submit" :class="form.processing ? 'w-full text-white bg-gray-500 opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center' : 'w-full text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center'" :disabled="form.processing">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
      </section>
</template>