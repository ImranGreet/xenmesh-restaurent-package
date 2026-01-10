<template>
  <div
  class="bg-gray-700 xl:bg-inherit w-full border-l border-gray-300/25 pl-2"
>
  <form
    class="w-full flex flex-col justify-between items-center"
  >
    <!-- Total -->
    <div
      class="w-full space-y-2 border border-gray-200/25 px-2 py-1 2xl:py-3 bg-pink-600 text-white rounded-t-lg"
    >
      <h1 class="w-full text-base 2xl:text-xl">
        Total <span class="ml-3 select-none"> 0 </span>
      </h1>
    </div>

    <!-- Subtotal -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full text-base">Subtotal</label>
      <input
        type="number"
        readonly
        class="w-full text-center px-4 py-1 focus:outline-none"
        value="0"
      />
    </div>

    <!-- Discount Rate -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full text-base">Discount Rate (%)</label>
      <input
        type="text"
        class="w-full text-center px-4 py-1 focus:outline-none"
      />
    </div>

    <!-- Discounted Amount -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full text-base">Discounted Amount</label>
      <input
        type="text"
        readonly
        class="w-full text-center px-4 py-1 focus:outline-none"
        value="0"
      />
    </div>

    <!-- Amount After Discount -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full text-sm">Amount After Discount</label>
      <input
        type="text"
        readonly
        class="w-full text-center px-4 py-1 focus:outline-none"
        value="0"
      />
    </div>

    <!-- Special Discount -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full text-base">Special Discount</label>
      <input
        type="number"
        class="w-full text-center px-4 py-1 focus:outline-none"
      />
    </div>

    <!-- Delivery Way -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full text-base">Delivery Way</label>
      <input
        type="text"
        readonly
        class="w-full text-center px-4 py-1 focus:outline-none"
        value="Dine In"
      />
    </div>

    <!-- Table Number -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full text-base">Table Number</label>
      <input
        type="text"
        readonly
        class="w-full text-center px-4 py-1 focus:outline-none"
        value="01"
      />
    </div>

    <!-- Payment Header -->
    <div
      class="bg-stone-600 text-start text-white px-2 py-1 2xl:py-3 w-full rounded-t-lg"
    >
      <h1 class="text-base 2xl:text-xl">Payment</h1>
    </div>

    <!-- Payable -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full">Payable</label>
      <input
        type="text"
        readonly
        class="w-full text-center px-4 py-1 focus:outline-none select-none"
        value="0"
      />
    </div>

    <!-- Paid Amount -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full">Paid Amount</label>
      <input
        type="text"
        class="w-full text-center px-4 py-1 focus:outline-none"
      />
    </div>

    <!-- Change Amount -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full">Change Amount</label>
      <input
        type="text"
        readonly
        class="w-full text-center px-4 py-1 focus:outline-none"
        value="0"
      />
    </div>

    <!-- Due Amount -->
    <div class="w-full flex justify-between items-center space-x-3 pl-2 py-1">
      <label class="w-full">Due Amount</label>
      <input
        type="text"
        readonly
        class="w-full text-center px-4 py-1 focus:outline-none"
        value="0"
      />
    </div>

    <!-- Confirm Button -->
    <button
      type="submit"
      class="px-2 py-3 text-base 2xl:text-xl tracking-wider bg-blue-700 text-white w-full"
    >
      Confirm
    </button>
  </form>
</div>

</template>

<script lang="ts" setup>

</script>

<style scoped>
input[type='number'] {
  -moz-appearance: textfield;
  appearance: textfiled;
}

input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
