<template>
    <div class="w-full flex gap-4">
        <div class="flex flex-col gap-4 w-20 ml-1">
            <Button class="flex flex-col justify-center items-center">
                <svg class="w-2.5 h-2.5 text-white">
                    <use href="#component-icon" />
                </svg>
                <span> All Menu
                </span>
            </Button>
            <Button>All Menu</Button>
            <Button>All Menu</Button>
            <Button>All Menu</Button>
            <Button>All Menu</Button>
            <Button>All Menu</Button>
            <Button>All Menu</Button>
            <Button>All Menu</Button>
            <Button>All Menu</Button>
        </div>
        <div class="flex-1 bg-red-50">
            <router-view></router-view>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { Button } from 'primevue';

</script>