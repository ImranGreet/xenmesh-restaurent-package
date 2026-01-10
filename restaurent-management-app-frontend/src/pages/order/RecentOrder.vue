<template>
    <section>
        <div class="w-full flex justify-between items-center">
            <h1>Products</h1>
            <div class="flex gap-2">
                <div class="flex flex-col gap-2">
                    <InputText name="username" type="text" placeholder="Search Order" />
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
                    <Button type="button" @click="addNewOrder">
                        <svg class="w-5 h-5 ">
                            <use href="#plus-icon" />
                        </svg>
                        <span> New Order</span>
                    </Button>

                </div>

            </div>
        </div>
        <div class="card">
            <DataTable :value="customers" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
                tableStyle="min-width: 50rem">
                <Column field="name" header="Name" style="width: 25%" />
                <Column field="country" header="Country" style="width: 25%" />
                <Column field="company" header="Company" style="width: 25%" />
                <Column field="representative" header="Representative" style="width: 25%" />
            </DataTable>
        </div>
    </section>
</template>

<script setup>
import { Button, Column, DataTable, InputText } from 'primevue';
import { ref } from 'vue';
import router from '../../routes';


let addNewOrder = function () {
    router.push({ name: `create-order` });
}


const customers = ref([
    {
        name: 'Imran Hossain',
        country: 'Bangladesh',
        company: 'YetFix',
        representative: 'Rahim'
    },
    {
        name: 'John Doe',
        country: 'USA',
        company: 'TechNova',
        representative: 'Sarah'
    },
    {
        name: 'Ali Khan',
        country: 'Pakistan',
        company: 'Foodies Ltd',
        representative: 'Ahmed'
    },
    {
        name: 'Maria Lopez',
        country: 'Spain',
        company: 'Cafe Mundo',
        representative: 'Carlos'
    },
    {
        name: 'Chen Wei',
        country: 'China',
        company: 'Dragon Foods',
        representative: 'Li Ming'
    },
    {
        name: 'Ahmed Noor',
        country: 'UAE',
        company: 'Desert Bites',
        representative: 'Khalid'
    }
]);
</script>
