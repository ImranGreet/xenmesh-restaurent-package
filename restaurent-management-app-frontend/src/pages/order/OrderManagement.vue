<template>
    <div class="payment px-2 flex flex-col justify-between">
        <div class="card">
            <Tabs value="0" class="px-2">
                <TabList class="flex gap-3 flex-wrap">
                    <Tab value="0">Order</Tab>
                    <Tab value="1">Customer</Tab>
                    <Tab value="3">Tables</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel value="0">
                        <OrderList></OrderList>
                    </TabPanel>
                    <TabPanel value="1">
                        <Customer></Customer>>
                    </TabPanel>
                    <TabPanel value="2">
                        <PaymentForm></PaymentForm>
                    </TabPanel>
                    <TabPanel value="3">
                        <OrderTables></OrderTables>
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </div>
        <div class="payment-card bg-gray-200/50 px-2 py-2.5">
            <div class="w-full px-2 flex justify-between items-center">
                <span>Subtotal</span>
                <span>$ 10.25</span>
            </div>
            <div class="w-full px-2 flex justify-between items-center">
                <span>Discount</span>
                <InputNumber v-model="value" showButtons buttonLayout="horizontal" :min="0" :max="99">
                    <template #incrementbuttonicon>
                        <span class="pi pi-plus" />
                    </template>
                    <template #decrementbuttonicon>
                        <span class="pi pi-minus" />
                    </template>
                </InputNumber>

            </div>
            <div class="w-full px-2 flex justify-between items-center">
                <span>Subtotal</span>
                <span>$ 10.25</span>
            </div>
            <div class="w-full border-t pt-3.5">
                <div class="w-full px-2 flex justify-between items-center">
                    <span>Total</span>
                    <span>$ 10.25</span>
                </div>
            </div>
        </div>

        <div class="card flex justify-center">
            <Button label="Procees to transactions" class="w-full" @click="visible = true" />
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
                    <Button type="button" label="Confirmed Payment" @click="visible = false"></Button>
                </div>
            </Dialog>
        </div>
    </div>
</template>

<script setup>
import { Button, Dialog, InputNumber, InputText, Tab, TabList, TabPanel, TabPanels, Tabs } from 'primevue';
import OrderList from './OrderList.vue';
import Customer from './Customer.vue';
import PaymentForm from './PaymentForm.vue';
import OrderTables from './OrderTables.vue';
import { ref } from 'vue';
const visible = ref(false);
const value = ref(50);


</script>


<style>
.p-inputtext.p-component.p-filled.p-inputnumber-input {
    width: 60px;
}
</style>