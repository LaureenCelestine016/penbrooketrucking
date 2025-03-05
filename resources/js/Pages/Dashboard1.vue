<template>
    <Head title="Dashboard" />
    <Toast />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isAdmin ? 'Admin' : 'Driver' }} Dashboard
            </h2>
        </template>

        <!-- Admin Dashboard -->
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
                                                {{ props.truck }}
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-center bg-blue-100 dark:bg-blue-400/30 rounded-border rounded-md w-10 h-10"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="28"
                                                height="28"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill="#1054da"
                                                    d="M7 20q-1.25 0-2.125-.875T4 17H2.725q-.425 0-.713-.288T1.725 16t.288-.712t.712-.288h2.05q.425-.475 1-.737T7 14t1.225.263t1 .737H13.4l2.1-9H5.75q-.425 0-.712-.288T4.75 5t.288-.712T5.75 4h11q.5 0 .8.375t.175.85L17.075 8H19q.475 0 .9.213t.7.587l1.875 2.475q.275.35.35.763t0 .837L22.15 16.2q-.075.35-.35.575t-.625.225H20q0 1.25-.875 2.125T17 20t-2.125-.875T14 17h-4q0 1.25-.875 2.125T7 20m8.925-7h4.825l.1-.525L19 10h-2.375zm-2.475 1.825l.163-.725q.162-.725.412-1.775q.075-.325.15-.6t.125-.55l.163-.725q.162-.725.412-1.775t.413-1.775l.162-.725L15.5 6l-2.1 9zm-11.7-1.5q-.425 0-.712-.287t-.288-.713t.288-.712t.712-.288h3.5q.425 0 .713.288t.287.712t-.288.713t-.712.287zm2-3.65q-.425 0-.712-.288t-.288-.712t.288-.712t.712-.288h4.5q.425 0 .713.288t.287.712t-.288.713t-.712.287zM7 18q.425 0 .713-.288T8 17t-.288-.712T7 16t-.712.288T6 17t.288.713T7 18m10 0q.425 0 .713-.288T18 17t-.288-.712T17 16t-.712.288T16 17t.288.713T17 18"
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
                                    class="bg-white dark:bg-surface-900 shadow p-4 rounded-border"
                                >
                                    <div class="flex justify-between mb-4">
                                        <div>
                                            <span
                                                class="block text-surface-500 dark:text-surface-300 font-medium mb-4"
                                            >Driver</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-xl"
                                            >
                                                0
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-center bg-orange-100 dark:bg-orange-400/30 rounded-border w-10 h-10"
                                        >
                                            <i
                                                class="pi pi-map-marker text-orange-500 dark:text-orange-200 !text-xl"
                                            />
                                        </div>
                                    </div>
                                    <span class="text-green-500 font-medium"
                                    >%52+
                                    </span>
                                    <span
                                        class="text-surface-500 dark:text-surface-300"
                                    >since last week</span
                                    >
                                </div>
                            </div>
                            <div
                                class="col-span-12 md:col-span-6 lg:col-span-3"
                            >
                                <div
                                    class="bg-white dark:bg-surface-900 shadow p-4 rounded-border"
                                >
                                    <div class="flex justify-between mb-4">
                                        <div>
                                            <span
                                                class="block text-surface-500 dark:text-surface-300 font-medium mb-4"
                                            >Fuel</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-xl"
                                            >
                                                0.00
                                            </div>
                                        </div>
                                        <div
                                            class="w-10 h-10 flex items-center justify-center bg-cyan-100 dark:bg-cyan-400/30 rounded-border"
                                        >
                                            <i
                                                class="pi pi-inbox text-cyan-500 dark:text-cyan-200 !text-xl"
                                            />
                                        </div>
                                    </div>
                                    <span class="text-green-500 font-medium"
                                    >520
                                    </span>
                                    <span
                                        class="text-surface-500 dark:text-surface-300"
                                    >newly registered</span
                                    >
                                </div>
                            </div>
                            <div
                                class="col-span-12 md:col-span-6 lg:col-span-3"
                            >
                                <div
                                    class="bg-white dark:bg-surface-900 shadow p-4 rounded-border"
                                >
                                    <div class="flex justify-between mb-4">
                                        <div>
                                            <span
                                                class="block text-surface-500 dark:text-surface-300 font-medium mb-4"
                                            >Maintenance</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-xl"
                                            >
                                                0.00
                                            </div>
                                        </div>
                                        <div
                                            class="w-10 h-10 flex items-center justify-center bg-purple-100 dark:bg-purple-400/30 rounded-border"
                                        >
                                            <i
                                                class="pi pi-comment text-purple-500 dark:text-purple-200 !text-xl"
                                            />
                                        </div>
                                    </div>
                                    <span class="text-green-500 font-medium"
                                    >85
                                    </span>
                                    <span
                                        class="text-surface-500 dark:text-surface-300"
                                    >responded</span
                                    >
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
                                <h2 class="text-lg font-semibold">
                                    Maintenance Trends
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
\
                    <div class="col-span-3 bg-blue-500">3</div>
                    <div class="bg-pink-500">4</div>
                </div>
            </div>
        </div>

        <!-- Driver Dashboard -->
        <div v-else class="py-8">
            <div class="mx-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">Assigned Rides</h3>
                        <p class="text-2xl font-bold">{{ props.assignedRides }}</p>
                    </div>

                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">Ongoing Rides</h3>
                        <p class="text-2xl font-bold">{{ props.ongoingRides }}</p>
                    </div>

                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">Completed Rides</h3>
                        <p class="text-2xl font-bold">{{ props.completedRides }}</p>
                    </div>

                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">Next Scheduled Ride</h3>
                        <div v-if="props.nextRide">
                            <p class="text-lg">
                                Date: <span class="font-bold">{{ props.nextRide.start_date }}</span>
                            </p>
                            <p class="text-sm">
                                From: <span class="font-medium">{{ props.nextRide.start_location }}</span>
                            </p>
                            <p class="text-sm">
                                To: <span class="font-medium">{{ props.nextRide.end_location }}</span>
                            </p>
                        </div>
                        <div v-else>
                            <p class="text-lg font-bold">None</p>
                        </div>
                    </div>
                    <!-- Pending Notifications -->
                    <div class="bg-white shadow p-4 rounded">
                        <h3 class="text-lg font-medium mb-2">Pending Notifications</h3>
                        <p class="text-2xl font-bold">{{ props.pendingNotifications }}</p>
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
                            <h2 class="text-lg font-semibold mb-4">Map</h2>
                            <div id="map" class="w-full"></div>
                        </div>

                    <div class="col-span-3 bg-blue-500">3</div>
                    <div class="bg-pink-500">4</div>

                </div>
            </div>
        </div>

        <!-- Driver Dashboard -->

    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted, watchEffect } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import Toast from "primevue/toast";
import Chart from "primevue/chart";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const { props } = usePage();
const user = props.auth.user;
const isAdmin = user.user_type === 1;


import { ref, onMounted, watchEffect, computed } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import L from "leaflet";

const props = defineProps({
    truck: {
        type: Number,
        required: true,
    },
    driver: {
        type: Number,
        required: true,
    },
    fuelTotal: {
        type: Number,
        required: true,
    },
    maintenanceTotal: {
        type: Number,
        required: true,
    },
    operationalCount: {
        type: Number,
        required: true,
    },
    nonOperationalCount: {
        type: Number,
        required: true,
    },
    maintenance: {
        type: Number,
        required: true,
    },
    fuelConsumption: {
        type: Array,
        required: true,
    },
    vehicleMaintenanceCosts: {
        type: Array,
        required: true,
    },
    monthlyExpenses: {
        type: Array,
        required: true,
    },
});

// Admin dashboard chart data props
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

// Only update charts if admin data exists
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

const location = () => {
    const map = ref(null);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const { latitude } = position.coords;
                const { longitude } = position.coords;

                // const coords = [latitude, longitude];
                const coords = [latitude, longitude];

                // Initialize the map
                map.value = L.map("map").setView(coords, 13);

                // Add a tile layer to the map
                L.tileLayer(
                    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                ).addTo(map.value);

                // Add a marker to the map
                L.marker(coords)
                    .addTo(map.value)
                    .bindPopup("You are here!")
                    .openPopup();
            },
            function () {
                alert(`Could not get your position`);
            }
        );
    }
};

onMounted(() => {
    location();
});

    onMounted(updateCharts);
    watchEffect(() => {
        updateCharts();
    });

</script>

<style scoped>
.chart-container {
    width: 100%;
    max-width: 600px;
    margin: auto;
}
</style>

