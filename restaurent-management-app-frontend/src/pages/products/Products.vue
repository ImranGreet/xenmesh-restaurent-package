<template>
    <section>
        <div class="w-full flex justify-between items-center">
            <h1>Products</h1>
            <div class="flex gap-2">
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
                    <Button type="button">
                        <svg class="w-5 h-5 ">
                            <use href="#filter-icon" />
                        </svg>
                        <span>Filter</span>
                    </Button>
                    <Button type="button" >
                        <svg class="w-5 h-5 ">
                            <use href="#plus-icon" />
                        </svg>
                        <span>Add New Product</span>
                    </Button>

                </div>

            </div>
        </div>
        <div class="card">
            <DataTable :value="products" tableStyle="min-width: 50rem">

                <Column field="id" header="Id" />
                <Column field="name" header="Name" />
                <Column field="category" header="Category" />
                <Column field="stock" header="Stock" />
                <Column field="status" header="Status" />

                <!-- Action Column -->
                <Column header="Action" style="width: 12rem">
                    <template #body="slotProps">
                        <div class="flex gap-0.5">
                            <Button type="button" label="edit" @click="visible = true" class="action-btn">
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
    </section>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import { ProductService } from './products';
import { Button, Column, DataTable, Dialog, InputText } from 'primevue';

onMounted(() => {
    ProductService.getProductsMini().then((data) => (products.value = data));
});

const products = ref();


const visible = ref(false);



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
</style>