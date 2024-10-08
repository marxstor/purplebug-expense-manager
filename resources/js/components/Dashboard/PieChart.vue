<script setup>
import { ref, onMounted } from 'vue';
import { Chart } from 'chart.js/auto';


const props = defineProps({
    expenses : Array,
});

const categoryList = [];
const categoryTotal = [];

for(const expense of props.expenses) {
    categoryList.push(expense.category_name)
    categoryTotal.push(expense.total)
}

const pieChart = ref(null);

onMounted(() => {
    new Chart(pieChart.value, {
        type: 'pie',
        data: {
            labels: categoryList,
            datasets: [{
            data: categoryTotal,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
            }]
        }
    });

});
</script>

<template>
    <div class="charts">
        <!-- Charts -->
        <div class="center bg-white py-4 px-6 rounded-md lg:w-96 md:w-96 sm:w-full h-auto">        
            <p class="font-bold text-xl text-slate-600 mb-2">Expenses Chart</p>
            <hr/>
            <!-- bar chart -->
            <canvas ref="pieChart"></canvas>
        </div>
    </div>
</template>