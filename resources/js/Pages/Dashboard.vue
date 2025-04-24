<template>
    <Head title="Dashboard" />
    <Toast>
        <template #message="slotProps">
            <template v-if="slotProps.message.severity === 'warn'">
                <div
                    class="custom-toast"
                    @click="
                        handleToastClick(
                            slotProps.message.data.truckId,
                            slotProps.message.data.truckType
                        )
                    "
                >
                    <div class="toast-header">
                        <i
                            class="pi pi-exclamation-triangle text-yellow-500 mr-2"
                        ></i>
                        <span class="font-semibold text-yellow-600 flex-1">
                            {{ slotProps.message.summary }}
                        </span>
                    </div>
                    <div class="toast-content text-sm text-gray-700 mt-1">
                        {{ slotProps.message.detail }}
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="toast-header">
                    <i
                        class="pi pi-check-circle text-green-500 text-lg mr-2"
                    ></i>

                    <span class="font-semibold text-green-600 flex-1">
                        {{ slotProps.message.summary }}
                    </span>
                </div>
                <div class="toast-content-success text-sm text-gray-700 mt-1">
                    {{ slotProps.message.detail }}
                </div>
            </template>
        </template>
    </Toast>

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->

        <div v-if="isAdmin" class="py-8 px-4 sm:px-6 lg:px-2">
            <div class="grid grid-cols-1 gap-y-6 lg:grid-cols-1">
                <!-- Summary Cards -->
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"
                >
                    <!-- TRUCKS -->
                    <div
                        class="bg-white dark:bg-surface-900 shadow p-4 rounded-md"
                    >
                        <div class="flex justify-between mb-4">
                            <div>
                                <span
                                    class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                    >TRUCKS</span
                                >
                                <div
                                    class="text-surface-900 dark:text-surface-0 font-medium text-2xl"
                                >
                                    {{ props.truck || 0 }}
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-center bg-blue-100 dark:bg-blue-400/30 rounded-md w-10 h-10"
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

                    <!-- DRIVER -->
                    <div
                        class="bg-white dark:bg-surface-900 shadow p-4 rounded-md"
                    >
                        <div class="flex justify-between mb-4">
                            <div>
                                <span
                                    class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                    >DRIVER</span
                                >
                                <div
                                    class="text-surface-900 dark:text-surface-0 font-medium text-2xl"
                                >
                                    {{ props.driver || 0 }}
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-center bg-green-100 dark:bg-green-400/30 rounded-md w-10 h-10"
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

                    <!-- FUEL -->
                    <div
                        class="bg-white dark:bg-surface-900 shadow p-4 rounded-md"
                    >
                        <div class="flex justify-between mb-4">
                            <div>
                                <span
                                    class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                    >FUEL</span
                                >
                                <div
                                    class="text-surface-900 dark:text-surface-0 font-medium text-2xl"
                                >
                                    <span class="text-gray-800">₱</span>
                                    {{ formatNumber(props.fuelTotal) || 0 }}
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-center bg-yellow-100 dark:bg-yellow-400/30 rounded-md w-10 h-10"
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

                    <!-- MAINTENANCE -->
                    <div
                        class="bg-white dark:bg-surface-900 shadow p-4 rounded-md"
                    >
                        <div class="flex justify-between mb-4">
                            <div>
                                <span
                                    class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                    >MAINTENANCE</span
                                >
                                <div
                                    class="text-surface-900 dark:text-surface-0 font-medium text-2xl"
                                >
                                    <span class="text-gray-800">₱</span>
                                    {{
                                        formatNumber(props.maintenanceTotal) ||
                                        0
                                    }}
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-center bg-red-100 dark:bg-red-400/30 rounded-md w-10 h-10"
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

                <!-- Vehicle & Maintenance Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <StatusOverview :operationalData="operationalData" />
                    <MaintenanceOverview :maintenanceData="maintenanceData" />
                </div>

                <!-- Fuel Chart -->
                <div>
                    <FuelChart
                        :litersByDriver="litersByDriver"
                        :litersPerMonth="litersPerMonth"
                        :fuelStats="fuelStats"
                    />
                </div>

                <!-- Expenses Chart -->
                <div>
                    <ExpensesChart :expensesData="expensesData" />
                </div>
            </div>
        </div>

        <div v-else class="py-8 px-4 sm:px-6 lg:px-2">
            <div class="grid grid-cols-4 gap-y-3 gap-x-4">
                <div class="col-span-5">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-3">
                            <div
                                class="bg-white dark:bg-surface-900 shadow p-4 rounded-border rounded-md"
                            >
                                <div class="flex justify-between mb-4">
                                    <div>
                                        <span
                                            class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                            >ASSIGNED RIDES</span
                                        >
                                        <div
                                            class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                        >
                                            {{ props.assignedRides || 0 }}
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center justify-center bg-blue-100 dark:bg-blue-400/30 rounded-border rounded-md w-10 h-10"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="32"
                                            height="32"
                                            viewBox="0 0 24 24"
                                        >
                                            <!-- Icon from All by undefined - undefined -->
                                            <path
                                                fill="currentColor"
                                                d="M3 21q-.425 0-.712-.288T2 20v-8l2.1-6q.15-.45.538-.725T5.5 5H9v1.375q0 .15.013.313T9.05 7h-3.2L4.8 10h6.375l3.35 3.35q-.25.2-.387.5T14 14.5q0 .625.438 1.063T15.5 16q.5 0 .9-.3t.525-.775q.275.05.537.075t.538-.025q.55-.05 1.063-.275t.937-.625V20q0 .425-.288.713T19 21h-1q-.425 0-.712-.288T17 20v-1H5v1q0 .425-.288.713T4 21zm3.5-5q.625 0 1.063-.437T8 14.5t-.437-1.062T6.5 13t-1.062.438T5 14.5t.438 1.063T6.5 16m10.05-3.45l-5.1-5.1q-.2-.2-.325-.488T11 6.376V2.5q0-.625.438-1.062T12.5 1h3.875q.3 0 .588.125t.487.325l5.1 5.1q.425.425.425 1.063t-.425 1.062l-3.875 3.875q-.425.425-1.062.425t-1.063-.425M15 6q.425 0 .713-.288T16 5t-.288-.712T15 4t-.712.288T14 5t.288.713T15 6"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-3">
                            <div
                                class="bg-white dark:bg-surface-900 shadow p-4 rounded-border rounded-md"
                            >
                                <div class="flex justify-between mb-4">
                                    <div>
                                        <span
                                            class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                            >ONGOING RIDES</span
                                        >
                                        <div
                                            class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                        >
                                            {{ props.ongoingRides || 0 }}
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
                                            <!-- Icon from All by undefined - undefined -->
                                            <path
                                                fill="currentColor"
                                                d="M6 12.05q0 .4.05.788t.175.762q.125.425-.025.813t-.525.562q-.4.2-.787.038t-.513-.588q-.2-.575-.288-1.175T4 12.05q0-3.35 2.325-5.7T12 4h.175l-.9-.9Q11 2.825 11 2.4t.275-.7t.7-.275t.7.275l2.6 2.6q.3.3.3.7t-.3.7l-2.6 2.6q-.275.275-.7.275t-.7-.275T11 7.6t.275-.7l.9-.9H12Q9.5 6 7.75 7.763T6 12.05m12-.1q0-.4-.05-.787t-.175-.763q-.125-.425.025-.812t.525-.563q.4-.2.787-.037t.513.587q.2.575.288 1.175t.087 1.2q0 3.35-2.325 5.7T12 20h-.175l.9.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-2.6-2.6q-.3-.3-.3-.7t.3-.7l2.6-2.6q.275-.275.7-.275t.7.275t.275.7t-.275.7l-.9.9H12q2.5 0 4.25-1.762T18 11.95"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-3">
                            <div
                                class="bg-white dark:bg-surface-900 shadow p-4 rounded-border rounded-md"
                            >
                                <div class="flex justify-between mb-4">
                                    <div>
                                        <span
                                            class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                            >COMPLETED RIDES</span
                                        >
                                        <div
                                            class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                        >
                                            {{ props.completedRides || 0 }}
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center justify-center bg-yellow-100 dark:bg-yellow-400/30 rounded-border rounded-md w-10 h-10"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="32"
                                            height="32"
                                            viewBox="0 0 24 24"
                                        >
                                            <!-- Icon from All by undefined - undefined -->
                                            <path
                                                fill="currentColor"
                                                d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2q1.625 0 3.075.475T17.75 3.8L16.3 5.275q-.95-.6-2.025-.937T12 4Q8.675 4 6.337 6.338T4 12t2.338 5.663T12 20q.8 0 1.55-.15t1.45-.425l1.5 1.525q-1.025.5-2.15.775T12 22m7-2v-3h-3v-2h3v-3h2v3h3v2h-3v3zm-8.4-3.4l-4.25-4.25l1.4-1.4l2.85 2.85l10-10.025l1.4 1.4z"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-3">
                            <div
                                class="bg-white dark:bg-surface-900 shadow p-4 rounded-border rounded-md"
                            >
                                <div class="flex justify-between mb-4">
                                    <div>
                                        <span
                                            class="block text-surface-500 dark:text-surface-300 font-medium text-base"
                                            >CANCELLED RIDES</span
                                        >
                                        <div
                                            class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                        >
                                            {{ props.cancelledRide || 0 }}
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center justify-center bg-red-100 dark:bg-red-400/30 rounded-border rounded-md w-10 h-10"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="32"
                                            height="32"
                                            viewBox="0 0 512 512"
                                        >
                                            <!-- Icon from All by undefined - undefined -->
                                            <path
                                                fill="currentColor"
                                                fill-rule="evenodd"
                                                d="M256 42.667c117.821 0 213.334 95.513 213.334 213.333c0 117.821-95.513 213.334-213.334 213.334c-117.82 0-213.333-95.513-213.333-213.334C42.667 138.18 138.18 42.667 256 42.667M85.334 256c0 94.257 76.41 170.667 170.666 170.667c39.44 0 75.754-13.378 104.654-35.843L121.177 151.347C98.71 180.247 85.334 216.56 85.334 256M256 85.334c-39.439 0-75.753 13.377-104.653 35.843l239.477 239.477c22.465-28.9 35.843-65.214 35.843-104.654c0-94.256-76.41-170.666-170.667-170.666"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-5">
                    <div class="col-span-5">
                        <FuelChartDriver
                            :fuelStats="fuelStats"
                            :lastCurrentMonth="lastCurrentMonth"
                        />
                    </div>
                </div>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-5 p-5"
                >
                    <div class="border mt-2 overflow-x-auto">
                        <DataTable
                            v-model:selection="selectedProduct"
                            :value="props.driverTruckUsed"
                            scrollable
                            scrollHeight="200px"
                            dataKey="id"
                            tableStyle="min-width: 50rem"
                            class="h-[20rem]"
                        >
                            <Column
                                header="Tractor / Trailer"
                                style="min-width: 15rem"
                            >
                                <template #body="slotProps">
                                    {{ slotProps.data.vehicle.license_plate }}
                                    /
                                    {{ slotProps.data.trailer.license_plate }}
                                </template>
                            </Column>
                            <Column header="Start Date" style="min-width: 10rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.start_date }}
                                </template></Column
                            >
                            <Column header="End Date" style="min-width: 10rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.end_date }}
                                </template></Column
                            >
                            <Column
                                header="Delivered Location"
                                style="min-width: 10rem"
                                ><template #body="slotProps">
                                    {{ slotProps.data.end_location.address }}
                                </template></Column
                            >
                            <Column header="Status" style="min-width: 10rem">
                                <template #body="slotProps">
                                    <span
                                        class="bg-green-700 p-1 rounded-md text-white"
                                        >{{ slotProps.data.status }}</span
                                    >
                                </template></Column
                            >
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>

        <Sidebar
            v-model:visible="visibleSidebar"
            position="right"
            :baseZIndex="1000"
            :modal="false"
            :dismissable="false"
            :showCloseIcon="false"
            class="chat-sidebar"
        >
            <div class="chat-header flex justify-between items-center p-3">
                <h4 class="text-white text-sm">All Drivers</h4>
                <Button
                    icon="pi pi-times"
                    class="p-button-rounded p-button-text text-white"
                    @click="visibleSidebar = false"
                />
            </div>

            <div class="chat-body p-3">
                <div v-if="props.drivers.length">
                    <div
                        v-for="driver in props.drivers"
                        :key="driver.id"
                        class="driver-card flex justify-between items-center p-2 mb-2"
                    >
                        <div class="text-xs text-white font-medium">
                            {{ driver.first_name }}
                        </div>
                        <Button
                            icon="pi pi-comments"
                            class="p-button-rounded p-button-text text-white"
                            @click="openChat(driver.id)"
                        />
                    </div>
                </div>
                <div v-else class="text-center text-white">
                    No drivers available.
                </div>
            </div>
        </Sidebar>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import StatusOverview from "../Pages/Dashboard/Vehiclestatus.vue";
import MaintenanceOverview from "../Pages/Dashboard/MaintenanceOverview.vue";
import ExpensesChart from "../Pages/Dashboard/ExpensesChart.vue";
import FuelChart from "../Pages/Dashboard/FuelChart.vue";
import FuelChartDriver from "../Pages/Dashboard/FuelChartDriver.vue";
import { ref, onMounted, onBeforeUnmount, watch, h, toRaw } from "vue";
import { Head, usePage, router } from "@inertiajs/vue3";
import AutoComplete from "primevue/autocomplete";

import InputText from "primevue/inputtext";
import Button from "primevue/button";
import ScrollPanel from "primevue/scrollpanel";
import Card from "primevue/card";
import Message from "primevue/message";
import Toast from "primevue/toast";
import Chart from "primevue/chart";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { useToast } from "primevue/usetoast";
import Dialog from "primevue/dialog";
import Sidebar from "primevue/sidebar";

const { props } = usePage();
const toast = useToast();
const user = props.auth.user;
const isAdmin = user.user_type === 1;

const formatNumber = (value) => {
    if (!value && value !== 0) return "-";

    if (value >= 1000000) {
        return (value / 1000000).toFixed(2) + "M";
    } else if (value >= 1000) {
        return (value / 1000).toFixed(2) + "K";
    }
    return value.toString();
};

if (isAdmin) {
    onMounted(() => {
        const notifications = props.notification;

        notifications.forEach((notification) => {
            toast.add({
                severity: "warn",
                summary: "Vehicle Expiration Alert",
                detail: notification.message,
                life: 8000,
                data: {
                    truckId: notification.vehicle_id ?? notification.trailer_id,
                    truckType: notification.trailer_id === null ? "1" : "2",
                },
            });
        });
    });
}

const handleToastClick = (id, type) => {
    router.get(`/registration/edit/${id}/${type}`);
};
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

.custom-toast {
    cursor: pointer;
    max-width: 400px;
}

.toast-header {
    display: flex;
    align-items: center;
}

.toast-content {
    margin-left: 1.5rem; /* offset to align with icon */
}
</style>
