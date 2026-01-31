export interface Expense {
  id: number;
  title: string;
  category: string;
  amount: number;
  expense_date: string;
  status: "paid" | "unpaid";
  note?: string | null;
}
