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
        component: () => import("../pages/Dashboard.vue"),
        name: "dashboard",
      },
      {
        path: "/products",
        component: () => import("../pages/products/Products.vue"),
        name: "products",
      },
      {
        path: "/incomes",
        component: () => import("../pages/Incomes/IncomeList.vue"),
        name: "income-list",
      },
      {
        path: "/expenses",
        component: () => import("../pages/Expenses/ExpenseList.vue"),
        name: "expenses-list",
      },
      {
        path: "/stuff",
        component: () => import("../pages/Stuff/StuffList.vue"),
        name: "stuff",
      },
      {
        path: "/profile",
        component: () => import("../pages/Profile/ProfileDetails.vue"),
        name: "profile-details",
      },
      {
        path: "/role-permission",
        component: () =>
          import("../pages/Auth/RolePermissions/RolePermissions.vue"),
        name: "role-permissions",
      },
      {
        path: "/order",
        component: () => import("../pages/order/Createorder.vue"),
        children: [
          {
            path: "",
            component: () => import("../pages/order/OrderItems.vue"),
            name: "create-order",
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
