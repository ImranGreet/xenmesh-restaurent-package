<template>
    <div class="flex gap-4">
        <div class="flex flex-col gap-4 w-24 ml-1">
            <Button class="flex flex-col justify-center items-center">
                <svg class="w-5 h-5 ">
                    <use href="#component-icon" />
                </svg>
                <span> All Menu
                </span>
            </Button>
            <Button class="flex flex-col justify-center items-center">
                <svg class="w-5 h-5 ">
                    <use href="#burger-icon" />
                </svg>
                <Span>Burger</Span>
            </Button>
            <Button class="flex flex-col justify-center items-center">
                <svg class="w-5 h-5 ">
                    <use href="#burger-icon" />
                </svg>
                <Span>Burger</Span>
            </Button>
            <Button class="flex flex-col justify-center items-center">
                <svg class="w-5 h-5 ">
                    <use href="#burger-icon" />
                </svg>
                <Span>Burger</Span>
            </Button>
            <Button class="flex flex-col justify-center items-center">
                <svg class="w-5 h-5 ">
                    <use href="#burger-icon" />
                </svg>
                <Span>Burger</Span>
            </Button>
            <Button class="flex flex-col justify-center items-center">
                <svg class="w-5 h-5 ">
                    <use href="#burger-icon" />
                </svg>
                <Span>Burger</Span>
            </Button>
            <Button class="flex flex-col justify-center items-center p-button-active">
                <svg class="w-5 h-5 ">
                    <use href="#burger-icon" />
                </svg>
                <Span>Burger</Span>
            </Button>

        </div>

    </div>
</template>

<script lang="ts" setup>
import { Button } from 'primevue';

</script>

<style scoped>
.p-button {
    background-color: oklch(92.8% 0.006 264.531);
    border: none;
    color: oklch(27.4% 0.006 286.033);
}

.p-button:not(:disabled):hover {
    background-color: oklch(92.8% 0.006 264.531);
    border: none;
    color: oklch(27.4% 0.006 286.033);
}

.p-button-active {
    position: relative;
    border: 1px solid oklch(87% 0 0);
    background-color: white;
}

.p-button:not(:disabled).p-button-active:hover {
    background-color: white;
    color: oklch(27.4% 0.006 286.033);
    border: 1px solid oklch(87% 0 0);

}

.p-button-active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 10px;
    bottom: 10px;
    background-color: #016630;
    width: 6px;
    border-radius: 5px;
}
</style>