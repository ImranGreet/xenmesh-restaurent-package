<template>

    <div class="w-full flex flex-col gap-2 border border-gray-200 rounded-sm px-4 py-5">
        <div class="card flex flex-col gap-2 justify-center w-full">
            <label for="phone">Enter Customer Name</label>

            <InputText type="text" placeholder="Enter Customer Name" />
        </div>
        <div class="card flex flex-col gap-2 justify-center w-full">
            <label for="phone">Customer Name</label>

            <InputText type="text" placeholder="Enter Customer Name" />
        </div>
        <div class="card flex flex-col gap-2 justify-center w-full">
            <label for="phone">Phone Number</label>
            <InputNumber type="text" placeholder="Enter Phone Number" />
        </div>

    </div>

</template>

<script lang="ts" setup>
import { InputNumber, InputText } from 'primevue';


</script>