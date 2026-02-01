<template>
    <section>
        <!-- Header -->
        <div class="w-full flex justify-between items-center">
            <h1>Products</h1>
            <div class="flex gap-2">
                <div class="flex flex-col gap-2">
                    <InputText name="username" type="text" placeholder="Search Expenses" />
                </div>
                <div class="flex gap-2">
                    <Button type="button">
                        <svg class="w-5 h-5">
                            <use href="#short-icon" />
                        </svg>
                        <span>Short</span>
                    </Button>
                    <Button type="button">
                        <svg class="w-5 h-5">
                            <use href="#filter-icon" />
                        </svg>
                        <span>Filter</span>
                    </Button>
                    <Button type="button" @click="visible = true">
                        <svg class="w-5 h-5">
                            <use href="#plus-icon" />
                        </svg>
                        <span> New Expenses</span>
                    </Button>
                </div>
            </div>
        </div>

        <!-- DataTable -->
        <div class="card">
            <DataTable :value="expenses" paginator lazy :rows="rows" :first="first" :totalRecords="meta?.total || 0"
                :rowsPerPageOptions="[5, 10, 20, 50]" :loading="loading" @page="onPageChange"
                tableStyle="min-width: 50rem">
                <Column field="title" header="Title" />
                <Column field="category" header="Category" />
                <Column field="amount" header="Amount" />
                <Column field="expense_date" header="Expense Date" />

                <Column header="Actions" class="flex justify-end">
                    <template #body="{ data }">
                        <div class="flex gap-1 justify-end">
                            <Button type="button" label="Edit" @click="openEditDialog(data)">
                                <svg class="w-2.5 h-2.5">
                                    <use href="#pencil-icon-edit" />
                                </svg>
                            </Button>
                            <Button type="button" label="Delete" @click="deleteExpense(data)">
                                <svg class="w-2.5 h-2.5">
                                    <use href="#trash-icon" />
                                </svg>
                            </Button>
                        </div>
                    </template>
                </Column>

                <ColumnGroup type="footer">
                    <Row>
                        <Column footer="Totals:" :colspan="2" footerStyle="text-align:right" />
                        <Column :footer="totalAmount" />
                    </Row>
                </ColumnGroup>

            </DataTable>
        </div>

        <!-- Dialog: Add Expense -->
        <Dialog v-model:visible="visible" modal :style="{ width: '45rem' }" header="Add New Expense" :closable="true">
            <form @submit.prevent="handleSubmit" class="flex flex-col gap-4">
                <!-- Title -->
                <div class="flex flex-col">
                    <label for="title" class="font-medium">Title <span class="text-red-500">*</span></label>
                    <Select id="title" v-model="form.title" :options="expenseItems" optionLabel="name_en"
                        optionValue="name_en" placeholder="Select Expense Item" class="w-full" />
                    <small v-if="errors.title" class="text-red-600">{{ errors.title }}</small>
                </div>

                <div class="w-full flex gap-2 flex-col sm:flex-row">
                    <!-- Category -->
                    <div class="w-full flex flex-col">
                        <label for="category" class="font-medium">Category</label>
                        <Select id="category" v-model="form.category" :options="categories" optionLabel="label"
                            optionValue="value" placeholder="Select Category" class="w-full" />
                    </div>

                    <!-- Amount -->
                    <div class="w-full flex flex-col">
                        <label for="amount" class="font-medium">Amount <span class="text-red-500">*</span></label>
                        <InputNumber id="amount" v-model="form.amount" mode="currency" currency="BDT" locale="en-BD"
                            class="w-full" />
                        <small v-if="errors.amount" class="text-red-600">{{ errors.amount }}</small>
                    </div>

                    
                </div>
                <div class="w-full flex gap-2 flex-col sm:flex-row">
                    <!-- Category -->
                    <div class="w-full flex flex-col">
                        <label for="category" class="font-medium">Category</label>
                        <Select id="category" v-model="form.category" :options="categories" optionLabel="label"
                            optionValue="value" placeholder="Select Category" class="w-full" />
                    </div>

                    <!-- Amount -->
                    <div class="w-full flex flex-col">
                        <label for="amount" class="font-medium">Amount <span class="text-red-500">*</span></label>
                        <InputNumber id="amount" v-model="form.amount" mode="currency" currency="BDT" locale="en-BD"
                            class="w-full" />
                        <small v-if="errors.amount" class="text-red-600">{{ errors.amount }}</small>
                    </div>

                    <!-- Expense Date -->
                    <div class="w-full flex flex-col">
                        <label for="expense_date" class="font-medium">Expense Date <span
                                class="text-red-500">*</span></label>
                        <DatePicker v-model="form.expense_date" name="date" fluid />
                        <small v-if="errors.expense_date" class="text-red-600">{{ errors.expense_date }}</small>
                    </div>
                </div>

                <!-- Description -->
                <div class="flex flex-col">
                    <label for="description" class="font-medium">Description</label>
                    <Textarea id="description" v-model="form.description" placeholder="Optional description" rows="3"
                        class="w-full" />
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <Button type="submit" label="Add Expense" icon="pi pi-plus" class="p-button-primary"
                        :loading="loading" />
                </div>
            </form>
        </Dialog>


        <!-- Dialog: Edit Expense -->
        <Dialog v-model:visible="editVisible" modal :style="{ width: '45rem' }" header="Update Expense"
            :closable="true">
            <form @submit.prevent="handleUpdate" class="flex flex-col gap-4">
                <!-- Title -->
                <div class="flex flex-col">
                    <label for="editTitle" class="font-medium">Title <span class="text-red-500">*</span></label>
                    <Select id="editTitle" v-model="editForm.title" :options="expenseItems" optionLabel="name_en"
                        optionValue="name_en" placeholder="Select Expense Item" class="w-full" />
                    <small v-if="editErrors.title" class="text-red-600">{{ editErrors.title }}</small>
                </div>

                <div class="w-full flex gap-2 flex-col sm:flex-row">
                    <!-- Category -->
                    <div class="w-full flex flex-col">
                        <label for="editCategory" class="font-medium">Category</label>
                        <Select id="editCategory" v-model="editForm.category" :options="categories" optionLabel="label"
                            optionValue="value" placeholder="Select Category" class="w-full" />
                    </div>

                    <!-- Amount -->
                    <div class="w-full flex flex-col">
                        <label for="editAmount" class="font-medium">Amount <span class="text-red-500">*</span></label>
                        <InputNumber id="editAmount" v-model="editForm.amount" mode="currency" currency="BDT"
                            locale="en-BD" class="w-full" />
                        <small v-if="editErrors.amount" class="text-red-600">{{ editErrors.amount }}</small>
                    </div>

                    <!-- Expense Date -->
                    <div class="w-full flex flex-col">
                        <label for="editExpenseDate" class="font-medium">Expense Date <span
                                class="text-red-500">*</span></label>
                        <DatePicker v-model="editForm.expense_date" name="date" fluid />
                        <small v-if="editErrors.expense_date" class="text-red-600">{{ editErrors.expense_date }}</small>
                    </div>
                </div>

                <!-- Description -->
                <div class="flex flex-col">
                    <label for="editDescription" class="font-medium">Description</label>
                    <Textarea id="editDescription" v-model="editForm.description" placeholder="Optional description"
                        rows="3" class="w-full" />
                </div>

                <!-- Submit -->
                <div class="flex justify-end gap-2">
                    <Button type="button" label="Cancel" class="p-button-secondary" @click="editVisible = false" />
                    <Button type="submit" label="Update Expense" icon="pi pi-save" class="p-button-primary"
                        :loading="loading" />
                </div>
            </form>
        </Dialog>

    </section>
</template>

<script setup lang="ts">
import {
    Button,
    Column,
    DataTable,
    InputText,
    InputNumber,
    Textarea,
    DatePicker,
    Select,
    Dialog,
    Row,
    ColumnGroup
} from "primevue";
import { computed, onMounted, reactive, ref } from "vue";
import { storeToRefs } from "pinia";
import useExpenseStore from "../../store/expense";

/* ---------------- Store ---------------- */
const expenseStore = useExpenseStore();
const { expenses, meta, loading, expenseItems ,totalAmount} = storeToRefs(expenseStore);
const { fetchExpenses, addExpense, fetchExpenseItems, deleteExpense } = expenseStore;

/* ---------------- Pagination State ---------------- */
const rows = ref<number>(10);
const first = ref<number>(0);

/* ---------------- Initial Load ---------------- */
onMounted(() => {
    fetchExpenses(1, rows.value);
    fetchExpenseItems();
    document.title = "Expenses - Restaurant Management";
});

/* ---------------- Page Change Handler ---------------- */
const onPageChange = async (event: any) => {
    first.value = event.first;
    rows.value = event.rows;

    const page = event.page + 1; // PrimeVue uses 0-based index
    await fetchExpenses(page, rows.value);
};

/* ---------------- Dialog Visibility ---------------- */
const visible = ref(false);

/* ---------------- Form ---------------- */
const form = reactive({
    title: "",
    category: "",
    amount: null as number | null,
    expense_date: null as Date | null,
    description: "" as string | null,
});

/* ---------------- Validation ---------------- */
const errors = reactive({
    title: "",
    amount: "",
    expense_date: "",
});

/* Example categories */
const categories = [
    { label: "Food", value: "food" },
    { label: "Transport", value: "transport" },
    { label: "Utilities", value: "utilities" },
];

const validateForm = () => {
    errors.title = form.title ? "" : "Title is required";
    errors.amount = form.amount && form.amount > 0 ? "" : "Amount is required";
    errors.expense_date = form.expense_date ? "" : "Expense date is required";

    return !errors.title && !errors.amount && !errors.expense_date;
};

/* ---------------- Submit Handler ---------------- */
const handleSubmit = async () => {
    if (!validateForm()) return;

    loading.value = true;

    const payload = {
        title: form.title,
        category: form.category || undefined,
        amount: form.amount!,
        expense_date: form.expense_date!.toISOString().split("T")[0], // YYYY-MM-DD
        description: form.description || null,
    };

    const newExpense = await addExpense(payload);

    if (newExpense) {
        // Reset form after successful creation
        form.title = "";
        form.category = "";
        form.amount = null;
        form.expense_date = null;
        form.description = "";

        // Optionally close dialog
        visible.value = false;

        // Refresh first page to show new expense
        await fetchExpenses(1, rows.value);
    }

    loading.value = false;
};


/* ---------------- Dialog Visibility ---------------- */
const editVisible = ref(false);

/* ---------------- Edit Form ---------------- */
const editForm = reactive({
    id: 0,
    title: "",
    category: "",
    amount: null as number | null,
    expense_date: null as Date | null,
    description: "" as string | null,
});

/* ---------------- Edit Form Validation ---------------- */
const editErrors = reactive({
    title: "",
    amount: "",
    expense_date: "",
});

const validateEditForm = () => {
    editErrors.title = editForm.title ? "" : "Title is required";
    editErrors.amount = editForm.amount && editForm.amount > 0 ? "" : "Amount is required";
    editErrors.expense_date = editForm.expense_date ? "" : "Expense date is required";

    return !editErrors.title && !editErrors.amount && !editErrors.expense_date;
};

/* ---------------- Open Edit Dialog ---------------- */
const openEditDialog = (expense: any) => {
    editForm.id = expense.id;
    editForm.title = expense.title;
    editForm.category = expense.category;
    editForm.amount = expense.amount;
    editForm.expense_date = new Date(expense.expense_date);
    editForm.description = expense.description || "";
    editVisible.value = true;
};

/* ---------------- Submit Handler for Update ---------------- */
const handleUpdate = async () => {
    if (!validateEditForm()) return;

    loading.value = true;

    const payload = {
        title: editForm.title,
        category: editForm.category || undefined,
        amount: editForm.amount!,
        expense_date: editForm.expense_date!.toISOString().split("T")[0],
        description: editForm.description || null,
    };

    try {
        // Call your API via store
        const updatedExpense = await expenseStore.updateExpense(editForm.id, payload);

        if (updatedExpense) {
            // Close dialog
            editVisible.value = false;

            // Refresh current page
            await fetchExpenses(currentPage(), rows.value);
        }
    } catch (error) {
        console.error("Failed to update expense:", error);
    } finally {
        loading.value = false;
    }
};




</script>
