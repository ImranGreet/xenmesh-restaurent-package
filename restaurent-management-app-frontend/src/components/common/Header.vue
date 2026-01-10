<template>
    <div class="w-full py-2.5 px-2 border-b border-gray-300/70 fixed left-0 right-0 top-0 z-50 bg-white">
        <Button @click="sidebarToggling" class="flex flex-col justify-center items-center  p-btn">
            <svg class="w-5 h-5 ">
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
    background-color: white;
    color: gray;
    border: none;
    border-radius: 0;
}

.p-button.p-btn:hover {
    background-color: white;
    color: gray;
    border: none;
    border-radius: 0;
}
</style>