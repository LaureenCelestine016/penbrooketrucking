<template>
    <div class="bg-white shadow-lg p-8 rounded-xl flex flex-col w-full h-full">
        <div class="flex justify-between items-center w-full mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Fuel Overview</h3>
        </div>

        <!-- Grid of 4 boxes inside the card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
            <div class="border border-gray-300 rounded-md p-4 min-h-[300px]">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Liters by Driver
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
                        Liters Month
                    </h3>
                </div>
                <div class="flex-1 min-h-0">
                    <div
                        ref="litersPerMonthChart"
                        class="w-full h-full min-h-[300px]"
                    ></div>
                </div>
            </div>
            <div
                class="border border-gray-300 rounded-md p-4 min-h-[300px]"
            ></div>
            <div
                class="border border-gray-300 rounded-md p-4 min-h-[300px]"
            ></div>
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

const litersByDriver = ref(props.litersByDriver || []);
const litersPerMonth = ref(props.litersPerMonth || []);

const LITER_THRESHOLD = 1000; // You can customize this

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
            left: "1%",
            right: "5%",
            top: "5%",
            bottom: "5%",
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
                    color: "#c92a2a", // Red for exceeded liters
                },
            },
        ],
    };

    litersMonthChartInstance.value.setOption(option);
};

// === INIT & DESTROY ===
onMounted(() => {
    nextTick(() => {
        initLitersChart();
        initMonthChart();
    });

    window.addEventListener("resize", () => {
        litersChartInstance.value?.resize();
        litersMonthChartInstance.value?.resize();
    });
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", () => {
        litersChartInstance.value?.resize();
        litersMonthChartInstance.value?.resize();
    });

    litersChartInstance.value?.dispose();
    litersMonthChartInstance.value?.dispose();
});

// === Watch for prop updates ===
watch(litersPerMonth, () => {
    updateMonthChart();
});
</script>
