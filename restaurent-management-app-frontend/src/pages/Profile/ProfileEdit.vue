<template>
    <div class="min-h-screen bg-gray-100 p-4">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6 space-y-6">

            <!-- Header -->
            <div class="border-b pb-4">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Edit Restaurant Profile
                </h1>
                <p class="text-sm text-gray-500">
                    Update your restaurant information
                </p>
            </div>

            <!-- Form -->
            <form class="space-y-6">

                <!-- Basic Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">
                        Basic Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-600">
                                Restaurant Name
                            </label>
                            <input type="text" value="Golden Spoon Restaurant"
                                class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">
                                Phone Number
                            </label>
                            <input type="text" value="+880 1712-345678"
                                class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">
                                Email Address
                            </label>
                            <input type="email" value="goldenspoon@gmail.com"
                                class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">
                                Restaurant Type
                            </label>
                            <select class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none">
                                <option>Family Restaurant</option>
                                <option>Fast Food</option>
                                <option selected>Cafe</option>
                                <option>Fine Dining</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Address & Location -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">
                        Address & Location
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-600">
                                Address
                            </label>
                            <input type="text" value="Daudkandi Bazar, Cumilla"
                                class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">
                                City / Area
                            </label>
                            <input type="text" value="Daudkandi"
                                class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">
                                Opening Hours
                            </label>
                            <input type="text" value="9:00 AM – 11:00 PM"
                                class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">
                                Google Map Link
                            </label>
                            <input type="text" placeholder="https://maps.google.com/..."
                                class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                        </div>

                    </div>
                </div>

                <!-- Facilities -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">
                        Facilities & Services
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>Home Delivery</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>Dine In</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>Take Away</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>Parking Facility</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>AC Available</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>Online Payment</span>
                        </label>

                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">
                        Cancel
                    </button>

                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>

</template>

<script lang="ts" setup>

</script>