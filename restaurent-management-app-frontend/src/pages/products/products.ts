import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

const useProductStore = defineStore("product-store", () => {
  let products = ref([]);
  const meta = ref({
    current_page: 1,
    last_page: 1,
    per_page: 10,
    total: 0,
  });
  let retrieveProducts = async function (page=1) {
    let response = await axios.get(
      `http://127.0.0.1:8000/api/products?page=${page}`
    );
    products.value = response.data.data;
    meta.value = response.data.meta;
    console.log(meta.value);
  };

  return {
    products,
    meta,
    retrieveProducts,
  };
});

export default useProductStore;
