<template>
    <div class="bg-white shadow-lg p-8 rounded-xl flex flex-col w-full h-full">
        <div class="flex justify-between items-center w-full mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Fuel Overview</h3>
        </div>

        <!-- Grid of 4 boxes inside the card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
            <div class="h-full">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-center font-semibold h-full"
                >
                    <!-- Card Template -->
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center h-full"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{ formatNumber(props.fuelStats.lastYearYTD) }}
                        </div>
                        <div class="text-sm text-gray-500">
                            Total Liter YTD Last Year
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center h-full"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{ formatNumber(props.fuelStats.currentYearYTD) }}
                        </div>
                        <div class="text-sm text-gray-500">Total YTD</div>
                    </div>
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center h-full"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{ formatPercentage(props.fuelStats.totalGrowth) }}
                        </div>
                        <div class="text-sm text-gray-500">Total Growth</div>
                    </div>
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center h-full"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{
                                formatNumber(props.fuelStats.sameMonthLastYear)
                            }}
                        </div>
                        <div class="text-sm text-gray-500">
                            Same Month in Last Year
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center h-full"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{ formatNumber(props.fuelStats.currentMonth) }}
                        </div>
                        <div class="text-sm text-gray-500">Current Month</div>
                    </div>
                    <div
                        class="bg-white rounded-xl p-5 shadow text-center border border-gray-200 flex flex-col justify-center h-full"
                    >
                        <div class="text-3xl font-bold text-gray-900">
                            {{
                                formatPercentage(props.fuelStats.monthlyGrowth)
                            }}
                        </div>
                        <div class="text-sm text-gray-500">
                            YTY Monthly Growth
                        </div>
                    </div>
                </div>
            </div>
            <div class="border border-gray-300 rounded-md p-4 min-h-[300px]">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Liter by Driver
                    </h3>
                </div>
                <div class="flex-1 min-h-0">
                    <div
                        ref="litersDriverChart"
                        class="w-full h-full min-h-[300px]"
                    ></div>
                </div>
            </div>
            <div class="border border-gray-300 rounded-md p-4 min-h-[300px]">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Liter by Month
                    </h3>
                </div>
                <div class="flex-1 min-h-0">
                    <div
                        ref="litersPerMonthChart"
                        class="w-full h-full min-h-[300px]"
                    ></div>
                </div>
            </div>

            <div class="border border-gray-300 rounded-md p-4 min-h-[300px]">
                <div class="flex flex-col space-y-6">
                    <!-- YTD Comparison -->
                    <div class="flex flex-col">
                        <div class="items-center mb-2 border-b border-gray-400">
                            <h3 class="text-lg font-semibold text-gray-700">
                                Total Liter YTD Last Year vs Total YTD
                            </h3>
                        </div>
                        <div class="flex-1 min-h-0">
                            <div
                                ref="ytdComparisonChart"
                                class="w-full h-full min-h-[150px]"
                            ></div>
                        </div>
                    </div>

                    <!-- Month Comparison -->
                    <div>
                        <div class="mb-2 border-b border-gray-400">
                            <h3 class="text-lg font-semibold text-gray-700">
                                Same Month in Last Year vs Current Month
                            </h3>
                        </div>
                        <div class="min-h-[150px] w-full">
                            <div
                                ref="monthComparisonChart"
                                class="w-full h-full min-h-[150px]"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, onBeforeUnmount, watch, nextTick } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import * as echarts from "echarts";

const { props } = usePage();

const litersDriverChart = ref(null);
const litersPerMonthChart = ref(null);

const litersChartInstance = ref(null);
const litersMonthChartInstance = ref(null);

const ytdComparisonChart = ref(null);
const ytdChartInstance = ref(null);

const monthComparisonChart = ref(null);
const monthChartInstance = ref(null);

const litersByDriver = ref(props.litersByDriver || []);
const litersPerMonth = ref(props.litersPerMonth || []);
const ytdComparisonData = ref({
    lastYearYTD: Number(props.fuelStats.lastYearYTD || 0),
    currentYearYTD: Number(props.fuelStats.currentYearYTD || 0),
    sameMonthLastYear: Number(props.fuelStats.sameMonthLastYear || 0),
    currentMonth: Number(props.fuelStats.currentMonth || 0),
});

const LITER_THRESHOLD = 1000; // You can customize this

const formatNumber = (value) => {
    if (!value && value !== 0) return "-";

    if (value >= 1000000) {
        return (value / 1000000).toFixed(2) + "M";
    } else if (value >= 1000) {
        return (value / 1000).toFixed(2) + "K";
    }
    return value.toString();
};

const formatPercentage = (value) => {
    if (value === null || value === undefined || isNaN(value)) return "-";
    return value.toFixed(2) + "%";
};

// === DRIVER CHART ===
const initLitersChart = () => {
    if (litersDriverChart.value) {
        litersChartInstance.value = echarts.init(litersDriverChart.value);
        litersChartInstance.value.on("click", onDriverBarClick);
        updateLitersChart();
    }
};

const updateLitersChart = () => {
    if (!litersChartInstance.value) return;

    // Dynamically adjust chart height based on number of drivers
    const chartHeight = litersByDriver.value.length * 28;
    litersChartInstance.value.getDom().style.height = `${chartHeight}px`;
    litersChartInstance.value.resize();

    const option = {
        tooltip: { trigger: "axis" },
        grid: {
            left: "1%",
            right: "6%",
            top: "5%",
            bottom: "5%",
            containLabel: true,
        },
        xAxis: {
            type: "value",
            name: "Liters",
            axisLabel: { fontSize: 12 },
        },
        yAxis: {
            type: "category",
            data: litersByDriver.value.map((driver) => driver.last_name),
            axisLabel: { fontSize: 12 },
        },
        series: [
            {
                name: "Total Liters",
                type: "bar",
                data: litersByDriver.value.map((driver) => ({
                    value: parseFloat(driver.total_liters),
                    driverId: driver.id,
                })),
                barWidth: "20px",
                itemStyle: {
                    borderRadius: [0, 4, 4, 0],
                },
                label: { show: false },
            },
        ],
        color: ["#213555"],
    };

    litersChartInstance.value.setOption(option);
};

const onDriverBarClick = (params) => {
    const driverId = params.data.driverId;
    router.visit(route("dashboard.driver", { id: driverId }));
};

// === MONTHLY CHART ===
const initMonthChart = () => {
    if (litersPerMonthChart.value) {
        litersMonthChartInstance.value = echarts.init(
            litersPerMonthChart.value
        );
        updateMonthChart();
    }
};

const updateMonthChart = () => {
    if (!litersMonthChartInstance.value) return;

    const allMonths = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    const monthDataMap = {};
    litersPerMonth.value.forEach((item) => {
        monthDataMap[item.month] = parseFloat(item.total_liters);
    });

    const fullMonthData = allMonths.map((month) => {
        const liters = monthDataMap[month] || 0;
        const exceededLiters =
            liters > LITER_THRESHOLD ? liters - LITER_THRESHOLD : 0;
        const normalLiters =
            liters <= LITER_THRESHOLD ? liters : LITER_THRESHOLD;

        return {
            normal: normalLiters,
            exceeded: exceededLiters,
            normalLabel:
                liters <= LITER_THRESHOLD
                    ? `${liters} L`
                    : `${LITER_THRESHOLD} Liters`,
            exceededLabel:
                exceededLiters > 0
                    ? `+${exceededLiters} Liters (Limit Exceeded)`
                    : "",
            itemStyleNormal: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                    { offset: 0, color: "#22c55e" }, // Green
                    { offset: 1, color: "#34d399" }, // Lighter Green
                ]),
            },
            itemStyleExceeded: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                    { offset: 0, color: "#f87171" }, // Red
                    { offset: 1, color: "#fca5a5" }, // Lighter Red
                ]),
            },
        };
    });

    const option = {
        tooltip: { trigger: "axis" },
        grid: {
            left: "2%",
            right: "3%",
            top: "12%",
            bottom: "0%",
            containLabel: true,
        },
        xAxis: {
            type: "category",
            data: allMonths,
            axisLabel: { fontSize: 12 },
        },
        yAxis: {
            type: "value",
            name: "Liters",
            axisLabel: { fontSize: 12 },
        },
        series: [
            {
                name: "Normal Liters",
                type: "bar",
                stack: "total",
                data: fullMonthData.map((data) => data.normal),
                barWidth: "60%",
                label: {
                    show: true,
                    position: "top",
                    formatter: (params) => {
                        return fullMonthData[params.dataIndex].normalLabel; // Display normal liters
                    },
                },
                itemStyle: {
                    color: "#213555", // Green for normal liters
                },
            },
            {
                name: "Exceeded Liters",
                type: "bar",
                stack: "total",
                data: fullMonthData.map((data) => data.exceeded),
                barWidth: "60%",
                label: {
                    show: true,
                    position: "top",
                    formatter: (params) => {
                        return (
                            fullMonthData[params.dataIndex].exceededLabel || ""
                        ); // Display message if exceeded
                    },
                },
                itemStyle: {
                    color: "#ff6b6b", // Red for exceeded liters
                },
            },
        ],
    };

    litersMonthChartInstance.value.setOption(option);
};

const initYTDChart = () => {
    if (ytdComparisonChart.value) {
        ytdChartInstance.value = echarts.init(ytdComparisonChart.value);
        updateYTDChart();
    }
};

const updateYTDChart = () => {
    if (!ytdChartInstance.value) return;

    const { lastYearYTD, currentYearYTD } = ytdComparisonData.value;

    const option = {
        tooltip: {
            trigger: "axis",
            axisPointer: { type: "shadow" },
        },
        legend: {
            data: ["Last Year", "Current Year"],
            icon: "circle",
            top: -3,
        },
        grid: {
            left: "2%",
            right: "2%",
            top: "20%", // Adjusted to move chart downward
            bottom: "0%",
            containLabel: true,
        },
        xAxis: {
            type: "category",
            data: ["YTD Comparison"],
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
                name: "Last Year",
                type: "bar",
                data: [lastYearYTD],
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
                name: "Current Year",
                type: "bar",
                data: [currentYearYTD],
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

    ytdChartInstance.value.setOption(option);
};

const initMonthComparisonChart = () => {
    if (monthComparisonChart.value) {
        monthChartInstance.value = echarts.init(monthComparisonChart.value);
        updateMonthComparisonChart();
    }
};

const updateMonthComparisonChart = () => {
    if (!monthChartInstance.value) return;

    const { sameMonthLastYear, currentMonth } = ytdComparisonData.value;

    const option = {
        tooltip: {
            trigger: "axis",
            axisPointer: { type: "shadow" },
        },
        legend: {
            data: ["Last Year", "Current Month"],
            icon: "circle",
            top: -3,
        },
        grid: {
            left: "2%",
            right: "2%",
            top: "20%",
            bottom: "5%",
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
                name: "Last Year",
                type: "bar",
                data: [sameMonthLastYear],
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

// === INIT & DESTROY ===
onMounted(() => {
    nextTick(() => {
        initLitersChart();
        initMonthChart();
        initYTDChart();
        initMonthComparisonChart();
    });

    window.addEventListener("resize", () => {
        litersChartInstance.value?.resize();
        litersMonthChartInstance.value?.resize();
        ytdChartInstance.value?.resize();
        monthChartInstance.value?.resize();
    });
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", () => {
        litersChartInstance.value?.resize();
        litersMonthChartInstance.value?.resize();
        ytdChartInstance.value?.resize();
        monthChartInstance.value?.resize();
    });

    litersChartInstance.value?.dispose();
    litersMonthChartInstance.value?.dispose();
    ytdChartInstance.value?.dispose();
    monthChartInstance.value?.dispose();
});

// === Watch for prop updates ===
watch(litersPerMonth, () => {
    updateMonthChart();
});

watch(ytdComparisonData, () => {
    updateYTDChart();
    updateMonthComparisonChart();
});
</script>
