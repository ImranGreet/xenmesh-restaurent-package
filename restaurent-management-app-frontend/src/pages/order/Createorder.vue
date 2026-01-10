<template>
    <div class="w-full flex gap-10">
        <OrderMenu></OrderMenu>
        <div class="w-full flex-1">
            <router-view></router-view>
        </div>
        <div class="border-l border-gray-400/35 w-86">
            <OrderManagement></OrderManagement>
        </div>
    </div>
</template>

<script lang="ts" setup>
import OrderManagement from './OrderManagement.vue';
import OrderMenu from './OrderMenu.vue';
</script>