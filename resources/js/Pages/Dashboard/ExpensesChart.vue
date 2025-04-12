<template>
    <div class="bg-white shadow-lg p-8 rounded-xl flex flex-col w-full h-full">
        <div class="flex justify-between items-center w-full mb-4">
            <h3
                v-if="!showPerVehicle"
                class="text-xl font-semibold text-gray-700"
            >
                Monthly Expenses Overview
            </h3>
            <h3 v-else class="text-xl font-semibold text-gray-700">
                Truck Expenses Overview
            </h3>
            <div class="w-32">
                <ToggleButton
                    v-model="showPerVehicle"
                    onLabel="Truck"
                    offLabel="Total"
                    onIcon="pi pi-truck"
                    offIcon="pi pi-chart-bar"
                    class="w-full"
                />
            </div>
        </div>
        <div
            ref="monthlyExpensesChart"
            class="w-full h-full min-h-[400px]"
        ></div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch, nextTick } from "vue";
import * as echarts from "echarts";
import { usePage } from "@inertiajs/vue3";
import ToggleButton from "primevue/togglebutton";

const monthlyExpensesChart = ref(null);
const { props } = usePage();
let myChart;

const showPerVehicle = ref(false); // false = total/month, true = stacked per asset

const initChart = () => {
    if (!monthlyExpensesChart.value) return;
    if (!myChart) {
        myChart = echarts.init(monthlyExpensesChart.value);
    }

    const monthNames = [
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

    let series = [];

    if (showPerVehicle.value) {
        // Group by asset (vehicle or trailer) and fill monthly data
        const assetMap = new Map();

        props.expensesData.forEach(
            ({ asset_id, asset_name, month, total_cost }) => {
                if (!assetMap.has(asset_id)) {
                    assetMap.set(asset_id, {
                        name: asset_name,
                        data: Array(12).fill(0),
                    });
                }
                // Convert total_cost to a float before summing
                assetMap.get(asset_id).data[month - 1] +=
                    parseFloat(total_cost);
            }
        );

        series = [...assetMap.values()].map((asset) => ({
            name: asset.name,
            type: "line",
            stack: "total", // key for stacking lines
            smooth: true,
            data: asset.data,
            areaStyle: { opacity: 0.2 },
        }));
    } else {
        // Total expenses per month
        const totalByMonth = Array(12).fill(0);

        props.expensesData.forEach(({ month, total_cost }) => {
            totalByMonth[month - 1] += parseFloat(total_cost);
        });

        series = [
            {
                name: "Total Expenses",
                type: "line",
                smooth: true,
                data: totalByMonth,
                areaStyle: {
                    color: "rgba(0, 123, 255, 0.3)",
                },
                lineStyle: {
                    color: "#213555",
                },
                itemStyle: {
                    color: "#213555",
                },
            },
        ];
    }

    const option = {
        tooltip: {
            trigger: "axis",
        },
        legend: {
            type: "scroll",
        },
        grid: {
            left: 0,
            right: 0,
            bottom: 0,
            top: 50,
            containLabel: true,
        },
        xAxis: {
            type: "category",
            data: monthNames,
            boundaryGap: false,
        },
        yAxis: {
            type: "value",
            name: "Cost",
        },
        series,
    };

    myChart.setOption(option, true);
};

onMounted(() => {
    initChart();
    window.addEventListener("resize", () => myChart?.resize());
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", () => myChart?.resize());
    if (myChart) {
        myChart.dispose();
    }
});

watch([() => props.expensesData, showPerVehicle], () => {
    nextTick(() => {
        initChart();
    });
});
</script>
