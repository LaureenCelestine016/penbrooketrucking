<template>
    <div
        class="bg-white shadow-lg p-8 rounded-xl flex flex-col justify-center items-center"
    >
        <h3 class="text-xl font-semibold text-gray-700">
            Operational Status Overview
            {{ props.operationalCount }}
        </h3>
        <div ref="vehicleStatusChart" class="w-[90%] h-[420px]"></div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import * as echarts from "echarts";
import { usePage } from "@inertiajs/vue3";

const vehicleStatusChart = ref(null);
const { props } = usePage();

let myChart;

const initChart = () => {
    if (vehicleStatusChart.value) {
        myChart = echarts.init(vehicleStatusChart.value);
        const option = {
            tooltip: { trigger: "item" },
            legend: { top: "5%", left: "center" },
            series: [
                {
                    name: "Operational Status",
                    type: "pie",
                    radius: ["45%", "75%"],
                    center: ["50%", "58%"],
                    data: [
                        {
                            value: props.operationalData.operationalCount,
                            name: "Operational",
                            itemStyle: { color: "#063970" },
                        },
                        {
                            value: props.operationalData.nonOperationalCount,
                            name: "Non-Operational",
                            itemStyle: { color: "#74c0fc" },
                        },
                        {
                            value: props.operationalData.maintenance,
                            name: "Maintenance",
                            itemStyle: { color: "#a5d8ff" },
                        },
                    ],
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
</script>
