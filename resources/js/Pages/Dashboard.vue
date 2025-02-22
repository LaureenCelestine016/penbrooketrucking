<template>
    <Head title="Dashboard" />
    <Toast />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-12">
                <div class="grid grid-cols-4 gap-y-8 gap-x-4">
                    <div class="col-span-5">
                        <div class="grid grid-cols-12 gap-4">
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
                                                >Truck</span
                                            >
                                            <div
                                                class="text-surface-900 dark:text-surface-0 font-medium !text-xl"
                                            >
                                                0
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-center bg-blue-100 dark:bg-blue-400/30 rounded-border w-10 h-10"
                                        >
                                            <i
                                                class="pi pi-shopping-cart text-blue-500 dark:text-blue-200 !text-xl"
                                            />
                                        </div>
                                    </div>
                                    <span class="text-green-500 font-medium"
                                        >24 new
                                    </span>
                                    <span
                                        class="text-surface-500 dark:text-surface-300"
                                        >since last visit</span
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
                                class="bg-white shadow p-4 rounded-border h-64"
                            >
                                <Chart
                                    type="bar"
                                    :data="chartData"
                                    :options="chartOptions"
                                    class=""
                                />
                            </div>
                            <div
                                class="bg-white shadow p-4 rounded-border flex justify-center"
                            >
                                <Chart
                                    type="pie"
                                    :data="chartData"
                                    :options="chartOptions"
                                />
                            </div>
                            <div class="p-2 bg-white"></div>
                        </div>
                    </div>
                    <div class="col-span-3 bg-blue-500">3</div>
                    <div class="bg-pink-500">4</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Toast from "primevue/toast";
import Chart from "primevue/chart";
import { ref, onMounted } from "vue";

const props = defineProps({
    operationalCount: {
        type: Number,
        required: true,
    },
    nonOperationalCount: {
        type: Number,
        required: true,
    },
});

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    try {
        const documentStyle = getComputedStyle(document.documentElement);

        return {
            labels: ["Operational", "Non-Operational"],
            datasets: [
                {
                    label: "Truck Status",
                    backgroundColor: ["#4CAF50", "#FF5252"],
                    borderColor: ["#4CAF50", "#FF5252"],
                    data: [props.operationalCount, props.nonOperationalCount],
                },
            ],
        };

        setChartOptions();
    } catch (error) {
        console.error("Error fetching truck data:", error);
    }
};

const setChartOptions = () => {
    chartOptions.value = {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: "top",
            },
        },
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    };
};
</script>

<style scoped>
.chart-container {
    width: 100%;
    max-width: 600px;
    margin: auto;
}
</style>
