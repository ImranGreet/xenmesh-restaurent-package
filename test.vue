<template>
  <section>
    <!-- Header -->
    <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
      <h1 class="px-3 pt-2 text-2xl font-semibold">Products</h1>

      <!-- Search & Buttons -->
      <div class="flex flex-col md:flex-row gap-2 px-2 md:px-0 items-start md:items-center">
        <!-- Search -->
        <InputText
          v-model="searchQuery"
          placeholder="Search Products"
          @input="onSearch"
          class="w-full md:w-64"
        />

        <!-- Action Buttons -->
        <div class="flex gap-2 mt-2 md:mt-0">
          <Button type="button" label="Sort" icon="pi pi-sort" @click="toggleSort" />
          <Button type="button" label="Filter" icon="pi pi-filter" @click="visibleFilter = true" />
          <Button type="button" label="Add New Product" icon="pi pi-plus" @click="openAddProduct" />
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div class="card">
      <DataTable
        tableStyle="min-width: 50rem"
        :value="products"
        :paginator="true"
        :rows="meta.per_page"
        :totalRecords="meta.total"
        :lazy="true"
        scrollable
        scrollHeight="700px"
        @page="onPageChange"
      >
        <Column field="id" header="ID" sortable />
        <Column field="name" header="Name" sortable />
        <Column field="category.name" header="Category" />
        <Column field="stock" header="Stock" sortable />
        <Column field="price" header="Price" sortable />
        <Column field="status" header="Status">
          <template #body="slotProps">
            <Badge
              :value="slotProps.data.status === 1 ? 'Active' : 'Inactive'"
              :severity="slotProps.data.status === 1 ? 'success' : 'danger'"
            />
          </template>
        </Column>

        <!-- Action Column -->
        <Column header="Action">
          <template #body="slotProps">
            <div class="flex gap-1 justify-end">
              <Button
                type="button"
                class="action-btn"
                icon="pi pi-pencil"
                @click="openEditProduct(slotProps.data)"
              />
              <Button
                type="button"
                class="action-btn delete"
                icon="pi pi-trash"
                @click="deleteProductById(slotProps.data.id)"
              />
              <Button
                type="button"
                class="action-btn lock"
                @click="toggleProductStatus(slotProps.data.id)"
              >
                <svg class="w-5 h-5" v-if="slotProps.data.status === 0">
                  <use href="#lock-icon" />
                </svg>
                <svg class="w-5 h-5" v-else>
                  <use href="#confirm-tick" />
                </svg>
              </Button>
            </div>
          </template>
        </Column>
      </DataTable>
    </div>

    <!-- Filter Dialog -->
    <Dialog
      v-model:visible="visibleFilter"
      modal
      header="Filter Products"
      :style="{ width: '30rem' }"
    >
      <div class="flex flex-col gap-3">
        <label class="font-semibold">Category</label>
        <Select
          v-model="filterCategory"
          :options="productCategories"
          optionLabel="name"
          placeholder="Select Category"
          class="w-full"
        />

        <label class="font-semibold">Status</label>
        <Select
          v-model="filterStatus"
          :options="statusOptions"
          placeholder="Select Status"
          class="w-full"
        />

        <div class="flex justify-end gap-2 mt-4">
          <Button label="Cancel" severity="secondary" @click="visibleFilter = false" />
          <Button label="Apply" @click="applyFilter" />
        </div>
      </div>
    </Dialog>

    <!-- Add/Edit Product Dialog -->
    <Dialog
      v-model:visible="visibleProductForm"
      modal
      :header="isEditing ? 'Edit Product' : 'Add Product'"
      :style="{ width: '45rem' }"
    >
      <div class="bg-white z-50">
        <div class="p-6">
          <h2 class="text-2xl font-semibold mb-4">Product Information</h2>

          <form @submit.prevent="submitProduct" class="space-y-4">
            <!-- Image Upload -->
            <div class="w-full flex flex-col gap-4 border border-gray-400/35 px-3 py-2 rounded-lg">
              <label class="block text-sm font-medium text-gray-700">Upload Image</label>
              <div class="card w-full flex justify-center">
                <FileUpload
                  mode="basic"
                  name="demo[]"
                  url="/api/upload"
                  accept="image/*"
                  :maxFileSize="1000000"
                  :auto="true"
                  chooseLabel="Browse"
                />
              </div>
            </div>

            <!-- Product Name & SKU -->
            <div class="w-full flex flex-col md:flex-row gap-5">
              <div class="w-full">
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                <InputText v-model="form.name" placeholder="Enter product name" class="w-full" />
              </div>

              <div class="w-full">
                <label class="block text-sm font-medium text-gray-700 mb-2">SKU / Unit</label>
                <Select
                  v-model="form.unit_id"
                  :options="restaurantUnits"
                  optionLabel="name"
                  placeholder="Select Unit"
                  class="w-full"
                />
              </div>
            </div>

            <!-- Price & Stock -->
            <div class="w-full flex flex-col md:flex-row gap-5">
              <div class="w-full">
                <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                <InputNumber v-model="form.price" mode="decimal" class="w-full" />
              </div>

              <div class="w-full">
                <label class="block text-sm font-medium text-gray-700 mb-2">Stock</label>
                <InputNumber v-model="form.stock" mode="decimal" class="w-full" />
              </div>
            </div>

            <!-- Status -->
            <div class="w-full flex justify-between items-center border border-gray-300 rounded-md px-3 py-1">
              <div class="flex flex-col gap-2">
                <label class="block text-sm font-medium text-gray-700">Product Status</label>
                <span>Enable show or hide products</span>
              </div>
              <div class="card flex justify-center">
                <ToggleSwitch v-model="form.status" true-value="1" false-value="0" />
              </div>
            </div>

            <!-- Description -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
              <Textarea v-model="form.description" rows="3" class="w-full border border-gray-400/35 rounded-md" />
            </div>

            <!-- Category -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
              <Select
                v-model="form.category_id"
                :options="productCategories"
                optionLabel="name"
                placeholder="Select a Category"
                class="w-full"
              />
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-5 mt-4">
              <Button label="Cancel" severity="danger" @click="closeProductForm" />
              <Button type="submit" label="Submit" />
            </div>
          </form>
        </div>
      </div>
    </Dialog>
  </section>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted } from "vue";
import { storeToRefs } from "pinia";
import useProductStore, { Product, ProductCategory } from "../../store/products";
import {
  DataTable,
  Column,
  Button,
  Dialog,
  InputText,
  Select,
  InputNumber,
  Textarea,
  ToggleSwitch,
  Badge,
  FileUpload
} from "primevue";

// Pinia Store
const store = useProductStore();
const { products, meta, productCategories } = storeToRefs(store);
const { retrieveProducts, toggleProductStatus, createProduct, updateProduct, deleteProduct, retrieveProductCategories } = store;

// UI State
const visibleFilter = ref(false);
const visibleProductForm = ref(false);
const isEditing = ref(false);
const searchQuery = ref("");
const filterCategory = ref<number | null>(null);
const filterStatus = ref<0 | 1 | null>(null);
const restaurantUnits = ref([
  { id: 1, name: "pcs" },
  { id: 2, name: "kg" },
  { id: 3, name: "g" },
  { id: 4, name: "ltr" },
  { id: 5, name: "ml" },
  { id: 6, name: "dozen" },
  { id: 7, name: "packet" },
  { id: 8, name: "box" },
  { id: 9, name: "cup" },
  { id: 10, name: "slice" }
]);

const statusOptions = [
  { label: "Active", value: 1 },
  { label: "Inactive", value: 0 }
];

// Product Form
interface ProductForm {
  id?: number | null;
  name: string;
  category_id: number | null;
  unit_id?: number | null;
  price: number;
  stock: number;
  status: 0 | 1;
  description: string;
}

const form = reactive<ProductForm>({
  id: null,
  name: "",
  category_id: null,
  unit_id: null,
  price: 0,
  stock: 0,
  status: 1,
  description: ""
});

// Lifecycle
onMounted(async () => {
  await retrieveProductCategories();
  fetchProducts();
});

// --- Methods ---
const fetchProducts = async (page = 1) => {
  await retrieveProducts({ page, per_page: meta.value.per_page, search: searchQuery.value || undefined });
};

const onPageChange = (event: { page: number }) => fetchProducts(event.page + 1);
const onSearch = () => fetchProducts();

const toggleSort = () => fetchProducts();

const applyFilter = () => {
  visibleFilter.value = false;
  fetchProducts();
};

const openAddProduct = () => {
  isEditing.value = false;
  Object.assign(form, { id: null, name: "", category_id: null, unit_id: null, price: 0, stock: 0, status: 1, description: "" });
  visibleProductForm.value = true;
};

const openEditProduct = (product: Product) => {
  isEditing.value = true;
  Object.assign(form, {
    id: product.id,
    name: product.name,
    category_id: product.category_id ?? null,
    unit_id: product.unit_id ?? null,
    price: product.price ?? 0,
    stock: product.stock ?? 0,
    status: product.status,
    description: product.description ?? ""
  });
  visibleProductForm.value = true;
};

const closeProductForm = () => {
  visibleProductForm.value = false;
  isEditing.value = false;
};

const submitProduct = async () => {
  if (isEditing.value && form.id) {
    await updateProduct(form.id, form);
  } else {
    await createProduct(form);
  }
  closeProductForm();
  fetchProducts();
};

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

.p-fileupload.p-fileupload-basic.p-component {
  width: 100%;
}
</style>
