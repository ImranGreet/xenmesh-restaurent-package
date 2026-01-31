import type { PaginationMeta } from "./paginationMeta";

export interface ExpenseItem {
  id: number;
  name_en: string;
  name_bn: string;
  slug: string;
  category: string | null;
  is_active: boolean | number;
  created_at: string;
  updated_at: string;
}

export interface PaginatedExpenseItemResponse {
  data: ExpenseItem[];
  meta: PaginationMeta;
}
