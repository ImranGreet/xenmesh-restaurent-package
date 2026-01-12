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
                    <Button type="button" @click="visibleRight = true">
                        <svg class="w-5 h-5 ">
                            <use href="#plus-icon" />
                        </svg>
                        <span>Add New Product</span>
                    </Button>

                </div>

            </div>
        </div>
        <div class="card">
            <DataTable tableStyle="min-width: 50rem" :value="products" paginator :rows="meta.per_page"
                :totalRecords="meta.total" lazy @page="onPageChange">

                <Column field="id" header="Id" />
                <Column field="name_bn" header="Name" />
                <Column field="name_en" header="Name" />
                <Column field="category" header="Category" />
                <Column field="stock" header="Stock" />
                <Column field="status" header="Status" />

                <!-- Action Column -->
                <Column header="Action" style="width: 12rem">
                    <template #body="slotProps">
                        <div class="flex gap-0.5">
                            <Button type="button" label="edit"  class="action-btn">
                                <svg class="w-5 h-5 ">
                                    <use href="#pencil-icon-edit" />
                                </svg>
                            </Button>
                            <Button type="button" label="edit" class="action-btn delete">
                                <svg class="w-5 h-5 ">
                                    <use href="#trash-icon" />
                                </svg>
                            </Button>
                            <Button type="button" label="edit" class="action-btn lock">
                                <svg class="w-5 h-5 ">
                                    <use href="#lock-icon" />
                                </svg>
                            </Button>
                            <Button type="button" class="tick">
                                <svg class="w-5 h-5 ">
                                    <use href="#confirm-tick" />
                                </svg>
                            </Button>
                        </div>
                    </template>
                </Column>

            </DataTable>


            <Dialog v-model:visible="visible" modal header="Edit Profile" :style="{ width: '25rem' }">
                <span class="text-surface-500 dark:text-surface-400 block mb-8">Update your information.</span>
                <div class="flex items-center gap-4 mb-4">
                    <label for="username" class="font-semibold w-24">Username</label>
                    <InputText id="username" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="email" class="font-semibold w-24">Email</label>
                    <InputText id="email" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex justify-end gap-2">
                    <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                    <Button type="button" label="Save" @click="visible = false"></Button>
                </div>
            </Dialog>
        </div>

        <Drawer v-model:visible="visibleRight" header="Right Drawer" position="right">
            <!-- Slide Drawer Form -->
            <div class="fixed top-0 right-0 h-full w-96 bg-white shadow-lg overflow-y-auto z-50">
                <div class="p-6">
                    <!-- Header -->
                    <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>

                    <!-- Form -->
                    <form class="space-y-4">

                        <!-- Product Name -->
                        <div>
                            <label for="product-name" class="block text-sm font-medium text-gray-700">Product
                                Name</label>
                            <InputText type="text" id="product-name" name="product-name"
                                placeholder="Enter product name"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                        <!-- category -->
                        <div class="card flex justify-center">
                            <Select v-model="selectedCity" :options="cities" optionLabel="name"
                                placeholder="Select a City" class="w-full" />
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <InputNumber v-model="value1" inputId="integeronly" fluid />

                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <Textarea v-model="value" rows="5" cols="30" class="w-full border border-gray-400/35 rounded-md" />
                        </div>

                        <!-- Image Upload -->
                        <div class="w-full flex flex-col gap-4 border border-gray-400/35 px-3 py-5 rounded-lg">
                            <label for="description" class="block text-sm font-medium text-gray-700">Upload File</label>

                            <div class="card w-full flex justify-center">
                                <FileUpload mode="basic" name="demo[]" url="/api/upload" accept="image/*"
                                    :maxFileSize="1000000" @upload="onUpload" :auto="true" chooseLabel="Browse"
                                    class="w-full" />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 w-full flex justify-between gap-5">
                            <Button type="submit" class="w-full">
                                Submit
                            </Button>
                            <Button class="w-full">
                                Cancel
                            </Button>
                        </div>

                    </form>
                </div>
            </div>

        </Drawer>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Button, Column, DataTable, Dialog, Drawer, InputText, Paginator, FileUpload, Select, InputNumber, Textarea } from 'primevue';
import useProductStore from './products';
import { storeToRefs } from 'pinia';

const visible = ref(false);

const productsStore = useProductStore();
const { retrieveProducts } = productsStore;
const { products, meta } = storeToRefs(productsStore);

const visibleRight = ref(false);

const value = ref('');


const selectedCity = ref();
const cities = ref([
    { name: 'New York', code: 'NY' },
    { name: 'Rome', code: 'RM' },
    { name: 'London', code: 'LDN' },
    { name: 'Istanbul', code: 'IST' },
    { name: 'Paris', code: 'PRS' }
]);


onMounted(async () => {
    await retrieveProducts();
});

const onPageChange = (event) => {
    retrieveProducts(event.page + 1);
};
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