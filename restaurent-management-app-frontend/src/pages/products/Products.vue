<template>
    <section>
        <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center">
            <h1 class="px-3 pt-2 text-2xl font-semibold">Products</h1>
            <div class="flex flex-col md:flex-row gap-2 px-2 md:px-0">
                <div class="flex flex-col gap-2">
                    <InputText v-model="searchQuery" @input="onSearch" placeholder="Search Products" />
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
                <Column header="Image">
                    <template #body="slotProps">
                        <div class="w-20 h-20 flex justify-center items-center">
                            <img :src="slotProps.data.product_thumbnail_url" alt="Product"
                                class="w-full h-full object-cover rounded" />
                        </div>
                    </template>
                </Column>
                <Column field="name_bn" header="Name" />
                <Column field="name_en" header="Name" />
                <Column field="category" header="Category" />
                <Column field="stock" header="Stock" />
                <Column field="price" header="Price" />
                <Column field="status" header="Status">
                    <template #body="slotProps">
                        <Badge severity="success" v-if="slotProps.data.status === 1">Active</Badge>
                        <Badge severity="danger" v-if="slotProps.data.status === 0">Inactive</Badge>
                    </template>
                </Column>

                <!-- Action Column -->
                <Column header="Action" class="text-end">
                    <template #body="slotProps">
                        <div class="flex gap-0.5 justify-end">
                            <Button type="button" label="edit" class="action-btn">
                                <svg class="w-5 h-5 ">
                                    <use href="#pencil-icon-edit" />
                                </svg>
                            </Button>
                            <Button type="button" class="action-btn delete"
                                @click="deleteProductById(slotProps.data.id)">
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
                <div class="p-0">
                    <!-- Header -->
                    <h2 class="text-2xl font-semibold mb-4">Product Information</h2>

                    <!-- Form -->
                    <form class="space-y-4">

                        <div class="w-full">
                            <div class="w-full flex flex-col gap-4">
                                <!-- Image Upload -->
                                <div class="w-full flex flex-col gap-4 border border-gray-400/35 px-3 py-2 rounded-lg">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Upload
                                        File</label>

                                    <div class="card w-full flex justify-center">
                                        <FileUpload @select="onThumbnailSelect" mode="basic" name="demo[]"
                                            url="/api/upload" accept="image/*" :maxFileSize="1000000" :auto="true"
                                            chooseLabel="Browse" />
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
                                        <InputText v-model="form.name" type="text" id="product-name" name="product-name"
                                            placeholder="Enter product name"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                    </div>
                                    <!-- category -->
                                    <div class="w-full">
                                        <label for="product-name"
                                            class="block text-sm font-medium text-gray-700 mb-2">Input
                                            Sku</label>
                                        <div class="card flex justify-center">
                                            <Select v-model="form.unit_id" :options="restaurantUnits" optionLabel="name"
                                                optionValue="id" placeholder="Select a Unit" class="w-full" />
                                        </div>
                                    </div>
                                </div>


                                <!-- Price -->
                                <div class="w-full flex flex-col  md:flex-row gap-5">
                                    <div class="w-full">
                                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                        <InputNumber v-model="form.price" inputId="integeronly" fluid />

                                    </div>
                                    <div class="w-full">
                                        <label for="price" class="block text-sm font-medium text-gray-700">Takeway
                                            Price</label>
                                        <InputNumber inputId="integeronly" fluid disabled />
                                    </div>
                                </div>
                                <!-- Description -->
                                <div>
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <Textarea v-model="form.descriptionEnglish" rows="2" cols="10"
                                        class="w-full border border-gray-400/35 rounded-md" />
                                </div>
                                <!-- category -->
                                <div>
                                    <label for="product-name"
                                        class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <div class="card flex justify-center">
                                        <Select v-model="form.category_id" :options="productCategories"
                                            optionLabel="slug" optionValue="id" placeholder="Select a Category"
                                            class="w-full" />
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="pt-4 w-full flex justify-end gap-5">
                <Button @click="submitProduct" type="submit" class="w-auto">
                    Submit
                </Button>
                <Button type="submit" severity="danger" class="w-auto">
                    Reset
                </Button>
                <Button class="w-auto" @click="visibleProductInfo = false">
                    Cancel
                </Button>

            </div>
        </Dialog>
    </section>
</template>

<script setup lang="ts">
import { ref, onMounted, reactive } from 'vue';
import { Button, Column, DataTable, Dialog, InputText, FileUpload, Select, InputNumber, Textarea, ToggleSwitch, Badge } from 'primevue';
import useProductStore from '../../store/products';
import { storeToRefs } from 'pinia';

import FilterProduct from './FilterProduct.vue';

const visible = ref(false);

const visibleProductInfo = ref(false);
const productsStore = useProductStore();
const { retrieveProducts, toggleProductStatus, retrieveProductCategories, createProduct, deleteProduct, retrieveRestaurantUnits } = productsStore;
const { products, meta, productCategories, restaurantUnits } = storeToRefs(productsStore);


const selectedUnit = ref();
interface Unit {
    id: number;
    name: string;
}


const checked = ref(false);




// Product Form
interface ProductForm {
    id?: number | null;
    name: string;
    category_id: number | null;
    unit_id?: number | null;
    price: number;
    stock: number;
    status: 0 | 1;
    descriptionEnglish: string;
    descriptionBangla: string;
    productThumbnail: File | null;
}

const form = reactive<ProductForm>({
    id: null,
    name: "",
    category_id: null,
    unit_id: null,
    price: 0,
    stock: 0,
    status: 1,
    descriptionEnglish: "",
    descriptionBangla: "",
    productThumbnail: null,
});

const submitProduct = async (event: Event) => {
    event.preventDefault();

    if (!form.category_id) {
        alert("Please select a category");
        return;
    }

    const formData = new FormData();

    formData.append("name_en", form.name);
    formData.append("name_bn", form.name);
    formData.append("category_id", String(form.category_id));
    formData.append("unit_id", String(form.unit_id ?? ""));
    formData.append("price", String(form.price));
    formData.append("stock", String(form.stock));
    formData.append("status", String(form.status));
    formData.append("description_en", form.descriptionEnglish);
    formData.append("description_bn", form.descriptionBangla);

    if (form.productThumbnail) {
        formData.append("product_thumbnail", form.productThumbnail);
    }

    await createProduct(formData);
    fetchProducts();
};


const onThumbnailSelect = (event: any) => {
    form.productThumbnail = event.files[0];
};

onMounted(async () => {
    await retrieveProducts();
    await retrieveProductCategories();
    await retrieveRestaurantUnits();
});



// UI State
const searchQuery = ref("");

// methods
const fetchProducts = async (page = 1) => {
    await retrieveProducts({ page, per_page: meta.value.per_page, search: searchQuery.value || undefined });
};

const onPageChange = (event: { page: number }) => fetchProducts(event.page + 1);


const onSearch = () => fetchProducts();

const deleteProductById = async (id: number) => {
    await deleteProduct(id);
    fetchProducts();
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