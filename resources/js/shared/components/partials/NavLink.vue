<script setup>
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    routerName: String,
});
</script>

<template>

    <Link :href="route(routerName)" class="flex items-center p-2 text-slate-100 rounded-lg hover:bg-purple-500 group">
        <span class="ms-3">
            <slot/>
        </span>
    </Link>
</template>