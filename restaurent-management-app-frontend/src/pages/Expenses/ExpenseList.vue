<template>
    <section>
        <div class="w-full flex justify-between items-center">
            <h1>Products</h1>
            <div class="flex gap-2">
                <div class="flex flex-col gap-2">
                    <InputText name="username" type="text" placeholder="Search Expenses" />
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
                    <Button type="button">
                        <svg class="w-5 h-5 ">
                            <use href="#plus-icon" />
                        </svg>
                        <span> New Expenses</span>
                    </Button>

                </div>

            </div>
        </div>
        <div class="card">
            <DataTable :value="expenses" paginator lazy :rows="rows" :first="first" :totalRecords="meta?.total || 0"
                :rowsPerPageOptions="[5, 10, 20, 50]" :loading="loading" @page="onPageChange"
                tableStyle="min-width: 50rem">
                <Column field="title" header="Title" />
                <Column field="category" header="Category" />
                <Column field="amount" header="Amount" />
                <Column field="expense_date" header="Expense Date" />
            </DataTable>

        </div>
    </section>
</template>

<script setup lang="ts">
import { Button, Column, DataTable, InputText } from "primevue";
import { onMounted, ref } from "vue";
import { storeToRefs } from "pinia";
import useExpenseStore from "../../store/expense";

/* ---------------- Store ---------------- */
const expenseStore = useExpenseStore();
const { expenses, meta, loading } = storeToRefs(expenseStore);
const { fetchExpenses } = expenseStore;

/* ---------------- Pagination State ---------------- */
const rows = ref<number>(10);
const first = ref<number>(0);

/* ---------------- Initial Load ---------------- */
onMounted(() => {
    fetchExpenses(1, rows.value);
});

/* ---------------- Page Change Handler ---------------- */
const onPageChange = async (event: any) => {
    first.value = event.first;
    rows.value = event.rows;

    const page = event.page + 1; // PrimeVue uses 0-based index
    await fetchExpenses(page, rows.value);
};
</script>
