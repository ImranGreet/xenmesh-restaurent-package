import {
  createRouter,
  createWebHistory,
  type RouteRecordRaw,
} from "vue-router";

const routes: RouteRecordRaw[] = [
  {
    path: "/",
    component: () => import("../components/layouts/AdminLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("../pages/products/Products.vue"),
        name: "products",
      },
      {
        path: "/order",
        component: () => import("../pages/order/Createorder.vue"),
        children: [
          {
            path: "",
            component: () => import("../pages/order/OrderItems.vue"),
          },
        ],
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
