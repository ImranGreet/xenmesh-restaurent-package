<template>
    <form class="w-full flex flex-col gap-4">
        <!-- Image Upload -->
        <div class="w-full flex flex-col gap-4 border border-gray-400/35 px-3 py-2 rounded-lg">
            <label for="description" class="block text-sm font-medium text-gray-700">Upload
                File</label>

            <div class="card w-full flex justify-center">
                <FileUpload mode="basic" name="demo[]" url="/api/upload" accept="image/*" :maxFileSize="1000000"
                    @upload="" :auto="true" chooseLabel="Browse" class="w-full" />
            </div>
        </div>

        <!-- Product Name -->
        <div class="w-full flex justify-between items-center border border-gray-300 rounded-md px-3 py-1 ">
            <div class="flex flex-col gap-2">
                <label for="product-name" class="block w-full text-sm font-medium text-gray-700">Product
                    Status</label>
                <span>Enable show or hide products</span>
            </div>
            <div class="card flex justify-center">
                <ToggleSwitch v-model="checked" />
            </div>
        </div>

        <div class="w-full flex flex-col  md:flex-row gap-5">
            <!-- Product Name -->
            <div class="w-full">
                <label for="product-name" class="block text-sm font-medium text-gray-700 mb-2">Product
                    Name</label>
                <InputText type="text" id="product-name" name="product-name" placeholder="Enter product name"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <!-- category -->
            <div class="w-full">
                <label for="product-name" class="block text-sm font-medium text-gray-700 mb-2">Input
                    Sku</label>
                <div class="card flex justify-center">
                    <Select v-model="selectedUnit" :options="restaurantUnits" optionLabel="name"
                        placeholder="Select a Unit" class="w-full" />
                </div>
            </div>
        </div>


        <!-- Price -->
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <InputNumber inputId="integeronly" fluid />

        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <Textarea v-model="value" rows="2" cols="10" class="w-full border border-gray-400/35 rounded-md" />
        </div>
        <!-- category -->
        <div>
            <label for="product-name" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <div class="card flex justify-center">
                <Select v-model="selectedCategory" :options="productCategories" optionLabel="slug"
                    placeholder="Select a Category" class="w-full" />
            </div>
        </div>
    </form>

</template>

<script lang="ts" setup>
import { InputText, FileUpload, Select, InputNumber, Textarea, ToggleSwitch } from 'primevue';

import useProductStore from '../../../store/products';

const productsStore = useProductStore();
const { retrieveProductCategories,  } = productsStore;
const { productCategories } = storeToRefs(productsStore);


import { onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';

const value = ref('');

const checked = ref(false);

const selectedUnit = ref();
interface Unit {
    id: number;
    name: string;
}

const restaurantUnits: Unit[] = [
    { id: 1, name: "pcs" },
    { id: 2, name: "kg" },
    { id: 3, name: "g" },
    { id: 4, name: "ltr" },
    { id: 5, name: "ml" },
    { id: 6, name: "dozen" },
    { id: 7, name: "packet" },
    { id: 8, name: "box" },
    { id: 9, name: "cup" },
    { id: 10, name: "slice" }
];

const selectedCategory = ref();

onMounted(() => {
    retrieveProductCategories();
})
</script>