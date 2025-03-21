<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Maintenance Report
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
                            placeholder="Select Tractor"
                        />
                        <AutoComplete
                            v-model="trailer"
                            dropdown
                            :suggestions="trailers"
                            optionLabel="license_plate"
                            @complete="searchTrailer"
                            placeholder="Select Trailer"
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
                    <div class="w-full">
                        <InputText
                            id="manufacturer_year"
                            type="text"
                            placeholder="Supplier"
                            v-model="form.supplier"
                            class="w-full"
                        />
                    </div>
                    <Button
                        @click="submitForm"
                        label="Generate Report"
                        class="p-button-primary w-full mt-5"
                    />

                    <!-- Data Table -->
                    <DataTable
                        :value="maintenanceFilter"
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
                            header="Tractor"
                        />
                        <Column
                            field="trailer.license_plate"
                            header="Trailer"
                        />
                        <Column
                            field="item_description"
                            header="Item and Description"
                        />
                        <Column field="price" header="Price" />
                        <Column field="total" header="Total" />
                        <Column field="supplier" header="Supplier" />
                        <Column
                            field="breakdown_date"
                            header="Breakdown Date"
                        />
                        <Column field="up_date" header="Up date" />
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
import InputText from "primevue/inputtext";

const { filters } = usePage().props;

// Reactive form data
const form = useForm({
    start_date: filters?.start_date || null,
    end_date: filters?.end_date || null,
    vehicle: filters?.vehicle || null,
    trailer: filters?.trailer || null,
    supplier: filters?.supplier || null,
    min_cost: filters?.min_cost || null,
    max_cost: filters?.max_cost || null,
});
// Variables for input fields
const dt = ref();
const vehicle = ref(null);
const trailer = ref(null);
const dates = ref(null);

const props = defineProps({
    maintenanceFilter: {
        type: Object,
        required: true,
    },
    tractor: {
        type: Array,
        required: true,
    },
    trailer: {
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
    form.trailer = trailer.value;

    // Send request to fetch filtered data
    form.get(route("reports.maintenancefilter"));
};

// Driver and Vehicle lists
const trailers = ref([]);
const vehicles = ref([]);

// Search filters
const searchDrivers = (event) => {
    const query = event.query.toLowerCase();
    drivers.value = ["Rigor Dimayuga", "Jonas Smitman", "Luis Manzano"].filter(
        (d) => d.toLowerCase().includes(query)
    );
};

const searchVehicles = (event) => {
    const query = event.query.toLowerCase();
    vehicles.value = props.tractor.filter(
        (v) => v.license_plate.toLowerCase().includes(query) // Change "name" to the correct property
    );
};

const searchTrailer = (event) => {
    const query = event.query.toLowerCase();
    trailers.value = props.trailer.filter(
        (v) => v.license_plate.toLowerCase().includes(query) // Change "name" to the correct property
    );
};

const exportCSV = () => {
    dt.value.exportCSV();
};
</script>
