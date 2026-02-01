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
  totalAmount:string,
}

interface CreateExpensePayload {
  title: string;
  category?: string;
  amount: number;
  expense_date: string; // YYYY-MM-DD
  description?: string | null;
}

interface ExpenseItem {
  id: number;
  name_en: string;
  name_bn: string;
  slug: string;
  category: string;
  is_active: number;
  created_at: string;
  updated_at: string;
}

export const useExpenseStore = defineStore("expenses", () => {
  /* -------------------- state -------------------- */
  const expenses = ref<Expense[]>([]);
  const meta = ref<PaginationMeta | null>(null);
  const loading = ref<boolean>(false);
  const expenseItems = ref<ExpenseItem[]>([]);
  const totalAmount = ref();

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
        totalAmount.value = response.data.total_amount;
        console.log(response.data.total_amount,'total expenses');
      }
    } catch (error) {
      console.error("Failed to fetch expenses", error);
    } finally {
      loading.value = false;
    }
  };

  const fetchExpenseItems = async () => {
    try {
      const response = await axios.get("/api/active-expense-items");
      console.log("Expense Items Response:", response.data);

      // Check if response.data.data exists and is an array
      if (Array.isArray(response.data.data)) {
        expenseItems.value = response.data.data;
        console.log("Fetched Expense Items:", expenseItems.value);
      } else {
        console.warn("Unexpected response format", response.data);
      }
    } catch (error) {
      console.error("Failed to fetch expense items", error);
    }
  };

  const addExpense = async (payload: CreateExpensePayload) => {
    loading.value = true;

    try {
      const response = await axios.post("/api/create-expense", payload);

      if (response.data.success) {
        // Add the newly created expense to the top of the list
        expenses.value.unshift(response.data.data);

        // Optionally refetch to update pagination/meta
        // await fetchExpenses(currentPage(), perPage());

        return response.data.data; // return the new expense
      } else {
        console.error("Failed to add expense", response.data.message);
        return null;
      }
    } catch (error) {
      console.error("Error adding expense:", error);
      return null;
    } finally {
      loading.value = false;
    }
  };

  /**
   * Update an existing expense item
   * @param id - Expense item ID
   * @param updatedData - Data to update
   */
  const updateExpense = async (id: number, payload: CreateExpensePayload) => {
    try {
      const response = await axios.put(`/api/update-expense/${id}`, payload);

      if (response.data.success) {
        // Update the local expenses array
        const index = expenses.value.findIndex((e) => e.id === id);
        if (index !== -1) expenses.value[index] = response.data.data;

        return response.data.data;
      }
      return null;
    } catch (error) {
      console.error("Failed to update expense", error);
      throw error;
    }
  };

  // Delete button click
  const deleteExpense = async (expense: any) => {
    if (confirm(`Are you sure you want to delete "${expense.title}"?`)) {
      try {
        await axios.delete(`/api/delete-expense/${expense.id}`);
        // Remove from local array
        expenses.value = expenses.value.filter((e) => e.id !== expense.id);
        alert("Expense deleted successfully!");
        await fetchExpenses();
      } catch (error) {
        console.error("Failed to delete expense", error);
        alert("Failed to delete expense!");
      }
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
    expenseItems,
    totalAmount,
    // getters
    totalRecords,
    perPage,
    currentPage,

    // actions
    fetchExpenses,
    addExpense,
    fetchExpenseItems,
    updateExpense,
    deleteExpense,
  };
});

export default useExpenseStore;
