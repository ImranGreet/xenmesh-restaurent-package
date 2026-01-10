<template>
    <div class="card">
        <DataTable :value="customers" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
            tableStyle="min-width: 50rem">
            <Column field="name" header="Name" style="width: 25%" />
            <Column field="country" header="Country" style="width: 25%" />
            <Column field="company" header="Company" style="width: 25%" />
            <Column field="representative" header="Representative" style="width: 25%" />
        </DataTable>
    </div>
</template>

<script setup>
import { Column, DataTable } from 'primevue';
import { ref } from 'vue';


const customers = ref([
    {
        name: 'Imran Hossain',
        country: 'Bangladesh',
        company: 'YetFix',
        representative: 'Rahim'
    },
    {
        name: 'John Doe',
        country: 'USA',
        company: 'TechNova',
        representative: 'Sarah'
    },
    {
        name: 'Ali Khan',
        country: 'Pakistan',
        company: 'Foodies Ltd',
        representative: 'Ahmed'
    },
    {
        name: 'Maria Lopez',
        country: 'Spain',
        company: 'Cafe Mundo',
        representative: 'Carlos'
    },
    {
        name: 'Chen Wei',
        country: 'China',
        company: 'Dragon Foods',
        representative: 'Li Ming'
    },
    {
        name: 'Ahmed Noor',
        country: 'UAE',
        company: 'Desert Bites',
        representative: 'Khalid'
    }
]);
</script>
