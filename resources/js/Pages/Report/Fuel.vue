<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Fuel Report
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md p-4">
                <div class="card flex gap-4 justify-between mb-5">
                    <DatePicker
                        v-model="dates"
                        selectionMode="range"
                        :manualInput="false"
                        placeholder="Select Date Range"
                        showIcon
                        disabled="true"
                    />
                    <Button
                        icon="pi pi-refresh"
                        label="Refresh"
                        class="w-[100px]"
                        @click="refresh"
                    />
                </div>

                <div class="mb-5 flex flex-row w-full">
                    <AutoComplete
                        v-model="driver"
                        dropdown
                        :suggestions="drivers"
                        optionLabel="full_name"
                        @complete="searchDrivers"
                        placeholder="Select Driver"
                        class="w-full"
                    />
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Vehicle Selection -->
                    <AutoComplete
                        v-model="vehicle"
                        dropdown
                        :suggestions="vehicles"
                        optionLabel="license_plate"
                        @complete="searchVehicles"
                        placeholder="Select Vehicle"
                    />

                    <InputNumber
                        v-model="form.liters"
                        placeholder="Min Liters"
                        class="w-full"
                    />

                    <!-- Generate Report Button -->
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Vehicle Selection -->
                    <InputNumber
                        v-model="form.min_cost"
                        placeholder="Min Cost"
                        mode="currency"
                        currency="PHP"
                        class="w-full"
                    />

                    <!-- Max Cost -->
                    <InputNumber
                        v-model="form.max_cost"
                        placeholder="Max Cost"
                        mode="currency"
                        currency="PHP"
                        class="w-full"
                    />

                    <!-- Generate Report Button -->
                </div>
                <Button
                    @click="submitForm"
                    label="Generate Report"
                    class="p-button-primary w-full mt-5"
                    :disabled="!isDisabled"
                />

                <!-- Data Table -->
                <DataTable
                    :value="fuelFilter"
                    ref="dt"
                    tableStyle="min-width: 50rem"
                    class="mt-6"
                >
                    <template #header>
                        <div class="flex flex-row gap-2 justify-end pb-4">
                            <Button
                                icon="pi pi-file-pdf"
                                label="PDF"
                                severity="danger"
                                class="w-[100px]"
                                @click="exportPDF"
                            />
                            <Button
                                icon="pi pi-external-link"
                                label="Export"
                                @click="exportCSV($event)"
                            />
                        </div>
                    </template>
                    <Column
                        field="vehicle.license_plate"
                        header="Tractor / Trailer"
                        style="min-width: 15rem"
                    />
                    <Column
                        field="driver.first_name"
                        header="First name"
                        style="min-width: 15rem"
                    />
                    <Column
                        field="driver.last_name"
                        header="Last name"
                        style="min-width: 15rem"
                    />
                    <Column
                        field="total_refuel"
                        header="Liters"
                        style="min-width: 15rem"
                    />
                    <Column
                        field="amount"
                        header="Cost"
                        style="min-width: 15rem"
                    />
                    <Column
                        field="refueling_date"
                        header="Date"
                        style="min-width: 15rem"
                    />
                </DataTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage, router } from "@inertiajs/vue3";
import { ref } from "vue";
import DatePicker from "primevue/datepicker";
import AutoComplete from "primevue/autocomplete";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import InputNumber from "primevue/inputnumber";

const { filters } = usePage().props;

// Reactive form data
const form = useForm({
    start_date: filters?.start_date || null,
    end_date: filters?.end_date || null,
    vehicle: filters?.vehicle || null,
    driver: filters?.driver || null,
    liters: filters?.liters || null,
    min_cost: filters?.min_cost || null,
    max_cost: filters?.max_cost || null,
});
// Variables for input fields
const dt = ref();
const vehicle = ref(null);
const driver = ref(null);
const dates = ref(null);
const isDisabled = ref(true);

const props = defineProps({
    fuelFilter: {
        type: Object,
        required: true,
    },
    tractor: {
        type: Array,
        required: true,
    },
    driver: {
        type: Array,
        required: true,
    },
});

const submitForm = () => {
    if (dates.value && dates.value.length === 2) {
        form.start_date = dates.value[0]; // First selected date
        form.end_date = dates.value[1]; // Last selected date
    } else {
        form.start_date = null;
        form.end_date = null;
    }

    form.vehicle = vehicle.value;
    form.driver = driver.value;

    // Send request to fetch filtered data
    form.get(route("reports.fuelfilter"));
    isDisabled.value = false;
};

// Driver and Vehicle lists

const vehicles = ref([]);
const drivers = ref([]);

// Search filters

const searchVehicles = (event) => {
    const query = event.query.toLowerCase();
    vehicles.value = props.tractor.filter(
        (v) => v.license_plate.toLowerCase().includes(query) // Change "name" to the correct property
    );
};

const searchDrivers = (event) => {
    const query = event.query.toLowerCase();
    drivers.value = props.driver.filter(
        (v) => v.full_name.toLowerCase().includes(query) // Change "name" to the correct property
    );
};

const exportCSV = () => {
    dt.value.exportCSV();
};

const exportPDF = () => {
    const fuelData = props.fuelFilter.map((fuel) => ({
        vehicle: fuel.vehicle.license_plate,
        first_name: fuel.driver?.first_name ?? "",
        last_name: fuel.driver?.last_name ?? "",
        liters: fuel.total_refuel ?? "",
        amount: fuel?.amount ?? "",
        date: fuel?.refueling_date ?? "",
    }));

    axios
        .post(
            route("reports.fuelpdf"),
            { fuels: fuelData },
            { responseType: "blob" }
        )
        .then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", "fuel_report.pdf");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        })
        .catch((error) => {
            console.error("PDF export failed", error);
        });
};

const refresh = () => {
    router.get("/reports/fuel");
    isDisabled.value = false;
};
</script>
