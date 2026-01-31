<template>
    <section>
        <!-- Header -->
        <div class="w-full flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold">Expenses</h1>

            <div class="flex gap-2">
                <InputText v-model="search" placeholder="Search Expenses" class="w-56" />

                <Button outlined>
                    <svg class="w-5 h-5">
                        <use href="#short-icon" />
                    </svg>
                    <span>Sort</span>
                </Button>

                <Button outlined>
                    <svg class="w-5 h-5">
                        <use href="#filter-icon" />
                    </svg>
                    <span>Filter</span>
                </Button>

                <Button severity="primary" @click="visible = true">
                    <svg class="w-5 h-5">
                        <use href="#plus-icon" />
                    </svg>
                    <span>New Expense</span>
                </Button>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <DataTable :value="items" lazy paginator :rows="perPage" :totalRecords="totalRecords" :loading="loading" 
                sortMode="single" :rowsPerPageOptions="[5, 10, 20, 50]" @page="onPage" @sort="onSort" scrollable
                scrollHeight="700px">
                <!-- Name EN -->
                <Column field="name_en" header="Name (EN)" sortable />

                <!-- Name BN -->
                <Column field="name_bn" header="Name (BN)" sortable />

                <!-- Category -->
                <Column field="category" header="Category" sortable />

                <!-- Status -->
                <Column header="Status" field="is_active" sortable>
                    <template #body="{ data }">
                        <Tag :value="data.is_active ? 'Active' : 'Inactive'"
                            :severity="data.is_active ? 'success' : 'danger'" />
                    </template>
                </Column>

                <Column header="Actions" class="flex justify-end">
                    <template #body="{ data }">
                        <div class="flex gap-1 justify-end">
                            <Button type="button" label="Edit"  >
                                <svg class="w-2.5 h-2.5">
                                    <use href="#pencil-icon-edit" />
                                </svg>
                            </Button>
                            <Button type="button" label="Delete" severity="danger">
                                <svg class="w-2.5 h-2.5">
                                    <use href="#trash-icon" />
                                </svg>
                            </Button>
                        </div>
                    </template>
                </Column>
            </DataTable>
        </div>

        <Dialog v-model:visible="visible" header="Add Expense Item" :modal="true" :closable="true"
            style="min-width: 30rem;">
            <form class="flex flex-col gap-4">
                <InputText placeholder="Name (EN)" required />
                <InputText placeholder="Name (BN)" required />
                <InputText placeholder="Category" />
                <Checkbox />
                <Button type="submit" label="Add Expense" :loading="store.loading" />
            </form>
        </Dialog>

    </section>
</template>


<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { storeToRefs } from 'pinia'

import Button from 'primevue/button'
import Column from 'primevue/column'
import DataTable from 'primevue/datatable'
import InputText from 'primevue/inputtext'
import Tag from 'primevue/tag'
import Dialog from 'primevue/dialog'
import Checkbox from 'primevue/checkbox'

import { useExpenseItemsStore } from '../../store/expenseItems'

const store = useExpenseItemsStore()
const { items, loading } = storeToRefs(store)

const search = ref('')
const perPage = ref(10)
const totalRecords = ref(0);

const visible = ref(false);





/* Fetch */
const loadData = async (page = 1, rows = 10) => {
    await store.fetchExpenseItems(page, rows)
    totalRecords.value = store.totalRecords()
}

/* Pagination event */
const onPage = (event: any) => {
    loadData(event.page + 1, event.rows)
}

const onSort = (event: any) => {
    store.sortOrder = event.sortOrder === 1 ? 'asc' : 'desc'

    // reload first page after sort
    store.fetchExpenseItems(1, perPage.value)
}

/* Initial load */
onMounted(() => {
    loadData();
})
</script>
