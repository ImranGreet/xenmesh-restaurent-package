<script setup lang="ts">
import ExpenseChart from '../components/Dashboard/chart/ExpenseChart.vue';
import IncomeExpense from '../components/Dashboard/chart/IncomeExpense.vue';

</script>

<template>
    <section class="w-full flex flex-row items-start gap-20">
        <div class="w-3/4 h-100">
            <IncomeExpense />
        </div>
        <div class="flex-1 h-100 flex justify-start">
            <ExpenseChart />
        </div>
    </section>
</template>