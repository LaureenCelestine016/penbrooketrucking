<template>
    <Head title="Dashboard" />
    <Toast />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isAdmin ? "Admin" : "Driver" }} Dashboard
            </h2>
        </template>

        <div v-if="isAdmin" class="py-8">
            <div class="mx-12">
                <div class="grid grid-cols-4 gap-y-8 gap-x-4">
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
                                            class="flex items-center justify-center bg-orange-100 dark:bg-orange-400/30 rounded-border rounded-md w-10 h-10"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                viewBox="0 0 24 24"
                                            >
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
                                                {{ props.fuelTotal }}
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-center bg-green-100 dark:bg-green-400/30 rounded-border rounded-md w-10 h-10"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                viewBox="0 0 15 15"
                                            >
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
                                                >Maintenance</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-2xl"
                                            >
                                                {{
                                                    props.maintenanceTotal ||
                                                    0.0
                                                }}
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
                        <div class="grid grid-cols-3 gap-x-6">
                            <div
                                class="bg-white shadow p-4 rounded-border h-80"
                            >
                                <h2 class="text-lg font-semibold mb-4">
                                    Truck Utilization
                                </h2>
                                <Chart
                                    type="bar"
                                    :data="truckChartData"
                                    :options="chartOptions"
                                    class="h-[20rem]"
                                />
                            </div>
                            <div
                                class="bg-white shadow p-4 rounded-border h-80"
                            >
                                <h2 class="text-lg font-semibold mb-4">
                                    Fuel Consumption
                                </h2>
                                <Chart
                                    type="line"
                                    :data="fuelChartData"
                                    :options="chartOptions"
                                    class="h-[20rem]"
                                />
                            </div>
                            <div
                                class="bg-white shadow p-4 rounded-border h-80"
                            >
                                <h2 class="text-lg font-semibold mb-4">
                                    Truck Maintenance
                                </h2>
                                <Chart
                                    type="bar"
                                    :data="maintenanceChartData"
                                    :options="chartOptions"
                                    class="h-[20rem]"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="bg-white shadow p-4 rounded-border h-100">
                            <h2 class="text-lg font-semibold mb-4">Expenses</h2>
                            <Chart
                                type="bar"
                                :data="expensesChartData"
                                :options="chartOptions"
                                class="h-[20rem]"
                            />
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="bg-white shadow p-4 rounded-border h-100">
                            <h2 class="text-lg font-semibold mb-4">Reminder</h2>
                            <DataTable
                                v-model:selection="selectedProduct"
                                :value="reminder"
                                dataKey="id"
                                tableStyle="min-width: 50rem"
                                class="h-[20rem]"
                            >
                                <!-- <Column
                                    selectionMode="single"
                                    headerStyle="width: 3rem"
                                ></Column> -->
                                <Column field="code" header="Topic"></Column>
                                <Column
                                    field="name"
                                    header="Description"
                                ></Column>
                            </DataTable>
                        </div>
                    </div>
                    <div class="col-span-5">
                        <div class="bg-white shadow p-4 rounded-border h-100">
                            <div class="flex items-center justify-center">
                                <Button
                                    type="button"
                                    label="TRACK VEHICLE"
                                    class="w-80"
                                    @click="goToTrack"
                                />
                            </div>

                            <!-- <div id="map" class="w-full"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="py-8">
            <div class="mx-12">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">Assigned Rides</h3>
                        <p class="text-2xl font-bold">
                            {{ props.assignedRides }}
                        </p>
                    </div>

                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">Ongoing Rides</h3>
                        <p class="text-2xl font-bold">
                            {{ props.ongoingRides }}
                        </p>
                    </div>

                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">
                            Completed Rides
                        </h3>
                        <p class="text-2xl font-bold">
                            {{ props.completedRides }}
                        </p>
                    </div>

                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">
                            Next Scheduled Ride
                        </h3>
                        <div v-if="props.nextRide">
                            <p class="text-lg">
                                Date:
                                <span class="font-bold">{{
                                    props.nextRide.start_date
                                }}</span>
                            </p>
                            <p class="text-sm">From:</p>
                            <span class="font-bold">{{
                                props.nextRide.start_location.address
                            }}</span>
                            <p class="text-sm">To:</p>
                            <span class="font-bold">{{
                                props.nextRide.end_location.address
                            }}</span>
                        </div>
                        <div v-else>
                            <p class="text-lg font-bold">None</p>
                        </div>
                    </div>
                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">No data</h3>
                        <p class="text-2xl font-bold">
                            {{ props.pendingNotifications }}
                        </p>
                    </div>
                    <!-- Pending Notifications -->
                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">
                            Pending Notifications
                        </h3>
                        <p class="text-2xl font-bold">
                            {{ props.pendingNotifications }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, router } from "@inertiajs/vue3";

import Chart from "primevue/chart";
import { ref, onMounted, watchEffect, computed } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import L from "leaflet";

import Button from "primevue/button";

// const props = defineProps({
//     truck: {
//         type: Number,
//         required: true,
//     },
//     driver: {
//         type: Number,
//         required: true,
//     },
//     fuelTotal: {
//         type: Number,
//         required: true,
//     },
//     maintenanceTotal: {
//         type: Number,
//         required: true,
//     },
//     operationalCount: {
//         type: Number,
//         required: true,
//     },
//     nonOperationalCount: {
//         type: Number,
//         required: true,
//     },
//     maintenance: {
//         type: Number,
//         required: true,
//     },
//     fuelConsumption: {
//         type: Array,
//         required: true,
//     },
//     vehicleMaintenanceCosts: {
//         type: Array,
//         required: true,
//     },
//     monthlyExpenses: {
//         type: Array,
//         required: true,
//     },
// });

const truckChartData = ref(null);
const fuelChartData = ref(null);
const maintenanceChartData = ref(null);
const expensesChartData = ref(null);
const chartOptions = ref({ responsive: true });
const reminder = ref([
    { id: 1, code: "MT-001", name: "Oil Change Reminder" },
    { id: 2, code: "MT-002", name: "Tire Rotation Reminder" },
    { id: 3, code: "MT-003", name: "Brake Inspection Reminder" },
    { id: 4, code: "MT-004", name: "Engine Check Reminder" },
]);

const { props } = usePage();

const user = props.auth.user;
const isAdmin = user.user_type === 1;
let goToTrack;

const handleChartClick = (status) => {
    console.log(status);

    router.get(route("vehicle.filter", { status }));
};

if (isAdmin) {
    const updateCharts = () => {
        truckChartData.value = {
            labels: ["Operational", "Non-Operational", "Maintenance"],
            datasets: [
                {
                    label: "Trucks",
                    backgroundColor: ["#4CAF50", "#FF5252", "#fcc419"],
                    data: [
                        props.operationalCount,
                        props.nonOperationalCount,
                        props.maintenance,
                    ],
                },
            ],
        };

        chartOptions.value = {
            responsive: true,
            maintainAspectRatio: true,
            onClick: (event, elements) => {
                if (elements.length > 0) {
                    const index = elements[0].index; // Get clicked bar index
                    const status = truckChartData.value.labels[index];
                    handleChartClick(status);
                }
            },
        };

        const fuelLabels = props.fuelConsumption.map((item) => item.name);
        const fuelValues = props.fuelConsumption.map((item) => item.total_cost);

        fuelChartData.value = {
            labels: fuelLabels,
            datasets: [
                {
                    label: "Fuel Efficiency (L/km)",
                    borderColor: "#FFA500",
                    data: fuelValues,
                    fill: false,
                },
            ],
        };

        const tructorLabel = props.vehicleMaintenanceCosts.vehicles.map(
            (item) => item.name
        );
        const costTructorValue = props.vehicleMaintenanceCosts.vehicles.map(
            (item) => item.total_cost
        );

        const trailerLabel = props.vehicleMaintenanceCosts.trailers.map(
            (item) => item.name
        );

        const costTrailerValue = props.vehicleMaintenanceCosts.trailers.map(
            (item) => item.total_cost
        );

        const tructLabel = [...tructorLabel, ...trailerLabel];
        const cost = [...costTructorValue, ...costTrailerValue];
        maintenanceChartData.value = {
            labels: tructLabel,
            datasets: [
                {
                    label: "Maintenance Count",
                    backgroundColor: "#3498db",
                    data: cost,
                    fill: false,
                },
            ],
        };

        const labels = computed(() => [
            ...new Set(props.monthlyExpenses.map((expense) => expense.month)),
        ]);

        const categoryNames = computed(() => [
            ...new Set(
                props.monthlyExpenses.map((expense) => expense.category_name)
            ),
        ]);

        expensesChartData.value = {
            labels: labels.value,
            datasets: categoryNames.value.map((category) => ({
                label: category,
                backgroundColor: category === "Fuel" ? "#66a80f" : "#ffa94d", // Add more colors if needed
                data: labels.value.map((month) => {
                    const expense = props.monthlyExpenses.find(
                        (e) => e.month === month && e.category_name === category
                    );
                    return expense ? expense.total_cost : 0;
                }),
            })),
        };
    };

    onMounted(updateCharts);

    watchEffect(() => {
        updateCharts();
    });

    goToTrack = () => {
        window.open(
            "https://www.tracksolidpro.com/resource/dev/index.html?t=241834#/monitorObject",
            "_blank",
            "noopener,noreferrer"
        );
    };
}

// const location = () => {
//     const map = ref(null);

//     if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(
//             function (position) {
//                 const { latitude } = position.coords;
//                 const { longitude } = position.coords;

//                 // const coords = [latitude, longitude];
//                 const coords = [latitude, longitude];

//                 // Initialize the map
//                 map.value = L.map("map").setView(coords, 13);

//                 // Add a tile layer to the map
//                 L.tileLayer(
//                     "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
//                 ).addTo(map.value);

//                 // Add a marker to the map
//                 L.marker(coords)
//                     .addTo(map.value)
//                     .bindPopup("You are here!")
//                     .openPopup();
//             },
//             function () {
//                 alert(`Could not get your position`);
//             }
//         );
//     }
// };

// onMounted(() => {
//     location();
// });
</script>

<style scoped>
.chart-container {
    width: 100%;
    max-width: 600px;
    margin: auto;
}
</style>
