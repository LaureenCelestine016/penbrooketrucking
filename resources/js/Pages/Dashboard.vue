<template>
    <Head title="Dashboard" />
    <Toast />
    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->

        <div class="py-8">
            <div class="mx-12">
                <div class="grid grid-cols-4 gap-y-3 gap-x-4">
                    <div class="col-span-5">
                        <div class="grid grid-cols-12 gap-2">
                            <div
                                class="col-span-12 md:col-span-6 lg:col-span-3"
                            >
                                <div
                                    class="bg-white dark:bg-surface-900 shadow p-4 rounded-border rounded-md"
                                >
                                    <div class="flex justify-between mb-4">
                                        <div>
                                            <span
                                                class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                                >TRUCKS</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                            >
                                                {{ props.truck || 0 }}
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-center bg-blue-100 dark:bg-blue-400/30 rounded-border rounded-md w-10 h-10"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                viewBox="0 0 256 256"
                                            >
                                                <!-- Icon from Recent by undefined - undefined -->
                                                <path
                                                    fill="currentColor"
                                                    d="M224 96.8V96a56.06 56.06 0 0 0-56-56h-8a16 16 0 0 0-16 16v120h-16V72a8 8 0 0 0-8-8H16A16 16 0 0 0 0 80v104a32 32 0 0 0 56 21.13A32 32 0 0 0 111 192h82a32 32 0 0 0 63-8v-48a40.07 40.07 0 0 0-32-39.2M32 200a16 16 0 1 1 16-16a16 16 0 0 1-16 16m48 0a16 16 0 1 1 16-16a16 16 0 0 1-16 16m144 0a16 16 0 1 1 16-16a16 16 0 0 1-16 16"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-span-12 md:col-span-6 lg:col-span-3"
                            >
                                <div
                                    class="bg-white dark:bg-surface-900 shadow p-4 rounded-border rounded-md"
                                >
                                    <div class="flex justify-between mb-4">
                                        <div>
                                            <span
                                                class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                                >DRIVER</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                            >
                                                {{ props.driver || 0 }}
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-center bg-green-100 dark:bg-green-400/30 rounded-border rounded-md w-10 h-10"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                viewBox="0 0 24 24"
                                            >
                                                <!-- Icon from Recent by undefined - undefined -->
                                                <path
                                                    fill="currentColor"
                                                    d="M12 22q-2.05 0-3.875-.788t-3.187-2.15t-2.15-3.187T2 12q0-2.075.788-3.887t2.15-3.175t3.187-2.15T12 2q2.075 0 3.888.788t3.174 2.15t2.15 3.175T22 12q0 2.05-.788 3.875t-2.15 3.188t-3.175 2.15T12 22M7 11q.425 0 .713-.288T8 10t-.288-.712T7 9t-.712.288T6 10t.288.713T7 11m3-3q.425 0 .713-.288T11 7t-.288-.712T10 6t-.712.288T9 7t.288.713T10 8m7 3q.425 0 .713-.288T18 10t-.288-.712T17 9t-.712.288T16 10t.288.713T17 11m-5 3q.825 0 1.413-.587T14 12q0-.325-.1-.638t-.3-.562l1.75-4.35l-1.875-.825L11.75 10q-.75.125-1.25.688T10 12q0 .825.588 1.413T12 14m5.6 3.7q-1.25-.825-2.675-1.263T12 16t-2.925.438T6.4 17.7L8.15 19q.875-.5 1.85-.75t2-.25t2 .25t1.85.75z"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-span-12 md:col-span-6 lg:col-span-3"
                            >
                                <div
                                    class="bg-white dark:bg-surface-900 shadow p-4 rounded-border rounded-md"
                                >
                                    <div class="flex justify-between mb-4">
                                        <div>
                                            <span
                                                class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                                >FUEL</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                            >
                                                <span class="text-gray-600"
                                                    >₱</span
                                                >
                                                0
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-center bg-yellow-100 dark:bg-yellow-400/30 rounded-border rounded-md w-10 h-10"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                viewBox="0 0 15 15"
                                            >
                                                <!-- Icon from Recent by undefined - undefined -->
                                                <path
                                                    fill="currentColor"
                                                    d="M14 6v5.5a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 0 11.5 8H10V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9h1.5a.5.5 0 0 1 .5.5v2a1.5 1.5 0 0 0 3 0V5a1 1 0 0 0-1-1V2.49a.5.5 0 0 0-.5-.49a.51.51 0 0 0-.5.55V5a1 1 0 1 0 1-1zm-5 .5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5z"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-span-12 md:col-span-6 lg:col-span-3"
                            >
                                <div
                                    class="bg-white dark:bg-surface-900 shadow p-4 rounded-border rounded-md"
                                >
                                    <div class="flex justify-between mb-4">
                                        <div>
                                            <span
                                                class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                                >MAINTENANCE</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                            >
                                                <span class="text-gray-600"
                                                    >₱</span
                                                >

                                                0
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-center bg-red-100 dark:bg-red-400/30 rounded-border rounded-md w-10 h-10"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                viewBox="0 0 24 24"
                                            >
                                                <!-- Icon from Recent by undefined - undefined -->
                                                <path
                                                    fill="currentColor"
                                                    fill-rule="evenodd"
                                                    d="M6.377 4.72a7 7 0 0 0-1.62 1.209a1 1 0 1 1-1.414-1.414a9 9 0 0 1 12.728 0l5.94 5.94a2.6 2.6 0 0 1 0 3.676l-1.273 1.273a2.6 2.6 0 0 1-3.677 0L14.657 13L5.89 21.768a2.6 2.6 0 0 1-3.677 0l-.566-.566a2.6 2.6 0 0 1 0-3.677l8.769-8.768zm13.937 6.866l-2.121 2.121l.282.283a.6.6 0 0 0 .849 0l1.273-1.273a.6.6 0 0 0 0-.848zm-9.192 2.121l-1.415-1.414L3.06 18.94a.6.6 0 0 0 0 .848l.566.566a.6.6 0 0 0 .849 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-5">
                        <div class="grid grid-cols-2 gap-x-2">
                            <!-- Vehicle status -->
                            <StatusOverview
                                :operationalData="operationalData"
                            />

                            <MaintenanceOverview
                                :maintenanceData="maintenanceData"
                            />
                        </div>
                    </div>
                    <div class="col-span-5">
                        <FuelChart
                            :litersByDriver="litersByDriver"
                            :litersPerMonth="litersByDriver"
                            :fuelStats="fuelStats"
                        />
                    </div>
                    <div class="col-span-5">
                        <!-- Vehicle status -->
                        <ExpensesChart :expensesData="expensesData" />
                    </div>
                </div>
            </div>
            <!-- toast -->
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import StatusOverview from "../Pages/Dashboard/Vehiclestatus.vue";
import MaintenanceOverview from "../Pages/Dashboard/MaintenanceOverview.vue";
import ExpensesChart from "../Pages/Dashboard/ExpensesChart.vue";
import FuelChart from "../Pages/Dashboard/FuelChart.vue";
import { ref, onMounted, onBeforeUnmount, watch } from "vue";
import { Head, usePage, router } from "@inertiajs/vue3";

import AutoComplete from "primevue/autocomplete";

const props = defineProps({
    operationalData: Object,
    maintenanceData: Object,
    expensesData: Object,
    litersByDriver: Object,
    litersPerMonth: Object,
    fuelStats: Object,
});
</script>

<style scoped>
h3 {
    font-size: 1.25rem;
    font-weight: 600;
}

.echarts {
    width: 100%;
    height: 100%;
    min-height: 300px;
}
</style>
