<template>

    <section>
        <Header></Header>
        <div class="w-screen flex">
            <div class="h-screen"
                :class="{ ' w-36 lg:w-64 px-4 bg-gray-300 text-black transition-all': sidebarDefault, 'w-0 transition-all': !sidebarDefault }"
                v-if="sidebarDefault">
                <Sidebar></Sidebar>
            </div>

            <div class="flex-1 py-20 overflow-scroll" :class="{ 'px-10 transition-all': sidebarDefault }">
                <router-view></router-view>
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import { sidebarDefault } from '../../scripts/Common/helper';
import Header from '../common/Header.vue';
import Sidebar from '../common/Sidebar.vue';

</script>

<style scoped>
.transtion-all {
    transition: all 0.3s ease-in-out;
}
</style>