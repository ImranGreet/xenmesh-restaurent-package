import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";

import type { Expense } from "../scripts/interfaces/expense";
import type { PaginationMeta } from "../scripts/interfaces/paginationMeta";

interface PaginatedExpenseResponse {
  data: Expense[];
  meta: PaginationMeta;
  success: boolean;
  message: string;
}

export const useExpenseStore = defineStore("expenses", () => {
  /* -------------------- state -------------------- */
  const expenses = ref<Expense[]>([]);
  const meta = ref<PaginationMeta | null>(null);
  const loading = ref<boolean>(false);

  const sortField = ref<string>("id");
  const sortOrder = ref<"asc" | "desc">("desc");

  /* -------------------- actions -------------------- */
  const fetchExpenses = async (page = 1, perPage = 10) => {
    loading.value = true;

    try {
      const response = await axios.get<PaginatedExpenseResponse>(
        "/api/expenses",
        {
          params: {
            page,
            per_page: perPage,
            sort_field: sortField.value,
            sort_order: sortOrder.value,
          },
        },
      );

      if (response.data.success) {
        expenses.value = response.data.data;
        meta.value = response.data.meta;
      }
    } catch (error) {
      console.error("Failed to fetch expenses", error);
    } finally {
      loading.value = false;
    }
  };

  /* -------------------- getters -------------------- */
  const totalRecords = () => meta.value?.total ?? 0;
  const perPage = () => meta.value?.per_page ?? 10;
  const currentPage = () => meta.value?.current_page ?? 1;

  return {
    // state
    expenses,
    meta,
    loading,
    sortField,
    sortOrder,

    // getters
    totalRecords,
    perPage,
    currentPage,

    // actions
    fetchExpenses,
  };
});


export default useExpenseStore;