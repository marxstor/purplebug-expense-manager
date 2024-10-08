<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from '../shared/components/partials/Sidebar.vue';
import Header from '../shared/components/partials/Header.vue';
import Table from '../components/Dashboard/Table.vue';
import PieChart from '../components/Dashboard/PieChart.vue';

const props = defineProps({
    expenses : Array,
});

</script>

<template>
    <Head title = "- Dashboard" />
    <Sidebar />
    <Header />

    <div class="md:ml-64">
        <main class="px-2 m-5">
            <div class="flex justify-between">
                <h2 class="text-lg font-bold">My Expenses</h2>
                <h2 class="text-lg font-bold">Dashboard</h2>    
            </div>

            <div class="mt-5 grid lg:grid-cols-2 sm:grid-cols-1 gap-10">
                <Table :expenses="expenses" />
                <PieChart :expenses="expenses" />  
            </div>
        </main>
    </div>

    
</template>
