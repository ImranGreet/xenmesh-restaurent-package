import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";
import type {
  ExpenseItem,
  PaginatedExpenseItemResponse,
} from "../scripts/interfaces/expenseItems";
import type { PaginationMeta } from "../scripts/interfaces/paginationMeta";

export const useExpenseItemsStore = defineStore("expenseItems", () => {
  const items = ref<ExpenseItem[]>([]);
  const meta = ref<PaginationMeta | null>(null);
  const sortField = ref("id");
  const sortOrder = ref<"asc" | "desc">("asc");
  const loading = ref(false);
  const expenseCategories = ref([]);

  const fetchExpenseItems = async (page = 1, perPage = 10) => {
    loading.value = true;

    try {
      const response = await axios.get<PaginatedExpenseItemResponse>(
        "/api/expense-items",
        {
          params: {
            page,
            per_page: perPage,
            sort_field: sortField.value,
            sort_order: sortOrder.value,
          },
        },
      );

      items.value = response.data.data;
      meta.value = response.data.meta;
    } catch (error) {
      console.error("Failed to fetch expense items", error);
    } finally {
      loading.value = false;
    }
  };

  // Retrieve product categories
  const retrieveExpenseCategories = async () => {
    try {
      const response = await axios.get(`/api/retrive-expense-categories`);
      expenseCategories.value = response.data.data;
    } catch (err: any) {
      console.log(err);
    }
  };

  const totalRecords = () => meta.value?.total ?? 0;
  const perPage = () => meta.value?.per_page ?? 10;
  const currentPage = () => meta.value?.current_page ?? 1;

  return {
    // state
    items,
    meta,
    loading,
    sortField,
    sortOrder,
    expenseCategories,
    // getters
    totalRecords,
    perPage,
    currentPage,

    // actions
    fetchExpenseItems,
    retrieveExpenseCategories,
  };
});
