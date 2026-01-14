<template>


    <div class="w-full flex flex-col gap-4">

        <!-- Price -->
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <InputNumber inputId="integeronly" fluid />
        </div>
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Takeway Price</label>
            <InputNumber inputId="integeronly" fluid />
        </div>

    </div>

</template>

<script lang="ts" setup>
import { InputNumber, } from 'primevue';

</script>