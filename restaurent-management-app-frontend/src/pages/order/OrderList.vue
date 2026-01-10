<template>
    <div class="card">
        <DataTable :value="products" size="small">
            <Column v-for="col in columns" :key="col.field" :field="col.field" :header="col.header" />
            
        </DataTable>
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";

const columns = [
    { field: "name", header: "Product" },
    { field: "price", header: "Price (৳)" },
];

const products = [
    {
        name: "Corn",
        quantity: "15 Ton",
        price: "40,000",
        location: "Daudkandi",
    },
    {
        name: "Rice",
        quantity: "10 Ton",
        price: "55,000",
        location: "Homna",
    },
    {
        name: "Wheat",
        quantity: "8 Ton",
        price: "38,000",
        location: "Titas",
    },
];
</script>
