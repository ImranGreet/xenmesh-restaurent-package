<template>
    <div class="h-screen  text-white" :class="{ 'w-64 px-4 bg-red-100': sidebarDefault, 'w-0': !sidebarDefault }">
        <div class="w-full" v-if="sidebarDefault">
            <h1>Header</h1>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { sidebarDefault } from '../../scripts/Common/helper';


</script>