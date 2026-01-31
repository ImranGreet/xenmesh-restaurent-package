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
  // add other fields if needed
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

export const useProductStore = defineStore("product-store", () => {
  // State
  const products = ref<Product[]>([]);
  const productCategories = ref<ProductCategory[]>([]);
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

  // Fetch products with pagination
  const retrieveProducts = async (page = 1) => {
    try {
      const response = await axios.get(
        `http://127.0.0.1:8000/api/products?page=${page}`,
      );
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
      const res = await axios.get(
        `http://127.0.0.1:8000/api/update-product-status/${id}`,
      );
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
      const response = await axios.get(`/api/retrieve-product-categories`);
      productCategories.value = response.data.data;
    } catch (err: any) {
      error.value = err.response?.data ?? {
        message: "Failed to fetch categories",
      };
    }
  };

  // Create product
  const createProduct = async (payload: {
    name: string;
    category_id: number;
    price: number;
    stock?: number;
    description?: string;
  }): Promise<Product | null> => {
    error.value = null;
    try {
      const response = await axios.post(
        `http://127.0.0.1:8000/api/create-product`,
        payload,
      );
      products.value.unshift(response.data.data); // add new product to start
      return response.data.data;
    } catch (err: any) {
      error.value = err.response?.data ?? {
        message: "Failed to create product",
      };
      return null;
    }
  };

  // Update product
  const updateProduct = async (
    id: number,
    payload: {
      name?: string;
      category_id?: number;
      price?: number;
      stock?: number;
      description?: string;
    },
  ): Promise<Product | null> => {
    updatingIds.value.push(id);
    error.value = null;
    try {
      const response = await axios.put(
        `http://127.0.0.1:8000/api/update-product/${id}`,
        payload,
      );
      const index = products.value.findIndex((p) => p.id === id);
      if (index !== -1) {
        products.value[index] = response.data.data;
      }
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
      await axios.delete(`http://127.0.0.1:8000/api/delete-product/${id}`);
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

  return {
    products,
    meta,
    error,
    updatingIds,
    productCategories,
    isUpdating,
    retrieveProducts,
    toggleProductStatus,
    retrieveProductCategories,
    createProduct,
    updateProduct,
    deleteProduct,
  };
});

export default useProductStore;
