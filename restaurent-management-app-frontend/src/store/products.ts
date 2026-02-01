import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

// Product interface
export interface Product {
  id: number;
  name: string;
  category_id?: number;
  status: 0 | 1;
  price?: number;
  stock?: number;
  description?: string;
  created_at?: string;
  updated_at?: string;
}

// Pagination meta interface
export interface PaginationMeta {
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

// Category interface
export interface ProductCategory {
  id: number;
  name: string;
}

export interface RestaurantUnit {
  id: number;
  name: string;
  created_at: string; // ISO date string
  updated_at: string; // ISO date string
}

// Full API response interface
export interface RestaurantUnitResponse {
  success: boolean;
  data: RestaurantUnit[];
}

export const useProductStore = defineStore("product-store", () => {
  // State
  const products = ref<Product[]>([]);
  const productCategories = ref<ProductCategory[]>([]);
  // Restaurant units state
  const restaurantUnits = ref<RestaurantUnit[]>([]);
  const meta = ref<PaginationMeta>({
    current_page: 1,
    last_page: 1,
    per_page: 10,
    total: 0,
  });
  const updatingIds = ref<number[]>([]);
  const error = ref<any>(null);

  // Check if a product is updating
  const isUpdating = (id: number) => updatingIds.value.includes(id);

  // Fetch products with pagination, search, filter, and sorting
  const retrieveProducts = async (
    params: {
      page?: number;
      per_page?: number;
      search?: string;
      category_id?: number;
      status?: 0 | 1;
      sort_by?: string;
      sort_dir?: "asc" | "desc";
    } = {},
  ) => {
    try {
      const response = await axios.get("/api/products", { params });
      products.value = response.data.data;
      meta.value = response.data.meta;
    } catch (err) {
      console.error("Failed to fetch products", err);
      error.value = err;
    }
  };

  // Toggle product status
  const toggleProductStatus = async (id: number): Promise<boolean> => {
    updatingIds.value.push(id);
    error.value = null;

    const product = products.value.find((p) => p.id === id);
    if (!product) return false;

    const previousStatus = product.status;
    product.status = product.status === 1 ? 0 : 1; // optimistic toggle

    try {
      const res = await axios.patch(`/api/products/${id}/status`);
      if (res.data?.data) {
        Object.assign(product, res.data.data); // sync with backend
      }
      return true;
    } catch (err: any) {
      product.status = previousStatus; // rollback
      error.value = err.response?.data ?? {
        message: "Failed to toggle status",
      };
      return false;
    } finally {
      updatingIds.value = updatingIds.value.filter((pid) => pid !== id);
    }
  };

  // Retrieve product categories
  const retrieveProductCategories = async () => {
    try {
      const response = await axios.get("/api/retrieve-product-categories");
      productCategories.value = response.data.data;
    } catch (err: any) {
      error.value = err.response?.data ?? {
        message: "Failed to fetch categories",
      };
    }
  };

  // Create product
  const createProduct = async (payload: FormData) => {
    error.value = null;

    try {
      const response = await axios.post("/api/products", payload, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });

      products.value.unshift(response.data.data);
      return response.data.data;
    } catch (err: any) {
      error.value = err.response?.data;
      return null;
    }
  };

  // Update product
  const updateProduct = async (
    id: number,
    payload: FormData,
  ): Promise<Product | null> => {
    updatingIds.value.push(id);
    error.value = null;

    try {
      const response = await axios.post(`/api/products/${id}`, payload, {
        headers: {
          "Content-Type": "multipart/form-data",
          "X-HTTP-Method-Override": "PUT", // important for Laravel PUT + FormData
        },
      });

      const index = products.value.findIndex((p) => p.id === id);
      if (index !== -1) products.value[index] = response.data.data;
      return response.data.data;
    } catch (err: any) {
      error.value = err.response?.data ?? {
        message: "Failed to update product",
      };
      return null;
    } finally {
      updatingIds.value = updatingIds.value.filter((pid) => pid !== id);
    }
  };

  // Delete product
  const deleteProduct = async (id: number): Promise<boolean> => {
    updatingIds.value.push(id);
    error.value = null;

    try {
      await axios.delete(`/api/products/${id}`);
      products.value = products.value.filter((p) => p.id !== id);
      return true;
    } catch (err: any) {
      error.value = err.response?.data ?? {
        message: "Failed to delete product",
      };
      return false;
    } finally {
      updatingIds.value = updatingIds.value.filter((pid) => pid !== id);
    }
  };

  // Retrieve restaurant units
  const retrieveRestaurantUnits = async () => {
    try {
      const response = await axios.get<RestaurantUnitResponse>(
        "/api/restaurant-units",
      );
      restaurantUnits.value = response.data.data;
      console.log(response, "units");
    } catch (err: any) {
      error.value = err.response?.data ?? {
        message: "Failed to fetch restaurant units",
      };
    }
  };

  return {
    products,
    meta,
    error,
    updatingIds,
    productCategories,
    restaurantUnits,
    isUpdating,
    retrieveProducts,
    toggleProductStatus,
    retrieveProductCategories,
    createProduct,
    updateProduct,
    deleteProduct,
    retrieveRestaurantUnits,
  };
});

export default useProductStore;
