<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Fuel Report
            </h2>
        </template>
        <div class="py-4">
            <div class="mx-12">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-md p-4"
                >
                    <div class="card flex justify-center mb-5">
                        <DatePicker
                            v-model="dates"
                            selectionMode="range"
                            :manualInput="false"
                            placeholder="Select Date Range"
                            showIcon
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
                    />

                    <!-- Data Table -->
                    <DataTable
                        :value="fuelFilter"
                        ref="dt"
                        tableStyle="min-width: 50rem"
                        class="mt-6"
                    >
                        <template #header>
                            <div class="text-end pb-4">
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
                        />
                        <Column field="fuel_type" header="Fuel Type" />
                        <Column field="liters" header="Liters" />
                        <Column field="cost" header="Cost" />
                        <Column field="refueling_date" header="Date" />
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
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
    liters: filters?.liters || null,
    min_cost: filters?.min_cost || null,
    max_cost: filters?.max_cost || null,
});
// Variables for input fields
const dt = ref();
const vehicle = ref(null);
const dates = ref(null);

const props = defineProps({
    fuelFilter: {
        type: Object,
        required: true,
    },
    tractor: {
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

    // Send request to fetch filtered data
    form.get(route("reports.fuelfilter"));
};

// Driver and Vehicle lists

const vehicles = ref([]);

// Search filters

const searchVehicles = (event) => {
    const query = event.query.toLowerCase();
    vehicles.value = props.tractor.filter(
        (v) => v.license_plate.toLowerCase().includes(query) // Change "name" to the correct property
    );
};

const exportCSV = () => {
    dt.value.exportCSV();
};
</script>
