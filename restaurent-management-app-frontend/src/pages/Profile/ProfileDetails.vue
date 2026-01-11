<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-6">
        <div class="max-w-6xl mx-auto space-y-6">

            <!-- Header -->
            <div class="bg-white rounded-2xl  p-6 border border-gray-100 transform transition-all duration-300 ">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-500 rounded-lg flex items-center justify-center">
                                <i class="pi pi-store text-white text-lg"></i>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900">
                                Restaurant Profile
                            </h1>
                        </div>
                        <p class="text-sm text-gray-600 ml-13">
                            Manage and update your restaurant information
                        </p>
                    </div>
                    <Button 
                        @click="visibleRight = true"
                        class="!px-5 !py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 border-0 text-white font-medium rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-0.5"
                        icon="pi pi-pencil"
                        label="Edit Profile"
                    />
                </div>
            </div>

            <!-- Restaurant Info Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Card -->
                <div class="bg-white rounded-2xl  p-6 border border-gray-100  transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
                            <i class="pi pi-info-circle text-white text-sm"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Basic Information
                        </h2>
                    </div>
                    
                    <div class="space-y-5">
                        <div class="pb-4 border-b border-gray-100">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Restaurant Name
                            </label>
                            <div class="flex items-center gap-2">
                                <i class="pi pi-building text-amber-500"></i>
                                <p class="text-lg font-semibold text-gray-900">
                                    Golden Spoon Restaurant
                                </p>
                            </div>
                        </div>

                        <div class="pb-4 border-b border-gray-100">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Contact Details
                            </label>
                            <div class="grid grid-cols-1 gap-3 mt-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                                        <i class="pi pi-phone text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">+880 1712-345678</p>
                                        <p class="text-sm text-gray-500">Phone Number</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                                        <i class="pi pi-envelope text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">goldenspoon@gmail.com</p>
                                        <p class="text-sm text-gray-500">Email Address</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pb-4 border-b border-gray-100">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Location Details
                            </label>
                            <div class="flex items-center gap-3 mt-2">
                                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                                    <i class="pi pi-map-marker text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Daudkandi Bazar, Cumilla, Bangladesh</p>
                                    <p class="text-sm text-gray-500">Full Address</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Card -->
                <div class="bg-white rounded-2xl  p-6 border border-gray-100  transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center">
                            <i class="pi pi-clock text-white text-sm"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Business Details
                        </h2>
                    </div>

                    <div class="space-y-5">
                        <div class="pb-4 border-b border-gray-100">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Business Hours
                            </label>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center">
                                    <i class="pi pi-clock text-emerald-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">9:00 AM – 11:00 PM</p>
                                    <p class="text-sm text-gray-500">Daily Opening Hours</p>
                                </div>
                            </div>
                        </div>

                        <div class="pb-4 border-b border-gray-100">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Restaurant Type
                            </label>
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-50 to-orange-50 rounded-full mt-2">
                                <div class="w-2 h-2 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full"></div>
                                <span class="font-medium text-gray-800">Family Restaurant</span>
                            </div>
                        </div>

                        <div class="pb-4 border-b border-gray-100">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                Owner Information
                            </label>
                            <div class="flex items-center gap-3 mt-2">
                                <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center">
                                    <i class="pi pi-user text-emerald-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Imran Hossain</p>
                                    <p class="text-sm text-gray-500">Restaurant Owner</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Facilities Card -->
            <div class="bg-white rounded-2xl  p-6 border border-gray-100  transition-shadow duration-300">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                        <i class="pi pi-star text-white text-sm"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">
                        Facilities & Services
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div v-for="(facility, index) in facilities" :key="index"
                         class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-purple-200 hover:bg-purple-50 transition-all duration-300 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-purple-100 to-pink-100 flex items-center justify-center group-hover:from-purple-200 group-hover:to-pink-200">
                            <i :class="facility.icon" class="text-purple-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ facility.name }}</p>
                            <p class="text-xs text-gray-500">{{ facility.status }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Placeholder -->
            <div class="bg-white rounded-2xl  p-6 border border-gray-100  transition-shadow duration-300">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-gradient-to-r from-red-500 to-rose-500 rounded-lg flex items-center justify-center">
                        <i class="pi pi-map text-white text-sm"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">
                        Location Map
                    </h2>
                </div>

                <div class="w-full h-64 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400 hover:border-red-200 hover:bg-red-50 transition-all duration-300">
                    <i class="pi pi-map-marker text-3xl mb-2 text-red-400"></i>
                    <p class="font-medium">Google Map Preview</p>
                    <p class="text-sm mt-1">Daudkandi Bazar, Cumilla, Bangladesh</p>
                </div>
            </div>

        </div>

        <Drawer v-model:visible="visibleRight" header="Edit Restaurant Profile" position="right" :style="{width: '500px'}" class="!rounded-l-2xl">
            <ProfileEdit @close="visibleRight = false" />
        </Drawer>
    </div>
</template>

<script lang="ts" setup>
import { Button, Drawer } from 'primevue';
import { ref } from 'vue';
import ProfileEdit from './ProfileEdit.vue';

const visibleRight = ref(false);

const facilities = [
    { name: 'Home Delivery', status: 'Available', icon: 'pi pi-truck' },
    { name: 'Dine In', status: 'Available', icon: 'pi pi-home' },
    { name: 'Take Away', status: 'Available', icon: 'pi pi-shopping-bag' },
    { name: 'Parking Facility', status: 'Available', icon: 'pi pi-car' },
    { name: 'AC Available', status: 'Available', icon: 'pi pi-snowflake' },
    { name: 'Online Payment', status: 'Available', icon: 'pi pi-credit-card' },
];
</script>