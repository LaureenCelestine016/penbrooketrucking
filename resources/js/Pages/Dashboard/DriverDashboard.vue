<template>
    <Head title="Dashboard" />
    <Toast />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-8">
                Driver Dashborad
            </h2>
            <div class="flex flex-row items-center gap-x-4 border p-2 rounded">
                <i
                    class="pi pi-arrow-circle-left text-6xl text-[#213555] hover:text-blue-500 cursor-pointer transition-colors duration-200"
                    style="font-size: 3rem"
                    @click="goBack"
                ></i>
                <div class="dark:bg-surface-900 shado flex flex-col">
                    <h2
                        class="text-3xl uppercase font-black text-customblue tracking-widest"
                    >
                        {{ props.driver.first_name }}
                        {{ props.driver.last_name }}
                    </h2>

                    <h2
                        class="text-base uppercase font-thin text-customblue tracking-widest"
                    >
                        {{ props.driver.license_number }}
                    </h2>
                </div>
            </div>
        </template>
        <template #s> </template>
        <div></div>
        <div class="py-8">
            <div class="mx-12 relative">
                <div class="grid grid-cols-4 gap-y-3 gap-x-4">
                    <div class="col-span-5">
                        <div class="grid grid-cols-12 gap-4">
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
                                        {{
                                            slotProps.data.vehicle.license_plate
                                        }}
                                        /
                                        {{
                                            slotProps.data.trailer.license_plate
                                        }}
                                    </template>
                                </Column>
                                <Column
                                    header="Start Date"
                                    style="min-width: 10rem"
                                    ><template #body="slotProps">
                                        {{ slotProps.data.start_date }}
                                    </template></Column
                                >
                                <Column
                                    header="End Date"
                                    style="min-width: 10rem"
                                    ><template #body="slotProps">
                                        {{ slotProps.data.end_date }}
                                    </template></Column
                                >
                                <Column
                                    header="Delivered Location"
                                    style="min-width: 10rem"
                                    ><template #body="slotProps">
                                        {{
                                            slotProps.data.end_location.address
                                        }}
                                    </template></Column
                                >
                                <Column
                                    header="Status"
                                    style="min-width: 10rem"
                                >
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
        </div></AuthenticatedLayout
    >
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FuelChart from "./FuelChart.vue";
import FuelChartDriver from "./FuelChartDriver.vue";

import { ref, onMounted, onBeforeUnmount, watch, nextTick } from "vue";
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
console.log(props);

const goBack = () => {
    window.history.back();
};
</script>
