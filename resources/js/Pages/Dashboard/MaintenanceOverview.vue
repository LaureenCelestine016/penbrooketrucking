<template>
    <div class="bg-white shadow-lg p-4 rounded-xl flex flex-col h-full">
        <!-- Header -->
        <div
            class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-4"
        >
            <h3 class="text-lg md:text-xl font-semibold text-gray-700">
                Maintenance Overview
            </h3>

            <div class="w-full md:w-40">
                <AutoComplete
                    id="year"
                    v-model="selectedYearObject"
                    :suggestions="filteredYears"
                    @complete="filterYears"
                    placeholder="Select Year"
                    dropdown
                    optionLabel="label"
                    @item-select="onYearSelect"
                    class="text-sm w-full"
                />
            </div>
        </div>

        <!-- Chart -->
        <div class="flex-1 min-h-[300px] md:min-h-[400px]">
            <div ref="maintenanceChart" class="w-full h-full"></div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, onBeforeUnmount, nextTick } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import * as echarts from "echarts";
import AutoComplete from "primevue/autocomplete";
import axios from "axios"; // if not already imported

const { props } = usePage();
const maintenanceChart = ref(null);
const maintenanceChartInstance = ref(null);
const selectedYearObject = ref(null); // Object format for AutoComplete
const filteredYears = ref([]);

const yearlyData = ref(props.yearlyData || []);
const maintenanceData = ref([]);
const isYearlyView = ref(true);

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
    selectedYearObject.value = {
        label: props.selectedYear.toString(),
        value: props.selectedYear,
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
    console.log(event);

    selectedYearObject.value = event.value;

    fetchMonthlyData(selectedYearObject.value.value);
};

const fetchMonthlyData = async (year) => {
    try {
        const response = await axios.get(
            route("dashboard.getMaintenanceCost", { year })
        );
        maintenanceData.value = response.data.maintenanceData;
        await nextTick();
        isYearlyView.value = false;
        updateMaintenanceChart();
    } catch (error) {
        console.error("Failed to fetch maintenance data:", error);
    }
};

const getChartData = () => {
    if (isYearlyView.value) {
        return yearlyData.value.map((year) => ({
            name: year.year,
            value: year.total_cost,
        }));
    } else {
        return months.map((month) => {
            const found = maintenanceData.value.find(
                (d) => d.month === month.value
            );
            return found ? found.total_cost : 0;
        });
    }
};

const onChartClick = (params) => {
    if (isYearlyView.value) {
        selectedYearObject.value = {
            label: params.name,
            value: parseInt(params.name),
        };
        fetchMonthlyData(selectedYearObject.value.value);
    } else {
        isYearlyView.value = true;
        updateMaintenanceChart();
    }
};

const initMaintenanceChart = () => {
    if (maintenanceChart.value) {
        maintenanceChartInstance.value = echarts.init(maintenanceChart.value);
        maintenanceChartInstance.value.on("click", onChartClick);
        updateMaintenanceChart();
    }
};

const updateMaintenanceChart = () => {
    if (!maintenanceChartInstance.value) return;

    const data = getChartData();
    const isYearly = isYearlyView.value;

    const option = {
        tooltip: { trigger: "axis" },
        grid: {
            left: "2%",
            right: "2%",
            top: "5%",
            bottom: "5%",
            containLabel: true,
        },
        xAxis: {
            type: "category",
            data: isYearly
                ? yearlyData.value.map((y) => y.year)
                : months.map((m) => m.label),
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
                data: isYearly ? data.map((y) => y.value) : data,
                barWidth: "40px",
                itemStyle: { color: "#213555", borderRadius: [4, 4, 0, 0] },
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

    maintenanceChartInstance.value.setOption(option, true);
};

onMounted(() => {
    initSelectedYear();
    initMaintenanceChart();
    window.addEventListener("resize", () =>
        maintenanceChartInstance.value?.resize()
    );
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", () =>
        maintenanceChartInstance.value?.resize()
    );
    if (maintenanceChartInstance.value)
        maintenanceChartInstance.value.dispose();
});
</script>
