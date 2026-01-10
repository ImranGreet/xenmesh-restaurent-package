<template>
    <div class="min-h-screen bg-gray-100 p-4">
        <div class="max-w-6xl mx-auto space-y-6">

            <!-- Header -->
            <div class="bg-white rounded-xl shadow p-6">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Role & Permission Management
                </h1>
                <p class="text-sm text-gray-500">
                    Control what each role can access in your system
                </p>
            </div>

            <!-- Role Info -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Role Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">
                            Role Name
                        </label>
                        <input type="text" value="Restaurant Manager"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">
                            Description
                        </label>
                        <input type="text" value="Can manage orders, staff, and reports"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none" />
                    </div>
                </div>
            </div>

            <!-- Permissions -->
            <div class="bg-white rounded-xl shadow p-6 space-y-6">

                <h2 class="text-lg font-semibold text-gray-700">
                    Permissions
                </h2>

                <!-- Permission Group -->
                <div>
                    <h3 class="text-md font-semibold text-gray-800 mb-2">
                        🧾 Order Management
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>View Orders</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>Create Orders</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>Cancel Orders</span>
                        </label>
                    </div>
                </div>

                <!-- Permission Group -->
                <div>
                    <h3 class="text-md font-semibold text-gray-800 mb-2">
                        🍽️ Menu Management
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>View Menu</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>Add Menu Item</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>Edit Menu Item</span>
                        </label>
                    </div>
                </div>

                <!-- Permission Group -->
                <div>
                    <h3 class="text-md font-semibold text-gray-800 mb-2">
                        👥 Staff Management
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>View Staff</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>Add Staff</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>Edit Staff</span>
                        </label>
                    </div>
                </div>

                <!-- Permission Group -->
                <div>
                    <h3 class="text-md font-semibold text-gray-800 mb-2">
                        📊 Reports & Finance
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked />
                            <span>View Reports</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>Export Reports</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input type="checkbox" />
                            <span>Manage Expenses</span>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow p-6 flex justify-end space-x-3">
                <button class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">
                    Cancel
                </button>

                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save Role
                </button>
            </div>

        </div>
    </div>

</template>