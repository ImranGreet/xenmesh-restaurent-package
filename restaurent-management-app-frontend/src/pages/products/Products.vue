<template>
    <section>
        <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center">
            <h1 class="px-3 pt-2 text-2xl font-semibold">Products</h1>
            <div class="flex flex-col md:flex-row gap-2 px-2 md:px-0">
                <div class="flex flex-col gap-2">
                    <InputText name="username" type="text" placeholder="Search Products" />
                </div>
                <div class="flex gap-2">
                    <Button type="button">
                        <svg class="w-5 h-5 ">
                            <use href="#short-icon" />
                        </svg>
                        <span>Short</span>
                    </Button>
                    <Button type="button" @click="visible = true">
                        <svg class="w-5 h-5 ">
                            <use href="#filter-icon" />
                        </svg>
                        <span>Filter</span>
                    </Button>
                    <Button type="button" @click="visibleProductInfo = true">
                        <svg class="w-5 h-5 ">
                            <use href="#plus-icon" />
                        </svg>
                        <span>Add New Product</span>
                    </Button>

                </div>

            </div>
        </div>
        <div class="card">
            <DataTable tableStyle="min-width: 50rem" :value="products" paginator :rows="meta.per_page" scrollable
                scrollHeight="700px" :rowsPerPageOptions="[5, 10, 20, 50, 100]" :totalRecords="meta.total" lazy
                @page="onPageChange">

                <Column field="id" header="Id" />
                <Column field="name_bn" header="Name" />
                <Column field="name_en" header="Name" />
                <Column field="category" header="Category" />
                <Column field="stock" header="Stock" />
                <Column field="status" header="Status">
                    <template #body="slotProps">
                        <Badge severity="success" v-if="slotProps.data.status === 1">Active</Badge>
                        <Badge severity="danger" v-if="slotProps.data.status === 0">Inactive</Badge>
                    </template>
                </Column>

                <!-- Action Column -->
                <Column header="Action" class="flex justify-end">
                    <template #body="slotProps">
                        <div class="flex gap-0.5 justify-end">
                            <Button type="button" label="edit" class="action-btn">
                                <svg class="w-5 h-5 ">
                                    <use href="#pencil-icon-edit" />
                                </svg>
                            </Button>
                            <Button type="button" class="action-btn delete">
                                <svg class="w-5 h-5 ">
                                    <use href="#trash-icon" />
                                </svg>
                            </Button>
                            <Button type="button" severity="danger" class="action-btn lock"
                                @click="toggleProductStatus(slotProps.data.id)">
                                <svg class="w-5 h-5 " v-if="slotProps.data.status === 0">
                                    <use href="#lock-icon" />
                                </svg>

                                <svg class="w-5 h-5 " v-else>
                                    <use href="#confirm-tick" />
                                </svg>

                            </Button>

                        </div>
                    </template>
                </Column>

            </DataTable>


            <Dialog v-model:visible="visible" modal header="Filter" :style="{ width: '45rem' }">
                <FilterProduct />
                <div class="flex justify-end gap-2">
                    <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                    <Button type="button" label="Save" @click="visible = false"></Button>
                </div>
            </Dialog>
        </div>

        <Dialog v-model:visible="visibleProductInfo" modal header="Add New Product" :style="{ width: '45rem' }">
            <!-- Slide Drawer Form -->
            <div class=" bg-white  z-50">
                <div class="p-6">
                    <!-- Header -->
                    <h2 class="text-2xl font-semibold mb-4">Product Information</h2>

                    <!-- Form -->
                    <form class="space-y-4">

                        <div class="w-full" v-if="productInformation.showBasicInfo">
                            <div class="w-full flex flex-col gap-4">
                                <!-- Image Upload -->
                                <div class="w-full flex flex-col gap-4 border border-gray-400/35 px-3 py-2 rounded-lg">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Upload
                                        File</label>

                                    <div class="card w-full flex justify-center">
                                        <FileUpload mode="basic" name="demo[]" url="/api/upload" accept="image/*"
                                            :maxFileSize="1000000" @upload="" :auto="true" chooseLabel="Browse"
                                             />
                                    </div>
                                </div>

                                <!-- Product Name -->
                                <div
                                    class="w-full flex justify-between items-center border border-gray-300 rounded-md px-3 py-1 ">
                                    <div class="flex flex-col gap-2">
                                        <label for="product-name"
                                            class="block w-full text-sm font-medium text-gray-700">Product
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
                                        <label for="product-name"
                                            class="block text-sm font-medium text-gray-700 mb-2">Product
                                            Name</label>
                                        <InputText type="text" v-model="productName" id="product-name"
                                            name="product-name" placeholder="Enter product name"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                    </div>
                                    <!-- category -->
                                    <div class="w-full">
                                        <label for="product-name"
                                            class="block text-sm font-medium text-gray-700 mb-2">Input
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
                                    <InputNumber v-model="productPrice" inputId="integeronly" fluid />

                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <Textarea v-model="productDetails" rows="2" cols="10"
                                        class="w-full border border-gray-400/35 rounded-md" />
                                </div>
                                <!-- category -->
                                <div>
                                    <label for="product-name"
                                        class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <div class="card flex justify-center">
                                        <Select v-model="selectedCategory" :options="productCategories"
                                            optionLabel="slug" placeholder="Select a Category" class="w-full" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full" v-if="productInformation.showPricingInfo">
                            <div class="w-full flex flex-col gap-4">

                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                    <InputNumber inputId="integeronly" fluid />
                                </div>
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700">Takeway
                                        Price</label>
                                    <InputNumber inputId="integeronly" fluid />
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="pt-4 w-full flex justify-end gap-5">
                <Button type="submit" class="w-auto">
                    Submit
                </Button>
                <Button type="submit" severity="danger" class="w-auto">
                    Reset
                </Button>
                <Button class="w-auto" @click="visibleProductInfo = false">
                    Cancel
                </Button>
                <Button class="w-auto border border-gray-400/30" @click="addNext" severity="secondary">
                    Next
                </Button>
            </div>
        </Dialog>
    </section>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Button, Column, DataTable, Dialog, InputText, FileUpload, Select, InputNumber, Textarea, ToggleSwitch, Badge } from 'primevue';
import useProductStore from '../../store/products';
import { storeToRefs } from 'pinia';

import FilterProduct from './FilterProduct.vue';

const visible = ref(false);

const visibleProductInfo = ref(false);
const productsStore = useProductStore();
const { retrieveProducts, toggleProductStatus, retrieveProductCategories, createProduct } = productsStore;
const { products, meta, productCategories } = storeToRefs(productsStore);


const productInformation = ref({
    showBasicInfo: true,
    showPricingInfo: false,
    showVariantInfo: false,
});



const addNext = function () {
    productInformation.value.showBasicInfo = !productInformation.value.showBasicInfo;
    productInformation.value.showPricingInfo = !productInformation.value.showPricingInfo;
}

const selectedUnit = ref();
interface Unit {
    id: number;
    name: string;
}


const value = ref('');

const checked = ref(false);

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

onMounted(async () => {
    await retrieveProducts();
    await retrieveProductCategories();
});

const onPageChange = (event) => {
    retrieveProducts(event.page + 1);
};

let productName = ref("");
let categoryId = ref<number>();
let productPrice = ref<number>();
let productStock = ref<number>();
let productDetails = ref<string>("");

let payload = {
    name: productName.value,
    category_id: categoryId,
    price: productPrice.value,
    stock: productStock.value,
    description: productDetails.value
}

let productSubmit = async function () {
    await createProduct(payload);
}
</script>


<style scoped>
.p-button.action-btn {
    background-color: white;
    border: none;
    color: oklch(21% 0.034 264.665);
}

.p-button:not(:disabled).action-btn:hover {
    background-color: oklch(76.337% 0.00314 264.728);
    border: none;
    color: oklch(21% 0.034 264.665);
}

.p-button.action-btn.delete {
    color: rgb(247, 178, 178);
}

button .p-paginator-page.p-paginator-page-selected {
    background-color: rgb(34, 30, 30) !important;
}

.p-fileupload.p-fileupload-basic.p-component {
    width: 100%;
}
</style>