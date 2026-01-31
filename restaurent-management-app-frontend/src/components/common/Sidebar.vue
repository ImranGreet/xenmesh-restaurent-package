<template>
    <div class="h-screen  text-white fixed left-0 top-10 bottom-0">
        <div class="w-full h-screen">
            <div class="w-full h-20"></div>

            <ul class="flex flex-col gap-2 px-3">
                <li>
                    <router-link :to="{ name: 'create-order' }" class="capitalize text-md font-semibold">
                        Create Order
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'order-list' }" class="capitalize text-md font-semibold">
                        Recent Order
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'products' }" class="capitalize text-md font-semibold">
                        Prodcuts
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'expenses-list' }" class="capitalize text-md font-semibold">
                        Expenses
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'expense-items-list' }" class="capitalize text-md font-semibold">
                        Expense Items
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'income-list' }" class="capitalize text-md font-semibold">Income
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'stuff' }" class="capitalize text-md font-semibold">Stuff
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'role-permissions' }" class="capitalize text-md font-semibold">Role and
                        Permissions
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'profile-details' }" class="capitalize text-md font-semibold">Profile
                    </router-link>
                </li>
            </ul>
            <div class="w-full flex flex-col justify-start px-3 mt-5">
                <AuthGurd></AuthGurd>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import AuthGurd from '../Auth/AuthGurd.vue';

</script>

<style scoped>
.transtion-all {
    transition: all 0.3s ease-in-out;
}

.router-link-exact-active {
    color: #41B883;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 0.48px;
    border-width: 0px 0px 0px 2px;
    border-color: #41B883;
    padding-left: 5px;
}
</style>