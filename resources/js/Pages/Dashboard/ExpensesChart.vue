<template>
    <div
        class="bg-white shadow-lg p-8 rounded-xl flex flex-col justify-center items-center w-full"
    >
        <h3 class="text-xl font-semibold text-gray-700">
            Monthly Expenses Overview
        </h3>
        <div ref="monthlyExpensesChart" class="w-full h-[420px]"></div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from "vue";
import * as echarts from "echarts";
import { usePage } from "@inertiajs/vue3";

const monthlyExpensesChart = ref(null);
const { props } = usePage();
let myChart;

const initChart = () => {
    if (monthlyExpensesChart.value) {
        myChart = echarts.init(monthlyExpensesChart.value);

        // Extract month labels and total costs
        const months = props.expensesData.map(
            (e) => `${e.year}-${String(e.month).padStart(2, "0")}`
        );
        const costs = props.expensesData.map((e) => e.total_cost);

        const option = {
            title: {
                text: "Monthly Expenses",
                left: "center",
            },
            tooltip: {
                trigger: "axis",
                axisPointer: {
                    type: "cross",
                    label: {
                        backgroundColor: "#6a7985",
                    },
                },
            },
            xAxis: {
                type: "category",
                data: months,
                axisLabel: {
                    rotate: 45,
                },
            },
            yAxis: {
                type: "value",
                name: "Cost ($)",
            },
            series: [
                {
                    data: costs,
                    type: "line",
                    smooth: true,
                    areaStyle: {
                        color: "rgba(0, 123, 255, 0.3)",
                    },
                    lineStyle: {
                        color: "#007bff",
                    },
                    itemStyle: {
                        color: "#007bff",
                    },
                },
            ],
            dataZoom: [
                {
                    type: "inside",
                    start: 0,
                    end: 50, // Show first 50% of data initially
                },
                {
                    type: "slider",
                    start: 0,
                    end: 50,
                },
            ],
        };

        myChart.setOption(option);
    }
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

// Re-initialize chart when expenses data changes
watch(
    () => props.expensesData,
    () => {
        initChart();
    }
);
</script>
