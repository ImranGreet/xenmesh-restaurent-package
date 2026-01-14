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
                            <Button type="button" label="edit" class="action-btn">
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


            <Dialog v-model:visible="visible" modal header="Filter" :style="{ width: '45rem' }">
                <FilterProduct/>
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
                            <BasicProductInfo></BasicProductInfo>
                        </div>

                        <div class="w-full" v-if="productInformation.showPricingInfo">
                            <PriceInfo></PriceInfo>

                        </div>
                    </form>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="pt-4 w-full flex justify-end gap-5">
                <Button type="submit" class="w-auto">
                    Submit
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

<script setup>
import { ref, onMounted } from 'vue';
import { Button, Column, DataTable, Dialog, Drawer, InputText, Paginator, FileUpload, Select, InputNumber, Textarea, ToggleSwitch } from 'primevue';
import useProductStore from './products';
import { storeToRefs } from 'pinia';
import BasicProductInfo from './AddNewProduct/BasicProductInfo.vue';
import PriceInfo from './AddNewProduct/PriceInfo.vue';
import FilterProduct from './FilterProduct.vue';

const visible = ref(false);

const visibleProductInfo = ref(false);
const productsStore = useProductStore();
const { retrieveProducts } = productsStore;
const { products, meta } = storeToRefs(productsStore);


const productInformation = ref({
    showBasicInfo: true,
    showPricingInfo: false,
    showVariantInfo: false,
});



const addNext = function () {
    productInformation.value.showBasicInfo = !productInformation.value.showBasicInfo;
    productInformation.value.showPricingInfo = !productInformation.value.showPricingInfo;
}

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