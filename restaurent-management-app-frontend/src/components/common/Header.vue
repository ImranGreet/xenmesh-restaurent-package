<template>
    <div class="w-full py-2.5 px-2 border-b border-gray-300/70">
        <Button
        @click="sidebarToggling"
        class="flex flex-col justify-center items-center text-white p-btn">
            <svg class="w-5 h-5 text-white">
                <use href="#hamburger-menu" />
            </svg>
        </Button>
    </div>
</template>

<script lang="ts" setup>
import { Button } from 'primevue';
import { sidebarToggling } from '../../scripts/Common/helper';

</script>

<style scoped>
.p-button.p-btn {
    background-color: oklch(86.9% 0.022 252.894);
    border: none;
}
.p-button.p-btn:hover{
     background-color: oklch(86.9% 0.022 252.894);
    border: none;
}
</style>