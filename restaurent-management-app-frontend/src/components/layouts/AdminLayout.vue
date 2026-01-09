<template>
    <section class="w-full min-h-screen flex flex-col justify-between">
        <Header></Header>

        <div class="flex-1">
            <div class="w-full flex">
                <Sidebar></Sidebar>
                <div class="flex-1">
                    <router-view></router-view>
                </div>
            </div>
        </div>

    </section>
</template>

<script lang="ts" setup>
import Header from '../common/Header.vue';
import Sidebar from '../common/Sidebar.vue';
</script>