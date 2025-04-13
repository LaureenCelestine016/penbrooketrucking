<template>
    <div class="bg-white shadow-lg p-8 rounded-xl flex flex-col w-full h-full">
        <div class="flex justify-between items-center w-full mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Fuel Overview</h3>
        </div>

        <!-- Grid of 4 boxes inside the card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
            <div class="h-full space-y-3">
                <!-- Top 3 Cards -->
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-center font-semibold"
                >
                    <!-- Card 1 -->
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{ formatNumber(props.fuelStats.lastYearYTD) }}
                        </div>
                        <div class="text-sm text-gray-500">
                            Total Liter YTD Last Year
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{ formatNumber(props.fuelStats.currentYearYTD) }}
                        </div>
                        <div class="text-sm text-gray-500">Total YTD</div>
                    </div>
                    <!-- Card 3 -->
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{ formatNumber(props.fuelStats.totalFuel) }}
                        </div>
                        <div class="text-sm text-gray-500">Total Fuel</div>
                    </div>
                </div>

                <!-- Chart Full Width -->
                <div
                    class="bg-white rounded-xl p-5 shadow border border-gray-200 w-full h-96 flex flex-col"
                >
                    <div class="items-center mb-2 border-gray-400">
                        <h3 class="text-lg font-semibold text-gray-700">
                            Liter Last Month vs Current Month
                        </h3>
                    </div>
                    <div class="flex-1 min-h-0">
                        <div
                            ref="monthComparisonChart"
                            class="w-full h-full min-h-[150px]"
                        ></div>
                    </div>
                </div>
            </div>

            <div class="border border-gray-300 rounded-md p-4 min-h-[300px]">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-xl font-semibold text-gray-700">
                        {{
                            fuelView === "year"
                                ? "Liters by Year"
                                : "Liters by Month"
                        }}
                    </h3>

                    <div class="flex items-center gap-2">
                        <button
                            v-if="fuelView === 'year'"
                            @click="toggleFuelView"
                            class="bg-navyblue text-white px-3 py-1 text-sm rounded"
                        >
                            View Month
                        </button>
                        <button
                            v-else
                            @click="toggleFuelView"
                            class="bg-navyblue text-white px-3 py-1 text-sm rounded"
                        >
                            View Year
                        </button>
                    </div>
                </div>

                <div class="flex-1 min-h-0">
                    <div
                        ref="fuelChart"
                        class="w-full h-full min-h-[400px]"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, onBeforeUnmount, watch, nextTick } from "vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import * as echarts from "echarts";

const { props } = usePage();

const fuelChart = ref(null);
const fuelChartInstance = ref(null);
const selectedYearObject = ref(null);
const filteredYears = ref([]);
const yearlyData = ref(props.yearlyData || []);
const fuelStatsData = ref([]);
const isYearlyView = ref(false);
const fuelView = ref("month");

const monthComparisonChart = ref(null);
const monthChartInstance = ref(null);

const monthlyComparisonData = ref({
    lastMonth: Number(props.lastCurrentMonth.lastMonthTotalFuel || 0),
    currentMonth: Number(props.lastCurrentMonth.currentMonthTotalFuel || 0),
});

const selectedDriverId = ref(null); // NEW: Track selected driver

const months = [
    { label: "January", value: 1 },
    { label: "February", value: 2 },
    { label: "March", value: 3 },
    { label: "April", value: 4 },
    { label: "May", value: 5 },
    { label: "June", value: 6 },
    { label: "July", value: 7 },
    { label: "August", value: 8 },
    { label: "September", value: 9 },
    { label: "October", value: 10 },
    { label: "November", value: 11 },
    { label: "December", value: 12 },
];

const initSelectedYear = () => {
    const fallbackYear = new Date().getFullYear();
    const year = props.selectedYear ?? fallbackYear;

    selectedYearObject.value = {
        label: year.toString(),
        value: year,
    };
};

const filterYears = (event) => {
    const query = event.query.toLowerCase();
    const availableYears = Array.from({ length: 5 }, (_, i) => {
        const year = new Date().getFullYear() - i;
        return { label: year.toString(), value: year };
    });

    filteredYears.value = availableYears.filter((y) =>
        y.label.toLowerCase().includes(query)
    );
};

const onYearSelect = (event) => {
    selectedYearObject.value = event.value;
    fetchFuelStats();
};

const toggleFuelView = () => {
    isYearlyView.value = !isYearlyView.value;
    fuelView.value = isYearlyView.value ? "year" : "month";
    fetchFuelStats();
};

const onDriverSelect = (driverId) => {
    selectedDriverId.value = driverId;
    fetchFuelStats();
};

const formatNumber = (value) => {
    if (!value && value !== 0) return "-";

    if (value >= 1000000) {
        return (value / 1000000).toFixed(2) + "M";
    } else if (value >= 1000) {
        return (value / 1000).toFixed(2) + "K";
    }
    return value.toString();
};

const fetchFuelStats = async () => {
    try {
        const response = await axios.get(route("dashboard.getFuelStats"), {
            params: {
                view: isYearlyView.value ? "yearly" : "monthly",
                year: selectedYearObject.value.value,
                driver_id: props.driver_id || null, // ✅ Include driver ID if viewing a driver
            },
        });

        fuelStatsData.value = response.data.fuelStats;
        console.log("Fuel Stats:", fuelStatsData.value);

        await nextTick();
        updateFuelChart();
    } catch (error) {
        console.error("Failed to fetch fuel stats:", error);
    }
};

const getChartData = () => {
    if (isYearlyView.value) {
        return fuelStatsData.value.map((d) => Number(d.total_liters));
    } else {
        return months.map((month) => {
            const found = fuelStatsData.value.find(
                (d) => d.month === month.value
            );
            return found ? Number(found.total_liters) : 0;
        });
    }
};

const getXAxisLabels = () => {
    if (isYearlyView.value) {
        return fuelStatsData.value.map((d) => d.year);
    } else {
        return months.map((m) => m.label);
    }
};

const initFuelChart = () => {
    if (fuelChart.value) {
        fuelChartInstance.value = echarts.init(fuelChart.value);
        updateFuelChart();
    }
};

const updateFuelChart = () => {
    if (!fuelChartInstance.value) return;

    const data = getChartData();
    const xAxisLabels = getXAxisLabels();

    const option = {
        tooltip: { trigger: "axis" },
        grid: {
            left: "2%",
            right: "2%",
            top: "10%",
            bottom: 0,
            containLabel: true,
        },
        xAxis: {
            type: "category",
            data: xAxisLabels,
            axisLabel: { fontSize: 12 },
        },
        yAxis: {
            type: "value",
            min: 0,
            splitLine: {
                show: true,
                lineStyle: { color: "#ddd", type: "dashed" },
            },
        },
        series: [
            {
                type: "bar",
                data: data,
                barWidth: "20px",
                itemStyle: {
                    color: "#213555",
                    borderRadius: [4, 4, 0, 0],
                },
                label: {
                    show: true,
                    position: "top",
                    fontSize: 12,
                    fontWeight: "bold",
                    color: "#333",
                },
            },
        ],
    };

    fuelChartInstance.value.setOption(option, true);
};

const initMonthComparisonChart = () => {
    if (monthComparisonChart.value) {
        monthChartInstance.value = echarts.init(monthComparisonChart.value);
        updateMonthComparisonChart();
    }
};

const updateMonthComparisonChart = () => {
    if (!monthChartInstance.value) return;

    const { lastMonth, currentMonth } = monthlyComparisonData.value;

    const option = {
        tooltip: {
            trigger: "axis",
            axisPointer: { type: "shadow" },
        },
        legend: {
            data: ["Last Month", "Current Month"],
            icon: "circle",
            top: -3,
        },
        grid: {
            left: "2%",
            right: "2%",
            top: "20%",
            bottom: "2%",
            containLabel: true,
        },
        xAxis: {
            type: "category",
            data: ["Month Comparison"],
            axisLabel: {
                fontSize: 12,
                color: "#999",
            },
            axisTick: { show: false },
            axisLine: { show: false },
        },
        yAxis: {
            type: "value",
            axisLine: { show: false },
            axisTick: { show: false },
            axisLabel: { show: false },
            splitLine: { show: false },
        },
        series: [
            {
                name: "Last Month",
                type: "bar",
                data: [lastMonth],
                itemStyle: {
                    color: "#213555",
                },
                barGap: 0,
                barWidth: 150,
                label: {
                    show: true,
                    position: "top",
                    fontWeight: "bold",
                    fontSize: 14,
                    color: "#213555",
                    formatter: `{c} L`,
                },
            },
            {
                name: "Current Month",
                type: "bar",
                data: [currentMonth],
                itemStyle: {
                    color: "#74c0fc",
                },
                barWidth: 150,
                label: {
                    show: true,
                    position: "top",
                    fontWeight: "bold",
                    fontSize: 14,
                    color: "#74c0fc",
                    formatter: `{c} L`,
                },
            },
        ],
    };

    monthChartInstance.value.setOption(option);
};

onMounted(() => {
    nextTick(() => {
        initSelectedYear();
        fetchFuelStats();
        initFuelChart();
        initMonthComparisonChart();
    });

    window.addEventListener("resize", () => {
        fuelChartInstance.value?.resize();
        monthChartInstance.value?.resize();
    });
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", () => {
        fuelChartInstance.value?.resize();
        monthChartInstance.value?.resize();
    });

    fuelChartInstance.value?.dispose();
    monthChartInstance.value?.dispose();
});

watch(monthlyComparisonData, () => {
    updateMonthComparisonChart();
});
</script>
