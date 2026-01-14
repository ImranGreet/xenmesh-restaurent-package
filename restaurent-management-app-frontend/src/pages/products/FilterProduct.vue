<template>


    <div class="w-full flex flex-col gap-4 px-4 py-4">
        <!-- category -->
        <div>
            <label for="product-name" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <div class="card flex justify-center">
                <Select v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Select a City"
                    class="w-full" />
            </div>
        </div>
        <!-- category -->
        <div>
            <label for="product-name" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <div class="card flex justify-center">
                <Select v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Select a City"
                    class="w-full" />
            </div>
        </div>
        <div class="w-full flex flex-col md:flex-row gap-4">
            <!-- Min Price -->
            <div class="w-full">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <InputNumber inputId="integeronly" fluid />

            </div>
            <!-- max Price -->
            <div class="w-full">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <InputNumber inputId="integeronly" fluid />

            </div>
        </div>

        <!-- category -->
        <div>
            <label for="product-name" class="block text-sm font-medium text-gray-700 mb-2">Stock</label>
            <div class="card flex justify-center">
                <Select v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Select a City"
                    class="w-full" />
            </div>
        </div>
    </div>

</template>

<script lang="ts" setup>
import { Select, InputNumber } from 'primevue';

import { ref } from 'vue';


const selectedCity = ref();
const cities = ref([
    { name: 'New York', code: 'NY' },
    { name: 'Rome', code: 'RM' },
    { name: 'London', code: 'LDN' },
    { name: 'Istanbul', code: 'IST' },
    { name: 'Paris', code: 'PRS' }
]);
</script>