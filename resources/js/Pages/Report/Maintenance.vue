<template>
    <Head title="Route" />
    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Maintenance Report
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
                    />
                    <Button
                        icon="pi pi-refresh"
                        label="Refresh"
                        class="w-[100px]"
                        @click="refresh"
                    />
                </div>
                <div class="flex flex-row gap-x-8 mb-6">
                    <div class="flex items-center gap-2">
                        <RadioButton
                            v-model="truck"
                            inputId="ingredient1"
                            name="truck"
                            value="1"
                        />
                        <label for="ingredient1">TRACTOR HEAD</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <RadioButton
                            v-model="truck"
                            inputId="ingredient2"
                            name="truck"
                            value="2"
                        />
                        <label for="ingredient2">TRAILER</label>
                    </div>
                </div>
                <div class="mb-4">
                    <!-- Vehicle Selection -->
                    <AutoComplete
                        v-if="truck === '1'"
                        v-model="vehicle"
                        dropdown
                        :suggestions="vehicles"
                        optionLabel="license_plate"
                        @complete="searchVehicles"
                        placeholder="Select Tractor"
                        class="w-full"
                    />
                    <AutoComplete
                        v-else
                        v-model="trailer"
                        dropdown
                        :suggestions="trailers"
                        optionLabel="license_plate"
                        @complete="searchTrailer"
                        placeholder="Select Trailer"
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
                    class="p-button-primary w-full my-5"
                />
                <p class="text-red-600">
                    Add Modal the content paper size and paper orientation
                </p>

                <!-- Data Table -->
                <DataTable
                    :value="maintenanceFilter"
                    paginator
                    :rows="5"
                    :rowsPerPageOptions="[5, 10, 20, 50]"
                    tableStyle="min-width: 50rem"
                    ref="dt"
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
                        :field="
                            truck === '1'
                                ? 'vehicle.license_plate'
                                : 'trailer.license_plate'
                        "
                        :header="truck === '1' ? 'Tractor' : 'Trailer'"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="item_description"
                        header="Item and Description"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="price"
                        header="Price"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="total"
                        header="Total"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="supplier"
                        header="Supplier"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="breakdown_date"
                        header="Breakdown Date"
                        style="width: 15%"
                    ></Column>
                    <Column
                        field="up_date"
                        header="Up date"
                        style="width: 15%"
                    ></Column>
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
import InputText from "primevue/inputtext";
import RadioButton from "primevue/radiobutton";

const { filters } = usePage().props;

const truck = ref("1"); // Tracks selected vehicle type

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
    form.get(route("reports.maintenancefilter"), {
        preserveState: true,
        preserveScroll: true,
    });
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

const exportPDF = () => {
    const maintenanceData = props.maintenanceFilter.map((maintain) => ({
        vehicle: maintain.vehicle?.license_plate ?? "",
        trailer: maintain.trailer?.license_plate ?? "",
        item: maintain?.item_description ?? "",
        price: maintain?.price ?? "",
        total: maintain?.total ?? "",
        supplier: maintain?.supplier ?? "",
        breakdown: maintain?.breakdown_date ?? "",
        up: maintain?.up_date ?? "",
    }));

    axios
        .post(
            route("reports.maintenancepdf"),
            { maintenance: maintenanceData },
            { responseType: "blob" }
        )
        .then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", "maintenance_report.pdf");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        })
        .catch((error) => {
            console.error("PDF export failed", error);
        });
};

const refresh = () => {
    router.get("/reports/maintenance");
};
</script>
