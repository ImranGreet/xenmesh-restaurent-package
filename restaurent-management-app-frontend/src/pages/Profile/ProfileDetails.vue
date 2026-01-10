<template>
    <div class="min-h-screen bg-gray-100 p-4">
        <div class="max-w-4xl mx-auto space-y-6">

            <!-- Header -->
            <div class="bg-white rounded-xl shadow p-6">
                <div class="w-full flex justify-between items-center">
                    <h1 class="text-2xl font-semibold text-gray-800">
                        Restaurant Profile
                    </h1>
                    <Button icon="pi pi-arrow-left" @click="visibleRight = true" />
                </div>
                <p class="text-sm text-gray-500">
                    Manage your restaurant information
                </p>
            </div>

            <!-- Restaurant Info -->
            <div class="bg-white rounded-xl shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Left Info -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-500">Restaurant Name</label>
                        <p class="text-lg font-medium text-gray-800">
                            Golden Spoon Restaurant
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Phone Number</label>
                        <p class="text-gray-800">
                            +880 1712-345678
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Email</label>
                        <p class="text-gray-800">
                            goldenspoon@gmail.com
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Address</label>
                        <p class="text-gray-800">
                            Daudkandi Bazar, Cumilla, Bangladesh
                        </p>
                    </div>
                </div>

                <!-- Right Info -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-500">Location</label>
                        <p class="text-gray-800">
                            Daudkandi, Cumilla
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Opening Hours</label>
                        <p class="text-gray-800">
                            9:00 AM – 11:00 PM
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Owner Name</label>
                        <p class="text-gray-800">
                            Imran Hossain
                        </p>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Restaurant Type</label>
                        <p class="text-gray-800">
                            Family Restaurant
                        </p>
                    </div>
                </div>

            </div>

            <!-- Facilities -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Facilities & Services
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span>Home Delivery</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span>Dine In</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span>Take Away</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span>Parking Facility</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span>AC Available</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span>Online Payment</span>
                    </div>
                </div>
            </div>

            <!-- Map Placeholder -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">
                    Location Map
                </h2>

                <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                    Map Preview (Google Map / OpenStreetMap)
                </div>
            </div>

        </div>

        <Drawer v-model:visible="visibleRight" header="Right Drawer" position="right" style="width: 40rem;">
            <ProfileEdit />
        </Drawer>
    </div>

</template>


<script lang="ts" setup>
import { Button, Drawer } from 'primevue';
import { ref } from 'vue';
import ProfileEdit from './ProfileEdit.vue';
const visibleRight = ref(false);
</script>