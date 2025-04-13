<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Route Report
            </h2>
        </template>
        <div class="py-4 px-4 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md p-4">
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
                    <AutoComplete
                        v-model="driver"
                        dropdown
                        :suggestions="drivers"
                        optionLabel="full_name"
                        @complete="searchDrivers"
                        placeholder="Select Driver"
                    />

                    <!-- Vehicle Selection -->
                    <AutoComplete
                        v-model="vehicle"
                        dropdown
                        :suggestions="vehicles"
                        optionLabel="license_plate"
                        @complete="searchVehicles"
                        placeholder="Select Vehicle"
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
                    :value="routes"
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
                    />
                    <Column field="driver.first_name" header="First Name" />
                    <Column field="driver.last_name" header="Last Name" />
                    <Column field="start_date" header="Trip Date" />
                    <Column field="end_location.address" header="Location" />
                </DataTable>
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

const { filters } = usePage().props;

// Reactive form data
const form = useForm({
    start_date: filters?.start_date || null,
    end_date: filters?.end_date || null,
    driver: filters?.driver || null,
    vehicle: filters?.vehicle || null,
});

// Variables for input fields
const dt = ref();
const driver = ref(null);
const vehicle = ref(null);
const dates = ref(null);
console.log(dates.value);

const props = defineProps({
    routes: {
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

    form.driver = driver.value;
    form.vehicle = vehicle.value;

    // Send request to fetch filtered data
    form.get(route("reports.routesfilter"));
};

// Driver and Vehicle lists
const drivers = ref([]);
const vehicles = ref([]);

// Search filters
const searchDrivers = (event) => {
    const query = event.query.toLowerCase();
    drivers.value = props.driver.filter((d) =>
        d.full_name.toLowerCase().includes(query.toLowerCase())
    );
    console.log(drivers.value);
};

const searchVehicles = (event) => {
    const query = event.query.toLowerCase();
    vehicles.value = props.tractor.filter(
        (v) => v.license_plate.toLowerCase().includes(query) // Change "name" to the correct property
    );
};

const exportCSV = () => {
    dt.value.exportCSV();
};

const exportPDF = () => {
    const routesData = props.routes.map((route) => ({
        end_date: route.end_date,
        first_name: route.driver?.first_name ?? "",
        last_name: route.driver?.last_name ?? "",
        license_plate: route.vehicle?.license_plate ?? "",
        location: route.end_location?.address ?? "",
    }));

    axios
        .post(
            route("reports.routespdf"),
            { routes: routesData },
            { responseType: "blob" }
        )
        .then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", "route_report.pdf");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        })
        .catch((error) => {
            console.error("PDF export failed", error);
        });
};
</script>
