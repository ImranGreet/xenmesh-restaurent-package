<template>
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
                    <Button type="button" icon="pi pi-ellipsis-v" @click="visible = true" class="action-btn" />

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



                </template>
            </Column>

        </DataTable>
    </div>
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
</style>