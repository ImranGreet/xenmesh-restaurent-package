<template>
    <div class="w-full flex flex-wrap gap-5">
        <Button class="w-48 shadow">
            <div class="px-6 py-4">
                <img :src="productImage" alt="" class="rounded-md">
                <div class="space-y-1.5 text-left border-t border-gray-200 mt-5">
                    <h3 class="text-lg font-semibold text-gray-800">Hamburger</h3>
                    <span class="text-md font-semibold text-gray-800">$5.60</span>
                </div>
            </div>
        </Button>
        <Button class="w-48 shadow">
            <div class="px-6 py-4">
                <img :src="productImage" alt="" class="rounded-md">
                <div class="space-y-1.5 text-left border-t border-gray-200 mt-5">
                    <h3 class="text-lg font-semibold text-gray-800">Hamburger</h3>
                    <span class="text-md font-semibold text-gray-800">$5.60</span>
                </div>
            </div>
        </Button>
        <Button class="w-48 shadow">
            <div class="px-6 py-4">
                <img :src="productImage" alt="" class="rounded-md">
                <div class="space-y-1.5 text-left border-t border-gray-200 mt-5">
                    <h3 class="text-lg font-semibold text-gray-800">Hamburger</h3>
                    <span class="text-md font-semibold text-gray-800">$5.60</span>
                </div>
            </div>
        </Button>
        <Button class="w-48 shadow">
            <div class="px-6 py-4">
                <img :src="productImage" alt="" class="rounded-md">
                <div class="space-y-1.5 text-left border-t border-gray-200 mt-5">
                    <h3 class="text-lg font-semibold text-gray-800">Hamburger</h3>
                    <span class="text-md font-semibold text-gray-800">$5.60</span>
                </div>
            </div>
        </Button>
        <Button class="w-48 shadow">
            <div class="px-6 py-4">
                <img :src="productImage" alt="" class="rounded-md">
                <div class="space-y-1.5 text-left border-t border-gray-200 mt-5">
                    <h3 class="text-lg font-semibold text-gray-800">Hamburger</h3>
                    <span class="text-md font-semibold text-gray-800">$5.60</span>
                </div>
            </div>
        </Button>
        <Button class="w-48 shadow">
            <div class="px-6 py-4">
                <img :src="productImage" alt="" class="rounded-md">
                <div class="space-y-1.5 text-left border-t border-gray-200 mt-5">
                    <h3 class="text-lg font-semibold text-gray-800">Hamburger</h3>
                    <span class="text-md font-semibold text-gray-800">$5.60</span>
                </div>
            </div>
        </Button>
        <Button class="w-48 shadow product-selected">
            <div class="px-6 py-4">
                <img :src="productImage" alt="" class="rounded-md">
                <div class="space-y-1.5 text-left border-t border-gray-200 mt-5">
                    <h3 class="text-lg font-semibold text-gray-800">Hamburger</h3>
                    <span class="text-md font-semibold text-gray-800 flex items-center gap-2"> <span
                            class="mr-0.5">$</span> 5.60 <span class="flex items-center gap-3"><svg
                                class="w-5 h-5 text-gray-800">
                                <use href="#cross-icon" />
                            </svg> <span
                                class="w-10 h-10 border flex flex-col justify-center items-center rounded-full bg-green-800 text-center text-white">1</span>
                        </span>
                    </span>
                </div>
            </div>
        </Button>
    </div>
</template>

<script lang="ts" setup>
import { Button } from 'primevue';
import { ref } from 'vue';

let productImage = ref("https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=999&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
</script>

<style scoped>
.p-button {
    padding: 0;
    border: 1px solid oklch(98.5% 0.002 247.839);
    background-color: oklch(100% 0.00011 271.152 / 0.308)
}

.p-button:not(:disabled):hover {
    background-color: oklch(96.7% 0.001 286.375);
    border: 1px solid oklch(98.5% 0.002 247.839);
}

.product-selected {
    border-width: 0 0 6px 0;
    border-color: green;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
}

.p-button:not(:disabled).product-selected:hover {
    border-width: 0 0 6px 0;
    border-color: green;
}
</style>